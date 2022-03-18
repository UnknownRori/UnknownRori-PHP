<?php

use Core\Support\Http\Route;
use Core\Utils\Time;

Route::get('/', function () {
    return view("welcome");
})->name('home');
