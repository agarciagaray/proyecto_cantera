<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineTanking extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tankmachines';
    protected $fillable = ['tanq_idmaquina','cubt_idcompra','cub_id','tanq_fecha', 'tanq_volumen', 'tanq_unidad', 'tanq_origen','tanq_observaciones','tanq_estado' ,'id_user','tanq_valor_tanqueo'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    // protected $primaryKey = 'tanq_id';
    
    public function User()
    {
        return $this->belongsTo('App\Models\Admin\User', 'id_user', 'id');
    }
    public function Machine()
    {
        return $this->belongsTo('App\Models\Machine', 'tanq_idmaquina', 'id');
    }
    public function Fuelsshopping()
    {
        return $this->belongsTo('App\Models\FuelsShopping', 'cubt_idcompra', 'id');
    }
    public function MachineCub()
    {
        return $this->belongsTo('App\Models\Machine', 'cub_id', 'id');
    }

}
