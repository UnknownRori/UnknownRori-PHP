<?php

function generate(string $name, string $modelName = null)
{
    if (!is_null($modelName)) {
        return "<?php

namespace App\Http\Controller;

use App\Models\{$modelName}

class {$name}
{
    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
";
    }
    return "<?php

namespace App\Http\Controller;

class {$name}
{
    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
";
}
