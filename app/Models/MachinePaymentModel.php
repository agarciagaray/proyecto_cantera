<?php

namespace App\Models;

use App\Models\MachinePayment;
use Validator;
// app includes
// use App\Models\Admin\MachinePayment;

/**
 * Querys for MachinePayment Table
 */
class MachinePaymentModel {

    /**
     * Get all MachinePayments
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object MachinePayments
     */
    public static function listMachinePayment($paginate = 8, $search = null) {

        $MachinePayment = MachinePayment::query();

        // $MachinePayment->orderBy('name');
        // if ($search) {
        //     $MachinePayment->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $MachinePayment->orderBy('id','DESC')->get();
    }

    /**
     * get a MachinePayment by id
     * @param integer $MachinePayment id from database
     * @return Object MachinePayment FormMachinePayment
     */
    public static function getMachinePayment($idMachinePayment) {
        $MachinePayment = MachinePayment::find($idMachinePayment);

        return $MachinePayment;
    }

    /**
     * get validator for MachinePayments
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false) {

        $validator = Validator::make($data, [
            "mqpg_idmaquina" => ['required'],
            "mqpg_concepto" => ['required'],
            "mqpg_fecha" => ['required'],
            "mqpg_vlrpagado" => ['required'],
            "mqpg_obs" => ['required'],
            'id_user' => ['required'],


        ]);

        $niceNames = array(
            'id_user' => ' usuario es requerido',
            'mqpg_fecha' => 'fecha es requerido',
            'mqpg_idmaquina' => 'maquina requerida',
            'mqpg_obs' => 'observación es requerido',
            'mqpg_concepto'=>'concepto es requerido',
            'mqpg_vlrpagado'=>'valor pagado es requerido'
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save MachinePayment
     * @param type $data information from form
     * @return Object MachinePaymentFormMachinePayment
     */
    public static function saveMachinePayment($data) {
        $MachinePayment = MachinePayment::find($data['id']);
        if ($MachinePayment) {

            $MachinePayment->update($data);
        } else {
   
            $MachinePayment = MachinePayment::create($data);
        }
        return $MachinePayment;
    }
}
