<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware(['json.response'])->group(function () {

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::middleware(['auth:api'])->group(function () {

        Route::post('logout', [UserController::class, 'logout']);

        Route::group(['prefix' => 'admin'], function () {
            Route::post('post/{status}/{id}', [PostController::class, 'statusUpdate']);
        });

        Route::resource('post', PostController::class);
        Route::resource('post/comment', CommentController::class);

    });

});
