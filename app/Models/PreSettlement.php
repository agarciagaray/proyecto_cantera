<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreSettlement extends Model
{
    protected $table = 'settlementremissions';
    public $timestamps = false;
    protected $fillable = ['dateStart','dateEnd','id_remission','id_construction','date','status'];
    public function Remission()
    {
        return $this->belongsTo('App\Models\Remission', 'id_remission', 'id');
    }
    public function Construction()
    {
        return $this->belongsTo('App\Models\Construction', 'id_construction', 'id');
    }

}
