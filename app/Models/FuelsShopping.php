<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelsShopping extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fuelsshopping';
    protected $fillable = ['id_supplier', 'ccmb_fechadescarga', 'ccmb_numremision', 'ccmb_volumen', 'ccmb_unidad','ccmb_vlrunidad','ccmb_observaciones','ccmb_estado' ,'id_user'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    // protected $primaryKey = 'ccmb_id';
    public function User()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
    public function Supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'id_supplier', 'id');
    }


}
