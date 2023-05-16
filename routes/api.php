<?php

use Illuminate\Http\Request;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');*/

Route::group(['prefix' => 'user'],function () {
    Route::post('register',\App\Http\Controllers\Api\User\Auth\RegisterController::class);
    Route::post('auth',\App\Http\Controllers\Api\User\Auth\AuthController::class);
});

Route::group(['prefix' => 'user/books'],function () {
    Route::get('/',[\App\Http\Controllers\Api\User\BookController::class,'index']);
    Route::get('/show/{book}',[\App\Http\Controllers\Api\User\BookController::class,'show']);

});

Route::group(['prefix' => 'comment','middleware' => 'auth:api'],function () {

    Route::get('/{comment}',[\App\Http\Controllers\Api\User\CommentController::class,'show']);
    Route::post('/store/{book}',[\App\Http\Controllers\Api\User\CommentController::class,'store']);
    Route::post('/update/{comment}',[\App\Http\Controllers\Api\User\CommentController::class,'update']);
    Route::delete('/delete/{comment}',[\App\Http\Controllers\Api\User\CommentController::class,'destroy']);

});
