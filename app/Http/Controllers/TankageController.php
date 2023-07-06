<?php

namespace App\Http\Controllers;

use App\Models\CubitanksLoadingModel;
use App\Models\FuelsShoppingModel;
use App\Models\Machine;
use App\Models\MachineTanking;
use App\Models\MachineTankingModel;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;
use App\Models\FuelsShopping;


//Compra
class TankageController extends Controller
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

    //FuelDischarge

    public function listFuelDischarge(Request $request)
    {
        $user = Auth::user();
        $fuelsshoppings = FuelsShoppingModel::listFuelsShopping();
        if (!$user->can('Lista de Descarga de carrotanque')) {
            return view('paginateErrors.403');
        }
        return view('tankages.fuelsShopping.index', compact('fuelsshoppings','request'));
    }

    public function formFuelDischarge(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Formulario de Descarga de carrotanque')) {
            return view('paginateErrors.403');
        }
        $fuelsshopping = FuelsShoppingModel::getFuelsShopping($request->ccmb_id);
        $suppliers = Supplier::all();

        if (isset($request->show) && $request->show == 'true') {
            return view('tankages.fuelsShopping.show', compact('fuelsshopping'));
        } else {

            return view('tankages.fuelsShopping.form', compact('fuelsshopping', 'suppliers'));
        }
    }

    public function saveFuelDischarge(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Guardar de Descarga de carrotanque')) {
            return view('paginateErrors.403');
        }
        $data = $request->all();
        $data['id_user'] = Auth::id();
        $validate = FuelsShoppingModel::getValidator($data);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        FuelsShoppingModel::saveFuelsShopping($data);

        $fuelsshoppings = FuelsShoppingModel::listFuelsShopping();
        return view('tankages.fuelsShopping.trFuelDischarge', compact('fuelsshoppings'));
    }

    public function deleteFuelDischarge(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Eliminar de Descarga de carrotanque')) {
            return view('paginateErrors.403');
        }
        $fuelsshopping = FuelsShoppingModel::getFuelsShopping($request->ccmb_id);
        $fuelsshopping->delete();

        $fuelsshoppings = FuelsShoppingModel::listFuelsShopping();
        return view('tankages.fuelsShopping.trFuelDischarge', compact('fuelsshoppings'));
    }

    //Carga de cubitanques
    //Fuelsshopcubitanks
    public function listCubitanksLoading(Request $request)
    {

        $user = Auth::user();

        if (!$user->can('Lista de carga de cubitanques')) {
            return view('paginateErrors.403');
        }
        $cubitanksLoadings = CubitanksLoadingModel::listCubitanksLoading();
        return view('tankages.cubitanksLoading.index', compact('cubitanksLoadings'));
    }
    public function formCubitanksLoading(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Formulario de carga de cubitanques')) {
            return view('paginateErrors.403');
        }
        $cubitanksLoading = CubitanksLoadingModel::getCubitanksLoading($request->cubt_id);
        $fuelsshoppings = FuelsShoppingModel::listFuelsShopping();

        if (isset($request->show) && $request->show == 'true') {
            return view('tankages.cubitanksLoading.show', compact('cubitanksLoading'));
        } else {

            return view('tankages.cubitanksLoading.form', compact('cubitanksLoading', 'fuelsshoppings'));
        }
    }
    public function saveCubitanksLoading(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Guardar de carga de cubitanques')) {
            return view('paginateErrors.403');
        }
        // $fuelsshopping = FuelsShoppingModel::getFuelsShopping($request->cubt_idcompra);


        // $cubitanksLoading = CubitanksLoadingModel::getCubitanksShopping($request->cubt_idcompra);
        // $cubitanksVolumen  = $cubitanksLoading->sum('cubt_volumen');

        // if($fuelsshopping->ccmb_volumen<=$cubitanksVolumen){

        //     return response()->json(['errors' =>'No se puede cargar'], 500);
        // }



        $data = $request->all();
        $data['id_user'] = Auth::id();
        $validate = CubitanksLoadingModel::getValidator($data);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        CubitanksLoadingModel::saveCubitanksLoading($data);

        $cubitanksLoadings  = CubitanksLoadingModel::listCubitanksLoading();
        return view('tankages.cubitanksLoading.trCubitanksLoading', compact('cubitanksLoadings'));
    }
    public function deleteCubitanksLoading(Request $request)
    {
        $user = Auth::user();

        if (!$user->can('Eliminar de carga de cubitanques')) {
            return view('paginateErrors.403');
        }
        $cubitanksLoading = CubitanksLoadingModel::getCubitanksLoading($request->cubt_id);
        $cubitanksLoading->delete();

        $cubitanksLoadings  = CubitanksLoadingModel::listCubitanksLoading();
        return view('tankages.cubitanksLoading.trCubitanksLoading', compact('cubitanksLoadings'));
    }


    //MachineTanking
    public function listMachineTanking(Request $request)
    {
        // dd(Storage::url('profile-1649181684.pdf'));
        $user = Auth::user();
        $machines =  Machine::where('maqn_estado', 'A')->get();

        if (!$user->can('Lista de máquinas de tanqueo')) {
            return view('paginateErrors.403');
        }
        if (!$user->can('Lista de Descarga de carrotanque')) {
            return view('paginateErrors.403');
        }
        // $fuelsshoppings = FuelsShoppingModel::listFuelsShopping($request);
        $machineTankings = MachineTankingModel::listMachineTanking($request);
        return view('tankages.machineTanking.index', compact('machineTankings','request','machines'));
    }
    public function formMachineTanking(Request $request)
    {
        $user = Auth::user();
        if (!$user->can('Formulario de máquinas de tanqueo')) {
            return view('paginateErrors.403');
        }
        $machineTanking = MachineTankingModel::getMachineTanking($request->tanq_id);
        $machines =  Machine::where('maqn_estado', 'A')->get();
        $tankings =  Machine::where('maqn_tipo', 7)->where('maqn_estado', 'A')->get();
        $fuelsshoppings = FuelsShoppingModel::listFuelsShopping();


        if (isset($request->show) && $request->show == 'true') {
            return view('tankages.machineTanking.show', compact('machineTanking'));
        } else {
            return view('tankages.machineTanking.form', compact('machineTanking', 'machines', 'fuelsshoppings', 'tankings'));
        }
    }
    public function saveMachineTanking(Request $request)
    {

        try {
            $user = Auth::user();
            $data = $request->all();



            if (!$user->can('Guardar de máquinas de tanqueo')) {
                return view('paginateErrors.403');
            }

            if ($request->cubt_idcompra) {

                $fuelsshopping = FuelsShoppingModel::getFuelsShoppingPersonalized($request->cubt_idcompra);

                $ccmb_volumen =  $fuelsshopping->ccmb_volumen;

                $machineTankingTanqVolumen = MachineTankingModel::getFuelsShoppingMachineTanking($request->cubt_idcompra)->sum('tanq_volumen');

                if ($request->tanq_volumen > $ccmb_volumen) {
                    return response()->json(['message' => "El volumén ingresado superá el volumén de la remisón de tanqueo"], 500);
                }


                if ($machineTankingTanqVolumen == $ccmb_volumen) {
                    return response()->json(['message' => "No se permite realizar más tanqueos con el número de remisión seleccionado # $fuelsshopping->ccmb_numremision"], 500);
                }
            }


            if ($request->tanq_origen == "CB") {


                $endFuelsShopping = FuelsShopping::orderBy('id', 'desc')->select('ccmb_vlrunidad')->first();
                $data['tanq_valor_tanqueo'] = $endFuelsShopping->ccmb_vlrunidad;
                $machineTanking1 =  MachineTanking::where('cub_id', $request->cub_id)->select('tanq_volumen')->first();

                if ($machineTanking1) {

                    $machineTanking2 = MachineTanking::where('cub_id', $request->cub_id)->whereNull('cubt_idcompra')->sum('tanq_volumen');

                    if ((int) $request->tanq_volumen > $machineTanking1->tanq_volumen) {

                        return response()->json(['message' => "Lo ingresado supera el volumén de que hay en el cubitaque"], 500);
                    }

                    if ($machineTanking1->tanq_volumen == (int)  $machineTanking2) {

                        return response()->json(['message' => "No se puede sacar más gasolina del cubitaque "], 500);
                    }
                }
            }



            // return response()->json([$machineTankingTanqVolumen,$ccmb_volumen], 500);

            // return response()->json( $men,500);



            // if ($request->tanq_origen == 'CB' || $request->tanq_origen == 'EX') {

            //     $data['cubt_idcompra'] = null;
            // }
            // // return response()->json(['message' => $data], 500);


            $data['id_user'] = Auth::id();

            $edit = !is_null($data['id']) ? true : false;
            $validate = MachineTankingModel::getValidator($data, $edit);
            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 500);
            }

            MachineTankingModel::saveMachineTanking($data);
            $machineTankings = MachineTankingModel::listMachineTanking($request);
            return view('tankages.machineTanking.trMachineTanking', compact('machineTankings'));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'Linea' => $e->getLine()], 500);
        }
    }
    public function deleteMachineTanking(Request $request)
    {
        $user = Auth::user();
        if (!$user->can('Eliminar de máquinas de tanqueo')) {
            return view('paginateErrors.403');
        }

        $machineTanking = MachineTankingModel::getMachineTanking($request->tanq_id);
        $machineTanking->delete();
        $machineTankings = MachineTankingModel::listMachineTanking();
        return view('tankages.machineTanking.trMachineTanking', compact('machineTankings'));
    }
}
