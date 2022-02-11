<?php

use Core\Support\Collection;

/**
 * Creating Collection Instance
 * @param   array $data
 * @return  Core\Support\Collection
 */
function collect($data = [])
{
    return new Collection($data);
}
