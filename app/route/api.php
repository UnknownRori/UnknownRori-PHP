<?php

use Core\Http\Route;
use Core\Utils\Json;

Route::get('/test', function () {
    echo Json::Encode([ 'message' => 'Hello World!' ]);
});