<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'clients';
//Aqui deben ir todos los campos de la table clients
    protected $fillable = ['id_person','client_estado'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function getClients()
    {
        //return Client::all();
        // $clients = Client::join("persons", "id", "=", "id_person")
        //             ->select("*")
        //             ->get();
        // return $clients;
    }

    public function getClientById($id)
    {
        //return Client::find($id);
        $client = Client::join("persons", "persons.id", "=", "id_person")
                    ->select("clients.*", "persons.id as idPerson", "pers_identif", "pers_tipoid", "pers_razonsocial", "pers_primernombre", "pers_segnombre",
                    "pers_primerapell", "pers_segapell", "pers_direccion", "pers_telefono", "pers_ciudad", "pers_dpto", "pers_email", "id_user")
                    ->where("clients.id", "=", $id)
                    ->get();

            
        //dd($client);
        return $client;

    }

    public function Person()
    {
        //return $this->belongsTo('App\Models\Person', 'id_person', 'id');
        return $this->belongsTo('App\Models\Person', 'id_person', 'id');
    }

    // public static function getValidator($data, $edit = false)
    // {
    //     if($edit){
    //         $validator = Validator::make($data, [
    //             'pers_tipoid' => ['required', 'string'],
    //             'pers_razonsocial' => ['string', 'max:120'],
    //             'pers_primernombre' => ['string', 'max:40'],
    //             'pers_segnombre' => ['string', 'max:40'],
    //             'pers_primerapell' => ['string', 'max:40'],
    //             'pers_segapell' => ['string', 'max:40'],
    //             'pers_direccion' => ['string', 'max:50'],
    //             'pers_telefono' => ['string', 'max:50'],
    //             'pers_ciudad' => ['required', 'string', 'max:3'],
    //             'pers_dpto' => ['required', 'string', 'max:3'],
    //             'pers_email' => ['string', 'max:50'],
    //             'pers_estado' => ['required', 'string', 'max:255'],
    //             // 'clie_dircorresp' => ['string', 'max:50'],
    //         ]);
    //     }else{
    //         $validator = Validator::make($data, [
    //             'pers_identif' => ['required', 'string', 'max:12'],
    //             'pers_tipoid' => ['required', 'string'],
    //             'pers_razonsocial' => ['string', 'max:120'],
    //             'pers_primernombre' => ['string', 'max:40'],
    //             'pers_segnombre' => ['string', 'max:40'],
    //             'pers_primerapell' => ['string', 'max:40'],
    //             'pers_segapell' => ['string', 'max:40'],
    //             'pers_direccion' => ['string', 'max:50'],
    //             'pers_telefono' => ['string', 'max:50'],
    //             'pers_ciudad' => ['required', 'string', 'max:3'],
    //             'pers_dpto' => ['required', 'string', 'max:3'],
    //             'pers_email' => ['string', 'max:50'],
    //             'pers_estado' => ['required', 'string', 'max:255'],
    //             // 'clie_dircorresp' => ['string', 'max:50'],
    //         ]);

    //     }

    //     return $validator;
    // }
    public function Constructions()
    {
        return $this->hasMany('App\Models\Construction', 'obra_idcliente','id');
    }
}
