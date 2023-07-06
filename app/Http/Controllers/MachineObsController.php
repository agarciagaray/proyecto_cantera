<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\MachineObs;
use App\Models\MachineObsModel;
use Illuminate\Http\Request;
use Auth;

class MachineObsController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase MachineObs
     * para utilizarlo en los métodos de la clase ClientController
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $machinesobs = MachineObs::query();

        if (isset($request->dateStart) && !$request->dateEnd) {

            $machinesobs->whereDate('mqdt_fecha', $request->dateStart);
        }
        if ((isset($request->dateStart) && $request->dateStart) && (isset($request->dateEnd) && $request->dateEnd)) {

            $machinesobs->whereBetween('mqdt_fecha', [$request->dateStart, $request->dateEnd]);
        }

        if (isset($request->mqdt_idmaquina)) {

            $machinesobs->where('mqdt_idmaquina', $request->mqdt_idmaquina);
        }
        $machines = Machine::where('maqn_estado','A')->get();
        $machinesobs= $machinesobs->orderBy('mqdt_fecha','DESC')->get();

        return view('machinesobs.index', [ 'machinesobs' => $machinesobs,'request'=>$request,'machines'=>$machines ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $machineOb =  MachineObs::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('machinesobs.show', compact('machineOb'));
        } else {
            $machines = Machine::where('maqn_estado','A')->get();
            return view('machinesobs.form', compact('machineOb','machines'));
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
        $data['id_user']         = Auth::id();
        $validate = MachineObsModel::getValidator($data);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        MachineObsModel::saveMachineObs($data);
        $machinesobs = MachineObs::orderBy('id','DESC')->get();

        return view('machinesobs.trMachineObs', [ 'machinesobs' => $machinesobs ]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MachinesType  $machinestype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $machineOb = MachineObsModel::getMachineObs($request->idMaquineObs);
        $machineOb->mqdt_estado = 'I';

        $machineOb->save();
        $machinesobs = MachineObs::orderBy('id','DESC')->get();

        return view('machinesobs.trMachineObs', [ 'machinesobs' => $machinesobs ]);

    }
}
