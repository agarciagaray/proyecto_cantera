<?php

namespace App\Models;

use App\Models\Production;
use Illuminate\Support\Facades\DB;
use Validator;
// app includes
// use App\Models\Admin\Production;

/**
 * Querys for Production Table
 */
class ProductionModel
{

    /**
     * Get all Productions
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Productions
     */
    public static function listProduction($request)
    {

        $production = Production::query();
        if (!is_null($request->dateStart) && is_null($request->dateEnd)) {

            $production->where('prod_fecha', $request->dateStart);
        }
        if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

            $production->where('prod_fecha','>=',$request->dateStart)->where('prod_fecha','<=', $request->dateEnd);
        }

        if ($request->typeProductionMaterial) {
            $production->where('typeProduction', $request->typeProductionMaterial);
        };
        return  $production->orderBy('id', 'DESC')->get();
    }

    /**
     * get a Production by id
     * @param integer $Production id from database
     * @return Object Production FormProduction
     */
    public static function getProduction($idProduction)
    {
        $production = Production::find($idProduction);

        return $production;
    }

    /**
     * get validator for Productions
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false)
    {

        $validator = null;
        if ($data['typeProduction'] == 'I') {

            $validator = Validator::make($data, [
                'typeProduction' => ['required'],
                'prod_idmaterial' => ['required'],
                'id_user' => ['required'],
                'prod_fecha' => ['required'],
               // 'prod_numviajes' => ['required'],
               // 'prod_cubicaje' => ['required'],
                'prod_volumen' => ['required']

            ]);
        } elseif ($data['typeProduction'] == 'E') {

            $validator = Validator::make($data, [
                'typeProduction' => ['required'],
                'prod_idmaqdeposita' => ['required'],
                'prod_idmateriaprima' => ['required'],
                'id_user' => ['required'],
                'prod_fecha' => ['required'],
              //  'prod_numviajes' => ['required'],
             //  'prod_cubicaje' => ['required'],
                'prod_volumen' => ['required'],
                // 'prod_iddispositivo' => ['required']

            ]);
        } else {

            $validator = Validator::make($data, [
                'typeProduction' => ['required'],
                'prod_iddispositivo' => ['required'],
                'prod_idmaterial' => ['required'],
                // 'prod_idmaqdeposita' => ['required'],
                // 'prod_idmateriaprima' => ['required'],
                'id_user' => ['required'],
                'prod_fecha' => ['required'],
               // 'prod_numviajes' => ['required'],
               // 'prod_cubicaje' => ['required'],
                'prod_volumen' => ['required'],


            ]);
        }
        $niceNames = array(
            'id_user' => ' usuario',
            'prod_fecha' => 'fecha',
            'prod_numviajes' => 'número de viaje',
            'prod_cubicaje' => 'cubinaje',
            'typeProduction' => 'tipo de movimiento',
            'prod_idmateriaprima' => 'materia prima',
            'prod_idmaterial' => 'material',
            'prod_iddispositivo' => 'deposito que recibe el material',
            'prod_volumen' => 'volumén'
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save Production
     * @param type $data information from form
     * @return Object ProductionFormProduction
     */
    public static function saveProduction($data)
    {
        $production = Production::find($data['prod_id']);
        if ($production) {
            $production->update($data);
        } else {
            $production = Production::create($data);
        }
        return $production;
    }


    /**
     * validate exit from production
     * @param type boolean
     * @return Boolean Production
     */
    public static function validateExitProduction($prod_idmaterial)
    {

        $id_material = (int) $prod_idmaterial;
        $prod_volumen_inventary = DB::select("SELECT sum(prod_volumen) as prod_volumen FROM productions where prod_idmaterial = $id_material and (typeProduction = 'I' or typeProduction = 'S') and prod_estado = 'A'");
         // Production::where('prod_idmaterial', (int) $prod_idmaterial)->where('typeProduction', 'I')->orWhere('typeProduction', 'S')->where('prod_estado','A')->sum('prod_volumen');

        $cantidad = RemissionDetail::where('dtrm_idmaterial',  $id_material)->sum('dtrm_cantdespachada');

        $available = (int) $prod_volumen_inventary[0]->prod_volumen == null ? 0: $prod_volumen_inventary[0]->prod_volumen - $cantidad;
        if ($available < 0) {
            $available = 0;
        }

        return [
            'prod_volumen' => (int) $prod_volumen_inventary[0]->prod_volumen,
            'available' =>   $available,
            'prod_volumen_exit' =>(int) $cantidad
        ];
    }
}
