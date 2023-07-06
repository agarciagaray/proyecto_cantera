<?php

namespace App\Models;

use App\Models\Client;
use Validator;
// app includes


/**
 * Querys for Person Table
 */
class ClientModel {

    /**
     * Get all Clients
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Persons
     */
    public static function listClients($paginate = 10, $search = null) {

        $client = Client::query();
        $client->whereNull('deleted_at');
        $client->orderBy('name');
        if ($search) {
            $client->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $client->paginate($paginate) : $client->get();
    }

    /**
     * get a Client by id
     * @param integer $client id from database
     * @return Object Client FormClient
     */
    public static function getClient($idClient) {
        // Estas funcion se puede usar si necesitan un cliente, se busca por id
        $client = Client::find($idClient);

        return $client;
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
