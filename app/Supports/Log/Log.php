<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/7
 * Time: 下午12:08
 */

namespace App\Supports\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    protected static $config = [
        'name' => 'keeper',
    ];
    
    /** @var Logger */
    public static $logger = null;
    
    /**
     * @return Logger
     * @throws \Exception
     */
    public static function getLogger(): Logger
    {
        if (!static::$logger) {
            static::initConfig();
            $logger = new Logger(static::$config['name']);
            $logger->pushHandler(
                new StreamHandler(static::$config['path'], Logger::WARNING)
            );
            static::$logger = $logger;
        }
        
        return static::$logger;
    }
    
    public static function initConfig()
    {
        $app_config = require __DIR__ . '/../../../config/app.php';
        static::$config['path'] = $app_config['log']['path'];
    }
    
    /**
     * @param $message
     * @param array $context
     * @return bool
     * @throws \Exception
     */
    public static function info($message, array $context = []): bool
    {
        return static::getLogger()->info($message, $context);
    }
    
    /**
     * @param $message
     * @param array $context
     * @return bool
     * @throws \Exception
     */
    public static function error($message, array $context = []): bool
    {
        return static::getLogger()->error($message, $context);
    }
    
    /**
     * @param $message
     * @param array $context
     * @return bool
     * @throws \Exception
     */
    public static function alert($message, array $context = []): bool
    {
        return static::getLogger()->alert($message, $context);
    }
    
}