<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class PostApiValidator
{

    public static function storePost($inputs)
    {
        $messages = [
            'title.required' => 'title is required',
            'description.required' => 'description is required',
        ];

        return Validator::make($inputs, [
            'title' => 'required',
            'description' => 'required',
        ], $messages);
    }

    public static function updatePost($inputs)
    {
        $messages = [
            'id.integer' => 'id is required',
            'title.required' => 'title is required',
            'description.required' => 'description is required',
        ];

        return Validator::make($inputs, [
            'id' => 'integer',
            'title' => 'required',
            'description' => 'required',
        ], $messages);
    }

    public static function deletePost($inputs)
    {
        $messages = [
            'id.integer' => 'id is required',
        ];

        return Validator::make($inputs, [
            'id' => 'integer',
        ], $messages);
    }

    public static function postComment($inputs)
    {
        $messages = [
            'id.integer' => 'id is required',
            'comment.required' => 'comment is required',
        ];

        return Validator::make($inputs, [
            'id' => 'integer',
            'comment' => 'required',
        ], $messages);
    }

    public static function getComments($inputs)
    {
        $messages = [
            'id.integer' => 'id is required',
        ];

        return Validator::make($inputs, [
            'id' => 'integer',
        ], $messages);
    }

    public static function statusUpdate($inputs)
    {
        $messages = [
        ];

        return Validator::make($inputs, [
        ], $messages);
    }

}
