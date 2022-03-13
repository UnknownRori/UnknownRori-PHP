<?php

function controller($name)
{
    return "<?php

namespace App\Models;
use Core\BaseModel;

class {$name} extends BaseModel
{
    // Code Here
}

";
}
