<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
use App\Services\Newsletter;
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
use Illuminate\Validation\ValidationException;




Route::get('/', [PostController::class,'index'])->name('home');

//comment
Route::get('/posts/{post:slug}',[PostController::class,'show']);
Route::post('posts/{post:slug}/comments',[PostCommentController::class,'store']);

Route::post('newsletter', NewsletterController::class);

//bookmark
Route::post('/posts/{post}/bookmark', [PostController::class, 'bookmark'])->middleware('auth')->name('bookmark');
//Route::get('posts/bookmark',[AdminPostController::class,'index']);
Route::get('admin/posts/bookmark',[AdminPostController::class,'bookmark'])->name('admin.posts.bookmark');


Route::post('/post/{post}/follow', [PostController::class, 'follow'])->name('post.follow');
Route::delete('/post/{post}/unfollow', [PostController::class, 'unfollow'])->name('post.unfollow');


//register
Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');
Route::get('admin/user/{user}/edit', [RegisterController::class, 'edit'])->name('admin.user.edit');
Route::patch('admin/user/{user}',[RegisterController::class,'update']);

//login
Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function (){
    Route::resource('admin/category',CategoryController::class)->names([
        'index'=>'admin.category.index',
        'create'=>'admin.category.create'
    ]);
    Route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);




    Route::resource('admin/posts', AdminPostController::class)->names([
        'create' => 'admin.posts.create',
        'index'=>'admin.posts'
    ]);
    Route::get('admin/posts/status/{status}/{id}', [AdminPostController::class, 'status']);
});


//    Route::get('admin/posts',[AdminPostController::class,'index'])->name('admin.posts');
//    Route::get('admin/posts/create',[AdminPostController::class,'create'])->name('admin.posts.create');
//    Route::post('admin/posts',[AdminPostController::class,'store']);
//    Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit']);
//    Route::patch('admin/posts/{post}',[AdminPostController::class,'update']);
//    Route::delete('admin/posts/{post}',[AdminPostController::class,'delete']);
