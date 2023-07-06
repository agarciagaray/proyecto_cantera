<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachinePayment extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'machinespayments';
    protected $fillable = ['mqpg_idmaquina', 'mqpg_fecha', 'mqpg_concepto', 'mqpg_vlrpagado','mqpg_estado','mqpg_obs', 'id_user'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    // protected $primaryKey = 'mqpg_id';

    public function Machine()
    {
        return $this->belongsTo('App\Models\Machine', 'mqpg_idmaquina', 'id');
    }
    public function ConceptPayment()
    {
        return $this->belongsTo('App\Models\ConceptPayment', 'mqpg_concepto', 'id');
    }
}
