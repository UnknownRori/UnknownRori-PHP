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
        $this->original = array_unique($data);
        $this->data = array_unique($data);
    }

    /**
     * Getting Collection Original Data
     */

    /**
     * Get the first original collection value
     */
    public function first()
    {
        return $this->original[0];
    }

    /**
     * Get the last original collection value
     */
    public function last()
    {
        return $this->original[count($this->original) - 1];
    }

    /**
     * Find value in the collection and return the key
     */
    public function find($needle)
    {
        return array_search($needle, $this->original);
    }

    /**
     * Fetch the Collection Original Data
     */
    public function fetch()
    {
        return $this->original;
    }

    /**
     * Fetch the specific Collection Original Data
     */
    public function get($key)
    {
        return $this->original[$key];
    }

    /**
     * Fetch the key inside the Collection Original Data
     */
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
    public function split(int $length)
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
        return $this;
    }

    public function fill(array $array)
    {
        $data_key = array_keys($this->data);
        $array_keys = array_keys($array);

        for ($i = 0; $i < count($this->data); $i++) {
            for ($j = 0; $j < count($array); $j++) {
                if ($data_key[$i] == $array_keys[$j]) {
                    $this->data[$data_key[$i]] = $array[$array_keys[$j]];
                }
            }
        }

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
