<?php

namespace App\Http\Controller;

use Core\Controller;

class Welcome extends Controller
{
    function index()
    {
        return view('welcome');
    }
}
