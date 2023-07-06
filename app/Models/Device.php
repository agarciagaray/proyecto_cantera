<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'devices';

    protected $fillable = ['disp_descripcion', 'disp_estado', 'id_user'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
  
    // protected $primaryKey = 'disp_id'; 

    public function getDeviceById($id)
    {
        return Device::find($id);
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

}
