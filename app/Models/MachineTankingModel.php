<?php

namespace App\Models;

use App\Models\MachineTanking;
use Validator;
// app includes
// use App\Models\Admin\MachineTanking;

/**
 * Querys for MachineTanking Table
 */
class MachineTankingModel
{

    /**
     * Get all MachineTankings
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object MachineTankings
     */
    public static function listMachineTanking($request)
    {

        $machineTanking = MachineTanking::query();


        if (!is_null($request->dateStart) && is_null($request->dateEnd)) {

            $machineTanking->where('tanq_fecha', $request->dateStart);
        }
        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $machineTanking->where('tanq_fecha','>=',$request->dateStart)->where('tanq_fecha','<=', $request->dateEnd);
        }

        if($request->tanq_idmaquina){
            $machineTanking->where('tanq_idmaquina','=',$request->tanq_idmaquina);

        }

        return  $machineTanking->orderBy('id', 'DESC')->get();
    }

    /**
     * get a MachineTanking by id
     * @param integer $machineTanking id from database
     * @return Object MachineTanking FormMachineTanking
     */
    public static function getMachineTanking($idMachineTanking)
    {
        $machineTanking = MachineTanking::find($idMachineTanking);

        return $machineTanking;
    }

    /**
     * get a MachineTanking by id
     * @param integer $fuelsShopping id from database
     * @return Object FuelsShopping
     */
    public static function getFuelsShoppingMachineTanking($cubt_idcompra)
    {
        $machineTanking = MachineTanking::where('cubt_idcompra', $cubt_idcompra)->get();

        return $machineTanking;
    }

    /**
     * get validator for MachineTankings
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false)
    {

        $niceNames = array(
            'tanq_idmaquina.required' => 'La maquina es requerida',
            'tanq_fecha.required' => 'La fecha es requerido',
            'tanq_volumen.required' => 'El volumen es requerido',
            'tanq_unidad.required' => 'La unidad requerida',
            'tanq_origen.required' => 'El origen requerido',
            'id_user.required' => 'El usuario es requerido',
            'cubt_idcompra.required' => 'El número de remisión es requerido',
            'tanq_valor_tanqueo.required' => 'El valor del tanqueo externo es requerido',
        );
        $validate = array();
        if ($data['tanq_origen'] == 'EX') {
            $validate = [
                'tanq_valor_tanqueo' => ['required'],
                'tanq_idmaquina' => ['required'],
                'tanq_fecha' => ['required'],
                'tanq_volumen' => ['required'],
                'tanq_unidad' => ['required'],
                'tanq_origen' => ['required'],
                'id_user' => ['required'],

            ];
        } elseif ($data['tanq_origen'] == 'CB') {
            $validate = [
                'tanq_idmaquina' => ['required'],
                'cub_id' => ['required'],
                'tanq_fecha' => ['required'],
                'tanq_volumen' => ['required'],
                'tanq_unidad' => ['required'],
                'tanq_origen' => ['required'],
                'id_user' => ['required'],

            ];
        } else {
            $validate = [
                'cubt_idcompra' => ['required'],
                'tanq_idmaquina' => ['required'],
                'tanq_fecha' => ['required'],
                'tanq_volumen' => ['required'],
                'tanq_unidad' => ['required'],
                'tanq_origen' => ['required'],
                'id_user' => ['required'],

            ];
        }
        if ($edit) {
            // 'unique:tankmachines' . ',id,' . $data['id'] ?? '',
            $validator = Validator::make($data, $validate, $niceNames);
        } else {
            $validator = Validator::make($data, $validate, $niceNames);
        }




        // $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save MachineTanking
     * @param type $data information from form
     * @return Object MachineTankingFormMachineTanking
     */
    public static function saveMachineTanking($data)
    {
        $machineTanking = MachineTanking::find($data['id']);

        if ($machineTanking) {
            $machineTanking->update($data);
        } else {
            $machineTanking = MachineTanking::create($data);
        }
        return $machineTanking;
    }
}
