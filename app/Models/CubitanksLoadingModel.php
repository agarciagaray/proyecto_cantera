<?php

namespace App\Models;

use App\Models\CubitanksLoading;
use Validator;
// app includes
// use App\Models\Admin\CubitanksLoading;

/**
 * Querys for CubitanksLoading Table
 */
class CubitanksLoadingModel {

    /**
     * Get all CubitanksLoadings
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object CubitanksLoadings
     */
    public static function listCubitanksLoading($paginate = 10, $search = null) {

        $cubitanksLoading = CubitanksLoading::query();

        // $cubitanksLoading->orderBy('name');
        // if ($search) {
        //     $cubitanksLoading->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return  $cubitanksLoading->orderBy('id','DESC')->paginate();;
    }

    /**
     * get a CubitanksLoading by id
     * @param integer $cubitanksLoading id from database
     * @return Object CubitanksLoading FormCubitanksLoading
     */
    public static function getCubitanksLoading($idCubitanksLoading) {
        $cubitanksLoading = CubitanksLoading::find($idCubitanksLoading);

        return $cubitanksLoading;
    }
        /**
     * get a CubitanksLoading by id
     * @param integer $cubitanksLoading cubt_idcompra from database
     * @return Object CubitanksLoading FormCubitanksLoading
     */
    public static function getCubitanksShopping($cubt_idcompra) {
        $cubitanksLoading = CubitanksLoading::where('cubt_idcompra',$cubt_idcompra)->get();

        return $cubitanksLoading;
    }

    /**
     * get validator for CubitanksLoadings
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false) {

        $validator = Validator::make($data, [
            'cubt_idcompra'=>['required'],
            'cubt_volumen'=>['required'],
            'cubt_unidad'=>['required'],
            'id_user'=>['required'],

        ]);

        $niceNames = array(
            'cubt_idcompra'=>'compra es requerido',
            'cubt_volumen'=>'valumén es requerido',
            'cubt_unidad'=>'unidad es requerido',
            'id_user' => ' usuario es requerido',
          
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save CubitanksLoading
     * @param type $data information from form
     * @return Object CubitanksLoadingFormCubitanksLoading
     */
    public static function saveCubitanksLoading($data) {
        $cubitanksLoading = CubitanksLoading::find($data['cubt_id']);
 
        if ($cubitanksLoading) {
            $cubitanksLoading->update($data);
        } else {
            $cubitanksLoading = CubitanksLoading::create($data);
        }
        return $cubitanksLoading;
    }
}
