<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'materials';
    
    protected $fillable = ['mate_codigo','mate_descripcion', 'mate_estado', 'id_user'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function getMaterials()
    {
        $materials = Material::select("*")->where('mate_estado','A')
                        ->get();
        return $materials;
    }

    public function getMaterialById($id)
    {
        return Material::find($id);
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
    public function DetailMaterials()
    {
        return $this->hasMany('App\Models\RemissionDetail','dtrm_idmaterial','id');
    }

    public function PriceLists()
    {
        return $this->hasMany('App\Models\PriceList','id','id_material');
    }

}
