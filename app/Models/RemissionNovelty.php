<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemissionNovelty extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'remissionsnovelties';
    protected $fillable = ['rmnv_idremision', 'rmnv_idconcepto', 'rmnv_idmaterial', 'rmnv_nuevovalor', 'rmnv_fecha', 'rmnv_obs', 'rmnv_estado', 'id_user', 'rmnv_idconcepto', 'rmnv_idclient', 'rmnv_doc_vascula', 'id_construction', 'rmnv_valor_subtotal','rmnv_valor_transporte','rmnv_valor_suministro','rmnv_valor_iva','nov_fecha'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];


    public function getRemissionNoveltyById($id)
    {
        return RemissionNovelty::find($id);
    }

    public function Remission()
    {
        return $this->belongsTo('App\Models\Remission', 'rmnv_idremision', 'id');
    }

    public function RemissionConcNovelty()
    {
        return $this->belongsTo('App\Models\RemissionConceptNovelty', 'rmnv_idconcepto', 'id');
    }

    public function Material()
    {
        return $this->belongsTo('App\Models\Material', 'rmnv_idmaterial', 'id');
    }

    public function Client()
    {
        return $this->belongsTo('App\Models\Client', 'rmnv_idclient', 'id');
    }

    public function Construction()
    {
        return $this->belongsTo('App\Models\Construction', 'id_construction', 'id');
    }
}
