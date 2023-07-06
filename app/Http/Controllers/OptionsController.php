<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OptionsModel;
use App\Models\Optionsdetails;
use App\Models\Options;
use App\Models\Material;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $options = Options::orderBy('id','DESC')->get();

        return view('options.index', ['options' => $options]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $options = Options::find($request->id);




        $detailsoptions = null;
        if (isset($request->show) && $request->show == 'true') {
          //Esta es la vista del show para opciones
            return view('options.show', compact('options'));
        } else {

            if ($options) {

                $detailsoptions = Options::with('detailOptions','detailOptions.Material')->find($request->id);;

            }

            $materials = Material::select('mate_descripcion', 'id')->get();

            

            return view('options.form_', compact('detailsoptions', 'options', 'materials'));
        }

        /* if (isset($request->show)&& $request->show=='false')
            {return view('options.form',compact('options'));}
            */


        /*
            $optionsdetails=
            if (isset($request->show) && $request->show == 'true') {

                return view('options.show', compact('options'));
            } else {
                if()
    
                return view('options.form', compact('options'));
            }
            */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        try {
            // $data = $request->all();
            DB::beginTransaction();
            /* $validate = PersonModel::getValidator($person, $request->TipoId);
        
                if ($validate->fails()) {
        
                    return response()->json(['errors' => $validate->errors()], 500);
                }
        */
            // Creo los datos option
            $newOption = new Options;
            $newOption->nom_option = $request->nom_option;
            $newOption->estado = 'A';


            
         
            $newOption->save();


          
            foreach ($request->options as $value) {

                $detail = new Optionsdetails;
                $detail->options_id = $newOption->id;
                $detail->materials_id =  $value['dtrm_idmaterial'];
                $detail->porcentaje = $value['porcentaje'];
                $detail->estado = 'A';
                $detail->save();
           

            }

          
            $options = Options::get();
            DB::commit();
            //  return redirect()->route('option.index');
            return view('options.trOption', ['options' => $options]);
        } 
    
        

        
        
        catch (\Exception $e) {
            DB::rollback();

          return response()->json(['message' => 'Error '. $e->getMessage() .' '.$e->getLine()],500);
        }



    }
    public function update(Request $request)
    {

        $options = Options::find($request->id);

        foreach ($request->options as $value) {
            $detail = Optionsdetails::where('options_id',$value['options_id']);
            if($detail){
                $detail->delete();
            }

        }
        foreach ($request->options as $value) {

            $detail = new Optionsdetails;
            $detail->options_id =  $options->id;
            $detail->materials_id =  $value['dtrm_idmaterial'];
            $detail->porcentaje = $value['porcentaje'];
            $detail->estado = 'A';
            $detail->save();

        }

        $options = Options::get();
        return view('options.trOption', ['options' => $options]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConceptPayment  $conceptpayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $options = Options::find($request->idoptions);
        $options->estado = 'I';
        $options->save();
        $options = Options::orderBy('id', 'DESC')->get();

        return view('options.trOption', ['options' => $options]);
    }

    public function trOptions(Request $request)
    {

        //dd($request->all());
        // Log::channel('stderr')->info('entrandooo');
        //  $data=Material::where('id','mate_descripcion');  
        //$data = PriceList::where('id_obra', $request->id_obra)->where('id_material', $request->id_material)->first();
        $data = PriceList::where('id_material', $request->id_material)->first();
        $count = $request->count;

        //   Log::channel('stderr')->info('data mensaje');
        // Log::channel('stderr')->info($data);
        return view('options.trOption_', compact('data', 'count'));
    }
}
