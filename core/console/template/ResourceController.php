<?php

function generateResourceController(string $name, ?string $modelName = null)
{
    $namespace = "namespace App\Http\Controller;\n\n";

    $modelImport = $modelName ? "use App\Models\\{$modelName};\n" : null;

    $class = "
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
    return "<?php\n" . $namespace . $modelImport . $class;
}
