<?php

namespace App\Models;

use App\Models\ConceptPayment;
use Validator;
// app includes
// use App\Models\Admin\ConceptPayment;

/**
 * Querys for ConceptPayment Table
 */
class ConceptPaymentModel {

    /**
     * Get all ConceptPayments
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object ConceptPayments
     */
    public static function listConceptPayment($paginate = 10, $search = null) {

        $conceptPayment = ConceptPayment::query();

        // $ConceptPayment->orderBy('name');
        // if ($search) {
        //     $ConceptPayment->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return  $conceptPayment->orderBy('id','DESC')->get();
    }

    /**
     * get a ConceptPayment by id
     * @param integer $ConceptPayment id from database
     * @return Object ConceptPayment FormConceptPayment
     */                  
    public static function getConceptPayment($idConceptPayment) {
        $ConceptPayment = ConceptPayment::find($idConceptPayment);

        return $ConceptPayment;
    }

    /**
     * get validator for ConceptPayments
     * @param array $data information from form
     * @return Object Validator
     */
    //Validaciones
    public static function getValidator($data, $edit = false) {

        $niceNames = array(
            'cncp_nombre.required' => 'El nombre es requerido',
            // 'cncp_estado.required' => 'El estado es requerido',

        );
        $validator = Validator::make($data, [
            'cncp_nombre' => ['required'],
            // 'cncp_estado' => ['required'],
            
        ], $niceNames);
        // 'after:mqmv_hinicio'
 

        // $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save ConceptPayment
     * @param type $data information from form
     * @return Object ConceptPaymentFormConceptPayment
     */
    public static function saveConceptPayment($data) {
        //Consulta primero para ver si existe , para saber si crear o no
        $ConceptPayment = ConceptPayment::find($data['id']);
        if ($ConceptPayment) {
            $ConceptPayment->update($data);
        } else {
            $ConceptPayment = ConceptPayment::create($data);
        }
        return $ConceptPayment;
    }
}
