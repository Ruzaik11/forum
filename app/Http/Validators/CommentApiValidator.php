<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class CommentApiValidator
{

    public static function storeComment($inputs)
    {
        $messages = [

        ];

        return Validator::make($inputs, [

        ], $messages);
    }


}
