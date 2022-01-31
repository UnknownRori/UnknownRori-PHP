<?php

function controller($name)
{
    return "<?php

namespace App\Models;
use Core\Model;

class {$name} extends Model
{
    // Code Here
}

    ";
}
