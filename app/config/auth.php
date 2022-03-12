<?php

return [
    'table' => 'users',
    'SessionName' => 'USER',
    'primary_key' => 'id',
    'unique_key' => 'name',
    'verify_key' => 'password',
    'guarded' => ['password', 'email'],
];
