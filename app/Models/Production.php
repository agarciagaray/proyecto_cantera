<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Production extends Model
{
  
    use SoftDeletes;
    protected $table = 'productions';
    // protected $primaryKey = 'prod_id';
    protected $fillable = ['prod_idmaqdeposita','prod_iddispositivo' ,'prod_idmateriaprima','prod_idmaterial','typeProduction','prod_fecha','prod_numviajes','prod_cubicaje','options_id','cerrado','prod_volumen','prod_estado','id_user'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'prod_id', 'created_at','updated_at','deleted_at'
    ];
    public function Commodity()
    {
        return $this->hasOne('App\Models\Commodity', 'id','prod_idmateriaprima');
    }
    public function Machine()
    {
        return $this->hasOne('App\Models\Machine','id','prod_idmaqdeposita');
    }
    public function Device()
    {
        return $this->hasOne('App\Models\Device', 'id','prod_iddispositivo');
    }
    public function Material()
    {
        return $this->hasOne('App\Models\Material','id','prod_idmaterial');
    }

//Nota crearla diferente a produccion la proxima
    public function Production()
    {
        return $this->belongsTo('App\Models\Options','options_id','id');
    }
   

    public function Options_()
    {
        return $this->hasMany('App\Models\Options', 'id','options_id');
    }
    
    public function OptionsNombre()
    {
        return $this->hasMany('App\Models\Options', 'options_id','id');
    }
}

