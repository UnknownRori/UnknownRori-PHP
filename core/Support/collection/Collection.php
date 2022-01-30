<?php

namespace Core\Support;

class Collection implements ICollection
{
    protected $original = [];
    public $data = [];

    /**
     * Initialize Collection Instance
     */
    public function __construct(array $data)
    {
        $this->original = $data;
        $this->data = $data;
    }

    /**
     * Getting Collection Original Data
     */

    /**
     * Get the first value
     */
    public function first()
    {
        return $this->original[0];
    }

    public function last()
    {
        return $this->original[count($this->original) - 1];
    }

    public function find($needle)
    {
        return array_search($needle, $this->original);
    }

    public function fetch()
    {
        return $this->original;
    }

    public function get($key)
    {
        return $this->original[$key];
    }

    public function key()
    {
        return array_keys($this->original);
    }

    /**
     * Collection Manipulation
     */

    /**
     * Map the Original Value of Collection
     */
    public function map($callback)
    {
        $this->data = array_map($callback, $this->original);
        return $this;
    }

    /**
     * Split the Original Value of Collection into smaller array
     */
    public function split($length)
    {
        $this->data = array_chunk($this->original, $length);
        return $this;
    }

    /**
     * Fetch current manipulated data
     */
    public function fetchData()
    {
        return $this->data;
    }

    /**
     * Fetch specific key in current manipulated data
     */
    public function getData($key)
    {
        return $this->data[$key];
    }

    /**
     * Push the value inside the collection
     */
    public function push(string|int $val)
    {
        array_push($this->data, $val);
        return $this;
    }

    /** 
     * Merge the input array into Collection
     */
    public function merge(array $array)
    {
        $this->data = array_merge_recursive($this->data, $array);
        dd($this->data);
        return $this;
    }

    /**
     * Persist the change
     */
    public function save()
    {
        $this->original = $this->data;
    }
}
