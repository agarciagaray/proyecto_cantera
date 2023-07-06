<?php

namespace App\Http\Controllers;

use App\Models\ProductionModel;
use App\Models\Commodity;
use App\Models\Device;
use App\Models\Machine;
use App\Models\MachineModel;
use App\Models\Material;
use App\Models\MaterialModel;
use App\Models\Production;
use App\Models\Options;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class MaterialMovementController extends Controller
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

        $user = Auth::user();
        if (!$user->can('Lista de movimiento de material')) {
            return view('paginateErrors.403');
        }
        $productions = ProductionModel::listProduction($request);
        return view('materialMovements.index', compact('productions','request'));
    }


    public function form(Request $request)
    {

       
        $user = Auth::user();
        if (!$user->can('Formulario de movimiento de material')) {
            return view('paginateErrors.403');
        }
        $production = Production::find($request->prod_id);
        $commodities = Commodity::where('matp_estado', 'A')->get();
        $materials = Material::where('mate_estado', 'A')->get();
        $devices = Device::where('disp_estado', 'A')->get();
        $machines =  Machine::where('maqn_estado', 'A')->get();
        $options =  Options::where('estado', 'A')->get();
       //  $options =  Options::select('id','nom_option')->get();

        if (isset($request->show) && $request->show == "true") {
            return view('materialMovements.show', compact('production'));
        } else {
            return view('materialMovements.form', compact('machines', 'production', 'devices', 'commodities', 'materials','options'));
        }
    }
    

    public function save(Request $request)
    {

        //dd($request->all());
        $user = Auth::user();
        if (!$user->can('Guardar de movimiento de material')) {
            return view('paginateErrors.403');
        }


        $cubitajeMachine = Machine::find($request->prod_idmaqdeposita);
        if($cubitajeMachine){
            if($request->prod_cubicaje > $cubitajeMachine->maqn_cubicaje){

                return response()->json(['message' => "El cubitaje ingresado superá el establecido para el vehiculo."], 500);
            }

        }

        // if($request->typeProduction == 'S'){

        //   $volumen = ProductionModel::validateExitProduction($request->prod_idmaterial,$request->prod_iddispositivo);

        //   if ($volumen['available'] == 0) {
        //     return response()->json(['message' => "No tenemos inventario de este material"], 500);

        //   }

        //   if ($request->prod_volumen>$volumen['available']) {
        //     return response()->json(['message' => "El volumén ingresado supera lo disponible en el momento"], 500);

        //   }

        // }

        $data = $request->all();

        $data['id_user'] = Auth::id();

        $validate = ProductionModel::getValidator($data);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        ProductionModel::saveProduction($data);
        $productions = Production::orderBy('id', 'DESC')->get();

        return view('materialMovements.trMaterialMovement', compact('productions'));
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if (!$user->can('Eliminar de movimiento de material')) {
            return view('paginateErrors.403');
        }

        $production = ProductionModel::getProduction($request->prod_id);
        $productions = Production::orderBy('id', 'DESC')->get();

        /*$production->prod_volumen;*/
        $volumen = ProductionModel::validateExitProduction($production->Material->id ??'');
        $tr ="";


        if ($volumen['prod_volumen'] > $volumen['prod_volumen_exit']) {
            $tr ="";
            $production->prod_estado  = 'I';
            $production->save();
            // foreach ($productions as $production){
            //     $tr .="<tr if($production->prod_estado == 'I'){ style='color:#e3342f' }><td>$production->id</td><td>$production->typeProduction</td><td>$production->Machine->maqn_placa ?? ''</td><td>$production->Device->disp_descripcion ?? ''</td>\<td>$production->Commodity->matp_descripcion ?? ''</td><td>$production->prod_fecha</td><td>$production->prod_numviajes</td><td>$production->prod_cubicaje</td><td>$production->prod_volumen</td><td class='text-right py-0 align-middle'><div class='btn-group btn-group-sm'><button class='btn btn-info mr-1' onclick='createMaterialMovement($production->id ,true)'><i class='fa fa-eye' aria-hidden='true'></i></button>if ($production->prod_estado == 'A'){<button class='btn btn-primary mr-1' onclick='createMaterialMovement($production->id ,false)'><i class='fas fa-edit'></i></button> } <button class='btn btn-danger' onclick='deleteMaterialMovement($production->id )'><i class='fa fa-trash' aria-hidden='true'></i></button></div></td></tr>";
            // }

            return response()->json(['message' => 'Al eliminar el movimiento el inventario del producto pasará a negativo', 'code' => 201, 'data' => $tr]);
        }

        $production->prod_estado  = 'I';
        $production->save();

        return view('materialMovements.trMaterialMovement', compact('productions'));
    }
    public function getMachine(Request $request)
    {

        $machine  =  MachineModel::getMachine($request->prod_idmaqdeposita);
        return response()->json($machine->maqn_cubicaje);
    }
}
