<?php

namespace App\Http\Controllers;

use App\Exports\CommodiesProductionExport;
use App\Exports\MachineMovExport;
use App\Exports\MaterialExport;
use App\Exports\MaterialOverviewExport;
use App\Exports\MaterialOverviewSocietyExport;
use App\Exports\ProductionExport;
use App\Exports\RemissionExport;
use App\Exports\RemissionToLiquidareExport;
use App\Models\Client;
use App\Models\Commodity;
use App\Models\Construction;
use App\Models\Drivers;
use App\Models\Machine;
//use App\Models\Drivers;
use App\Models\MachineMov;
use App\Models\MachineTanking;
use App\Models\Material;
use App\Models\Production;
use App\Models\Remission;
use App\Models\RemissionNovelty;
use App\Models\Society;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use Excel;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class ReportController extends Controller
{

    public function index(Request $request)
    {

        // dd($request->all());
        $machines = Machine::all();

        $inventories = MachineTanking::query();

        if (isset($request->search) && !is_null($request->search)) {
            $inventories->whereHas('Machine', function ($query) use ($request) {
                $query->where("maqn_placa",  $request->search);
            });
        }

        if (isset($request->searchOrigin) && !is_null($request->searchOrigin)) {
            $inventories->whereHas('MachineCub', function ($query) use ($request) {
                $query->where("maqn_placa",  $request->searchOrigin);
            });
        }


        if (isset($request->dateStart) && !is_null($request->dateStart)) {
            $inventories->whereDate('tanq_fecha', $request->dateStart);
        }

        if ((isset($request->dateStart) && !is_null($request->dateStart)) && (isset($request->dateEnd) && !is_null($request->dateEnd))) {
            $inventories->where('tanq_fecha', '>=', $request->dateStart)->where('tanq_fecha', '<=', $request->dateEnd);
        }

        if (isset($request->tanq_origen) && !is_null($request->tanq_origen)) {
            $inventories->where('tanq_origen', $request->tanq_origen);
        }
        if (isset($request->tanq_unidad) && !is_null($request->tanq_unidad)) {
            $inventories->where('tanq_unidad', $request->tanq_unidad);
        }

        $count = $inventories->count();
        $inventories = $inventories->get();

        if ($count > 0) {

            return view('reports.index', compact('machines', 'request', 'inventories'));
        } else {

            Session::forget('info_message');
            Session::flash('info_message', 'No se puede generar un reporte, porque no tenemos información al respecto');
            return view('reports.index', compact('inventories', 'machines', 'request'));
            // return redirect()->route('reports','machines', 'inventories');
        }
    }

    public function reportDocument(Request $request)
    {
        Session::forget('info_message');
        $inventories = MachineTanking::query();
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $user = Auth::user();
        if (isset($request->search)) {

            $inventories->whereHas('Machine', function ($query) use ($request) {
                $query->where("maqn_placa",  $request->search);
            });
        }
        if (isset($request->searchOrigin)) {

            $inventories->whereHas('MachineCub', function ($query) use ($request) {
                $query->where("maqn_placa",  $request->searchOrigin);
            });
        }


        if (isset($request->dateStart)) {
            $inventories->where('tanq_fecha', $request->dateStart);
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {
            $inventories->where('tanq_fecha', '>=', $request->dateStart)->where('tanq_fecha', '<=', $request->dateEnd);
        }

        if (isset($request->tanq_origen)) {
            $inventories->where('tanq_origen', $request->tanq_origen);
        }
        if (isset($request->tanq_unidad)) {
            $inventories->where('tanq_unidad', $request->tanq_unidad);
        }


        $inventories = $inventories->orderBy('id', 'DESC')->get();

        if (count($inventories) == 0) {
            Session::flash('info_message', 'No se puede generar un reporte, porque no tenemos información al respecto');
            return redirect()->route('reports');
        } else {
            $pdf = PDF::loadView('reports.report', compact('inventories', 'date', 'user', 'request'));
            return $pdf->stream("report_$date");
            // $name = "Reporte $date.pdf";
            // return $pdf->download($name);
        }
    }
    public function reportRemissions(Request $request)
    {

        $remissions  = Remission::query();
        Session::forget('info_message');
        if (!is_null($request->idConstruction)) {

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
        if (!is_null($request->idSociety)) {
            $remissions->whereHas('Society', function ($query) use ($request) {

                $query->where('id_society', $request->idSociety);
            });
        }


        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $remissions->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
        }
        if (!is_null($request->stateInvoice)) {
            if ($request->stateInvoice == 1) {
                $remissions->where('remi_numfactura', '!=', '');
            }

            if ($request->stateInvoice == 0) {
                $remissions->where('remi_numfactura', '=', '');
            }
        }
        $remissions = $remissions->orderBy('id', 'DESC')->get();

        $clients  = Client::where('client_estado', 'A')->get();
        $constructions  = Construction::where('obra_estado', 'A')->get();
        $societies  = Society::where('soci_estado', 'A')->get();
        return view('reports.report_remissions', compact('request', 'clients', 'remissions', 'constructions', 'societies'));
    }
    public function pdfReportRemissions(Request $request)
    {
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissions  = Remission::query();
        $user = Auth::user();
        if (isset($request->idConstruction)) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->where('id', $request->idConstruction);
            });
        }
        if (isset($request->idClient)) {
            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($queryC) use ($request) {
                    $queryC->where('id', $request->idClient);
                });
            });
        }

        if (isset($request->stateInvoice) && $request->stateInvoice == 1) {

            $remissions->whereNotNull('remi_numfactura');
        }
        if (isset($request->stateInvoice) && $request->stateInvoice == 0) {

            $remissions->whereNull('remi_numfactura');
        }
        if ($request->dateStart && is_null($request->dateEnd)) {
            $remissions->where('remi_fecha', $request->dateStart);
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $remissions->whereBetween('remi_fecha', [$request->dateStart, $request->dateEnd]);
        }

        $remissions = $remissions->get();


        if (count($remissions) == 0) {
            Session::flash('info_message', 'No se puede generar un reporte de remisión, porque no tenemos información al respecto');
            return redirect()->route('reports');
        } else {
            $pdf = PDF::loadView('reports.reportRemissions', compact('remissions', 'date', 'user', 'request'));

            $name = "Reporte de remisiones $date.pdf";
            return $pdf->stream("$name");
            // return $pdf->download($name);
        }
    }
    

    //Agregar Fr@y luis conductor 31/03/2023
    public function reportMachineMov(Request $request)
    {
        {
           
        $machine =  Machine::find($request->idMachine);
        $drivers =  Drivers::find($request->id_conductor);
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $nameNew = $machine->maqn_placa ?? $date;
        $name = "$nameNew.xlsx";

        $dateMachineMov = MachineMov::first();
        $dateMachineMovLast = MachineMov::get('id')->last();
        $dateFirst = Carbon::parse($dateMachineMov->mqmv_fecha)->format('Y-m-d');
        $dateLast = Carbon::parse($dateMachineMovLast->mqmv_fecha)->format('Y-m-d');
        $request->dateStart = $request->dateStart ?? $dateFirst;
        $request->dateEnd = $request->dateEnd ?? $dateLast;
        // return response()->json($request->all(),500);
        return Excel::download(new MachineMovExport($request->id_conductor,$request->idMachine, $request->dateStart, $request->dateEnd), $name);
        }
    }
    public function pdfReportRemissionAssignments(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissiondatas  = Remission::query();

        if (isset($request->dateStart) && isset($request->dateEnd) && !$request->dateEnd) {
            $remissiondatas->whereDate('remi_fecha', $request->dateStart);
        }

        if (isset($request->idConstruction) && !$request->idConstruction) {
            $remissiondatas->where('id_obra', $request->idConstruction);
        }

        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $remissiondatas->whereBetween('remi_fecha', [$request->dateStart, $request->dateEnd]);
        }
        $remissions = $remissiondatas->get();
        $pdf = PDF::loadView('reports.reportAssignmentRemissions', compact('remissions', 'date', 'user', 'request'));

        $name = "Pre reporte de asignación de factura a remisiones de $request->dateStart a $request->dateEnd.pdf";
        return $pdf->stream("$name");
    }

    public function pdfReportRemissionNovelties($idReportRemissionNovelties)
    {
        $user = Auth::user();
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissionNovelty =  RemissionNovelty::find($idReportRemissionNovelties);
        $name = "Novedad de remisión #" . $idReportRemissionNovelties;
        $pdf = PDF::loadView('reports.reportNoveltiesRemissions', compact('remissionNovelty', 'date', 'user', 'name'));
        return $pdf->stream("$name.pdf");
    }

    public function reportMaterials(Request $request)
    {
        // dump($request->all());
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissions  = Remission::query();
        $user = Auth::user();
        if (isset($request->idConstruction)) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->where('id', $request->idConstruction);
            });
        }
        if (isset($request->idClient)) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($queryC) use ($request) {
                    $queryC->where('id', $request->idClient);
                });
            });
        }

        if (isset($request->stateInvoice) && $request->stateInvoice == "1") {

            $remissions->where('remi_numfactura', '!=', NULL)->where('remi_numfactura', '!=', '');
        }
        if (isset($request->stateInvoice) && $request->stateInvoice == "0") {

            $remissions->where('remi_numfactura', '=', NULL)->orWhere('remi_numfactura', '=', '');
        }

        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $remissions->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
        }


        if ($request->excel == "true") {
         
            return Excel::download(new MaterialExport($remissions, $date, $user ,$request), "Material de remisiones $date.xlsx"); 
        }


        $remissions = $remissions->get();

        $clients  = Client::all();
        $constructions  = Construction::all();
        $societies  = Society::all();
      
          // return view('reports.report_materials')->all();

           // Exportar excel 04/26/2023
          //
            return view('reports.report_materials', compact('request', 'clients', 'remissions', 'constructions', 'societies'));
       
      
     
       
       
    
    }
    public function pdfReportMaterials(Request $request)
    {

        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissions  = Remission::query();
        $user = Auth::user();
        if (isset($request->idConstruction)) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->where('id', $request->idConstruction);
            });
        }
        if (isset($request->idClient)) {
            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($queryC) use ($request) {
                    $queryC->where('id', $request->idClient);
                });
            });
        }

        if (isset($request->stateInvoice) && $request->stateInvoice == 1) {

            $remissions->whereNotNull('remi_numfactura');
        }
        if (isset($request->stateInvoice) && $request->stateInvoice == 0) {

            $remissions->whereNull('remi_numfactura');
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $remissions->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
        }

        $remissions = $remissions->get();


        if (count($remissions) == 0) {
            Session::flash('info_message', 'No se puede generar un reporte de remisión, porque no tenemos información al respecto');
            return redirect()->route('reports');
        } else {
            $pdf = PDF::loadView('reports.reportRemissionMaterials', compact('remissions', 'date', 'user', 'request'));

            $name = "Reporte de material de remisiones $date.pdf";
            return $pdf->stream("$name");
            // return $pdf->download($name);
        }
    }  
    
    
    public function exportExcelMaterialRemission(Request $request)
    {

        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissions  = Remission::query();
        $user = Auth::user();
        if (isset($request->idConstruction)) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->where('id', $request->idConstruction);
            });
        }
        if (isset($request->idClient)) {
            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($queryC) use ($request) {
                    $queryC->where('id', $request->idClient);
                });
            });
        }

        if (isset($request->stateInvoice) && $request->stateInvoice == 1) {

            $remissions->whereNotNull('remi_numfactura');
        }
        if (isset($request->stateInvoice) && $request->stateInvoice == 0) {

            $remissions->whereNull('remi_numfactura');
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $remissions->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
        }

        $remissions = $remissions->get();


        if (count($remissions) == 0) {
            Session::flash('info_message', 'No se puede generar un reporte de remisión, porque no tenemos información al respecto');
           //return redirect()->route('reports');
          return Excel::download(new MaterialExport($remissions, $date, $user), "Material de remisiones $date.xlsx");
        }

        
    }


    public function exportExcelRemissions(Request $request)
    {

        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $remissions  = Remission::query();

        if (!is_null($request->notCancelled) && $request->notCancelled == "on") {

            $remissions->where('remi_estado', 'A');
        }

        $user = Auth::user();
        if (isset($request->idConstruction) && $request->idConstruction != 0) {
            $remissions->where('id_obra', $request->idConstruction);
        }

        if (isset($request->idClient) && !is_null($request->idClient)) {

            $remissions->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($queryC) use ($request) {
                    $queryC->where('id', $request->idClient);
                });
            });
        }
        if (isset($request->stateInvoice) && $request->stateInvoice == 1) {
            $remissions->where('remi_numfactura', '!=', '');
        }
        if (isset($request->stateInvoice) && $request->stateInvoice == 0) {
            $remissions->where('remi_numfactura', '');
        }

        if (!is_null($request->dateStart) && is_null($request->dateEnd)) {
            $remissions->where('remi_fecha', $request->dateStart);
        }

        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $remissions->where('remi_fecha', '>=', $request->dateStart)->where('remi_fecha', '<=', $request->dateEnd);
        }
        // dump(count($remissions->get()));
        if (isset($request->idSociety) && !is_null($request->idSociety)) {
            $remissions->where('id_society', $request->idSociety);
        }
        // dd(count($remissions->get()));


        if ($request->filter == "true") {

            return view('reports.trReportRemissions', ['remissions' =>  $remissions->get(), 'request' => $request]);
        }
        return Excel::download(new RemissionExport($remissions->get(), $date, $user), "Remisiones $date.xlsx");
    }

    public function exportExcelProductions(Request $request)
    {
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $productions  = Production::query();

        if ($request->typeProductionMaterial) {

            $productions->where('typeProduction', $request->typeProductionMaterial);
        }
        $productions = $productions->get();
        $user = Auth::user();

        return Excel::download(new ProductionExport($productions, $date, $user), "Producción $date.xlsx");
    }

    public function exportExcelRemittanceToLiquidate(Request $request)
    {
        $remissions = Remission::query();

        $remissions->where('remi_estado', '=', 'A');

        if (isset($request->dateStart) && isset($request->dateEnd) && !$request->dateEnd) {

            $remissions->whereDate('remi_fecha', $request->dateStart);
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $remissions->whereBetween('remi_fecha', [$request->dateStart, $request->dateEnd]);
        }

        if (isset($request->idConstruction) && $request->idConstruction) {

            $remissions->where('id_obra', $request->idConstruction);
        }



        $remissions->where('remi_numfactura', '=', '')->doesnthave('PreSettlement');


        $date = date("d") . " del " . date("m") . " de " . date("Y");
        return Excel::download(new RemissionToLiquidareExport($remissions->get()), "Remisiones sin liquidación $date.xlsx");
    }

         
    
    function reportMaterialOverview(Request $request)
    {
        // DB::statement("SET sql_mode = '' ");
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $materialsOverview = [];

      // Filtro  por maquina

        if (!is_null($request->idMaterial) && !is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $materialsOverview = DB::select("call sp_inventory('list_sale_filter_mat','$request->idMaterial', '','','$request->dateStart','$request->dateEnd','')");
        } 
        // Filtro  por fecha
        if (($request->dateStart) && !is_null($request->dateEnd)) {

            $materialsOverview = DB::select("call sp_inventory('list_sale_filter_mat','$request->idMaterial', '','','$request->dateStart','$request->dateEnd','')");
        } 
        else {

            $materialsOverview = DB::select("call sp_inventory('sale_mat', '', '', '',null,null,'')");
        }
        if ($request->excel == "true") {

            return FacadesExcel::download(new MaterialOverviewExport($materialsOverview), "Resumén por material  $date.xlsx");
        }

        $materials = Material::where('mate_estado', 'A')->get();

        
        return view('reports.reportMaterialOverview', compact('materialsOverview', 'materials', 'request'));
    }
    
    
    
    function reportMaterialOverviewSociety(Request $request)
    {
        // DB::statement("SET sql_mode = '' ");
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $materialsOverviewSocieties= [];

        if (!is_null($request->idSociety) && !is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $materialsOverviewSocieties = DB::select("call sp_inventory('material_society','','','$request->idSociety','$request->dateStart','$request->dateEnd','')");
        } 
        //Fitro por solo  la fecha Fray Luis
        if (($request->dateStart) && !is_null($request->dateEnd)) {

            $materialsOverviewSocieties = DB::select("call sp_inventory('material_society','','','$request->idSociety','$request->dateStart','$request->dateEnd','')");
        }
        
        
        
        else {

            $materialsOverviewSocieties= DB::select("call sp_inventory('list_material_society', '', '', '',null,null,'')");
        }
        if ($request->excel == "true") {

            return FacadesExcel::download(new MaterialOverviewSocietyExport($materialsOverviewSocieties), "Resumén por material  $date.xlsx");
        }

        $societies = Society::where('soci_estado', 'A')->get();

        
        
        return view('reports.reportMaterialOverviewSociety', compact('materialsOverviewSocieties', 'societies', 'request'));
    }
    


    function reportCommodiesProduction(Request $request)
    {
        // DB::statement("SET sql_mode = '' ");
        $date = date("d") . " del " . date("m") . " de " . date("Y");
        $commodiesProduction = [];

        if (!is_null($request->idCommodity) && !is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $commodiesProduction = DB::select("call sp_inventory('commodies','', '','','$request->dateStart','$request->dateEnd','$request->idCommodity')");
        } else {

            $commodiesProduction = DB::select("call sp_inventory('list_commodies', '', '', '',null,null,'')");
        }
        if ($request->excel == "true") {

            return FacadesExcel::download(new CommodiesProductionExport($commodiesProduction), "Resumén de material por sociedad $date.xlsx");
        }

        $commodities = Commodity::where('matp_estado', 'A')->get();

        return view('reports.reportCommoditiesProduction', compact('commodiesProduction', 'commodities', 'request'));
    }
}
