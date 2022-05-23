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
        if(Session::check(self::$session)) {
            if(Request::post('_csrf_token') == Session::get(self::$session)) return;
        }

        // Stop executing
    }

    /**
     * Create token and insert it to session
     * @return void
     */
    public static function createToken(): void
    {
        Session::set(self::$session, Random::byte(40));
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