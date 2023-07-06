<?php

namespace App\Models;

use App\Models\Machine;
use Validator;
// app includes


class MachineModel {

    /**
     * Get all Machines
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Machine
     */
    public static function listMachines($paginate = 10, $search = null) {

        $machine = Machine::query();
        // $machine->whereNull('deleted_at');
        // $machine->orderBy('name');
        // if ($search) {
        //     $machine->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $machine->orderBy('id','DESC')->get();
    }

    /**
     * get a Machine by id
     * @param integer $machine id from database
     * @return Object Machine FormMachine
     */
    public static function getMachine($idMachine) {
        // Estas funcion se puede usar si necesitan un machine, se busca por id
        $machine = Machine::find($idMachine);

        return $machine;
    }

    /**
     * get validator for Machine
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {

        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'maqn_tipo.required'   => 'El tipo es requerido',
            'maqn_cubicaje.required'   => 'El cubicaje es requerido',
            'maqn_idunidad.required'   => 'La unidad de medida es requerida',
            'maqn_placa.required'    =>'La placa es requerida',
            'maqn_placa.unique'    =>'La placa ingresada ya ha sido asociada a un maquina, ingresa una distinta',
            'maqn_placa.max'    =>'La placa debe tener max 12 caracteres',
            'name_complete.required'   => 'El nombres y apellidos son requeridos',
            'name_complete.max'   => 'El nombres y apellidos no debe tener más de 45 caracteres',
            'nuip.required'   => 'El número de identificación son requerido',
            'nuip.max'   => 'El número de identificación no debe tener más de 45 caracteres',
        );
        $validator = Validator::make($data, [
            'maqn_placa'    =>'required','max:12','unique:machines'. ',id,'.$data['id'] ?? '',
            'maqn_tipo'     => ['required', 'max:12'],            
            'maqn_cubicaje' => ['required', 'max:12'],
            'maqn_idunidad' => ['required', 'max:3'],
            'name_complete' => ['required', 'max:45'],
            'nuip' => ['required', 'max:14'],
        ], $niceNames);
    
        // 'reputationNotes',


        $validator->setAttributeNames($niceNames);

        return $validator;
    }

}
