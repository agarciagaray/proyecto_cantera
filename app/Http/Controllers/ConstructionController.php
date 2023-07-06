<?php

namespace App\Http\Controllers;

use App\Exports\ConstructionExport;
use App\Models\Admin\PermissionModel;
use App\Models\Construction;
use App\Models\ConstructionModel;
use App\Models\State;
use App\Models\City;
use App\Models\Client;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ConstructionController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase 
     * para utilizarlo en los métodos de la clase Controller
     */
    protected $constructions;
    protected $states;
    protected $cities;

    public function __construct(Construction $constructions, City $cities)
    {
        $this->constructions = $constructions;
        $this->cities = $cities;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $constructions = Construction::orderBy('id', 'DESC')->get();

        $clients = Client::where('client_estado', 'A')->get();
        $states = State::where('country_id', 1)->get();

        return view('constructions.index', ['constructions' => $constructions, 'states' => $states, 'clients' => $clients]);
    }

    public function Cities($state_id)
    {
        $cities = $this->cities->getCities($state_id);

        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $construction = Construction::find($request->id);

        $client = null;
        if (isset($request->show) && $request->show == 'true') {

            return view('constructions.show', compact('construction'));
        } else {
            $clients = Client::where('client_estado', 'A')->get();
            $states = State::where('country_id', 1)->get();

            // dd($states);
            $cities = City::all();

            if ($construction) {
                $client = $construction->Client;
            }
            return view('constructions.form', compact('construction', 'clients', 'states', 'cities', 'client'));
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
        // Creo los datos de Obra
        $construction = [];

        $construction['obra_idcliente']         = $request->idCliente;
        $construction['obra_nombre']            = strtoupper($request->nombreObra);
        // $construction['obra_dpto']              = $request->dpto;
        // $construction['obra_ciudad']            = $request->ciudad;
        $construction['obra_direccion']         = strtoupper($request->dir);
        $construction['obra_porcsuministro']    = $request->porcSuministro;
        $construction['obra_porctransporte']    = $request->porcTransporte;
        $construction['obra_obs']               = strtoupper($request->obs);
        $construction['id_user']                = Auth::id();

        $validate = ConstructionModel::getValidator($construction);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        Construction::create($construction);

        // Obtengo los datos nuevamente para mostrarlos en el listado 
        $constructions = Construction::orderBy('id', 'DESC')->get();
        $states = State::where('country_id', 1)->get();
        return view('constructions.trConstruction', ['constructions' => $constructions, 'states' => $states]);
    }


    public function show($id)
    {
        $construction = $this->constructions->getConstructionById($id);
        $materials = PriceList::where('id_obra', $id)->where('priceList_estado', 'A')->with('Material')->get();
        return response()->json(['data' => $construction, 'materials' => $materials]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Construction $construction)
    {
        // Actualizo los datos de una Obra
        $constrUpd = [];

        $constrUpd['obra_idcliente']         = $request->idCliente;
        $constrUpd['obra_nombre']            = $request->nombreObra;
        // $constrUpd['obra_dpto']              = $request->dpto;
        // $constrUpd['obra_ciudad']            = $request->ciudad;
        $constrUpd['obra_direccion']         = $request->dir;
        $constrUpd['obra_porcsuministro']    = $request->porcSuministro;
        $constrUpd['obra_porctransporte']    = $request->porcTransporte;
        $constrUpd['obra_obs']               = $request->obs;

        $validate = ConstructionModel::getValidator($constrUpd);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        $constr = ConstructionModel::getConstruction($request->id);
        $constr->update($constrUpd);

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $constructions = Construction::orderBy('id', 'DESC')->get();
        $states = State::where('country_id', 1)->get();
        return view('constructions.trConstruction', ['constructions' => $constructions, 'states' => $states]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $contructor = ConstructionModel::getConstruction($request->idContructor);

       if(count($contructor->Remission)>0){

  
        return response()->json(['message' => "No se puede anular la obra, está asociada a una remisión"], 500);

       }


      
        $contructor->obra_estado = 'I';
        $contructor->save();
        $constructions = Construction::orderBy('id', 'DESC')->get();
        $states = State::where('country_id', 1)->get();
        return view('constructions.trConstruction', ['constructions' => $constructions, 'states' => $states]);
    }
      public function searchContructionClient(Request $request)
    {
        $constructions =  Construction::where('obra_idcliente', $request->obra_idcliente)->select('id', 'obra_nombre')->where('obra_estado', 'A')->get();

        return response()->json($constructions);
    }

    function filterContructionExcel(Request $request)
    {

        $constructions =  Construction::where('obra_idcliente', $request->idClient)->where('obra_estado', $request->status)->get();

        if ($request->filter == "true") {

            return view('constructions.trConstruction', ['constructions' => $constructions]);
        }

        $date = date("d") . " del " . date("m") . " de " . date("Y");
        return Excel::download(new ConstructionExport($constructions), "Obras $date.xlsx");
    }
}
