<?php
/**
 * User: qbhy
 * Date: 2018/3/8
 * Time: 下午2:54
 */

namespace App\Database;

use Pixie\QueryBuilder\QueryBuilderHandler;
use App\Database\Connection\Connection;

/**
 * Class DB
 * @mixin QueryBuilderHandler
 * @package App\Database
 */
class DB
{
    /** @var QueryBuilderHandler */
    protected $handler;
    
    /** @var Connection */
    protected $connection;
    
    /** @var array 需要占用链接的方法 */
    protected $occupyMethods = [
        'get',
    ];
    
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->handler = new QueryBuilderHandler($connection);
    }
    
    public function __call($name, $arguments)
    {
        if (in_array($name, $this->occupyMethods)) {
            $this->connection->occupy();
        }
        $data = call_user_func_array([$this->handler, $name], $arguments);
        $this->connection->release();
        
        return $data;
    }
    
}