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
    return redirect()->to('/posts');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// ใส่ก่อน resource
Route::post('/posts/{post}/comments', [\App\Http\Controllers\PostController::class, 'storeComment'])
    ->name('posts.comments.store'); // กำหนดชื่อ route


Route::post('/posts/{post}/update/status', [\App\Http\Controllers\PostController::class, 'updateStatus'])
    ->name('posts.update.status'); // กำหนดชื่อ route

Route::get('/users/{user}/posts', [\App\Http\Controllers\UserController::class, 'userPosts'])
    ->name('users.posts'); // กำหนดชื่อ route


Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/tags',\App\Http\Controllers\TagController::class);
Route::resource('/test',\App\Http\Controllers\TestController::class);
Route::resource('/users',\App\Http\Controllers\UserController::class);
Route::resource('/comments',\App\Http\Controllers\CommentController::class);
Route::resource('/admin',\App\Http\Controllers\AdminController::class);

