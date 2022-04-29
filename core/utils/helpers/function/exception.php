<?php

function report($message = "")
{
    if (env('APP_DEBUG', true)) throw new Exception($message);
    return;
}
