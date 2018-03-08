<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/7
 * Time: 上午11:11
 */

namespace App\Database;

use App\Database\Connection\ConnectionPool;
use App\Supports\Log\Log;
use Dybasedev\Keeper\Module\Interfaces\ModuleProvider;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\Container;

class DatabaseModule implements ModuleProvider
{
    /** @var ConnectionPool */
    public static $pool = null;
    
    /**
     * @return mixed
     */
    public static function getPool(): ConnectionPool
    {
        if (!static::$pool) {
            $config = require __DIR__ . '/../../config/database.php';
            static::$pool = new ConnectionPool($config['connections'][$config['default']]);
            static::$pool->createConnection();
        }
        
        return static::$pool;
    }
    
    public function register(Container $container)
    {
        $config = $container->make(Repository::class)->get('database');
        
        $container->singleton(ConnectionPool::class, function (Container $container) use ($config) {
            return (new ConnectionPool($config['connections'][$config['default']], $config['max_connections__count']))
                ->createConnection();
        });
        
    }
    
    public function mount(Container $container)
    {
        $container->bind(DB::class, function (Container $container) {
            /** @var ConnectionPool $pool */
            $pool = $container->make(ConnectionPool::class);
            return (new DB($pool->fetchIdleConnection()));
        });
    }
}