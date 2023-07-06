<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\MachinePaymentModel;
use App\Models\ConceptPayment;
use App\Models\MachinePayment;
use Illuminate\Http\Request;
use Auth;

class ViaticoOtherController extends Controller
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

        if (!$user->can('Listado viaticos y otros')) {
            return view('paginateErrors.403');
        }
        $viaticoOthers = MachinePayment::query();

        if (isset($request->dateStart) && !$request->dateEnd) {

            $viaticoOthers->whereDate('mqpg_fecha', $request->dateStart);
        }
        if ((isset($request->dateStart) && $request->dateStart) && (isset($request->dateEnd) && $request->dateEnd)) {

            $viaticoOthers->whereBetween('mqpg_fecha', [$request->dateStart, $request->dateEnd]);
        }

        if (isset($request->id_machine)) {
            $viaticoOthers->where('mqpg_idmaquina', $request->id_machine);

        }
        $viaticoOthers= $viaticoOthers->orderBy('mqpg_fecha','DESC')->get();
        $machines =  Machine::where('maqn_estado','A')->get();
        //dd($machinesobs);
        return view('viaticoOthers.index', compact('viaticoOthers','request','machines'));
    }


    public function form(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Formulario viaticos y otros')) {
            return view('paginateErrors.403');
        }
        $viaticoOther = MachinePaymentModel::getMachinePayment($request->mqpg_id);
        $machines =  Machine::where('maqn_estado','A')->get();
        $concepts = ConceptPayment::where('cncp_estado','A')->get();

        if(isset($request->show) && $request->show =='true'){
            return view('viaticoOthers.show', compact('viaticoOther'));
        }else{
            return view('viaticoOthers.form', compact('viaticoOther','machines','concepts'));
        }

    }

    public function save(Request $request)
    {

        $user = Auth::user();

        if (!$user->can('Guardar viaticos y otros')) {
            return view('paginateErrors.403');
        }
        $data =  $request->all();

        $data['id_user'] = Auth::id();
        $validate = MachinePaymentModel::getValidator($data);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
            # code...
        }

        MachinePaymentModel::saveMachinePayment($data);
        $viaticoOthers = MachinePaymentModel::listMachinePayment();
        return view('viaticoOthers.trViaticoOther', compact('viaticoOthers'));
    }
    public function delete(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Eliminar viaticos y otros')) {
            return view('paginateErrors.403');
        }


        $machinePayment = MachinePaymentModel::getMachinePayment($request->mqpg_id);
        $machinePayment->mqpg_estado ='I';
        $machinePayment->save();
        $viaticoOthers = MachinePaymentModel::listMachinePayment();
        return view('viaticoOthers.trViaticoOther', compact('viaticoOthers'));
        //
    }

}
