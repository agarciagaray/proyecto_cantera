<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemissionConceptNovelty extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'remissionconcnovelties';

    protected $fillable = ['cncn_nombre', 'cncn_estado'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    // public function getConceptNovelties()
    // {
    //     $remissionconcnovelties = RemissionConceptNovelty::select("*")
    //                     ->get();

    //     return $remissionconcnovelties;
    // }

    public function getConceptNoveltyById($id)
    {
        return RemissionConceptNovelty::find($id);
    }
}
