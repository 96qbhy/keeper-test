<?php

use App\Supports\Log\Log;

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        return __DIR__ . '/../..' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('config')) {
    /**
     * @param string $name
     * @return array|mixed
     */
    function config(string $name)
    {
        $keys = explode('.', $name);
        $file = $keys[0];
        
        $file_path = base_path("config/$file.php");
        if (!is_file($file_path)) {
            return null;
        }
        
        $config = require $file_path;
        
        unset($keys[0]);
        
        foreach ($keys as $key) {
            if (!isset($config[$key])) {
                return null;
            }
            $config = $config[$key];
        }
        
        return $config;
    }
}

if (!function_exists('stop')) {
    function stop($pid_file)
    {
        if (is_file($pid_file)) {
            posix_kill(file_get_contents($pid_file), SIGTERM);  // 启动服务器
            unlink($pid_file);
        }
    }
}

if (!function_exists('keeper_error_handler')) {
    function keeper_error_handler($type, $message, $file, $line)
    {
        Log::info('出现异常', compact('type', 'message', 'file', 'line'));
    }
}

if (!function_exists('_log')) {
    /**
     * @return \Monolog\Logger
     * @throws Exception
     */
    function _log()
    {
        return Log::getLogger();
    }
}