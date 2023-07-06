<?php

namespace App\Models;

use App\Models\Supplier;
use Validator;
// app includes


class SupplierModel {

    /**
     * Get all Supplier
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Supplier
     */
    public static function listSuppliers($paginate = 10, $search = null) {

        $supplier = Supplier::query();

        return  $supplier->orderBy('id','DESC')->get();
    }

    /**
     * get a Supplier by id
     * @param integer $supplier id from database
     * @return Object Supplier
     */
    public static function getSupplier($idSupplier) {
        // Estas funcion se puede usar si necesitan un proveedor, se busca por id
        $supplier = Supplier::find($idSupplier);

        return $supplier;
    }

    /**
     * get validator for Supplier
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data,$booleanCode) {

        $validator = "";

        if($booleanCode){
            $validator = Validator::make($data, [
                // 'prov_identif'      => ['required', 'min:2'],
                'prov_codactividad' => ['required', 'max:3'],
                'codeVerification' => ['required','max:9'],

            ]);
        }else{
            $validator = Validator::make($data, [
                'prov_codactividad' => ['required', 'max:3'],

            ]);
        }

        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'prov_identif.required'      => 'Identificación',
            'prov_codactividad.required' => 'Cód. de Actividad',
            'codeVerification.required' => 'Cód. de verificación',
            'prov_identif.max'      => 'Identificación',
            'prov_codactividad.max' => 'Cód. de Actividad',
            'codeVerification.max' => 'Cód. de verificación',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

}
