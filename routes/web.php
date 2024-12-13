<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/articles', [ArticleController::class, "index"]);
Route::resource('/articles', ArticleController::class);

Route::post('/comment',[CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{id}/edit', [CommentController::class, 'edit']);
Route::post('/comment/{comment}/update', [CommentController::class, 'update']);
Route::get('/comment/{comment}/delete', [CommentController::class, 'destroy']);


Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'signin']);

Route::get('/', [MainController::class, 'index']);
Route::get('/galery/{full_image}', [MainController::class, 'show']);

Route::get('/about', function () {
    return view('main/about');
});

Route::get('/contacts', function () {
    $data = [
        "name" => "Polytech",
        "address" => "B.Semenovskaya",
        "email" => "@mospolytech.ru"
    ];

    return view('main/contact', ['data'=>$data]);
});