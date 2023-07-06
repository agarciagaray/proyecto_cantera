<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipopago extends Model
{
    use SoftDeletes;

    protected $table='tipopago';
   // protected $primaryKey='id_tipopago';
    protected $fillable=['siglas','descripcion','estado'];

    
  protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


 
  public function geTipoPagotyById($id)
  {
      return Tipopago::find($id);
  }
}
