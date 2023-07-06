<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Validator;

class Options extends Model
{
    use SoftDeletes;
  protected $table='options';
  protected $fillable=['nom_option','estado','cerrado'];
  protected $hidden= ['created_at','updated_at','deleted_at']; 

  //Opcion de busqueda
    public function getOptions()
    {
        $options = Options::select("*")
                        ->get();
        //dd($conceptspayments);
        return $options;
    }

    public function getOptionsById($id)
    {
        return Options::find($id);
    }

    

    public function detailOptions()
    {
        return $this->hasMany('App\Models\Optionsdetails', 'options_id','id');
    }

    public function Production()
    {
        return $this->hasMany('App\Models\Production','options_id','id');
    }


    public static function getValidator($data, $Nom_) {
        $validator  = null;

        // Se organiza la condicion los validator dependiendo lo que se necesite que valide

        $niceNames = array(
            'nom_option.required'     => 'El nombre de la opcion de requerido',
    
        );


        $valid = $data['id'] == '' ? '':',id,'.$data['id'] ;
        if($Nom_ =='nom_option'){
            // dump('nit');
            $validator = Validator::make($data, [
                'nom_option'      => 'required|digits_between:9,12|unique:options'.$valid,
         
            ],$niceNames);
        } else {
            // dump('cc');
            $validator = Validator::make($data, [
                'nom_option'      => 'required|digits_between:9,12|unique:options'.$valid,
        
              
            ],$niceNames);

        }

           return $validator;

    }

}