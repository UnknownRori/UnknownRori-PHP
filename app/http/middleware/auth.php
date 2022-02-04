<?php

namespace App\Http\Middleware;

use Core\Auth as CoreAuth;

class auth
{
    public function Run()
    {
        if (!CoreAuth::check()) header("Location: /login");
    }
}
