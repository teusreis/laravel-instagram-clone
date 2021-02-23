<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/', [UserController::class, "index"])->middleware("auth")->name("home");

/**
 * Profiles Routes
 */
Route::group(['prefix' => '/profile'], function () {

    Route::get('/{user:username}', [ProfileController::class, 'index'])->name("profile.show");
    Route::get('/{user:username}/edit', [ProfileController::class, 'edit'])->name("profile.edit");
    Route::put('/{user:username}', [ProfileController::class, 'update'])->name("profile.update");
});


/**
 * Explore Routes
 */
Route::get('/explore', [ExploreController::class, 'index'])->middleware('auth')->name("explore.index");

/**
 * Follow Routes
 */
Route::group(['prefix' => '/follow', 'middleware' => 'auth'], function () {
    Route::post("/{user:username}", [FollowsController::class, 'store'])->name('follow');
    Route::delete("/{user:username}", [FollowsController::class, 'delete'])->name('unfollow');
});

/**
 * Post Routes
 */
Route::group(['prefix' => '/post', 'middleware' => 'auth'], function () {
    Route::get('/create', [PostController::class, 'create'])->name("post.create");
    Route::get('/{post}', [PostController::class, 'show'])->name("post.show");
    Route::post('/store', [PostController::class, 'store'])->name("post.store");

    Route::get("/{post}/edit", [PostController::class, 'edit'])->name("post.edit");
    Route::patch('/{post}', [PostController::class, 'update'])->name("post.update");
    Route::delete('/{post}', [PostController::class, 'delete'])->name("post.delete");
});

/**
 * Like Routes
 */
Route::group(['prefix' => '/like', 'middleware' => 'auth'], function () {
    Route::post('/{post}/like', [LikeController::class, 'store'])->name("post.like");
    Route::delete('/{post}/unlike', [LikeController::class, 'delete'])->name("post.unlike");
});

/**
 * Save Routes
 */
Route::group(['prefix' => '/save', 'middleware' => 'auth'], function () {
    Route::get('/', [SaveController::class, 'index'])->name("save.index");
    Route::post('/{post}', [SaveController::class, 'store'])->name("save.store");
    Route::delete('/{post}', [SaveController::class, 'delete'])->name("save.delete");
});

/**
 * Comments Routes
 */
Route::group(['prefix' => '/comment', 'middleware' => 'auth'], function () {
    Route::post('/{post}', [CommentController::class, 'store'])->name("comment.store");
    Route::delete('/{comment}', [CommentController::class, 'delete'])->name("comment.delete");
});

require __DIR__ . '/auth.php';
