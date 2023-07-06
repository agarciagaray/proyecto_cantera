<?php

namespace App\Http\Controllers;

use App\Exports\PriceListExport;
use App\Models\Client;
use App\Models\Construction;
use App\Models\Material;
use App\Models\MaterialModel;
use App\Models\PriceList;
use App\Models\PriceListModel;
use App\Models\Unit;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class PriceListController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceLists =  PriceList::orderBy('id', 'DESC')->get();
        $constructions =  Construction::where('obra_estado', 'A')->get();
        $clients =  Client::where('client_estado', 'A')->get();
        return view('priceLists.index', compact('priceLists', 'constructions','clients'));
    }

    public function getPriceList($idObra, $idMaterial)
    {
        $pricelist = $this->pricelist->getPriceListById($idObra, $idMaterial);
        //dd($pricelist);
        return $pricelist;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $priceList = PriceList::find($request->priceList_id);
        $constructions =  Construction::where('obra_estado', 'A')->get();
        if (isset($request->show) && $request->show == 'true') {

            return view('priceLists.show', compact('priceList'));
        } else {
            $materials = Material::where('mate_estado', 'A')->get();
            $clients = Client::where('client_estado', 'A')->get();
            $units = Unit::where('unit_estado', 'A')->get();
            return view('priceLists.form', compact('priceList', 'materials', 'clients', 'units', 'constructions'));
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
        // Creo los datos de Persona
        $arrayErrors = [];
        $id_user = Auth::id();
        try {
            if (!isset($request->priceLists) && is_null($request->id)) {
                return response()->json(['message' => "No se puede guardar, sin antes crear una lista de precios"], 500);
            }

            if (!is_null($request->id)) {

                $priceListRemission = PriceList::find($request->id);

                if (count($priceListRemission->Material->DetailMaterials) > 0) {
                    return response()->json(['message' => "No se puede modificar, ya fue asociada a una remisión"], 500);
                }
                $data  = $request->all();

                $data['id_user'] =  $id_user;
                // return response()->json(['datas' =>  $data], 500);
                $validate = PriceListModel::getValidator($data);

                if ($validate->fails()) {

                    return response()->json(['errors' => $validate->errors()], 500);
                }

                $priceList = PriceListModel::savePriceList($data);
            } else {

                $priceLists  = $request->priceLists;
                $id_obra =  $request->id_obra;
                foreach ($priceLists as $priceList) {

                    $priceList['id_user'] =  $id_user;
                    $priceList['id_obra'] =  $id_obra;


                    $validate = PriceListModel::getValidator($priceList);
                    if ($validate->fails()) {

                        return response()->json(['errors' => $validate->errors()], 500);
                    }

                    $arrayPriceList = PriceListModel::savePriceList($priceList);

                    if ($arrayPriceList  === false) {
                        $meterial = MaterialModel::getMaterial($priceList['id_material']);
                        array_push($arrayErrors, "El meterial  $meterial->mate_descripcion ya ha sido asociado a está obra");
                    }
                }
            }

            if (count($arrayErrors) > 0) {
                return response()->json(['errors' => $arrayErrors], 500);
            }

            $priceLists =  PriceList::orderBy('id', 'DESC')->get();
            return view('priceLists.trPriceList', compact('priceLists'));
        } catch (\Exception $ex) {
            if ($ex->getCode() == 23000) {
                return response()->json(['code' => $ex->getCode(), 'message' => 'El producto ya tiene lista de precio'], 500);
            }
            return response()->json(['code' => $ex->getCode(), 'message' => $ex->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function  searchMaterial(Request $request)
    {
        // PersonModel::getPerson('paso el id de persona'); me retorna la persona

        $material = Material::find($request->material_id);
        // dd($material);
        $units = Unit::all();
        $count = $request->count;
        return view('priceLists.trMaterial', compact('material', 'units', 'count'));
    }

    public function destroy(Request $request)
    {
        $priceList = PriceListModel::getPriceList($request->priceList_id);
        $priceList->priceList_estado = 'I';
        $priceList->save();

        $priceLists =  PriceList::orderBy('id', 'DESC')->get();
        return view('priceLists.trPriceList', compact('priceLists'));
    }

    public function exportListPrice(Request $request)
    {

        $priceLists =  PriceList::query();

        if (isset($request->id_customer) && !is_null($request->id_customer)) {
            $priceLists->whereHas('Construction', function ($query) use ($request) {
                $query->whereHas('Client', function ($query1) use ($request) {
                    $query1->where("id",  $request->id_customer);
                });
            });
        }



        if (!is_null($request->id_obra)) {
       
            $priceLists->where('id_obra', $request->id_obra);
        }
 
        if (!is_null($request->dateStart) && is_null($request->dateEnd)) {
            $request->dateStart = Carbon::parse($request->dateStart)->format('Y-m-d H:i:s');
            $priceLists->where('created_at', $request->dateStart);
        }


        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $request->dateStart = Carbon::parse($request->dateStart)->format('Y-m-d H:i:s');
            $request->dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d H:i:s');
            $priceLists->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
        }

        if ($request->excel == "true") {

            return Excel::download(new PriceListExport($priceLists->get()), 'Lista_de_pecios.xlsx');
        } else {

            $priceLists = $priceLists->get();

            return view('priceLists.trPriceList', compact('priceLists'));
        }
    }
}
