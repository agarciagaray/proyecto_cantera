<?php

namespace App\Models;

use App\Models\MachineMov;
use Validator;
// app includes
// use App\Models\Admin\MachineMov;

/**
 * Querys for MachineMov Table
 */
class MachineMovModel {

    /**
     * Get all MachineMovs
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object MachineMovs
     */
    public static function listMachineMov($paginate = 10, $search = null) {

        $machineMov = MachineMov::query();

        // $machineMov->orderBy('name');
        // if ($search) {
        //     $machineMov->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $paginate ? $machineMov->paginate($paginate) : $machineMov->get();
    }

    /**
     * get a MachineMov by id
     * @param integer $machineMov id from database
     * @return Object MachineMov FormMachineMov
     */
    public static function getMachineMov($idMachineMov) {
        $machineMov = MachineMov::find($idMachineMov);

        return $machineMov;
    }

    /**
     * get validator for MachineMovs
     * @param array $data information from form
     * @return Object Validator
     */
    //Validaciones
    public static function getValidator($data, $horometro = false) {
        $validator = null;
        $niceNames = array(
            'id_user.required' => 'El usuario es requerido',
            'mqmv_fecha.required'=> 'La fecha es requerida',
            'mqmv_hinicio.required' => 'hora de inicio es requerida',
            'mqmv_hfin.required' => 'hora de final es requerida, ',
            'mqmv_idmaquina.required'=>'La maquina requerida',
            'mqmv_vlrhora.required'=>'El valor de hora es requerido',
            'horometro_hinicio.required' => 'El campo horometro inicial es requerido',
            'horometro_hfinal.required' => 'El campo horometro final es requerido',
            'horometro_hfinal.gt' => 'El campo horometro final, debe ser mayor que el hometro inicial'
            // 'mqmv_estado'=>'estado es requerido',
        );

        if($horometro){
            $validator = Validator::make($data, [
                'mqmv_idmaquina' => ['required'],
                'mqmv_fecha'=> ['required'],
                'horometro_hinicio' => ['required'],
                'horometro_hfinal' => ['required','gt:horometro_hinicio'],
                'mqmv_vlrhora' => ['required'],
             //   'id_conductor' => ['required'],
                'id_user' => ['required'],
    
            ],$niceNames);

        }else{
            $validator = Validator::make($data, [
                'mqmv_idmaquina' => ['required'],
                'mqmv_fecha'=> ['required'],
                'mqmv_hinicio' => ['required'],
                'mqmv_hfin' => ['required','after:mqmv_hinicio'],
                'mqmv_vlrhora' => ['required'],
             //  'id_conductor' => ['required'],
                'id_user' => ['required'],
                
            ],$niceNames);
        }


        // 'after:mqmv_hinicio'

        // $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save MachineMov
     * @param type $data information from form
     * @return Object MachineMovFormMachineMov
     */
    public static function saveMachineMov($data) {
        //Consulta primero para ver si existe , para saber si crear o no
        $machineMov = MachineMov::find($data['id']);
        if ($machineMov) {
            $machineMov->update($data);
        } else {
            $machineMov = MachineMov::create($data);
        }
        return $machineMov;
    }
}
