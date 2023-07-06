<?php

namespace App\Http\Controllers;

use App\Models\MachinesType;
use App\Models\MachineTypeModel;
use Illuminate\Http\Request;

class MachinesTypeController extends Controller {
    /**
     * Creamos el constructor para inyectar la dependencia de la clase Client
     * para utilizarlo en los métodos de la clase ClientController
     */
    protected $machinestypes;
    public function __construct(MachinesType $machinestypes) {
        $this->machinestypes = $machinestypes;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $machinestypes = MachinesType::orderBy('id','DESC')->get();
        return view('machinestypes.index', ['machinestypes' => $machinestypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $machineType = MachinesType::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('machinestypes.show', compact('machineType'));
        } else {

            return view('machinestypes.form', compact('machineType'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = $request->all();

        $validate = MachineTypeModel::getValidator($data);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }
        MachineTypeModel::saveMachineType($data);
        $machinestypes = MachinesType::orderBy('id','DESC')->get();

        return view('machinestypes.trMachineTypes', compact('machinestypes'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MachinesType  $machinestype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        
        $machinestype = MachineTypeModel::getMachineType($request->idMaquineType);

        $machinestype->tmaq_estado = 'I';
        $machinestype->save();
        $machinestypes = MachinesType::orderBy('id','DESC')->get();

        return view('machinestypes.trMachineTypes', compact('machinestypes'));
    }
}
