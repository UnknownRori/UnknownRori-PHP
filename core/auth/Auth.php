<?php

namespace Core;

use Core\Database\DB;
use Core\Support\Collection;
use Core\Support\Session;
use Core\Utils\Hash;

class Auth
{
    protected static $table = 'users';
    protected static $UserSession = 'USER';
    protected static $primary_key = 'id';
    protected static $unique_key = 'name';
    protected static $verify_key = 'password';
    protected static $guarded = ['password', 'email'];
    protected $userData;

    public static function User()
    {
        $User = new static;
        $User->userData = Session::get(self::$UserSession);
        return $User;
    }

    public function get($key)
    {
        return $this->userData->get($key);
    }

    public static function attempt($credentials)
    {
        $data = DB::table(self::$table)->find($credentials[self::$unique_key], self::$unique_key);
        if (!$data->is_null()) {
            if (Hash::verify($credentials[self::$verify_key], $data->get(self::$verify_key))) {
                $data->remove(self::$guarded);
                $data->save();
                Session::set(self::$UserSession, $data);
            } else {
                Collection::destroy($data);
            }
        } else {
            Session::unset(self::$UserSession);
        }
    }

    public static function check()
    {
        if (Session::get(self::$UserSession)) return true;
        return false;
    }

    public static function logout()
    {
        Session::unset(self::$UserSession);
    }
}
