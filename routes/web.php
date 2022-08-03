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

Route::get('/about', function () {
    return "About Page";
});

Route::get('/pages', [\App\Http\Controllers\PageController::class, 'index']);
Route::get('/pages/{id}', [\App\Http\Controllers\PageController::class, 'show']);

// ใส่ก่อน resource
Route::post('/posts/{post}/comments', [\App\Http\Controllers\PostController::class, 'storeComment'])
    ->name('posts.comments.store'); // กำหนดชื่อ route

Route::resource('/posts', \App\Http\Controllers\PostController::class);
Route::resource('/tags',\App\Http\Controllers\TagController::class);
