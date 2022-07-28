<?php

function generateController(string $name, string $modelName = null)
{
    $namespace = "namespace App\Http\Controller;\n\n";

    $modelImport = $modelName ? "use App\Models\\{$modelName};\n" : null;

    $class = "
class {$name}
{
    //
}
    ";
    return "<?php\n" . $namespace . $modelImport . $class;
}
