<?php

namespace Core\Support\Validator;

class Validator
{
    private $data;

    private function __construct(string|array $data)
    {
        $this->data = $data;
    }

    public static function Validate($data)
    {
        return new self($data);
    }

    public function regex(array|string $rules)
    {
    }

    public function rules(array|string $rules)
    {
    }
}
