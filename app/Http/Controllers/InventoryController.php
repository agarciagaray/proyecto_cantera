<?php

namespace App\Http\Controllers;

use App\Exports\MachineTankingExport;
use App\Exports\MaterialInventoryExport;
use App\Models\Machine;
use App\Models\MachineTanking;
use App\Models\Material;
use App\Models\Production;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        Session::forget('info_message');
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


        if ((isset($request->dateStart) && !is_null($request->dateStart)) && is_null($request->dateEnd)) {
            $inventories->whereDate('tanq_fecha', $request->dateStart);
        }
        if ((isset($request->dateStart) && !is_null($request->dateStart)) && (isset($request->dateEnd) && !is_null($request->dateEnd))) {

            $inventories->whereBetween('tanq_fecha', [$request->dateStart, $request->dateEnd]);
        }

        if (isset($request->tanq_origen) && !is_null($request->tanq_origen)) {
            $inventories->where('tanq_origen', $request->tanq_origen);
        }
        if (isset($request->tanq_unidad) && !is_null($request->tanq_unidad)) {

            $inventories->where('tanq_unidad', $request->tanq_unidad);
        }


        $inventories = $inventories->orderBy('id', 'DESC')->get();
        if ($inventories->count() == 0) {
            Session::flash('info_message', 'No encontramos tados asociados a los parametros establecidos en la busqueda');
        } else {
            Session::forget('info_message');
        }
        if ($request->excel == "true") {
            // dd($inventories);
            $date = date("d") . " del " . date("m") . " de " . date("Y");
            return Excel::download(new MachineTankingExport($inventories), "Inventario de tanqueo $date.xlsx");
        }

        return view('inventories.index', compact('inventories', 'machines', 'request'));
    }

    public function apiInventory()
    {

     $inventories = MachineTanking::all();
        return  $inventories;
    }

    public function inventoryControl(Request $request)
    {
        // dd($request->typeProduction);
     //   DD($request->all());

        $sql = "call sp_inventory('inventory_mat', '$request->prod_idmaterial', '$request->typeProduction','',null,null,'')";
        if (isset($request->dateStart) && !isset($request->dateEnd)) {

            $sql = "call sp_inventory('inventory_mat', '$request->prod_idmaterial', '$request->typeProduction','','$request->dateStart',null,'')";
        }
        if (isset($request->dateEnd) && !isset($request->dateStart)) {

            $sql = "call sp_inventory('inventory_mat', '$request->prod_idmaterial', '$request->typeProduction','',null,'$request->dateEnd','')";
        }

        if (isset($request->dateStart) && isset($request->dateEnd)) {

            $sql = "call sp_inventory('inventory_mat', '$request->prod_idmaterial', '$request->typeProduction','','$request->dateStart','$request->dateEnd','')";
        }

        $materialInventory = DB::select($sql);

        $materials =  Material::where('mate_estado', 'A')->get();

        if ($request->excel == "true") {
            $date = date("d") . " del " . date("m") . " de " . date("Y");
            return Excel::download(new MaterialInventoryExport($materialInventory), "Inventario de material $date.xlsx");
        }

        return view('inventories.inventoryControl', compact('materialInventory', 'materials','request'));
    }
}
