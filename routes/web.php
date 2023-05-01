<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}', [PostController::class, 'get'])->where('id', '[0-9]+')->name('posts.get');
    Route::get('/posts/new-post', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

require __DIR__ . '/auth.php';
