<?php

namespace App\Http\Controllers;
use App\Models\Tipopago;
use App\Tipopago as AppTipopago;
use Illuminate\Http\Request;

class TipopagoController extends Controller
{
 
    protected $tipopago;
    public function __construct(Tipopago $tipopago)
    {
        $this->tipopago = $tipopago;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {    
        $tipopago = Tipopago::orderBy('id_tipopago','DESC')->get();
        //dd($conceptsnovelties);
        return view('tipopago.index', [ 'tipopago' => $tipopago ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipopago = Tipopago::find($request->id_tipopago);

        if (isset($request->show) && $request->show == 'true') {

            return view('tipopago.show', compact('tipopago'));
        } else {
        
            return view('tipopago.form', compact('tipopago'));
        }
    }

    /* * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    

     
     //Voy por aqui 04/05/2023
     /*
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


     /*
    public function destroy(Request $request)
    {

        $remissionconcnovelty = RemissionConceptNovelty::find($request->idConceptNovelty);

        $remissionconcnovelty->cncn_estado = 'I';
        $remissionconcnovelty->save();
        
        $remissionconcnovelties = RemissionConceptNovelty::orderBy('id','DESC')->get();
        //dd($conceptsnovelties);
        return view('remissionconcnovelties.trRemissionConceptNov', [ 'remissionconcnovelties' => $remissionconcnovelties ]);
    }*/
}
