<?php

namespace Core\Utils;

use Core\Exception\KernelException;

class Hash
{
    public static function make($value)
    {
        switch ($_ENV['HASH_ALGO']) {
            case 'PASSWORD_DEFAULT':
                return password_hash($value, PASSWORD_DEFAULT, require("{$_ENV['APP_DIR']}/config/hash.php"));
                break;
            case 'PASSWORD_BCRYPT':
                return password_hash($value, PASSWORD_BCRYPT, require("{$_ENV['APP_DIR']}/config/hash.php"));
                break;
            case 'PASSWORD_ARGON2I':
                return password_hash($value, PASSWORD_ARGON2I, require("{$_ENV['APP_DIR']}/config/hash.php"));
                break;
            case 'PASSWORD_ARGON2ID':
                return password_hash($value, PASSWORD_ARGON2ID, require("{$_ENV['APP_DIR']}/config/hash.php"));
                break;
            default:
                KernelException::Hash($_ENV['HASH_ALGO']);
                break;
        }
    }

    public static function verify($value, $hash)
    {
        return password_verify($value, $hash);
    }
}
