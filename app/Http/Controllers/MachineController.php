<?php

namespace App\Http\Controllers;

use App\Models\Admin\PermissionModel;
use App\Models\Machine;
use App\Models\MachineModel;
use App\Models\MachinesType;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachineController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::orderBy('id','DESC')->get();
        $machinestypes = MachinesType::orderBy('id','DESC')->get();;
        $units =  Unit::orderBy('id','DESC')->get();

        return view('machines.index', [ 'machines' => $machines, 'machinestypes' => $machinestypes, 'units' => $units ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $machine = Machine::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('machines.show', compact('machine'));
        } else {
            $machinestypes = MachinesType::orderBy('id','DESC')->get();;
            $units =  Unit::orderBy('id','DESC')->get();
    
            return view('machines.form', compact('machine','machinestypes','units'));
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
        // Creo los datos de Machine
        $machine = [];
        $machine['id']      = $request->id;
        $machine['maqn_placa']      = $request->placa;
        $machine['maqn_tipo']       = $request->tipo;
        $machine['maqn_cubicaje']   = $request->cubicaje;
        $machine['maqn_idunidad']   = $request->unidad;
        $machine['maqn_obs']        = $request->obs;
        $machine['name_complete']        = $request->name_complete;
        //$machine['mqmv_fecha']        = $request->mqmv_fecha;
        $machine['nuip']        = $request->nuip;
        $machine['id_user']         = Auth::id();
        // dd($machine);
        $validate = MachineModel::getValidator($machine);

        if($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);

        }
        
        Machine::create($machine);

        // Obtengo los datos nuevamente para mostrarlos en el listado de maquinas
        $machines = Machine::orderBy('id','DESC')->get();
        $machinestypes = MachinesType::orderBy('id','DESC')->get();
        $units = Unit::orderBy('id','DESC')->get();
        return view('machines.trMachine', [ 'machines' => $machines, 'machinestypes' => $machinestypes, 'units' => $units ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machine $machine)
    {
        // Actualizo los datos de Maquina
        $machineUpd = [];
        $machineUpd['id']      = $request->id;
        $machineUpd['maqn_placa']      = $request->placa;
        $machineUpd['maqn_tipo']       = $request->tipo;
        $machineUpd['maqn_cubicaje']   = $request->cubicaje;
        $machineUpd['maqn_idunidad']   = $request->unidad;
        $machineUpd['maqn_obs']        = $request->obs;
        $machineUpd['name_complete']        = $request->name_complete;
        $machineUpd['nuip']        = $request->nuip;


        $validate = MachineModel::getValidator($machineUpd);

        if($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        $machine = MachineModel::getMachine($request->id);
        $machine->update($machineUpd);

        // Obtengo los datos nuevamente para mostrarlos en el listado de maquinas
        $machines = Machine::orderBy('id','DESC')->get();
        $machinestypes = MachinesType::orderBy('id','DESC')->get();
        $units =  Unit::orderBy('id','DESC')->get();
        return view('machines.trMachine', [ 'machines' => $machines, 'machinestypes' => $machinestypes, 'units' => $units ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $machine = MachineModel::getMachine($request->id);
        $machine->maqn_estado = 'I';
        $machine->save();
        $machines = Machine::orderBy('id','DESC')->get();
        $machinestypes = MachinesType::orderBy('id','DESC')->get();;
        $units =  Unit::orderBy('id','DESC')->get();
        return view('machines.trMachine', [ 'machines' => $machines, 'machinestypes' => $machinestypes, 'units' => $units ]);
    }

    /**
     * Buscar una maquina y obtener el cubitaje.
     *
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function getCubitajeMachine(Request $request)
    {
        $cubitajeMachine =  Machine::select('maqn_cubicaje')->find($request->id_machine);

        return response()->json(
            [
                'cubitaje'=>$cubitajeMachine
            ],
            200

        );
    }
}
