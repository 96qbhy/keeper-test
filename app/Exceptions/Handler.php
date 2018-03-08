<?php
/**
 * User: qbhy
 * Date: 2018/3/8
 * Time: 下午6:04
 */

namespace App\Exceptions;

use App\Supports\Log\Log;

class Handler
{
    static function handle()
    {
        if ($error = error_get_last()) {
            Log::info('<b>register_shutdown_function: Type:' . $error['type'] . ' Msg: ' . $error['message'] . ' in ' . $error['file'] . ' on line ' . $error['line'] . '</b>');
        }
    }
}