<?php

use Core\Http\Route;

Route::get('/api', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});

Route::prefix('/api')->group(function () {
    //
});