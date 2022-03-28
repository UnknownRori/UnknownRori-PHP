<?php

use Core\Http\Route;

Route::get('/', function () {
    return view("welcome");
})->name('home');
