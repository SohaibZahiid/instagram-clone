<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;

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


Auth::routes();

// ROUTES ORDER IS IMPORTANT!!!
// ROUTES WITH PARAMS SHOULD BE LAST

// POST ROUTES
Route::get('/', [PostController::class, 'index'])->name(('post.index'));
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

// PROFILE ROUTES
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');;
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

// FOLLOW
Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow.store');

// SEARCH
Route::get('/search/{user}', [ProfileController::class, 'search'])->name('profile.search');;
