<?php
/**
 * User: qbhy
 * Date: 2018/3/8
 * Time: 下午2:54
 */

namespace App\Database;

use App\Database\Connection\ConnectionPool;
use Pixie\QueryBuilder\QueryBuilderHandler;
use App\Database\Connection\Connection;
use \Illuminate\Contracts\Container\Container;
use \Dybasedev\Keeper\Http\Request;

/**
 * Class DB
 *
 * @mixin QueryBuilderHandler
 * @package App\Database
 */
class DB
{
    /** @var QueryBuilderHandler */
    protected $handler = null;
    
    /** @var Request */
    protected $request;
    
    /** @var Container */
    protected $container;
    
    /** @var Connection */
    protected $connection;
    
    public function __construct(Container $container, Request $request)
    {
        $this->container = $container;
        $this->request = $request;
    }
    
    public function __call($name, $arguments)
    {
        if (is_null($this->handler)) {
            /** @var ConnectionPool $pool */
            $pool = $this->container->make(ConnectionPool::class);
            $this->connection = $pool->getIdleConnection();
            $this->handler = new QueryBuilderHandler($this->connection);
            ConnectionPool::setFdConnection($this->request->getFd(), $this->connection);
        }
        
        $data = call_user_func_array([$this->handler, $name], $arguments);
        
        return $data;
    }
    
}