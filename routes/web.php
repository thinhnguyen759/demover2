<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, "index"])->name('posts.index');
    Route::get('/posts/create', [PostController::class, "create"]);
    Route::get('/posts/{id}', [PostController::class, "show"]);
    Route::post('/posts', [PostController::class, "store"]);
    Route::delete('/posts/{id}', [PostController::class, "destroy"])->middleware(CheckRole::class. ':member');
    Route::get('/posts/{id}/edit', [PostController::class, "edit"]);
    Route::put('/posts/{id}', [PostController::class, "update"]);
});
Route::post('/comments', [CommentController::class, "store"])->name('comments.store');
Route::put('/comments/{id}', [CommentController::class, "update"]);
Route::delete('/comments/{id}', [CommentController::class, "destroy"]);
Route::post('/reactions', [ReactionController::class,'store']);



