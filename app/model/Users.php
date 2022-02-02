<?php

namespace App\Model;

use App\Models\Posts;
use Core\Model;


class Users extends Model
{
    protected $table = "users";
    protected $hasMany = [Posts::class, 'users_id'];
}
