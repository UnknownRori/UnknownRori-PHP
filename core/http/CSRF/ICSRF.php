<?php

namespace Core\Http;

interface ICSRF {
    public static function init(): void;
    public static function verify(): void;
    public static function createToken(): void;
    public static function destroy(): void;
}