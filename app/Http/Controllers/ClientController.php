<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\State;
use App\Models\City;
use App\Models\Person;
use App\Models\PersonModel;
use App\Models\ClientModel;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller {
    /**
     * Creamos el constructor para inyectar la dependencia de la clase Client
     * para utilizarlo en los métodos de la clase ClientController
     */

     protected $cities;

     public function __construct(City $cities) {

        $this->cities = $cities;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $clients = Client::orderBy('id','DESC')->get();
        $states = State::all();
        //dd($clients);
        return view('clients.index', ['clients' => $clients, 'states' => $states]);
    }

    public function Cities($state_id) {
        //return City::where('ciud_coddpto', '=', $state_id)->get();

        // dd('hola');
        $cities = $this->cities->getCities($state_id);
        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $client = Client::find($request->id);

        $person = null;
        if (isset($request->show) && $request->show == 'true') {

            return view('clients.show', compact('client'));
        } else {
            $states = State::all();
            $cities = City::all();
            if ($client) {

                $person =  $client->Person;
            }
            return view('clients.form', compact('client', 'states', 'person', 'cities'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Creo los datos de Persona

        // return response()->json(['errors' => $request->all()], 500);

      //  dd($request->all());
        $person = [];
        $person['id']         = '';
        $person['pers_identif']         = $request->idCliente;
        $person['pers_tipoid']          = $request->TipoId;
        $person['pers_razonsocial']     = strtoupper($request->pers_razonsocial);
        $person['pers_primernombre']    = strtoupper($request->Nom1);
        $person['pers_segnombre']       = strtoupper($request->Nom2);
        $person['pers_primerapell']     = strtoupper($request->Apell1);
        $person['pers_segapell']        = strtoupper($request->Apell2);
        $person['pers_direccion']       = strtoupper($request->dir);
        $person['pers_telefono']        = strtoupper($request->tel);
        $person['ciud_id']          = (int) $request->ciudad;
        $person['dpto_id']            = (int) $request->dpto;
        $person['pers_email']           = strtoupper($request->eMail);
        $person['id_user']              = Auth::id();
        $person['pers_estado'] = 'A';
        $validate = PersonModel::getValidator($person, $request->TipoId);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        $person = Person::create($person);

        // Creo los datos de Clientes
        $client = [];
        $client['client_estado'] = 'A';
        $client['id_person']     = $person->id;
     //    $client['clie_dircorresp']  = $request->dirCorresp;

        $validate = ClientModel::getValidator($client);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        Client::create($client);

        // Obtengo los datos nuevamente para mostrarlos en el listado de clientes
        $clients = Client::orderBy('id','DESC')->get();
        $states = State::all();
        //dd($clients);
        return view('clients.trClient', ['clients' => $clients, 'states' => $states]);

        /*return view('clients.trClient',compact('clients'));*/
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function  searchClient(Request $request) {
        // PersonModel::getPerson('paso el id de persona'); me retorna la persona

        $client = Client::find($request->id);
        return   $client->Person;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client) {

        // Actualizo los datos de Persona
        // dd($request->pers_razonsocial);
        
        // return response()->json(['errors' =>$request->all()], 500);
        $personUpd = [];
        $personUpd['id']  = $request->idPerson;
        $personUpd['pers_identif']         = $request->idCliente;
        $personUpd['pers_tipoid']          = $request->TipoId;
        $personUpd['pers_razonsocial']     = strtoupper($request->pers_razonsocial);
        $personUpd['pers_primernombre']    = strtoupper($request->Nom1);
        $personUpd['pers_segnombre']       = strtoupper($request->Nom2);
        $personUpd['pers_primerapell']     = strtoupper($request->Apell1);
        $personUpd['pers_segapell']        = strtoupper($request->Apell2);
        $personUpd['pers_direccion']       = strtoupper($request->dir);
        $personUpd['pers_telefono']        = strtoupper($request->tel);
        $personUpd['ciud_id']          = (int) $request->ciudad;
        $personUpd['dpto_id']            = (int) $request->dpto;
        $personUpd['pers_email']           = strtoupper($request->eMail);

       
        $validate = PersonModel::getValidator($personUpd, $request->TipoId);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        $person = PersonModel::getPerson($request->idPerson);
        $person->update($personUpd);

        // Actualizo los datos de Cliente
        $clientUpd = [];
        $clientUpd['id_person']      = $person->id;
       //    $clientUpd['clie_dircorresp']   = $request->dirCorresp;

        $validate = ClientModel::getValidator($clientUpd);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        $client = ClientModel::getClient($request->idClient);
        $client->update($clientUpd);

        // Obtengo los datos nuevamente para mostrarlos en el listado de clientes
        $clients = Client::orderBy('id','DESC')->get();
        $states = State::all();
        return view('clients.trClient', ['clients' => $clients, 'states' => $states]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $client = Client::find($request->id);
        $client->client_estado ='I';
        $client->save();
        if (count($client->Constructions)) {
            return response()->json(['message' => "Este cliente no se puede inactivar ya que ha sido asociado a una obra"], 500);
        }

        $person  = Person::find($client->Person->id);

        $person->pers_estado = 'I';
        $person->save();

        // Obtengo los datos nuevamente para mostrarlos en el listado de clientes
        $clients = Client::orderBy('id','DESC')->get();
        $states = State::all();
        return view('clients.trClient', ['clients' => $clients, 'states' => $states]);
    }
}
