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
    
    public function register(Container $container)
    {
//        $config = $container->make(Repository::class)->get('database');
        $config = require __DIR__ . '/../../config/database.php';
        
        $container->singleton(ConnectionPool::class, function (Container $container) use ($config) {
            ($pool = new ConnectionPool($config['connections'][$config['default']], $config['max_connections_count']))
                ->createConnection();
            
            return $pool;
        });
        
        $container->bind(DB::class, function (Container $container) {
            /** @var ConnectionPool $pool */
            $pool = $container->make(ConnectionPool::class);
            return (new DB($pool->fetchIdleConnection()));
        });
    }
    
    public function mount(Container $container)
    {
    
    }
}