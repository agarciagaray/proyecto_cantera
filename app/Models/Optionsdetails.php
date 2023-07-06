<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class Optionsdetails extends Model

{
    use SoftDeletes;
    protected $table = 'optionsdetails';
    protected $fillable = ['options_id', 'materials_id', 'porcentaje', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    //Opcion de busqueda
    public function getDetailsOptions()
    {
        $optionsdetails = OptionsDetails::select("*")
            ->get();
        //dd($conceptspayments);
        return $optionsdetails;
    }

    public function getOptionsdetailsById($id)
    {
        return Optionsdetails::find($id);
    }

    public function Material()
    {
        return $this->belongsTo('App\Models\Material','materials_id','id');
    }



    public function Material_()
    {
        return $this->hasMany('App\Models\Material','id','materials_id');
    }

   public function detailOptions()
    {
        return $this->hasMany('App\Models\Optionsdetails', 'options_id','id');
    }

    public function Options()
    {
        return $this->hasMany('App\Models\Options','id','options_id');
    }
}
