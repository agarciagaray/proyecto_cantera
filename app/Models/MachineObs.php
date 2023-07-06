<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineObs extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'machinesobs';
    protected $fillable = ['mqdt_idmaquina', 'mqdt_fecha', 'mqdt_obs', 'mqdt_estado', 'id_user'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    // protected $primaryKey = 'mqdt_id';
    public function getMachinesObs()
    {
        $machinesobs = MachineObs
                        ::join("machines", "id", "=", "mqdt_idmaquina")
                        ->select("*")
                        ->get();
        //dd($machinesobs);
        return $machinesobs;
    }

    public function getMachinesObsById($id)
    {
        return MachineObs::find($id);
    }

    public function Machine()
    {
        return $this->belongsTo('App\Models\Machine', 'mqdt_idmaquina', 'id');
    }
}
