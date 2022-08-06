<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }



    public function store($data, $post, $user)
    {
        $comment =  $post->comments()->create([
                        'comment_by' => $user->id,
                        'comment' => $data['comment'],
                        'created_at' => now(),
                    ]);

        return $comment;
    }

    public function getComments($comment)
    {
        return $comment;
    }








}
