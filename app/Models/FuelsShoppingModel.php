<?php

namespace App\Models;

use App\Models\FuelsShopping;
use Facade\Ignition\DumpRecorder\Dump;
use Validator;
// app includes
// use App\Models\Admin\FuelsShopping;

/**
 * Querys for FuelsShopping Table
 */
class FuelsShoppingModel
{

    /**
     * Get all FuelsShoppings
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object FuelsShoppings
     */
    public static function listFuelsShopping($request = null)
    {

        $fuelsShopping = FuelsShopping::query();

        // $fuelsShopping->orderBy('name');
        // if ($search) {
        //     $fuelsShopping->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }
        if ($request) {
            if (!is_null($request->dateStart) && is_null($request->dateEnd)) {

                $fuelsShopping->where('ccmb_fechadescarga', $request->dateStart);
            }
            if (!is_null($request->dateStart) && !is_null($request->dateEnd)) {

                $fuelsShopping->where('ccmb_fechadescarga', '>=', $request->dateStart)->where('ccmb_fechadescarga', '<=', $request->dateEnd);
            }
        }

        return $fuelsShopping->orderBy('id', 'DESC')->get();
    }

    /**
     * get a FuelsShopping by id
     * @param integer $fuelsShopping id from database
     * @return Object FuelsShopping FormFuelsShopping
     */
    public static function getFuelsShopping($idFuelsShopping)
    {

        $fuelsShopping = FuelsShopping::find($idFuelsShopping);

        return $fuelsShopping;
    }

    /**
     * get a FuelsShopping by id
     * @param integer $fuelsShopping id from database
     * @return Object FuelsShopping Personalized
     */
    public static function getFuelsShoppingPersonalized($idFuelsShopping)
    {

        $fuelsShopping = FuelsShopping::where('id', $idFuelsShopping)->select('ccmb_volumen', 'ccmb_numremision')->first();

        return $fuelsShopping;
    }



    /**
     * get validator for FuelsShoppings
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false)
    {

        $validator = Validator::make($data, [
            'id_supplier' => ['required'],
            'ccmb_fechadescarga' => ['required'],
            'ccmb_numremision' => ['required'],
            'ccmb_volumen' => ['required'],
            'ccmb_unidad' => ['required'],
            'ccmb_vlrunidad' => ['required'],
            'id_user' => ['required'],

        ]);

        $niceNames = array(
            'id_supplier' => 'proveedor es requerido',
            'ccmb_fechadescarga' => 'fecha es requerido',
            'ccmb_numremision' => 'número de remisión es requerido',
            'ccmb_volumen' => 'volumen es requerido',
            'ccmb_unidad' => 'unidad es requerida',
            'ccmb_vlrunidad' => 'valor unidad es requerida',
            'id_user' => ' usuario es requerido',

        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save FuelsShopping
     * @param type $data information from form
     * @return Object FuelsShoppingFormFuelsShopping
     */
    public static function saveFuelsShopping($data)
    {
        $fuelsShopping = FuelsShopping::find($data['id']);

        if ($fuelsShopping) {
            $fuelsShopping->update($data);
        } else {
            $fuelsShopping = FuelsShopping::create($data);
        }
        return $fuelsShopping;
    }
}
