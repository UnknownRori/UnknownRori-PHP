<?php

namespace App\Http\Middleware;

use UnknownRori\UnknownRoriPHPCore\Auth\Auth as AuthAuth;

class auth
{
    public function Run()
    {
        if (!AuthAuth::check()) header("Location: /login");
    }
}
