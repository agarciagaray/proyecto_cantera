<?php

namespace App\Models;

//use App\Drivers;
use App\Models\Drivers;
use Validator;
// app includes


/**
 * Querys for Person Table
 */
class DriverModel {

    /**
     * Get all Clients
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Persons
     */
    public static function listDrivers($paginate = 10, $search = null) {

        $driver =Drivers::query();
        $driver->whereNull('deleted_at');
        $driver->orderBy('name');
        if ($search) {
            $driver->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $driver->paginate($paginate) : $driver->get();
    }

    /**
     * get a Client by id
     * @param integer $client id from database
     * @return Object Client FormClient
     */
    public static function getDriver($idDriver) {
        // Estas funcion se puede usar si necesitan un cliente, se busca por id
        $driver = Drivers::find($idDriver);

        return $driver;
    }

    /**
     * get validator for Client
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            // 'clie_identif'      => ['max:12'],
            // 'clie_dircorresp'   => ['max:50'],
        ]);
    
        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
        // $niceNames = array(
        //     'clie_dircorresp'   => 'Dir. de Correspond.',
        // );

        // $validator->setAttributeNames($niceNames);

        return $validator;
    }

}
