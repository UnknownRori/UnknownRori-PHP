<?php

/**
 * Your typical Die and Dump in Laravel, but different
 */
function dd(...$arguments)
{
    echo "<style>
        pre.dump {
            background-color: #18171B;
            color: white;
            line-height: 1.2em;
            font: 12px Menlo, Monaco, Consolas, monospace;
            word-wrap: break-word;
            white-space: pre-wrap;
            position: relative;
            z-index: 99999;
            word-break: break-all;
        }
        pre.dump:after {
            content: '';
            visibility: hidden;
            display: block;
            height: 0;
            clear: both;
        }
    </style>";
    echo '<pre class="dump">';
    var_dump(...$arguments);
    echo '</pre>';
    die;
}

/**
 * Gets the value of an environment variable.
 * @param string $key
 * @param mixed $default
 * 
 * @return mixed  
 */
function env($key, $default = null)
{
    if (isset($_ENV[$key])) {
        return $_ENV[$key];
    }

    return $default;
}