<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class RemissionDetail extends Model
{
    //use SoftDeletes;
    //use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'remissionsdetails';

    protected $fillable = ['dtrm_idremision', 'dtrm_idmaterial', 'dtrm_cantdespachada', 'dtrm_precio','unit_id', 'valor_iva','transporte','suministro','subtotal','pricelist_id','date_detail'];

    protected $hidden = ['id'];

    public function getRemissionsDetails()
    {
        $remissionDetails = RemissionDetail::all();
                            // ::join("materials", "materials.id", "=", "dtrm_idmaterial")
                            // ->join("units", "units.id", "=", "dtrm_unidad")
                            // ->select("*",'materials.id as id_material','units.id as unit_id')
                            // ->get();

        return $remissionDetails;
    }

    public function Society()
    {
        return $this->belongsTo('App\Models\Society', 'id_society', 'id');
    }

    public function Construction()
    {
        return $this->belongsTo('App\Models\Construction', 'id_obra', 'id');
    }

    public function Remission()
    {
        return $this->belongsTo('App\Models\Remission', 'dtrm_idremision', 'id');
    }

    public function Material()
    {
        return $this->belongsTo('App\Models\Material', 'dtrm_idmaterial', 'id');
    }
    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'id');
    }

}
