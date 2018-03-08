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

/**
 * Class Log
 *
 * @method static null|bool info(string $message, array $arguments = [])
 * @method static null|bool debug(string $message, array $arguments = [])
 * @method static null|bool warning(string $message, array $arguments = [])
 * @method static null|bool error(string $message, array $arguments = [])
 * @method static null|bool err(string $message, array $arguments = [])
 * @method static null|bool warn(string $message, array $arguments = [])
 * @method static null|bool alert(string $message, array $arguments = [])
 * @mixin Logger
 * @package App\Supports\Log
 */
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
                new StreamHandler(static::$config['path'])
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
     * @param $name
     * @param $arguments
     * @return null|bool
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $logger = static::getLogger();
        
        if (method_exists($logger, $name)) {
            return $logger->$name(...$arguments);
        }
        
        return null;
    }
    
    
}