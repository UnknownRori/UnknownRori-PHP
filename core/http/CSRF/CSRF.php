<?php

namespace Core\Http;

use Core\Support\Session;
use Core\Utils\Random;

class CSRF implements ICSRF {

    public static $session = 'CSRF_TOKEN';

    /**
     * Initialize CSRF Service
     * @return void
     */
    public static function init(): void
    {
        if(!Session::check(self::$session)) {
            self::createToken();
        }
    }

    /**
     * Verify CSRF token
     * @return void
     */
    public static function verify(): void
    {
        if(Request::method() == 'GET') return;
        
        if (Session::check(self::$session)) {
            if (isset($_POST['_csrf_token'])) {
                if(Request::post('_csrf_token') == Session::get(self::$session)) return;
            }
        }
        abort(403);
        die;
    }

    /**
     * Create token and insert it to session
     * @return void
     */
    public static function createToken(): void
    {
        Session::set(self::$session, md5(uniqid(mt_rand(), true)));
    }

    /**
     * Destroy CSRF token
     * @return void
     */
    public static function destroy(): void
    {
        Session::unset(self::$session);
    }

}