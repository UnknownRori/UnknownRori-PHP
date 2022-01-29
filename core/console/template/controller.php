<?php

function controller($name)
{
    return "
<?php

namespace App\Http\Controller;

use Core\Controller;

class {$name} extends Controller
{
    // Code Here
}
    ";
}
