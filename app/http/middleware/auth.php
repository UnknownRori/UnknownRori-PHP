<?php

namespace App\Http\Middleware;

use UnknownRori\UnknownRoriPHPCore\Auth\Auth;

class Authentication
{
    public function Run()
    {
        if (!Auth::check()) header("Location: /login");
    }
}
