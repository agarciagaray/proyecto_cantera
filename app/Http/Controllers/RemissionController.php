<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Construction;
use App\Models\Machine;
use App\Models\Remission;
use App\Models\RemissionModel;
use App\Models\RemissionDetail;
use App\Models\Material;
use App\Models\PriceList;
use App\Models\ProductionModel;
use App\Models\Society;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RemissionExportList;
use App\Exports\RemissionLiquidatedExport;
use App\Exports\RemissionSettlementExport;
use App\Models\PreSettlement;
use App\Models\Production;
use App\Models\RemissionNovelty;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class RemissionController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase Remission
     * para utilizarlo en los métodos de la clase RemissionController
     */
    protected $remissions;
    protected $remissionsdetails;
    protected $materials;
    protected $units;

    public function __construct(Remission $remissions, RemissionDetail $remissionsdetails, Material $materials, Unit $units)
    {
        $this->remissions           = $remissions;
        $this->remissionsdetails    = $remissionsdetails;
        $this->materials            = $materials;
        $this->units                = $units;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients  = Client::where('client_estado', 'A')->get();
        $constructions  = Construction::where('obra_estado', 'A')->get();
        $societies  = Society::where('soci_estado', 'A')->get();
        $remissions = Remission::orderBy('id', 'DESC')->get();
        $remissionsdetails = $this->remissionsdetails->getRemissionsDetails();
        $materials = $this->materials->getMaterials();
        $units = $this->units->getUnits();
        $machines =  Machine::where('maqn_estado', 'A')->get();
        //dd($remissions);
        return view('remissions.index', ['clients' => $clients, 'constructions' => $constructions, 'societies' => $societies, 'remissions' => $remissions, 'remissionsdetails' => $remissionsdetails, 'materials' => $materials, 'units' => $units, 'machines' =>  $machines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $remission = Remission::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('remissions.show', compact('remission'));
        } else {
            // $remissionstypes = $this->remissionstypes->getremissionsTypes();
            // $units = $this->units->getUnits();
            $remissions = Remission::where('id_tipopago')->get();
            $machines =  Machine::where('maqn_estado', 'A')->get();
            $constructions = Construction::where('obra_estado', 'A')->get();
            $materials = $this->materials->getMaterials();//Referencia para tomar material 
            $societies = Society::where('soci_estado', 'A')->get();
            $units = $this->units->getUnits();
            $clients = Client::where('client_estado', 'A')->get();

            $pago= [

                [
                  'label' => 'CONTADO',
                  'value' => '1'
                ],
          
                [
                  'label' => 'CREDITO',
                  'value' => '2'
                ],
                [
                    'label' => 'TRANSFERENCIA',
                    'value' => '3'
                  ]
          
          
              ];
                                                        //Referencia para tomar material 
            
            return view('remissions.form', compact('remission', 'materials', 'units', 'constructions', 'societies', 'clients', 'machines','pago'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

            $data = $request->data;
            $detailremissions = $request->remissions;
            $message = null;
            $date_detail = Carbon::now();
            $volumen = [];
            $remission = Remission::where('num_remission', $data['numRem'])->first();

            if ($remission) {
                return response()->json(['message' => "El número de remisión ya existe, vuelve a intentarlo"], 500);
            }
            foreach ($detailremissions as $detail) {

                $volumen = ProductionModel::validateExitProduction($detail['dtrm_idmaterial']);

                if ($volumen['available'] == 0) {
                    $message = "No tenemos inventario de este material";
                }

                if ($request->prod_volumen > $volumen['available']) {
                    $message = "El volumén ingresado supera lo disponible en el momento";
                }
            }
            if (!is_null($message) > 0) {
                return response()->json(['message' => $message,'data'=>$volumen], 500);
            }

            $construction = Construction::find($data['idObra']);

            // Creo los datos de remision
            $remissionData = [];
            $remissionData['id_obra']       = $data['idObra'];
            $remissionData['id_society']   = $data['idSoc'];
            $remissionData['remi_fecha']        = $data['fecha'];
            $remissionData['remi_obs']          = $data['obs'];
            $remissionData['num_remission']          = $data['numRem'];
            $remissionData['total']          = $data['totalRemission'];
            $remissionData['id_machine']          = $data['id_machine'];
          //  $remissionData['destiny']          = $data['destiny']; // Cambiar por direccion
            $remissionData['id_tipopago']          = $data['id_tipopago'];
            $remissionData['rem_porc_trans']          = $construction->obra_porctransporte;
            $remissionData['rem_porc_sum']          = $construction->obra_porcsuministro;
            $remissionData['id_user']           = Auth::id();

            $validate = RemissionModel::getValidator($remissionData);

            if ($validate->fails()) {

                return response()->json(['errors' => $validate->errors()], 500);
            }

             $remission = Remission::create($remissionData);



            foreach ($detailremissions as $detail) {

                $detail['dtrm_idremision'] = $remission->id;

                $priceList = PriceList::where('id_material', $detail['dtrm_idmaterial'])->first();

                $detail['subtotal']  =  $detail['dtrm_cantdespachada']  * $detail['dtrm_precio'];
                $detail['transporte'] =  $detail['subtotal']  *  $construction->obra_porctransporte / 100;
                $detail['suministro'] =  $detail['subtotal']  * $construction->obra_porcsuministro / 100;
                $detail['valor_iva']  = $detail['suministro'] * $priceList->iva / 100;
                $detail['date_detail']  =  $date_detail->format('Y-m-d');

                $volumen = ProductionModel::validateExitProduction($detail['dtrm_idmaterial']);

                if ($volumen['available'] == 0) {
                    $message = "No tenemos inventario de este material";
                }

                if ($request->prod_volumen > $volumen['available']) {
                    $message = "El volumén ingresado supera lo disponible en el momento";
                }
                if ($detail['dtrm_cantdespachada'] < 0) {
                    $message = "La cantidad ingresada debe ser mayor a cero";
                }

                if (is_null($message)) {
                    RemissionDetail::create($detail);
                }
            }
            if (!is_null($message) > 0) {
                DB::rollBack();
                return response()->json(['message' => $message], 500);
            }
           // Log::channel('stderr')->info( $detailremissions);

            // Obtengo los datos nuevamente para mostrarlos en el listado
            $remissions =   Remission::orderBy('id', 'DESC')->get();
            DB::commit();


            return view('remissions.trBodyRemission', ['remissions' => $remissions]);


        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 500);
            //throw $th;
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remission  $remission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
        $remission = Remission::find($request->id);
        $remission->remi_estado = 'I';
        //$remission->save();
        $remission->update();
        $remissions = Remission::orderBy('id', 'DESC')->get();
        return view('remissions.trBodyRemission', ['remissions' => $remissions]);
    }

    public function trRemission(Request $request)
    {
        // $data = $request->all();

        $data = PriceList::where('id_obra', $request->id_obra)->where('id_material', $request->id_material)->first();

        $count = $request->count;

        return view('remissions.trRemission', compact('data', 'count'));
    }

    public function listInvoiceAssignment(Request $request)
    {
        $remissions = Remission::query();

        // $constructions  = Construction::orderBy('id', 'DESC')->get();
        $remissions->where('remi_estado', '=', 'A');
        $clients = Client::where('client_estado', 'A')->get();
        if ($request->statusInvoice == 'PL') {
            if (isset($request->dateStart) && isset($request->dateEnd) && !$request->dateEnd) {

                $remissions->whereDate('remi_fecha', $request->dateStart);
            }
            if (isset($request->dateStart) && isset($request->dateEnd)) {

                $remissions->where('remi_fecha','>=',$request->dateStart)->where('remi_fecha','<=', $request->dateEnd);
            }

            if (isset($request->idConstruction) && $request->idConstruction) {

                $remissions->where('id_obra', $request->idConstruction);
            }

            $remissions->where('remi_numfactura', '=', '');


            return view('invoices.trInvoiceAssignment', ['remissions' => $remissions->doesnthave('PreSettlement')->get()]);
        }

        $remissions->whereNotNull('remi_numfactura');
        // $remissions->where('remi_estado', '=', 'A');

        if ($request->statusInvoice == 'L') {
            if (isset($request->dateStart) && isset($request->dateEnd) && !$request->dateEnd) {

                $remissions->whereDate('remi_fecha', $request->dateStart);
            }
            if (isset($request->dateStart) && isset($request->dateEnd)) {

                $remissions->whereBetween('remi_fecha', [$request->dateStart, $request->dateEnd]);
            }

            if (isset($request->idConstruction) && $request->idConstruction) {

                $remissions->where('id_obra', $request->idConstruction);
            }

            return view('invoices.trInvoiceAssignment', ['remissions' =>  $remissions->get()]);
        }

        return view('invoices.InvoiceAssignment', ['remissions' => $remissions->get(), 'clients' => $clients, 'request' => $request]);
    }
//----------------------------------------------------------------------------------------------------
    public function saveInvoiceAssignment(Request $request)
    {


        //dd($request->all());
        if ($request->type == 'PL') {
            Log::channel('stderr')->info('$request->type == PL');
            foreach ($request->remissionAssigns as $value) {

                $pre = PreSettlement::where('id_remission', $value["id"])->first();
                if ($pre) continue;
                $date = Carbon::now();

                $preSettlement = new PreSettlement;
                $preSettlement->dateStart = $request->dateStart;
                $preSettlement->dateEnd = $request->dateEnd;
                $preSettlement->id_construction = $request->idConstruction;
                $preSettlement->id_remission =  $value["id"];
                $preSettlement->date =  $date->format('Y-m-d');
                $preSettlement->save();
            }
        }
        
        else {
            Log::channel('stderr')->info('$request->type diferente PL');
            foreach ($request->remissionAssigns as $value) {

                $remission =  RemissionModel::getRemission($value["id"]);
                $remission->remi_numfactura = $request->remi_numfactura;
                $remission->save();
                $pre = PreSettlement::where('id_remission', $value["id"])->first();
                $pre->status = 'F';
                $pre->save();
            }
        }
    }



//--------------------------------------------------------------------------------------------------


//---------------------------------------------------


    public function exportlistInvoiceAssignment(Request $request)
    {

        $remissions  = null;
        if ($request->preSettlement =="false") {
            $nameNew = 'Liquidación' . '_' . $request->idConstruction . '_' . $request->dateStart . '_' . $request->dateEnd;
            $name = "$nameNew.xlsx";
            $remissions = DB::select("call sp_consulta_novedades_liquidada($request->idConstruction, 1, 2, 3,'$request->dateStart', '$request->dateEnd')");

            return Excel::download(new RemissionLiquidatedExport($remissions), $name);

        }


        $nameNew = 'Preliquidación' . '_' . $request->idConstruction . '_' . $request->dateStart . '_' . $request->dateEnd;
        $name = "$nameNew.xlsx";


        if(isset($request->pre_settlement_management) && $request->pre_settlement_management =="true"){
            $remissions = DB::select("call sp_consulta_novedades_manejo($request->idConstruction, 1, 2, 3,'$request->dateStart', '$request->dateEnd')");
        }else{
            $remissions = DB::select("call sp_consulta_novedades($request->idConstruction, 1, 2, 3,'$request->dateStart', '$request->dateEnd')");
        }

           return Excel::download(new RemissionSettlementExport($remissions), $name);

        // return view('invoices.excel.index', ['remissions' =>  $remissions]);

    }

    public function detailRemission(Request $request)
    {
        $remission = RemissionModel::getRemission($request->idRemission);
        $material = $request->material;
        $details = $remission->detailRemissions;
        return view('remissions.detailRemission', compact('details', 'remission', 'material'));
    }
    public function cancelRemission(Request $request)
    {

        $remissionValidate = DB::select('select id from remissions where id = ? and id in (select id_remission from settlementremissions)',[$request->idRemission]);

        if(count($remissionValidate)>0){

            return response()->json(['message' => "No se puede anular la remisión, ya que tiene una preliquidación"], 500);
        }

        $remission =  RemissionModel::getRemission($request->idRemission);


        if ($remission->remi_numfactura) {

            return response()->json(['message' => "No se puede anular la remisión, ya que tiene una factura asignada"], 500);
        } else {

            $remission->remi_estado = 'AN';
            $remission->save();

            $remissions =   Remission::orderBy('id', 'ASC')->get();
            return view('remissions.trBodyRemission', ['remissions' => $remissions]);
        }
    }

    public function referralReceipt(Request $request)// Aqui se modifica lo que va a salir en el pdf.
    {
        $user = Auth::user();

        $remission =  RemissionModel::getRemission($request->idRemission);
        $remission_nov_vol = RemissionNovelty::where('rmnv_idconcepto',2)->where('rmnv_idremision',$request->idRemission)->select('rmnv_nuevovalor')->latest()->first();
        $remission_nov_date = RemissionNovelty::where('rmnv_idconcepto',3)->where('rmnv_idremision',$request->idRemission)->select('rmnv_fecha')->latest()->first();
        $remission_nov_client = RemissionNovelty::where('rmnv_idconcepto',1)->where('rmnv_idremision',$request->idRemission)->latest()->first();

        $pdf = PDF::loadView('reports.referral_receipt', compact('remission','user', 'remission_nov_date','remission_nov_vol','remission_nov_client'));
        $name = "Recibo_de_remisión_$remission->id.pdf";
        return $pdf->stream($name);
    }
    public function filterRemission(Request $request)
    {

        $remissions  = Remission::query();

        if(isset($request->notCancelled) && $request->notCancelled =="on"){
            $remissions->where('remi_estado', 'A');
        }

        if (!is_null($request->idSociety) && $request->idSociety != 0) {
            $remissions->where('id_society', $request->idSociety);
        }
        if (!is_null($request->idConstruction) && $request->idConstruction != 0) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->where('id', $request->idConstruction);
            });
        }

        if (!is_null($request->idClient)) {
            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($queryC) use ($request) {
                    $queryC->where('id', $request->idClient);
                });
            });
        }

        if (!is_null($request->idMachine)) {
            $remissions->where('id_machine', $request->idMachine);
        }
        if (!is_null($request->dateStart) && is_null($request->dateEnd)) {
            $remissions->where('remi_fecha', $request->dateStart);
        }
        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $remissions->whereBetween('remi_fecha', [$request->dateStart, $request->dateEnd]);
        }

        $remissions = $remissions->get();
        // dd($remissions);
        if (isset($request->export) == "true") {
            $date = date("d") . " del " . date("m") . " de " . date("Y");
            return Excel::download(new RemissionExportList($remissions), "Remisiones $date.xlsx");
        } else {

            return view('remissions.trBodyRemission', ['remissions' => $remissions]);
        }
    }

    public function listLiquidationRemission(Request $request)
    {

        // return response()->json($request->all());
        $preSettlements = PreSettlement::query();

        $preSettlements->whereDoesntHave('Remission', function ($query) use ($request) {
            $query->where('remi_numfactura', '!=', '');
        });

        if (isset($request->dateStart) && !$request->dateEnd) {
            $preSettlements->whereDate('date', $request->dateStart);
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $preSettlements->whereBetween('date',[$request->dateStart,$request->dateEnd]);

        }

        if (isset($request->idConstruction) && $request->idConstruction) {
            $preSettlements->where('id_construction', $request->idConstruction);
        }

        $preSettlements->where('status','SF');

        if (isset($request->filter) && $request->filter) {

            return view('invoices.trAssignmentReSettlement', ['remissions' =>  $preSettlements->get()]);
        }

        $clients = Client::where('client_estado', 'A')->get();


        return view('invoices.liquidationRemission', ['remissions' => $preSettlements, 'clients' => $clients]);
    }
}
