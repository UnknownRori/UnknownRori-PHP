<?php

use Core\Support\Http\Route;

Route::get('/', [Welcome::class, 'index'])->name('home');
Route::post('/post', [Welcome::class, 'post'])->name('post');
