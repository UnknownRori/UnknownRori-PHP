<?php

function generate(string $name, string $modelName = null)
{
    if (!is_null($modelName)) {
        return "<?php

namespace App\Http\Controller;

use App\Models\{$modelName}

class {$name}
{
    // Code Here
}
";
    }
    return "<?php

namespace App\Http\Controller;

class {$name}
{
    // Code Here
}
";
}
