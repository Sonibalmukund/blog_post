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

    return view('posts', [
        'posts' => Post::latest()->get(),
        'categories' => \App\Models\Category::all()
    ]);
})->name('home');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post,
        'categories' => \App\Models\Category::all()
    ]);
});

Route::get('/categories/{category:slug}', function (\App\Models\Category $category) {
    return view('posts', [
        'posts' => $category->posts,
        'currentCategory' => $category,
        'categories' => \App\Models\Category::all()
    ]);
})->name('category');

Route::get('/authors/{author:user_name}', function (\App\Models\User $author) {
    return view('posts', [
        'posts' => $author->posts
    ]);
});
