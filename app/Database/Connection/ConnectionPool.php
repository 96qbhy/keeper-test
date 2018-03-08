<?php
/**
 * User: xiejianlai
 * Date: 2018/3/6
 * Time: 下午5:18
 */

namespace App\Database\Connection;

class ConnectionPool
{
    /* @var int 链接池大小 */
    public $size;
    
    /** @var array 链接配置 */
    protected $connectionConfig;
    
    /** @var Connection[] */
    protected $connections = [];
    
    /**
     * ConnectionPool constructor.
     * @param array $config
     * @param int $size
     */
    public function __construct(array $config, $size = 10)
    {
        $this->connectionConfig = $config;
        $this->size = $size;
    }
    
    /**
     * @param array $connectionConfig
     * @return $this
     */
    public function setConnectionConfig(array $connectionConfig): ConnectionPool
    {
        $this->connectionConfig = $connectionConfig;
        
        return $this;
    }
    
    /**
     * 获取所有链接，临时
     *
     * @return Connection[]
     */
    public function getConnections(): array
    {
        return $this->connections;
    }
    
    /**
     * 获取当前空闲的连接
     *
     * @return Connection
     */
    public function fetchIdleConnection(): Connection
    {
        
        foreach ($this->connections as $connection) {
            if ($connection->status === Connection::STATUS_IDLE) {
                return $connection->occupy();
            }
        }
        
        if (count($this->connections) < $this->size) {
            $connection = $this->createConnection();
        } else {
            $connection = $this->fetchIdleConnection();
        }
        
        return $connection->occupy();
    }
    
    /**
     * 建立一个新的数据库连接
     *
     * @return Connection
     */
    public function createConnection(): Connection
    {
        $connection = new Connection($this->connectionConfig['driver'], $this->connectionConfig);
        $this->connections[] = $connection;
        
        return $connection;
    }
    
    
}