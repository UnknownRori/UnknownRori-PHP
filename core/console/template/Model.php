<?php

function generateModel(string $name)
{
    $namespace = "namespace App\Models;\n\n";
    $class = "
use Core\BaseModel;

class {$name} extends BaseModel
{
    protected \$table = '{$name}';
}
    ";

    return "<?php\n" . $namespace . $class;
}
