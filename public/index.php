<?php

use Core\Kernel;

// This is used for local development server using UnknownRoriCLI
require_once('server.php');

// This is used for web server
// require_once('../server.php');

return Kernel::Start();
