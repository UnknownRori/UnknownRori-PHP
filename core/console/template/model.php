<?php

function generate(string $name)
{
    return "<?php

namespace App\Models;

use Core\BaseModel;

class {$name} extends BaseModel
{
    protected \$table = '{$name}';
}

";
}
