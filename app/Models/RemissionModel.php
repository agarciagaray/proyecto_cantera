<?php

namespace App\Models;

use App\Models\Remission;
use Validator;
// app includes


class RemissionModel {

    /**
     * Get all Remission
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Remission
     */
    public static function listRemissions($paginate = 10, $search = null) {

        $remission = Remission::query();

        return  $remission->orderBy('id','DESC')->get();
    }

    /**
     * get a Construction by id
     * @param integer $remission id from database
     * @return Object Remission 
     */
    public static function getRemission($idRemission) {
        // Estas funcion se puede usar si necesitan una remision, se busca por id
        $remission = Remission::find($idRemission);

        return $remission;
    }

    /**
     * get validator for Remission
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $niceNames = array(
            'id_obra.required'      => 'Id. Obra es requerido',
            'id_society.required'   => 'Id. Sociedad es requerido',
            'remi_fecha.required'   => 'Fecha es requerida',
            'num_remission.max'=>'El número de remisión debe tener maximo 20 caracteres',
          //  'destiny.required'=>'La destino es requerido', // Cambiar por direccion
            'id_machine.required'=>'La maquina es requerida'
        );
        $validator = Validator::make($data, [
            'id_obra'       => ['required', 'max:12'],
            'id_society'    => ['required', 'max:12'],            
            'remi_fecha'    => ['required'],
          //  'destiny'    => ['required'],// Cambiar por direccion
            'num_remission'=>['max:20'],
            'id_machine'       => ['required', 'max:12'],

        ],$niceNames );
    
        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
  

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

}
