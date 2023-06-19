<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('user.book.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user'],function() {

    Route::get('/',[\App\Http\Controllers\User\BookController::class,'index'])
        ->name('user.book.index');

    Route::get('/show/{book}',[\App\Http\Controllers\User\BookController::class,'show'])
        ->name('user.book.show');

    Route::get('/comment/{book}/create',[\App\Http\Controllers\User\CommentController::class,'create'])
        ->name('user.comment.create');

    Route::post('/comment/{book}/store',[\App\Http\Controllers\User\CommentController::class,'store'])
        ->name('user.comment.store');

    Route::get('/comment/{comment}/edit',[\App\Http\Controllers\User\CommentController::class,'edit'])
        ->name('user.comment.edit');

    Route::post('/comment/{comment}/update',[\App\Http\Controllers\User\CommentController::class,'update'])
        ->name('user.comment.update');

    Route::post('/comment/{comment}/delete',[\App\Http\Controllers\User\CommentController::class,'destroy'])
        ->name('user.comment.destroy');

    Route::get('/search',[\App\Http\Controllers\SearchController::class,'index'])->name('search');
});


Route::group(['prefix' => 'admin','middleware' => 'admin'],function () {
    Route::get('/',\App\Http\Controllers\Admin\HomeController::class);
    Route::resource('book',\App\Http\Controllers\Admin\Book\BookController::class);
    Route::resource('category',\App\Http\Controllers\Admin\Category\CategoryController::class);
    Route::resource('users',\App\Http\Controllers\Admin\Users\AdminController::class);
});


