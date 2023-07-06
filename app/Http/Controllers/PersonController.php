<?php

namespace App\Http\Controllers;

use App\Models\Admin\PermissionModel;
use App\Models\Person;
use App\Models\PersonModel;
use App\Models\Remission;
use App\Models\Society;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase Person
     * para utilizarlo en los métodos de la clase ClientController
     */
    protected $persons;

    public function __construct(Person $persons)
    {
        $this->persons = $persons;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $str = strtr($date, "-", " ");
        $ultime = str_replace(" ", "",  $str);
        $society = Society::find($request->id);
        $person = $society->Person;

        $remission = Remission::where('id_society', $society->id)->select('id')->latest()->first();

        $remission_count = Remission::where('id_society', $society->id)->orderBy('id_society')->take(1)->count();

        $count = $remission_count + 1;

        $id_remission = 0;

        if ($remission) {
            $id_remission = $remission->id + 1;
        } else {
            $id_remission = 1;
        }

        $society['prefix'] = $society['prefix'] . $ultime . '-' . ($id_remission) . '-' . $count;


        return response()->json(['data' => ['person' => $person, 'society' => $society]]);
    }
}
