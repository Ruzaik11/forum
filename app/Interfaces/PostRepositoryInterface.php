<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function store($data);

    public function update($data, $post);

    public  function delete($post);

    public  function getAllPosts($data, $user);

    public function getPostById($post);

}
