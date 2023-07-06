<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConceptPayment extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'conceptspayments';

    protected $fillable = ['cncp_nombre', 'cncp_estado'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function getConceptsPayments()
    {
        $conceptspayments = ConceptPayment::select("*")
                        ->get();
        //dd($conceptspayments);
        return $conceptspayments;
    }

    public function getConceptNoveltyById($id)
    {
        return ConceptPayment::find($id);
    }
}
