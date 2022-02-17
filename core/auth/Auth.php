<?php

namespace Core;

use Core\Database\DB;
use Core\Support\Collection;
use Core\Support\Session;
use Core\Utils\Hash;

class Auth implements IAuth
{
    protected static $table = 'users';
    protected static $UserSession = 'USER';
    protected static $primary_key = 'id';
    public static $unique_key = 'name';
    protected static $verify_key = 'password';
    protected static $guarded = ['password', 'email'];
    protected $userData;

    /**
     * Get UserData from session
     * @return static
     */
    public static function User()
    {
        $User = new static;
        $User->userData = Session::get(self::$UserSession);
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
        $data = DB::table(self::$table)->find($credentials[self::$unique_key], self::$unique_key);
        if (!$data->is_null()) {
            if (Hash::check($credentials[self::$verify_key], $data->get(self::$verify_key))) {
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

    /**
     * Check whether user is logged in or not
     * @return boolean
     */
    public static function check()
    {
        if (Session::check(self::$UserSession)) return true;
        return false;
    }

    /**
     * Log out current authenticated user
     * @return void
     */
    public static function logout()
    {
        Session::unset(self::$UserSession);
    }
}
