<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Society extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'societies';

    protected $fillable = ['id_person', 'soci_nombrelogo', 'soci_estado','prefix'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    // public function getSocieties()
    // {
    //     $societies = Society::join("persons", "pers_identif", "=", "soci_identif")
    //                 ->select("*")
    //                 ->get();
    //     return $societies;
    // }

    public function getSocietyById($id)
    {
        return Society::find($id);
    }

    public function Person()
    {
        return $this->belongsTo('App\Models\Person', 'id_person', 'id');
    }

    public function Remission()
    {
        return $this->hasMany('App\Models\Remission', 'id', 'id_society');
    }

}
