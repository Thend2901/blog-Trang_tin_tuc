<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

Route::get('/', function () {
    $posts = [];
    if(auth()->check()){
        $user=auth()->user();
        $posts = $user->userPosts()->latest()->get();
        return view('home',['user'=>$user ,'posts'=>$posts]);
    }
    else{
        return view('home');
    }
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login' ,[UserController::class,'login']);
Route::get('/logout' ,[UserController::class,'logout']);

// xử lý tạo bài viết
Route::post('/create-post',[PostController::class,'createPost']);
Route::delete('/delete-post/{id}',[PostController::class,'destroy']);
Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']);
Route::put('/edit-post/{post}',[PostController::class,'updatePost']);