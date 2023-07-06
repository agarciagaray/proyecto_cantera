<?php

namespace App\Models;

use App\Models\Society;
use Validator;
// app includes


// use App\Models\Admin\SocietySystem;

/**
 * Querys for Society Table
 */
class SocietyModel {

    /**
     * Get all Societys
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Societys
     */
    public static function listSociety($paginate = 10, $search = null) {

        $society = Society::query();


        return $society->orderBy('id','DESC')->get();
    }

    /**
     * get a Society by id
     * @param integer $Society id from database
     * @return Object Society FormSociety
     */
    public static function getSociety($idSociety) {
        // Estas funcion se puede usar si necesitan una Societya, se busca por id
        $Society = Society::find($idSociety);

        return $Society;
    }

    /**
     * get validator for Societys
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator  = null;
        // Se organiza la condicion los validator dependiendo lo que se necesite que valide
        
        // Con esto se cambia el mensaje, que muestra la validacion

        $niceNames = array(
            // 'soci_identif.required'      => 'El número de identificación es requerido',
            'soci_estado.required'       => 'El estado es requerido',
            'soci_identif.unique'      => 'El número de identificación debe ser único, el ingresado ya está asociado a una sociedad existente', 
            'prefix.max'=>'Se permite maximo 10 caracteres para prefijo',
            'prefix.required'=>'El prefijo es requerido',
            'soci_nombrelogo.file'=>'El logo debe ser un archivo',
            'soci_nombrelogo.size'=>'El logo debe tener un tamaño menor o igual 5000mb'
        );
        $validator = Validator::make($data, [
            // 'soci_identif'      => 'required', 'unique:societies' . ',id,' . $data['id'] ?? '',
            'soci_estado'       => 'required',
            'id_person'      => 'required',
            'soci_nombrelogo'=>   'file|max:5000'
         
            // 'prefix'=> 'required|max:10', 'unique:societies' . ',id,' . $data['id'] ?? ''
            // 'pers_identif'      => 'required|max:12|unique:persons'. ',id,'.$data['id'] ?? '',

        ],$niceNames);




        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    public static function saveSociety($data) {
        $society =  Society::find($data['id']??'');

        if($society){
            $society->update($data);
        }else{

            Society::create($data);
        }
        return $society;
    }
}
