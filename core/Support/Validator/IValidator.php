<?php

namespace Core\Support\Validator;

interface IValidator
{
    /**
     * Validate Data
     * @param  mixed $data
     * @return self
     */
    public static function Validate($data): Validator;

    /**
     * Validate the passed data using regular expression.
     * if it fail to validate it will return false but it's success it will return data that passed.
     * @param  array|string $rules
     * @return string|array|bool
     */
    public function regex(array|string $rules): string|array|bool;

    /**
     * Validate the passed data using built in rule.
     * if it fail to validate it will return false but it's success it will return data that passed.
     * @param  array|string $rules
     * @return string|array|bool
     */
    public function rules(array $rules): string|int|bool|array;
}
