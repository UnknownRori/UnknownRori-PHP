<?php

namespace App\Http\Middleware;

use Core\Http\CSRF;

class VerifyCSRF
{
    public function Run()
    {
        CSRF::verify();
    }
}
