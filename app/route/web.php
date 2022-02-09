<?php

use Core\Support\Http\Route;

Route::get('/', function () {
    return view("welcome");
})->name('home');
