<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PreSettlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreSettlementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $preSettlements = PreSettlement::query();
        if (isset($request->dateStart) && !$request->dateEnd) {
            $preSettlements->whereDate('dateStart', $request->dateStart);
        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {
            // dump(2);
            $preSettlements->whereBetween('date',[$request->dateStart,$request->dateEnd]);
            // $preSettlements->where('dateEnd', $request->dateEnd);
        }
  
        if (isset($request->idConstruction) && $request->idConstruction) {
            $preSettlements->where('id_construction', $request->idConstruction);
        }
        $preSettlements = $preSettlements->get();
        
        if($request->filter){
            return view('invoices.trSettlement',compact('preSettlements'));
        }
      
        $clients = Client::where('client_estado', 'A')->get();
        return view('invoices.indexSettlement',compact('preSettlements','clients'));
    }

    public function edit(Request $request)
    {
      
        $settlement = PreSettlement::find($request->id);
        $settlement->delete();
        $preSettlements = PreSettlement::get();
        return view('invoices.trSettlement',compact('preSettlements'));
     
    }

}
