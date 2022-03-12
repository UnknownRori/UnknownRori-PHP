<?php

return [
    'table' => 'users',
    'session_name' => 'USER',
    'primary_key' => 'id',
    'unique_key' => 'name',
    'verify_key' => 'password',
    'guarded' => ['password', 'email'],
];
