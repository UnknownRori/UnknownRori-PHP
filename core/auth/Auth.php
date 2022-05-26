<?php

namespace Core;

use Core\Database\DB;
use Core\Support\Collection;
use Core\Support\Session;
use Core\Utils\Hash;

class Auth implements IAuth
{
    public static $option;
    protected $userData;

    public function __construct()
    {
        self::$option = require(env('APP_DIR') . '/config/auth.php');
        return $this;
    }

    /**
     * Get UserData from session
     * @return static
     */
    public static function user()
    {
        if (!Auth::check()) return;
        $User = new static;
        $User->userData = Session::get(self::$option['session_name']);
        return $User;
    }

    /**
     * Get authenticated user specific data
     * @param string $key
     * @return mixed
     */
    public function get($key = null)
    {
        if (!is_null($key)) {
            return $this->userData->get($key);
        }
        return $this->userData;
    }

    /**
     * Try to Authenticate User using passed credentials
     * @param array $credentials
     * @return void
     */
    public static function attempt($credentials)
    {
        $data = DB::table(self::$option['table'])->find($credentials[self::$option['unique_key']], self::$option['unique_key']);
        if (!$data->is_null()) {
            if (Hash::check($credentials[self::$option['verify_key']], $data->get(self::$option['verify_key']))) {
                $data->remove(self::$option['guarded']);
                
                $data->save();

                Session::set(self::$option['session_name'], $data);

                return true;
            } else {
                unset($data);
            }
        } else {
            Session::unset(self::$option['session_name']);
        }
        return false;
    }

    /**
     * Check whether user is logged in or not
     * @return boolean
     */
    public static function check()
    {
        if (Session::check(self::$option['session_name'])) return true;
        return false;
    }

    /**
     * Log out current authenticated user
     * @return void
     */
    public static function logout()
    {
        Session::unset(self::$option['session_name']);
    }
}
