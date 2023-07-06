<?php

namespace App\Models;

use App\Models\MachineObs;
use Validator;
// app includes
// use App\Models\Admin\MachineObs;

/**
 * Querys for MachineObs Table
 */
class MachineObsModel {

    /**
     * Get all MachineObss
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object MachineObss
     */
    public static function listMachineObs($paginate = 10, $search = null) {

        $machineObs = MachineObs::query();

        // $machineObs->orderBy('name');
        // if ($search) {
        //     $machineObs->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $machineObs->orderBy('id','DESC')->paginate();
    }

    /**
     * get a MachineObs by id
     * @param integer $machineObs id from database
     * @return Object MachineObs FormMachineObs
     */
    public static function getMachineObs($idMachineObs) {
        $machineObs = MachineObs::find($idMachineObs);

        return $machineObs;
    }

    /**
     * get validator for MachineObss
     * @param array $data information from form
     * @return Object Validator
     */
    //Validaciones
    public static function getValidator($data, $edit = false) {

        $validator = Validator::make($data, [
            'mqdt_idmaquina' => ['required'],
            'mqdt_fecha' => ['required'],
            'mqdt_obs' => ['required'],
            'id_user' => ['required'],
        
            
        ]);

        $niceNames = array(
            'id_user' => ' usuario es requerido',
            'mqdt_fecha' => 'fecha es requerido',
            'mqdt_idmaquina'=>'maquina requerida',
            'mqdt_obs'=>'observación es requerido',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save MachineObs
     * @param type $data information from form
     * @return Object MachineObsFormMachineObs
     */
    public static function saveMachineObs($data) {
        //Consulta primero para ver si existe , para saber si crear o no
        $machineObs = MachineObs::find($data['id']);
        if ($machineObs) {
            $machineObs->update($data);
        } else {
            $machineObs = MachineObs::create($data);
        }
        return $machineObs;
    }
}
