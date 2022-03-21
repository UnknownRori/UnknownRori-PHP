<?php

function controller($name)
{
    return "<?php

namespace App\Http\Controller;

class {$name}
{
    public function index(){
        //
    }

    public function show(){
        //
    }

    public function create(){
        //
    }

    public function store(){
        //
    }

    public function edit(){
        //
    }

    public function update(){
        //
    }

    public function destroy(){
        //
    }
}
";
}
