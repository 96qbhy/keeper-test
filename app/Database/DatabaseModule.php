<?php
/**
 * User: qbhy
 * Date: 2018/3/7
 * Time: 上午11:11
 */

namespace App\Database;

use App\Database\Connection\ConnectionPool;
use Dybasedev\Keeper\Http\Interfaces\WorkerHookDelegation;
use Dybasedev\Keeper\Http\Request;
use Dybasedev\Keeper\Module\Interfaces\ModuleProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;

class DatabaseModule implements ModuleProvider
{
    
    public function register(Container $container)
    {
        $config = $container->make(Repository::class)->get('database');
        
        $container->singleton(ConnectionPool::class, function (Container $container) use ($config) {
            ($pool = new ConnectionPool($config['connections'][$config['default']], $config['max_connections_count']));
            
            return $pool;
        });
        
    }
    
    public function mount(Container $container)
    {
        $this->hookDelegationHandle($container);
        
    }
    
    public function hookDelegationHandle(Container $container)
    {
        /** @var WorkerHookDelegation $delegation */
        $delegation = $container->make(WorkerHookDelegation::class);
        
        $delegation->processBegin(function (Request $request) {
        
        });
        
        $delegation->processBegin(function (Request $request) {
            ConnectionPool::releaseConnection($request->getFd());
        });
        
    }
}