<?php

namespace App\Http\Controllers;

//use App\Drivers as AppDrivers;
use App\Models\Drivers;
use App\Models\DriverModel;
use App\Models\State;
use App\Models\City;
use App\Models\Person;
use App\Models\PersonModel;
use App\Models\ClientModel;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverController extends Controller {
    protected $cities;

     public function __construct(City $cities) {

        $this->cities = $cities;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $drivers =Drivers::orderBy('id','DESC')->get();
        $states = State::all();

        //dd($clients);
        return view('drivers.index', ['drivers' => $drivers, 'states' => $states]);
       // return view('drivers.index',compact('drivers', 'states'));

         
       
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

//$out = new \Symfony\Component\Console\Output\ConsoleOutput();
      //  $out->writeln('Entra create driver' ,$request->id );

        $driver = Drivers::find($request->id);

        $person = null;
        if (isset($request->show) && $request->show == 'true') {

            return view('drivers.show', compact('driver'));
        } else {
            $states = State::all();
            $cities = City::all();
            if ($driver) {

                $person =  $driver->Person;
            }


          //  return dd($request->all());
          return view('drivers.form', compact('driver','states','person','cities'));
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

       // dd($request->all());
        // return response()->json(['errors' => $request->all()], 500);
        $person = [];
        $person['id']         = '';
        $person['pers_identif']         = $request->idDriver;
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

        // Creo los datos de conductores
        $driver = [];
        $driver['conductor_estado'] = 'A';
        $driver['id_person']     = $person->id;
        $driver['driver_dircorresp']  = $request->dirCorresp;

        $validate = DriverModel::getValidator($driver);

        if ($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);
        }

        Drivers::create($driver);

        // Obtengo los datos nuevamente para mostrarlos en el listado de conductores
        $drivers = Drivers::orderBy('id','DESC')->get();
        $states = State::all();
        //dd($clients);
        return view('drivers.trDriver', ['drivers' => $drivers, 'states' => $states]);

       
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $client
     * @return \Illuminate\Http\Response
     */
    public function  searchDriver(Request $request) {
        // PersonModel::getPerson('paso el id de persona'); me retorna la persona

        $driver = Drivers::find($request->id);
        return   $driver->Person;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */


        public function update(Request $request, Drivers $drivers) {

        // Actualizo los datos de Persona
        // dd($request->pers_razonsocial);
        
        // return response()->json(['errors' =>$request->all()], 500);



        $personUpd = [];
        $personUpd['id']  = $request->idPerson;
        $personUpd['pers_identif']         = $request->idDriver;
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

        // Actualizo los datos del conductor
    /*   $drivertUpd = [];
        //$drivertUpd['id_person']      = $person->id;
      //   $drivertUpd['drive_dircorresp']   = $request->dirCorresp;

        $validate = DriverModel::getValidator($drivertUpd);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }
        $drivers = DriverModel::getDriver($request->idDriver);
       // dd($request->idDriver);
      
        //  $drive->update($drivertUpd);
       $drivers->id_person=$person->id;*/

     
      // $drivers->save();
       
       
  
//

        // Obtengo los datos nuevamente para mostrarlos en el listado de condcutores
        $drivers = Drivers::orderBy('id','DESC')->get();
        $states = State::all();
        return view('drivers.trDriver', ['drivers' => $drivers, 'states' => $states]);
    }









    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $driver =Drivers::find($request->id);
        $driver->conductor_estado ='I';
        $driver->save();
    /*   if (count($driver->Constructions)) {
            return response()->json(['message' => "Este conductor no se puede inactivar ya que ha sido asociado a una maquina"], 500);
        }
*/
        $person  = Person::find($driver->Person->id);

        $person->pers_estado = 'I';
        $person->save();

        // Obtengo los datos nuevamente para mostrarlos en el listado de clientes
        $drivers =Drivers::orderBy('id','DESC')->get();
        $states = State::all();
        return view('drivers.trDriver', ['drivers' => $drivers, 'states' => $states]);
    }
}
