<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\Options;

class OptionsModel extends Model
{
   /**
    * Get all ConceptPayments
    * @param integer $paginate default value 10, quantity to be shown by pages, can be null
    * @param string $search value to be searched, can be null
    * @return Object ConceptPayments
    */
   public static function listOptions($paginate = 10, $search = null) {               

       $options = Options::query();

       // $ConceptPayment->orderBy('name');
       // if ($search) {
       //     $ConceptPayment->where(function ($sbQuery) use ($search) {
       //         $sbQuery->where('name', 'LIKE', "%$search%");
       //     });
       // }

       return  $options->orderBy('id','DESC')->get();
   }

   /**
    * get a ConceptPayment by id
    * @param integer $ConceptPayment id from database
    * @return Object ConceptPayment FormConceptPayment
    */
   public static function getoptions($idoptions) {
       $options = Options::find($idoptions);

       return $options;
   }

   /**
    * get validator for ConceptPayments
    * @param array $data information from form
    * @return Object Validator
    */
   //Validaciones
  

   public static function getValidator($data,$Nom_) {
    $validator  = null;

    // Se organiza la condicion los validator dependiendo lo que se necesite que valide

    $niceNames = array(
        'options_id.required'     => 'El nombre es requerido',
        'materials_id.min'  => 'El material  es requeridod',
        'porcentaje.min'  => 'El porcentaje es requerido',
    );


    $valid = $data['id'] == '' ? '':',id,'.$data['id'] ;
    if($Nom_ =='false'){
        // dump('nit');
        $validator = Validator::make($data, [
            'options_id'      => 'required|digits_between:9,12|unique:options'. $valid ,
            'materials_id'       => 'required|max:3',
            'porcentaje'  => 'required|max:120', //Bien

        ],$niceNames);
    } else {
        // dump('cc');
        $validator = Validator::make($data, [
            'options_id'      => 'required|digits_between:9,12|unique:options'.$valid,
            'materials_id'       => 'required', 'max:3',
            'porcentaje'  => 'max:120',
    
           // 'pers_primerapell' => 'required|max:40',
           // 'pers_email'        => 'max:50|email|unique:persons'.$valid,
        ],$niceNames);

    }

    // 'reputationNotes',
    // Con esto se cambia el mensaje, que muestra la validacion
;

    // $validator->setAttributeNames($niceNames);

    return $validator;
}

   /**
    * save ConceptPayment
    * @param type $data information from form
    * @return Object ConceptPaymentFormConceptPayment
    */
   public static function saveOptions_($data) {
       //Consulta primero para ver si existe , para saber si crear o no
       $Options_ = Options::find($data['id']);
       if ($Options_) {
           $Options_->update($data);
       } else {
           $Options_ = Options::create($data);
       }
       return $Options_;
   }
}
