<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Validators\CommentApiValidator;
use App\Interfaces\CommentRepositoryInterface;

class CommentController extends BaseApiController
{

    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        //
        try {

            $data = $request->except(array_keys($request->query()));

            $validateRequest = CommentApiValidator::storeComment($data);

            if (!$validateRequest->fails()) {

                $post = $this->commentRepository->store($data, $post, auth()->user());

                return response()->json([
                    'error' => false,
                    'data' => $post,
                ], 200);

            } else {
                return response()->json([
                    'error' => true,
                    'message' => $validateRequest->errors()->all(),
                ], 400);
            }

        } catch (\Throwable $th) {
            return $this->returnErrorMessage($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        try {

            $data = [];

            $validateRequest = CommentApiValidator::storeComment($data);

            if (!$validateRequest->fails()) {

                $comment = $this->commentRepository->getComments($comment);

                return response()->json([
                    'error' => false,
                    'data' => $comment,
                ], 200);

            } else {
                return response()->json([
                    'error' => true,
                    'message' => $validateRequest->errors()->all(),
                ], 400);
            }

        } catch (\Throwable $th) {
            return $this->returnErrorMessage($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
