<?php

namespace App\Http\Controllers;

use App\Models\ConceptPayment;
use App\Models\ConceptPaymentModel;
use Illuminate\Http\Request;

class ConceptPaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    

        $conceptspayments = ConceptPayment::orderBy('id','DESC')->get();
        return view('conceptspayments.index', ['conceptspayments' => $conceptspayments ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $conceptPayment = ConceptPayment::find($request->id);

        if (isset($request->show) && $request->show == 'true') {

            return view('conceptspayments.show', compact('conceptPayment'));
        } else {

            return view('conceptspayments.form', compact('conceptPayment'));
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
        $validate = ConceptPaymentModel::getValidator($data);
        if($validate->fails()) {

            return response()->json(['errors' => $validate->errors()], 500);

        }
        ConceptPaymentModel::saveConceptPayment($data);
        $conceptspayments = ConceptPayment::orderBy('id','DESC')->get();
     
        return view('conceptspayments.trConceptPayment', [ 'conceptspayments' => $conceptspayments ]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConceptPayment  $conceptpayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {                                                    
        $conceptPayment = ConceptPayment::find($request->idConceptPayment);
        $conceptPayment->cncp_estado ='I';
        $conceptPayment->save();
        $conceptspayments = ConceptPayment::orderBy('id','DESC')->get();
     
        return view('conceptspayments.trConceptPayment', [ 'conceptspayments' => $conceptspayments ]);
    }
}
