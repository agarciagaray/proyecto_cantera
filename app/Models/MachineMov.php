<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use DateTime;


// use Illuminate\Database\Eloquent\SoftDeletes;

class MachineMov extends Model
{
    // use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'machinesmov';

    protected $fillable = ['mqmv_idmaquina','mqmv_fecha' ,'mqmv_hinicio', 'mqmv_hfin','horometro_hinicio','horometro_hfinal' ,'mqmv_vlrhora', 'mqmv_estado', 'id_conductor','mqmv_obs', 'id_user'];

    protected $hidden = ['created_at', 'updated_at','deleted_at'];


    // public function getMachinesMovs()
    // {
    //     $machinesmovs = MachineMov
    //                 ::join("machines", "id", "=", "mqmv_idmaquina")
    //                 ->select("*")
    //                 ->get();
    //     return $machinesmovs;
    // }

    public function getMachineMovById($id)
    {
        return MachineMov::find($id);
    }

    public function Machine()
    {
        return $this->belongsTo('App\Models\Machine', 'mqmv_idmaquina', 'id');
    }

    public function Driver()
    {
        return $this->belongsTo('App\Models\Drivers', 'id_conductor', 'id');
    }

    public function rest($op1,$op2)
    {
        return $op2-$op1;
    }

    public function hourDiff($h1,$h2)
    {
        $hfin = new DateTime($h2);
        $hini = new DateTime($h1);
        $hdiff = date_diff($hfin, $hini);

        return  $hdiff->format('%H:%i:%s');
    }
}
