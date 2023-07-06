<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'suppliers';

    protected $fillable = ['id_person', 'prov_codactividad', 'prov_estado','codeVerification'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['prov_id', 'created_at', 'updated_at', 'deleted_at'];

    public function getSupplierById($id)
    {
        return Supplier::find($id);
    }

    public function Person()
    {
        return $this->belongsTo('App\Models\Person', 'id_person', 'id');
    }

}
