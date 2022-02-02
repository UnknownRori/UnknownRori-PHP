<?php

namespace App\Models;

use App\Model\Users;
use Core\Model;

class Posts extends Model
{
    /**
     * This model used for relation model test
     */

    protected $table = 'post';
    protected $belongsTo = [Users::class, 'users_id'];
}
