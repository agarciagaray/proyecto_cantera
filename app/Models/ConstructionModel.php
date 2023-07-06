<?php

namespace App\Models;

use App\Models\Construction;
use Validator;
// app includes


class ConstructionModel {

    /**
     * Get all Construction
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Construction
     */
    public static function listConstructions($paginate = 10, $search = null) {

        $construction = Construction::query();

        return $construction->orderBy('id','DESC')->get();
    }

    /**
     * get a Construction by id
     * @param integer $construction id from database
     * @return Object Construction 
     */
    public static function getConstruction($idConstruction) {
        // Estas funcion se puede usar si necesitan una obra, se busca por id
        $construction = Construction::find($idConstruction);

        return $construction;
    }

    /**
     * get validator for Construction
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            'obra_idcliente'            => ['required', 'max:12'],
            'obra_nombre'               => ['required', 'max:100'],            
            // 'obra_dpto'                 => ['required', 'max:3'],
            // 'obra_ciudad'               => ['required', 'max:3'],
            'obra_direccion'            => ['required', 'max:50'],
            'obra_porcsuministro'       => ['required', 'max:5'],
            'obra_porctransporte'       => ['required', 'max:5'],

        ]);
    
        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'obra_idcliente'        => 'Id. Cliente',
            'obra_nombre'           => 'Nombre de obra',
            // 'obra_dpto'             => 'Dpto.',
            // 'obra_ciudad'           => 'Ciudad',
            'obra_direccion'        => 'dirección',
            'obra_porcsuministro'   => '% suministro',
            'obra_porctransporte'   => '% transporte',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

}
