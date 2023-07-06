<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'machines';
    protected $fillable = ['maqn_placa', 'maqn_tipo', 'maqn_cubicaje', 'maqn_idunidad', 'maqn_estado', 'maqn_obs', 'id_user','nuip','name_complete'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function getMachines()
    {
        $machines = Machine
                        ::join("units", "units.id", "=", "maqn_idunidad")
                        ->join("machinestypes", "id", "=", "maqn_tipo")
                        ->orderBy('id', 'ASC')
                        ->select("*")
                        ->get();
                        //::join("users", "id", "=", "id_user")
        //dd($machines);
        return $machines;
    }

    // protected $primaryKey = 'maqn_id';
    public function getMachineById($id)
    {
        return Machine::find($id);
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit', 'maqn_idunidad', 'id');
    }

    public function MachineType()
    {
        return $this->belongsTo('App\Models\MachinesType', 'maqn_tipo', 'id');
    }

    public function MachineMov()
    {
        return $this->hasMany('App\Models\MachineMov', 'id', 'mqmv_idmaquina');
    }
    public function Tankmachines()
    {
        return $this->hasMany('App\Models\MachineTanking', 'tanq_idmaquina','id');
    }
    public function MachineObs()
    {
        return $this->hasMany('App\Models\MachineObs', 'mqdt_idmaquina','id');
    }
    public function MachinePayments()
    {
        return $this->hasMany('App\Models\MachinePayment', 'mqpg_idmaquina','id');
    }
}
