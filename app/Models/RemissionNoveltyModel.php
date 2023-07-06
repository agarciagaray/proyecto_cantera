<?php

namespace App\Models;

use App\Models\RemissionNovelty;
use Validator;
// app includes


class RemissionNoveltyModel {

    /**
     * Get all RemissionNovelty
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object RemissionNovelty
     */
    public static function listRemissionNovelties($paginate = 10, $search = null) {

        $remissionNovelty = RemissionNovelty::query();


        return $remissionNovelty->orderBy('id','DESC')->get();
    }

    /**
     * get a Construction by id
     * @param integer $RemissionNovelty id from database
     * @return Object RemissionNovelty 
     */
    public static function getRemissionNovelty($idRemissionNovelty) {
        // Estas funcion se puede usar si necesitan una remision, se busca por id
        $remissionNovelty = RemissionNovelty::find($idRemissionNovelty);

        return $remissionNovelty;
    }

    /**
     * get validator for RemissionNovelty
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            'rmnv_idremision'       => ['required', 'max:12'],
            'rmnv_idconcepto'    => ['required', 'max:12'],            
            'id_user'    => ['required'],
       //     'rmnv_idmaterial'       => ['required', 'max:12'],
          //  'rmnv_nuevovalor'    => ['required', 'max:12'],            
            // 'rmnv_estado'    => ['required'],
            // 'rmnv_fecha'    => ['required'],
        ]);
    
        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'rmnv_idremision'      => 'remisión es requireido',
            'rmnv_idconcepto'   => 'concepto de remisión es requerido',
            'id_user'   => 'usuario es requerido',
       //     'rmnv_idmaterial'      => 'material es requereido',
         //   'rmnv_nuevovalor'   => 'valor nuevo es requerido',
            // 'rmnv_estado'   => 'estado es requerido',
            // 'rmnv_fecha'   => 'fecha es requerida',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    public static function saveRemissionNovelty($data){

        $remissionNovelty = RemissionNovelty::find($data['id']);

      
        if ($remissionNovelty) {
            $remissionNovelty->update($data);
        } else {
       
            $remissionNovelty =RemissionNovelty::create($data);
        }
        return $remissionNovelty;
    }

}
