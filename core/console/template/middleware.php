<?php

function generate(string $name)
{
    return "<?php

namespace App\Http\Middleware;

class {$name}
{
    public function Run()
    {
        // Code Here
    }
}
";
}
