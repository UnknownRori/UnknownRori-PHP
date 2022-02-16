<?php

namespace App\Http\Middleware;

class TimeExecutionMonitor
{
    protected static $timeExecution;

    public function Run()
    {
        if (is_null(self::$timeExecution)) {
            self::$timeExecution = microtime(true);
        } else {
            $timeExecution = round((microtime(true) - self::$timeExecution) * 1000);

            echo "
            <div style='background: #ff3737;'>
                <p style='text-align: center; color: white;'>Execution Time {$timeExecution} ms</p>
            </div>
            ";
        }
    }
}
