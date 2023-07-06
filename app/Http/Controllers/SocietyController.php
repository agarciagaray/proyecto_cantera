<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\State;
use App\Models\City;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\SocietyModel;
use App\Models\PersonModel;
use Auth;
// use Illuminate\Support\Facades\Storage;
class SocietyController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase Supplier
     * para utilizarlo en los métodos de la clase SupplierController
     */
    protected $cities;

    public function __construct(City $cities)
    {

        $this->cities = $cities;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  dd($url = Storage::url('1654542134_Flyer Food Truck México de Comida Mexicana.png'));
        $societies = Society::orderBy('id', 'DESC')->get();
        $states = State::all();
        return view('societies.index', ['societies' => $societies, 'states' => $states]);
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

        $society = Society::find($request->id);
        $person = $society->Person ?? '';


        if (isset($request->show) && $request->show == 'true') {

            return view('societies.show', compact('society'));
        } else {
            $states = State::all();
            $cities = City::all();
            // dd($cities);
            return view('societies.form', compact('society', 'states', 'person', 'cities'));
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

        $society = $request->society;
        $societyPrefix = null;
        if ($society['prefix']) {
            $societyPrefix = Society::where('prefix', $society['prefix'])->first();
        }
    
        if ($societyPrefix && is_null($society['id'])) {
            return response()->json(['message' => "Este prefijo ya fue asociado a una sociedad"], 500);
        }

        $person = $request->person;

        $person['pers_identif']  =   $request->person['pers_identif'];
        $person['id_user'] = Auth::id();
        $person['pers_estado']       =  'A';
        $validatePerson = PersonModel::getValidator($person, $request->person['pers_tipoid']);

        if ($validatePerson->fails()) {
            return response()->json(['errors' =>   $validatePerson->errors()], 500);
        }

        $person = Person::updateOrCreate($person);
        $society['id_person'] = $person->id;
        // $society['soci_identif'] = $request->society['soci_identif'];
        // $society['soci_nombrelogo'] = $request->society['rSocial'];
        $society['soci_estado'] = 'A';

        $validateSociety  = SocietyModel::getValidator($society);
        if ($validateSociety->fails()) {
            return response()->json(['errors' => $validateSociety->errors()], 500);
        }
        
        $society = SocietyModel::saveSociety($society);

        if ($request->file('file')) {
            $file = $request->file('file');
            //obtenemos el nombre del archivo
            $name =  time() . "_" . $file->getClientOriginalName();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('public')->put($name,  \File::get($file));

            // public\images\perfile\society\1654543493_Post de Instagram Collage Fitness Motivación Deporte Amarillo y Negro (2).png
            $soc = Society::find($society->id);
            $soc->soci_nombrelogo ="/storage/".$name;
    
            $soc->save();
        }

        $societies = Society::orderBy('id', 'DESC')->get();

        return view('societies.trSociety', ['societies' => $societies]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //    dd($request->idSociety);
        $society = Society::find($request->idSociety);
        $society->soci_estado = 'I';
        $society->save();

        $id_person = $society->Person->id ?? '';
        $person = PersonModel::getPerson($id_person);
        if ($person) {
            $person->pers_estado  = 'I';
            $person->save();
        }

        $societies = Society::orderBy('id', 'DESC')->get();

        return view('societies.trSociety', ['societies' => $societies]);
    }
}
