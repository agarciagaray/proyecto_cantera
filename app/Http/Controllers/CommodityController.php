<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request;
use Auth;
class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$commodities = Commodity::orderBy('id','DESC')->get();
        $commodities = Commodity::orderBy('id','DESC')->get();
        return view('commodities.index', ['commodities' => $commodities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $commodity= Commodity::find($request->id);
       
        if (isset($request->show) && $request->show == 'true') {

            return view('commodities.show', compact('commodity'));
        } else {

            return view('commodities.form', compact('commodity'));
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
        $commodity  = Commodity::find($request->id);
        $data =$request->all();
        if ($commodity) {
            $commodity->update( $data);
        } else {
            $data['id_user']=Auth::id();
            $commodity = Commodity::create($data);
        }
        $commodities = Commodity::orderBy('id','DESC')->get();
        return view('commodities.trCommodities', compact('commodities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $commodity= Commodity::find($request->idCommodity);
        $commodity->matp_estado = $request->matp_estado;
        $commodity->save();
        $commodities = Commodity::orderBy('id','DESC')->get();
        return view('commodities.trCommodities', compact('commodities'));
    }
}
