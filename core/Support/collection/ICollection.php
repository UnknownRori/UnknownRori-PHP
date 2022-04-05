<?php

namespace Core\Support;

interface ICollection
{
    // Getting Collection Original Data

    public function first();
    public function last();
    public function find(mixed $needle);
    public function get(array|string $key = null);
    public function key();

    // Collection Manipulation

    public function map(callable $callback);
    public function removeKeyInt();
    public function filter(callable $callback, $mode = ARRAY_FILTER_USE_KEY);
    public function split(int $length);
    public function push(mixed $val);
    public function merge(array $array);
    public function remove(array $key);
    public function save();
    public function rollback();
    public function revert();

    /**
     * DB Collection Pagination
     */
    public function set_perPage(int $perPage);
    public function set_total(int $total);
    public function nextPageUrl();
    public function previousPageUrl();
}
