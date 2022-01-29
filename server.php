<?php
$_ENV['ROOT_PROJECT'] = __DIR__;

// This is used for local development server using UnknownRoriCLI
require_once('./vendor/autoload.php');
require_once('./app/bootstrap.php');
require_once('./core/bootstrap.php');

// This is used for web server
// require_once('vendor/autoload.php');
// require_once('app/bootstrap.php');
// require_once('core/bootstrap.php');