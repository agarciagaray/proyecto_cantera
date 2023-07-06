<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CubitanksLoading extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fuelsshopcubitanks';
    protected $fillable = ['cubt_idcompra', 'cubt_volumen', 'cubt_unidad', 'cubt_observaciones', 'cubt_estado','id_user'];
    protected $hidden = ['cubt_id', 'created_at', 'updated_at', 'deleted_at'];
    protected $primaryKey = 'cubt_id';
    public function User()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
    public function Fuelsshopping()
    {
        return $this->belongsTo('App\Models\FuelsShopping', 'cubt_idcompra', 'id');
    }


}
