<?php

namespace Core\Utils;

use Core\KernelException;

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
                KernelException::hash($_ENV['HASH_ALGO']);
                break;
        }
    }

    /**
     * Check the given string match with the hash
     * @param  string  $value
     * @param  string  $hash
     * @return boolean
     */
    public static function check($value, $hash)
    {
        return password_verify($value, $hash);
    }
}
