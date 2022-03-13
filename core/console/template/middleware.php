<?php

function controller($name)
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
