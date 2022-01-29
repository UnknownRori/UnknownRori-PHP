<?php

function controller($name)
{
    return "
<?php

namespace App\Models;

class {$name} extends
{
    // Code Here
}

    ";
}
