<?php

namespace App\Models;

use App\Models\MachinesType;
use Validator;
// app includes
// use App\Models\Admin\MachineType;

/**
 * Querys for MachineType Table
 */
class MachineTypeModel {

    /**
     * Get all MachineTypes
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object MachineTypes
     */
    public static function listMachineType($paginate = 8, $search = null) {

        $machineType = MachinesType::query();

        // $machineType->orderBy('name');
        // if ($search) {
        //     $machineType->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $machineType->orderBy('id','DESC')->get();
    }

    /**
     * get a MachineType by id
     * @param integer $machineType id from database
     * @return Object MachineType FormMachineType
     */
    public static function getMachineType($idMachineType) {
        $machineType = MachinesType::find($idMachineType);

        return $machineType;
    }


    /**
     * get validator for MachineTypes
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false) {


        $validator = Validator::make($data, [
            'tmaq_nombre' => ['required'],
            // 'tmaq_estado' => ['required'],


        ]);

        $niceNames = array(
            'tmaq_nombre' => 'nombre del tipo es requerido',
            // 'tmaq_estado' => 'estado es requerido',


        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save MachineType
     * @param type $data information from form
     * @return Object MachineTypeFormMachineType
     */
    public static function saveMachineType($data) {
        $machineType = MachinesType::find($data['id']);

        if ($machineType) {
            $machineType->update($data);
        } else {
            $machineType = MachinesType::create($data);
        }
        return $machineType;
    }
}
