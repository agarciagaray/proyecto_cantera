<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class Drivers extends Model
{
    use SoftDeletes;
  
    
    protected   $table='drivers';
    protected   $fillable =['id_person','conductor_estado'];
    protected    $hidden = ['created_at', 'updated_at', 'deleted_at'];





    public function getDriver()
    {
        //return Client::all();
        // $clients = Client::join("persons", "id", "=", "id_person")
        //             ->select("*")
        //             ->get();
        // return $clients;
    }

    public function getDriverById($id)
    {
        //return Client::find($id);
        $driver = Drivers::join("persons", "persons.id", "=", "id_person")
                    ->select("drivers.*", "persons.id as idPerson", "pers_identif", "pers_tipoid", "pers_razonsocial", "pers_primernombre", "pers_segnombre",
                    "pers_primerapell", "pers_segapell", "pers_direccion", "pers_telefono", "pers_ciudad", "pers_dpto", "pers_email", "id_user")
                    ->where("drivers.id", "=", $id)
                    ->get();

            
        //dd($client);
        return $driver;

    }

    public function Person()
    {
        //return $this->belongsTo('App\Models\Person', 'id_person', 'id');
        return $this->belongsTo('App\Models\Person','id_person','id');
    }



}
