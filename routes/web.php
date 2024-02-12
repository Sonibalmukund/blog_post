<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;


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

Route::get('/', function () {

    return view('posts',[
        'posts' => Post::latest()->get()
    ]);
});

Route::get('/posts/{post:slug}',function(Post $post){
    return view('post', [
        'post' =>$post
    ]);
});

Route::get('/categories/{category:slug}',function (\App\Models\Category $category){
    return view('posts',[
        'posts' => $category->posts
    ]);
});

Route::get('/authors/{author:user_name}',function (\App\Models\User $author){
    return view('posts',[
        'posts' => $author->posts
    ]);
});
