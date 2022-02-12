<?php

use UnknownRori\UnknownRoriPHPCore\Http\Route;

Route::get('/', function () {
    return view("welcome");
})->name('home');
