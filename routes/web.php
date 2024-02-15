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

Route::get('/', [\App\Http\Controllers\PostController::class,'index'])->name('home');

Route::get('/posts/{post:slug}',[\App\Http\Controllers\PostController::class,'show']);

Route::get('register',[\App\Http\Controllers\RegisterController::class,'create'])->middleware('guest');
Route::post('register',[\App\Http\Controllers\RegisterController::class,'store'])->middleware('guest');

Route::get('login',[\App\Http\Controllers\SessionController::class,'create'])->middleware('guest');
Route::post('login',[\App\Http\Controllers\SessionController::class,'store'])->middleware('guest');
Route::post('logout',[\App\Http\Controllers\SessionController::class,'destroy'])->middleware('auth');
