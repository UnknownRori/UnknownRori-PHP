<?php

function generateMiddleware(string $name)
{
    $namespace =  "namespace App\Http\Middleware;\n\n";

    $class = "
class {$name}
{
    public function Run()
    {
        // Code Here
    }
}    
    ";

    return "<?php" . $namespace . $class;
}
