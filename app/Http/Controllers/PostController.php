<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController;
use App\Http\Validators\PostApiValidator;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends BaseApiController
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $data = $request->except(array_keys($request->query()));

            $validateRequest = PostApiValidator::storePost($data);

            if (!$validateRequest->fails()) {

                $post = $this->postRepository->store($data);

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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        try {

            $post = $this->postRepository->getPostById($post);

            if (!$post) {
                return response()->json([
                    'error' => true,
                    'message' => 'Post Not Found',
                ], 404);
            }

            return response()->json([
                'error' => false,
                'data' => $post,
            ], 200);

        } catch (\Throwable $th) {
            return $this->returnErrorMessage($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        try {

            $data = $request->except(array_keys($request->query()));

            $validateRequest = PostApiValidator::updatePost($data);

            if (!$validateRequest->fails()) {

                $post = $this->postRepository->update($data, $post);

                if ($post) {

                    return response()->json([
                        'error' => false,
                        'data' => $post,
                    ], 200);

                } else {
                    return response()->json([
                        'error' => false,
                        'data' => 'Unable to update this post',
                    ], 200);
                }

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {

            $post = $this->postRepository->delete($post);

            if ($post) {

                return response()->json([
                    'error' => false,
                    'msg' => 'Post deleted successfully',
                ], 200);

            } else {

                return response()->json([
                    'error' => false,
                    'msg' => 'Unable to delete the post',
                ], 200);

            }

        } catch (\Throwable $th) {
            return $this->returnErrorMessage($th);
        }
    }

    public function statusUpdate(Request $request, $status, $id)
    {

        try {

            if (!auth()->user()->inRole('admin')) {

                return response()->json([
                    'error' => true,
                    'message' => 'Access Denied',
                ], 401);
            }

            $data = $request->except(array_keys($request->query()));

            $validateRequest = PostApiValidator::statusUpdate([]);

            if (!$validateRequest->fails()) {

                $post = $this->postRepository->statusUpdate($status, $id);

                if ($post) {

                    return response()->json([
                        'error' => false,
                        'data' => $post,
                    ], 200);

                } else {

                    return response()->json([
                        'error' => false,
                        'data' => 'Unable to update the status',
                    ], 200);

                }

            } else {
                return response()->json([
                    'error' => true,
                    'message' => $validateRequest->errors()->first(),
                ], 400);
            }

        } catch (\Throwable $th) {
            
            return $this->returnErrorMessage($th);

        }
    }




}
