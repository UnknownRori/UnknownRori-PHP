<?php

namespace Core\Support;

interface ICollection
{
    // Getting Collection Original Data

    public function first();
    public function last();
    public function find($needle);
    public function fetch();
    public function get($key);
    public function key();

    // Collection Manipulation

    public function map($callback);
    public function filter($callback, $mode = ARRAY_FILTER_USE_KEY);
    public function split(int $length);
    public function fetchData();
    public function getData($key);
    public function push(string|int $val);
    public function merge(array $array);
    public function remove(array $key);
    public static function destroy($collection);
    public function save();

    /**
     * DB Collection Pagination
     */
    public function set_perPage(int $perPage);
    public function set_total(int $total);
    public function nextPageUrl();
    public function previousPageUrl();
}
