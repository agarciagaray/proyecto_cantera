<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Drivers;
use App\Models\MachineMov;

use App\Models\MachineMovModel;
use Illuminate\Http\Request;
use Auth;

class MachineMovController extends Controller
{
      /**
     * Creamos el constructor para inyectar la dependencia de la clase Supplier
     * para utilizarlo en los métodos de la clase SupplierController
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machinesmovs = MachineMov::orderBy('id', 'DESC')->get();
        $machines =  Machine::where('maqn_estado', 'A')->get();

        $drivers=  Drivers::where('conductor_estado', 'A')->get();
        $machine['id_user']         = Auth::id();


        //
        return view('machinesmovs.index', ['machinesmovs' => $machinesmovs,'drivers'=>$drivers, 'machines' => $machines]);
    }

    public function getApiMachineMov(Request $request)
    {
        $machinesmovs = MachineMov::with('Machine')->orderBy('id', 'DESC')->get();
       // $driver = Drivers::with('Drivers')->orderBy('id', 'DESC')->get();

        return response()->json(['data'=>$machinesmovs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $machineMov = MachineMov::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('machinesmovs.show', compact('machineMov'));
        } else {

            $machines =  Machine::where('maqn_estado', 'A')->get();
            $drivers =  Drivers::where('conductor_estado', 'A')->get();
         
            return view('machinesmovs.form', compact('machines', 'machineMov','drivers'));
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

            $machine = $request->all();

        if ($machine['horometro_hinicio'] || $machine['horometro_hfinal']) {

            $machine['horometro_hinicio'] = $machine['horometro_hinicio'];
            $machine['horometro_hfinal'] =  $machine['horometro_hfinal'];
            // $machine['mqmv_vlrhora'] = floatvaL($machine['mqmv_vlrhora']);

        }
        //  return response()->json(['machine' =>$machine], 500);



        $horometro = $request->horometro == null ? false : true;

        $machine['id_user']         = Auth::id();

        $validate = MachineMovModel::getValidator($machine, $horometro);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        MachineMovModel::saveMachineMov($machine);
        $machinesmovs = MachineMov::orderBy('id', 'DESC')->get();
        $drivers = Drivers::orderBy('id', 'DESC')->get();
        return view('machinesmovs.trMachineMovs',['machinesmovs' => $machinesmovs,'drivers'=>$drivers]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MachineMov  $machinemov
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $machineMov = MachineMov::find($request->idMaquineMov);
        $machineMov->mqmv_estado = 'I';
        $machineMov->save();
        $machinesmovs = MachineMov::orderBy('id', 'DESC')->get();
        return view('machinesmovs.trMachineMovs', ['machinesmovs' => $machinesmovs]);
    }


    public function filterMovMaq(Request $request)
    {
    // dd($request->all());
    $machineMovs  = MachineMov::query();
    // $machineMovs->where('mqmv_estado', 'A');
    if ($request->idMachine) {
        $machineMovs->where('mqmv_idmaquina',$request->idMachine);
    }
    if ($request->id_conductor) {
        $machineMovs->where('id_conductor',$request->id_conductor);
    }

    if ($request->dateStart && is_null($request->dateEnd)) {
        $machineMovs->where('mqmv_fecha',$request->dateStart);
    }
    if ($request->dateStart &&  $request->dateEnd) {
        $machineMovs->whereBetween('mqmv_fecha',[$request->dateStart, $request->dateEnd]);
    }
    $machineMovs = $machineMovs->get();
    // $machineMovs->orderBy('id','DESC')->get();
    return view('machinesmovs.trMachineMovs',['machinesmovs' => $machineMovs]);
   }

}
