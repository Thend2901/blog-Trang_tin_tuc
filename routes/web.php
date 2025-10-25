<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    if(auth()->check()){
        $user=auth()->user();
        return view('home',['user'=>$user]);
    }
    return view('home');
});
Route::post('/register',[UserController::class,'register']);
Route::post('/login' ,[UserController::class,'login']);
Route::get('/logout' ,[UserController::class,'logout']);

// xử lý tạo bài viết
Route::post('/creat-post',[PostController::class,'createPost']);