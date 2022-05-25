<?php

use Core\Http\Route;

Route::get('', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});
