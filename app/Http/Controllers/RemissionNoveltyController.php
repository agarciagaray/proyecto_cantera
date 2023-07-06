<?php

namespace App\Http\Controllers;

use App\Exports\RemissionNovExportList;
use App\Models\Client;
use App\Models\Construction;
use App\Models\RemissionNovelty;
use App\Models\RemissionConceptNovelty;
use App\Models\Material;
use App\Models\PreSettlement;
use App\Models\PriceList;
use App\Models\Remission;
use App\Models\RemissionModel;
use App\Models\RemissionNoveltyModel;
use App\Models\Society;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RemissionNoveltyController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase RemissionNovelty
     * para utilizarlo en los métodos de la clase RemissionController
     */
    protected $remissionnovs;
    protected $remissionconcnovs;
    protected $materials;

    public function __construct(RemissionNovelty $remissionnovs, RemissionConceptNovelty $remissionconcnovs, Material $materials)
    {
        $this->remissionnovs = $remissionnovs;
        $this->remissionconcnovs = $remissionconcnovs;
        $this->materials = $materials;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remissionnovs = RemissionNovelty::orderBy('id', 'DESC')->get();
        $remissions = Remission::get();
        $materials = Material::where('mate_estado', 'A')->get();
        $clients = Client::where('client_estado', 'A')->get();
        $societies = Society::where('soci_estado', 'A')->get();
        $remissionconcnovs = RemissionConceptNovelty::where('cncn_estado', 'A')->get();
        return view('remissionnovelties.index', compact('remissionnovs', 'materials', 'remissions', 'clients', 'societies', 'remissionconcnovs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $remissionnovelty = RemissionNovelty::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('remissionnovelties.show', compact('remissionnovelty'));
        } else {

            $remissions = Remission::where('remi_estado', 'A')->get();
            $remissionconcnovs = RemissionConceptNovelty::where('cncn_estado', 'A')->get();
            $materials = Material::where('mate_estado', 'A')->get();
            $clients = Client::where('client_estado', 'A')->get();
            return view('remissionnovelties.form', compact('remissionnovelty', 'materials', 'remissionconcnovs', 'remissions', 'clients'));
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
        $data = $request->all();
        $data['id_user'] = Auth::id();

        $preSettlement = PreSettlement::where('id_remission', $data['rmnv_idremision'])->first();
        if ($preSettlement) {

            return response()->json(['message' => "La remisión #" . $data['rmnv_idremision'] . ", ya esta en preliquidación no se le puede agregar novedades."], 500);
        }

        $remission = Remission::find($data['rmnv_idremision']);

        $newValue = [];
        // return response()->json($remission->detailRemissions ,500 );
        // if(count($remission->detailRemissions)>0){
        // }
        foreach ($remission->detailRemissions as $value) {
            $newValue["dtrm_precio"] = $value->dtrm_precio;
            $newValue["dtrm_idmaterial"] =$value->dtrm_idmaterial;
        }

        $constructor = Construction::find($remission->id_obra);

        $priceList = PriceList::where('id_material', $newValue["dtrm_idmaterial"])
        ->where('id_obra',$remission->id_obra)
        ->where('id_unmedida',2)->first();



        $data["rmnv_valor_subtotal"] = $newValue["dtrm_precio"] * $data["rmnv_nuevovalor"];
        $data["rmnv_valor_transporte"] = $data["rmnv_valor_subtotal"] * $constructor->obra_porctransporte / 100;
        $data["rmnv_valor_suministro"] = $data["rmnv_valor_subtotal"] * $constructor->obra_porcsuministro / 100;
        $data["rmnv_valor_iva"] = $data["rmnv_valor_suministro"]  *   $priceList->iva/100;

        $date = new Carbon();
        $date = $date->format('Y-m-d');

        $data["nov_fecha"] =$date ;

        $validate = RemissionNoveltyModel::getValidator($data);
        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        $remissionNovelty = RemissionNoveltyModel::saveRemissionNovelty($data);

        $remissionnovs = RemissionNovelty::orderBy('id', 'DESC')->get();

        //dd($remissionnovs);
        return view('remissionnovelties.trRemissionnovelties', ['remissionnovs' => $remissionnovs]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remission  $remission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $remissionnovelty = RemissionNovelty::find($request->idRemissionNovelty);

        if (count($remissionnovelty->Remission->PreSettlement)>0) {

            return response()->json(['message' => "La novedad de remisión #" .$request->idRemissionNovelty . ", no se puede inabilitar ya que está asociada a una remisión que ya cuenta con preliquidación."], 500);
        }

        $remissionnovelty = RemissionNovelty::find($request->idRemissionNovelty);
        $remissionnovelty->rmnv_estado = 'I';
        $remissionnovelty->save();

        $remissionnovs = RemissionNovelty::orderBy('id', 'DESC')->get();

        return view('remissionnovelties.trRemissionnovelties', ['remissionnovs' => $remissionnovs]);
    }

    public function filterRemissionNov(Request $request)
    {

        $remissionNovs  = RemissionNovelty::query();

        if(!is_null($request->idConstruction)){

            $remissionNovs->whereHas('Remission', function ($query) use ( $request) {
                $query->whereHas('Construction', function ($query1) use ( $request) {
                    $query1->where('id',$request->idConstruction);
                });
            });
        }


        if (!is_null($request->rmnv_idremision)) {

            $remissionNovs->where('rmnv_idremision', $request->rmnv_idremision);
        }
        if (!is_null($request->conceptNoveltyRemission)) {

            $remissionNovs->where('rmnv_idconcepto', $request->conceptNoveltyRemission);
        }
        if (!is_null($request->dateStart) && is_null($request->dateEnd)) {

            $remissionNovs->where('nov_fecha', $request->dateStart);
        }
        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $remissionNovs->where('nov_fecha','>=',$request->dateStart)->where('nov_fecha','<=', $request->dateEnd);
        }

        // return response()->json($remissionNovs->get());


        // Log::channel('stderr')->info('$remissionNovs');
        //Log::channel('stderr')->info($remissionNovs);
        $remissionNovs = $remissionNovs->get();
        // dd($remissionNovs);
        if (isset($request->export) == "true") {
            $date = date("d") . " del " . date("m") . " de " . date("Y");
            return Excel::download(new RemissionNovExportList($remissionNovs), "Remisiones $date.xlsx");
        } else {

            return view('remissionnovelties.trRemissionnovelties', ['remissionnovs' => $remissionNovs]);
        }
    }
}
