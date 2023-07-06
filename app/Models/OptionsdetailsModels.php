<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class OptionsdetailsModels extends Model
{
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            // 'clie_identif'      => ['max:12'],
            // 'clie_dircorresp'   => ['max:50'],
        ]);


        return $validator;
}
    

 }