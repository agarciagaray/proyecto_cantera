<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachinesType extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'machinestypes';

    protected $fillable = ['tmaq_nombre', 'tmaq_estado'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function getMachinesTypes()
    {
        $machinestypes = MachinesType::select("*")
                        ->where('tmaq_estado','A')->get();
        //dd($machinestypes);
        return $machinestypes;
    }

    public function getMachinesTypeById($id)
    {
        return MachinesType::find($id);
    }
}
