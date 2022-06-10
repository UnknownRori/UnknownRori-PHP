<?php

use Core\Http\Route;

Route::get('/', function () {
    return view("welcome");
})->name('home');

Route::middlewares('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::prefix('/post')->names('post')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/create', [PostController::class, 'store'])->name('store');
        Route::get('/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('/edit', [PostController::class, 'update'])->name('update');
        Route::post('/delete', [PostController::class, 'destroy'])->name('destroy');
    });
    dd(Route::dump());

    Route::prefix('/comment')->names('comment')->group(function () {
        Route::post('/create', [PostController::class, 'store'])->name('store');
        Route::get('/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('/edit', [PostController::class, 'update'])->name('update');
        Route::post('/delete', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/user')->names('user')->group(function () {
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/edit', [UserController::class, 'update'])->name('update');
        Route::get('/show', [UserController::class, 'show'])->name('show');
    });

    Route::prefix('/auth')->names('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::middlewares('admin')->group(function () {
        Route::prefix('/user')->names('user')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::post('/delete', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/post')->names('post')->group(function () {
            Route::get('/list', [PostController::class])->name('list');
        });

        Route::prefix('/comment')->names('comment')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('index');
        });
    });
});

dd(Route::dump());
