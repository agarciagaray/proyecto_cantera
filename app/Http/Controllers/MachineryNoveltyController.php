<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\MachineObs;
use App\Models\MachineObsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachineryNoveltyController extends Controller
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


    public function index()
    {
        $machineObs = MachineObsModel::listMachineObs();
        return view('mochineryNovelties.index',compact('machineObs'));
    }

    
    public function form(Request $request)
    {
        // En este formulario controlo el formulario para crear o editar o la vista de ver 
        $machineOb = MachineObs::find($request->mqdt_id); //Consulto si existe un machineObs
        $machines =  Machine::where('maqn_estado','A')->get();

        if (isset($request->show) && $request->show == "true") {
            return view('mochineryNovelties.show', compact('machineOb')); //Lo paso
        } else {
       
            return view('mochineryNovelties.form', compact('machines', 'machineOb'));//Lo paso
        }
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $data['id_user'] = Auth::id();

        $validate = MachineObsModel::getValidator($data);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }
     
        MachineObsModel::saveMachineObs($data);
        // Envio una vista para actualizar la tabla. Despues de guardar
        $machineObs = MachineObsModel::listMachineObs();
        return view('mochineryNovelties.trMochineryNovelty',compact('machineObs'));
    }
    
    public function delete()
    {

    }
    

    

}