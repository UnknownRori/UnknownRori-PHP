<?php

namespace App\Http\Middleware;

use Core\Auth;

class Authentication
{
    public function Run()
    {
        if (!Auth::check()) header("Location: /login");
    }
}
