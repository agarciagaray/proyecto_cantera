<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Construction extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'constructions';

    protected $fillable = ['obra_idcliente', 'obra_nombre','obra_direccion', 'obra_porcsuministro', 'obra_porctransporte', 'obra_obs', 'obra_estado', 'id_user'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    //protected $primaryKey = 'obra_id';

    public function getConstructions()
    {
        $constructions = Construction::join("clients", "clients.id", "=", "obra_idcliente")
                        ->join("persons", "persons.id", "=", "id_person")
                        ->select("constructions.*", "pers_razonsocial", "pers_primernombre", "pers_segnombre", "pers_primerapell", "pers_segapell")
                        ->orderBy("constructions.id", "asc")
                        ->get();

        return $constructions;
    }
    public function getConstructionById($id)
    {
        //$construction = Construction::find($id);

        $construction = Construction::join("clients", "clients.id", "=", "obra_idcliente")
                        ->join("persons", "persons.id", "=", "clients.id_person")
                        ->select("constructions.*", "pers_identif", "pers_razonsocial", "pers_primernombre", "pers_segnombre", "pers_primerapell", "pers_segapell")
                        ->where("constructions.id", "=", $id)
                        ->orderBy("constructions.id", "asc")
                        ->get();

        //dd($construction);
        return $construction;
    }

    public function Client()
    {
        return $this->belongsTo('App\Models\Client', 'obra_idcliente', 'id');
    }

    public function Remission()
    {
        return $this->hasMany('App\Models\Remission', 'id_obra','id');
    }

}
