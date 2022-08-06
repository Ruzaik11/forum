<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function store($data, $post, $user);

    public function getComments($comment);

}
