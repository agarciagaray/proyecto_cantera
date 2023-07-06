<?php

namespace App\Models;

use App\Models\Material;
use Validator;
// app includes


class MaterialModel {

    /**
     * Get all Material
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Material
     */
    public static function listMaterials($paginate = 10, $search = null) {

        $material = Material::query();

        return $material->orderBy('id','DESC')->paginate();
    }

    /**
     * get a Material by id
     * @param integer $material id from database
     * @return Object Material 
     */
    public static function getMaterial($idMaterial) {
        // Estas funcion se puede usar si necesitan un material, se busca por id
        $material = Material::find($idMaterial);

        return $material;
    }

    /**
     * get validator for Material
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            'mate_codigo'           => ['required', 'max:20'],
            // 'mate_clasificacion'    => ['required'],            
            'mate_descripcion'      => ['required', 'max:100'],
        ]);
    
        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'mate_codigo'           => 'Código',
            // 'mate_clasificacion'    => 'Clasificación',
            'mate_descripcion'      => 'Descripción',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

}
