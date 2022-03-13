<?php

function controller($name)
{
    return "<?php

namespace App\Http\Controller;

class {$name}
{
    // Code Here
}
";
}
