<?php

namespace Core\Support;

use Core\Database\DB;
use Core\Support\Http\Request;

class Collection implements ICollection
{
    protected $table;
    protected $original;
    public $data;
    public $pagination;

    /**
     * Initialize Collection Instance
     */
    public function __construct($data)
    {
        $this->original = $data;
        $this->data = $data;
    }

    /**
     * Getting Collection Original Data
     */

    /**
     * Get the first original collection value
     * @return mixed
     */
    public function first()
    {
        return $this->original[0];
    }

    /**
     * Get the last original collection value
     * @return mixed
     */
    public function last()
    {
        return $this->original[count($this->original) - 1];
    }

    /**
     * Find value in the collection and return the key
     * @return int|string|false
     */
    public function find($needle)
    {
        return array_search($needle, $this->original);
    }

    /**
     * Fetch the Collection Original Data
     * @param  string|array $key
     * @return mixed
     */
    public function get($key = null)
    {
        if (!is_null($key)) {
            if (is_array($key)) {
                return array_map(function ($key) {
                    return $this->original[$key];
                }, $key);
            } else {
                return $this->original[$key];
            }
        };

        return $this->original;
    }

    /**
     * Fetch the key inside the Collection Original Data
     * @return array
     */
    public function key()
    {
        return array_keys($this->original);
    }

    /**
     * Check if original collection is null or not
     * @return boolean
     */
    public function is_null()
    {
        return is_null($this->data);
    }

    /**
     * Collection Manipulation
     */

    /**
     * Map the Data Value of Collection
     * @param  callable @callback
     * @return array
     */
    public function map($callback)
    {
        $this->data = array_map($callback, $this->data);
        return $this;
    }

    /**
     * Split the Data Value of Collection into smaller array
     * @param  int $length
     * @return array
     */
    public function split(int $length)
    {
        $this->data = array_chunk($this->data, $length);
        return $this;
    }

    /**
     * Remove specific key in the collection
     * @param  array $key
     * @return this
     */
    public function remove(array $key)
    {
        for ($j = 0; $j < count($key); $j++) {
            if (array_key_exists($key[$j], $this->data)) {
                unset($this->data[$key[$j]]);
            }
        }
        return $this;
    }

    /**
     * Fetch current manipulated data
     * @param  string|array $key
     * @return mixed
     */
    public function getData(array|string $key = null)
    {
        if (!is_null($key)) {
            if (is_array($key)) {
                return array_map(function ($key) {
                    return $this->data[$key];
                }, $key);
            } else {
                return $this->data[$key];
            }
        };

        return $this->data;
    }

    /**
     * Push the value inside the collection
     * @param  string|int $val
     * @return this
     */
    public function push(string|int $val)
    {
        array_push($this->data, $val);
        return $this;
    }

    /**
     * Pop the current collection data
     * @return  this
     */
    public function pop()
    {
        array_pop($this->data);
        return $this;
    }

    /** 
     * Merge the input array into Collection
     * @param  array $array
     * @return this
     */
    public function merge(array $array)
    {
        $this->data = array_merge_recursive($this->data, $array);
        return $this;
    }

    /**
     * Fill the collection key
     * @param  array $array
     * @return this
     */
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
     * Destroy collection
     * @param Core\Support\Collection $collection
     * @return void
     */
    public static function destroy($collection)
    {
        unset($collection);
    }

    /**
     * Filter original data collection
     * @param  callable $callback
     * @param  int      $mode
     * @return this
     */
    public function filter($callback, $mode = ARRAY_FILTER_USE_KEY)
    {
        $this->data = array_filter($this->data, $callback, $mode);
        return $this;
    }

    /**
     * Persist the change
     * if the collection has table object property it will try to persist on database
     * @return boolean|void
     */
    public function save()
    {
        $this->original = $this->data;
        if (!is_null($this->table)) {
            $this->filter(function ($key) {
                if (is_int($key)) {
                    return false;
                }
                return true;
            });

            return DB::table($this->table)->update($this->data);
        }
    }

    /**
     * Replace all the data property in collection using original property
     * @return  this
     */
    public function revert()
    {
        $this->data = $this->original;
        return $this;
    }

    /**
     * Integrate Collection into Database Collection
     * @param  string $table
     * @return this
     */
    public function set_table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Database Pagination
     */

    /**
     * Setting up pagination object property per page item inside collection
     * @param  int $perPage
     * @return this
     */
    public function set_perPage(int $perPage)
    {
        $this->pagination['per-page'] = $perPage;
        return $this;
    }

    /**
     * Setting up pagination object property total item inside collection
     * @param  int $total
     * @return $this
     */
    public function set_total(int $total)
    {
        $this->pagination['total'] = $total;
        return $this;
    }

    /**
     * Next Page
     * @return string|void
     */
    public function nextPageUrl()
    {
        if ($this->pagination['total'] > ($this->pagination['per-page'] * Request::Get()['page'])) {
            return Request::URI() . '?page=' . Request::Get()['page'] + 1;
        } else {
            return;
        }
    }

    /**
     * Previous Page
     * @return string|void
     */
    public function previousPageUrl()
    {
        if ($this->pagination['total'] < ($this->pagination['per-page'] * Request::Get()['page'])) {
            return Request::URI() . '?page=' . Request::Get()['page'] - 1;
        } else {
            return;
        }
    }
}
