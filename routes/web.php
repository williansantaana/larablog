<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/', [PostController::class, 'index'])
    ->name('home');

Route::get('/posts/{id}', [PostController::class, 'get'])
    ->where('id', '[0-9]+')
    ->name('posts.get');

Route::middleware('auth')->group(function () {

    Route::name('profile.')->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('destroy');
    });

    Route::name('posts.')->group(function () {

        Route::get('/posts', [PostController::class, 'show'])
            ->name('show');

        Route::get('/posts/new-post', [PostController::class, 'create'])
            ->name('create');

        Route::get('/posts/edit/{id}', [PostController::class, 'edit'])
            ->where('id', '[0-9]+')
            ->name('edit');

        Route::post('/posts', [PostController::class, 'store'])
            ->name('store');

        Route::put('/posts/{id}', [PostController::class, 'update'])
            ->where('id', '[0-9]+')
            ->name('update');

        Route::delete('/posts/{id}', [PostController::class, 'delete'])
            ->where('id', '[0-9]+')
            ->name('delete');
    });

});

require __DIR__ . '/auth.php';

