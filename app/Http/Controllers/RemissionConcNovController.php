<?php

namespace App\Http\Controllers;

use App\Models\RemissionConceptNovelty;
use App\Models\RemissionConceptNoveltyModel;
use Illuminate\Http\Request;

class RemissionConcNovController extends Controller
{
    /**
     * Creamos el constructor para inyectar la dependencia de la clase RemissionConceptNovelty
     * para utilizarlo en los métodos de la clase ClientController
     */
    protected $remissionconcnovelties;
    public function __construct(RemissionConceptNovelty $remissionconcnovelties)
    {
        $this->remissionconcnovelties = $remissionconcnovelties;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $remissionconcnovelties = RemissionConceptNovelty::orderBy('id','DESC')->get();
        //dd($conceptsnovelties);
        return view('remissionconcnovelties.index', [ 'remissionconcnovelties' => $remissionconcnovelties ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $remissionconcnovelty = RemissionConceptNovelty::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('remissionconcnovelties.show', compact('remissionconcnovelty'));
        } else {
        
            return view('remissionconcnovelties.form', compact('remissionconcnovelty'));
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
        $data = $request->all();

        $validate = RemissionConceptNoveltyModel::getValidator($data);


        if($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);

        }

        RemissionConceptNoveltyModel::saveRemissionConceptNovelty($data);

        $remissionconcnovelties = RemissionConceptNovelty::orderBy('id','DESC')->get();
        //dd($conceptsnovelties);
        return view('remissionconcnovelties.trRemissionConceptNov', [ 'remissionconcnovelties' => $remissionconcnovelties ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConceptNovelty  $conceptsnovelty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $remissionconcnovelty = RemissionConceptNovelty::find($request->idConceptNovelty);

        $remissionconcnovelty->cncn_estado = 'I';
        $remissionconcnovelty->save();
        
        $remissionconcnovelties = RemissionConceptNovelty::orderBy('id','DESC')->get();
        //dd($conceptsnovelties);
        return view('remissionconcnovelties.trRemissionConceptNov', [ 'remissionconcnovelties' => $remissionconcnovelties ]);
    }
}
