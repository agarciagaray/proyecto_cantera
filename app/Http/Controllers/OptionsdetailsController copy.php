<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\models\Optionsdetails;
use App\models\Options;
use App\models\Material;
use App\models\Production;
use Illuminate\Http\Request;
use App\Exports\PorcentajesExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;




class OptionsdetailsController extends Controller
{
    public function conversiones(){


       // $optionsdetails_  = Optionsdetails::where('client_estado', 'A')->get();
       
         

        $productions =Production::whereNotNull('options_id')->where('cerrado','!=','0')->paginate(3);
  
        $optionsdetails = Optionsdetails::orderBy('id','ASC')->get();
        $Options = Options::where('estado','A')->get();
        
      //  $optionsdetails = Optionsdetails::paginate(10);
            
        return view('optionsdetails.conversiones', ['optionsdetails'=>$optionsdetails,'Options'=>$Options,'productions'=>$productions]);
    
        $options = Options::orderBy('id','DESC')->get();

        return view('options.index', ['options' => $options]);
    
    
    
      } 


      public function   closeoption()
      {


         return view('optionsdetails.closed');


      }



//prueba
    public function cerraroption(Request $request){

      $optionsdetails = Optionsdetails::query();

      $options=Options::where('estado','A')->get();
   
      $Abiertas=Production::where('cerrado','0')->where('options_id','!=','null')->get();
       
    
       $Options=Options::where('estado','A')->get();
       $NomOptions = Production::with('OptionsNombre')->find($request->id);;
    
    return view('optionsdetails.cerraropciones', ['optionsdetails' => $optionsdetails,'options'=>$options,'request'=>$request,'Abiertas'=>$Abiertas,'NomOptions'=>$NomOptions,'Options'=>$Options]);

   } 





      public function createSalidaPorcentaje(Request $request)

    {

      $productions = Production::find($request->id);
      $optionsdetails = Optionsdetails::where('estado','A')->get();
      $options = Options::where('estado','A')->get();



   //   $productions= Production::find($request->id);
   
     
          return view('optionsdetails.show',compact('productions','optionsdetails','options'));
     }
     


                public function FiltrarsalidaConversion(Request $request)
           {

          // Esto se envia sin importar la condicion ya que es obligatorio.
            $optionsdetails =Optionsdetails::where('estado','A')->get();
            $Options = Options::where('estado','A')->get();
            $productionsQuery= Production::query();
            $productions =  Production::get();

            if (isset($request->prod_fecha_1) && isset($request->prod_fecha_2)) {
                          
              $productions = $productionsQuery->whereNotNull('options_id')->where('cerrado','!=','0')
              ->whereBetween('prod_fecha', [$request->prod_fecha_1, $request->prod_fecha_2])
              ->paginate(10);
              
            }
      
            // INtenta

            // se hara de la manera mas sencilla
            return view('optionsdetails.trSearch',compact('productions','Options','optionsdetails'));
                        //dd($request->all());)
                    //  
                        //dd($production); 

/*
                        $fechaInicio = $request->input('prod_fecha_1');
                        $fechaFin = $request->input('prod_fecha_2');
                        
                        // Realiza tu consulta utilizando los parámetros de fecha
                        $productions = Production::whereNotNull('options_id')->where('cerrado','!=','0')
                        ->whereBetween('prod_fecha', [$fechaInicio, $fechaFin])
                                              ->get();

                        // Devuelve los resultados a una vista


//pera por que lo comente
                        $optionsdetails =Optionsdetails::where('estado','A')->get();
                        $Options = Options::where('estado','A')->get();
                       // $productions = $productions;
                        
                      //  $optionsdetails = Optionsdetails::paginate(10);
                            
                        return view('optionsdetails.index', ['productions '=>$productions ,'Options'=>$Options,'optionsdetails'=>$optionsdetails]);
 
                       // return view('optionsdetails.index')->with('resultados', $resultados);



                       */ 
                        


                        
       // $productions =Production::whereNotNull('options_id')->where('cerrado','!=','0')->paginate(3);
  
    
                 

                     

             //dd($production); 
              // dump(2);
            //  $fecha->whereBetween('prod_fecha',[$request->prod_fecha_1,$request->prod_fecha_2]);
             // $fecha->whereBetween('prod_fecha',['2023-02-17','2023-05-29']);
            //  dd($request->all());
              // $preSettlements->where('dateEnd', $request->dateEnd);
          
            //  $optionsdetails = Optionsdetails::paginate(10);
     

                          
       //   return view('optionsdetails.index', ['production '=>$production ]);
    
      
     

       // $production =$production->get();
        
      //  return view('optionsdetails.index',compact('production ',$production));
       // $productions =Production::whereNotNull('options_id')->where('cerrado','!=','0')->get();
        
       // $optionsdetails = Optionsdetails::where('estaso','A')->get();
    
      //  $optionsdetails = Optionsdetails::paginate(10);
            
     
        


       // $optionsdetails = ::where('client_estado', 'A')->get();
    //    return view('invoices.indexSettlement',compact('preSettlements','clients'));


     /*
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
*/
  

          }


         public function exportlistPorcentajes(Request $request)
         
         
         {

          $productionsQuery= Production::query();

          $optionsdetails =Optionsdetails::where('estado','A')->get();
          $Options = Options::where('estado','A')->get();
          $productionsQuery= Production::query();
          $productions =  Production::get();

          $porcentajes  = null;
          if (isset($request->prod_fecha_1) && isset($request->prod_fecha_2)){
            $nameNew = 'Porcentajes' . '_' .$request->prod_fecha_1. '_' .$request->prod_fecha_1 ;
            $name = "$nameNew.xlsx";
           // $porcentajes =  DB::select("prod_fecha('$request->prod_fecha_1','$request->prod_fecha_2')");
            
            
                          
           /* $porcentajes = $productionsQuery->whereNotNull('options_id')->where('cerrado','!=','0')
            ->whereBetween('prod_fecha', [$request->prod_fecha_1, $request->prod_fecha_2])
            ->get();
           */ 
                   
             $porcentajes = $productionsQuery->whereNotNull('options_id')->where('cerrado','!=','0')
             ->whereBetween('prod_fecha', [$request->prod_fecha_1, $request->prod_fecha_2])
             ->paginate(10);
             
           
            return Excel::download(new PorcentajesExport($porcentajes,$optionsdetails, $Options,$productions), $name);
           
            }
      

        }


     
     public function Filtraropciones(Request $request)
     {



            // dd($request->all());
              $optionsdetails = Optionsdetails::query();
              $options= Options::query();
              $Options= Production::query();
            
            
              $options=Options::where('cerrado','!=','1')->get();
              $Abiertas=Production::where('cerrado','0')->get();
            //  $Abiertas=Production::select('cerrado','0')->get();
            // $optionss=Options::where('estado','A')->get();
            // $optionss=Options::where('estado','A')->get();
            //  $optionss->where('estado', '=', 'A');
              
            // $clients = Client::where('estado', 'A')->get();
              $optionsdetails= Optionsdetails::where('estado','A')->get();
        
            //  $Salida = $Abiertas->get(); 
            if (isset($request->options_id ) &&  $request->options_id) {

            // dd($request->options_id);

              //$options->where('_idOption', $request->_idOption);
              $Options->where('options_id', $request->options_id);
              
              return view('optionsdetails.trPorcentajeAssignment', ['options'=>$options,'Abiertas'=>$Abiertas,'Options' => $Options]);
      }
               
  
    


         
     }


                       
                        
        public function cerrarporcentajes(Request $request)
        {
       
            $optionsdetails = Optionsdetails::query();

             $options=Options::where('estado','A')->get();
          
             $Abiertas=Production::where('cerrado','0')->where('options_id','!=','null')->get();
              
           
              $Options=Options::where('estado','A')->get();
              $NomOptions = Production::with('OptionsNombre')->find($request->id);;
           
           return view('optionsdetails.cerraropciones', ['optionsdetails' => $optionsdetails,'options'=>$options,'request'=>$request,'Abiertas'=>$Abiertas,'NomOptions'=>$NomOptions,'Options'=>$Options]);
   
        }
    



// Nota pasar para el controlador de Optionsdetails






public function savePorcentajeAssignment(Request $request)
{
    
  // dd($request->all());
  foreach($request->optionAssigns as $value){

  $OptionsCerrar = Production::where('options_id', $value["id"])->first();
  $OptionsCerraroption = Options::where('id', $value["id"])->first();
  $OptionsCerrar->cerrado = '1';
  $OptionsCerraroption->cerrado='1';
  $OptionsCerrar->save();
  $OptionsCerraroption->save();

}


   

    }







      /*    public function store(Request $request)

    {
       

    }

*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConceptPayment  $conceptpayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $options = Optionsdetails::find($request->idoptions);
        $options->estado ='I';
        $options->save();
        $options = Options::orderBy('id','DESC')->get();
     
        return view('options.trOption',['options' => $options]);
    }

}



