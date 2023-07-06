<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'commodities';

    protected $fillable = ['matp_descripcion', 'matp_estado', 'id_user'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // protected $primaryKey = 'matp_id';

    public function getCommodities()
    {
        $commodities = Commodity::join("users", "id", "=", "id_user")
                        ->select("*")
                        ->get();
        return $commodities;
    }

    public function getCommodityById($id)
    {
        return Commodity::find($id);
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

}
