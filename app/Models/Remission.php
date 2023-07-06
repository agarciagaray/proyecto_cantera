<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remission extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'remissions';

    protected $fillable = ['id', 'id_obra', 'id_society','id_machine', 'remi_fecha', 'remi_numfactura','destiny', 'remi_obs', 'remi_estado', 'id_user','total','num_remission','id_tipopago','rem_porc_sum','rem_porc_trans'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];



    public function detailRemissions() {
        return $this->hasMany('App\Models\RemissionDetail', 'dtrm_idremision', 'id');
    }

    public function getRemissionById($id)
    {
        return Remission::find($id);
    }

    public function Society()
    {
        return $this->belongsTo('App\Models\Society', 'id_society', 'id');
    }

    public function Construction()
    {
        return $this->belongsTo('App\Models\Construction', 'id_obra', 'id');
    }

    public function remissionNovelties() {
        return $this->hasMany('App\Models\RemissionNovelty', 'rmnv_idremision', 'id');
    }

    
    
    public function Machine()
    {
        return $this->belongsTo('App\Models\Machine', 'id_machine', 'id');
    }

    public function PreSettlement() {
        return $this->hasMany('App\Models\PreSettlement','id_remission','id');
    }


    public function TipoPago() {
        return $this->hasMany('App\Models\Tipopago','id','id_tipopago');
    }

}
