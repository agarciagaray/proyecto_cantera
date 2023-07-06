<?php

namespace App\Models;

use App\Models\RemissionConceptNovelty;
use Validator;
// app includes
// use App\Models\Admin\RemissionConceptNovelty;

/**
 * Querys for RemissionConceptNovelty Table
 */
class RemissionConceptNoveltyModel {

    /**
     * Get all RemissionConceptNoveltys
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object RemissionConceptNoveltys
     */
    public static function listRemissionConceptNovelty($paginate = 10, $search = null) {

        $remissionConceptNovelty = RemissionConceptNovelty::query();

        // $RemissionConceptNovelty->orderBy('name');
        // if ($search) {
        //     $RemissionConceptNovelty->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return  $remissionConceptNovelty->orderBy('id','DESC')->get();
    }

    /**
     * get a RemissionConceptNovelty by id
     * @param integer $RemissionConceptNovelty id from database
     * @return Object RemissionConceptNovelty FormRemissionConceptNovelty
     */
    public static function getRemissionConceptNovelty($idRemissionConceptNovelty) {
        $RemissionConceptNovelty = RemissionConceptNovelty::find($idRemissionConceptNovelty);

        return $RemissionConceptNovelty;
    }

    /**
     * get validator for RemissionConceptNoveltys
     * @param array $data information from form
     * @return Object Validator
     */
    //Validaciones
    public static function getValidator($data, $edit = false) {

        $validator = Validator::make($data, [
            'cncn_nombre' => ['required'],
            'cncn_estado' => ['required'],

        
            
        ]);

        $niceNames = array(
            'cncn_nombre' => 'nombre es requerido',
            'cncn_estado' => 'estado es requerido',
      
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save RemissionConceptNovelty
     * @param type $data information from form
     * @return Object RemissionConceptNoveltyFormRemissionConceptNovelty
     */
    public static function saveRemissionConceptNovelty($data) {
        //Consulta primero para ver si existe , para saber si crear o no
        $RemissionConceptNovelty = RemissionConceptNovelty::find($data['id']);
        if ($RemissionConceptNovelty) {
            $RemissionConceptNovelty->update($data);
        } else {
            $RemissionConceptNovelty = RemissionConceptNovelty::create($data);
        }
        return $RemissionConceptNovelty;
    }
}
