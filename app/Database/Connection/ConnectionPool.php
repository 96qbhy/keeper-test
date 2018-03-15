<?php
/**
 * User: qbhy
 * Date: 2018/3/6
 * Time: 下午5:18
 */

namespace App\Database\Connection;

use App\Supports\Log\Log;

class ConnectionPool
{
    /* @var int 链接池大小 */
    public $size;
    
    /** @var array 链接配置 */
    protected $connectionConfig;
    
    /** @var Connection[] */
    protected $connections = [];
    
    /**
     * @var \App\Database\Connection\Connection[]
     */
    protected static $fd_connections = [];
    
    /**
     * ConnectionPool constructor.
     *
     * @param array $config
     * @param int   $size
     */
    public function __construct($config, $size = 100)
    {
        $this->connectionConfig = $config;
        $this->size = $size;
    }
    
    /**
     * @param array $connectionConfig
     *
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
     * @param int $num
     *
     * @return Connection
     */
    public function getIdleConnection(int $num = 3): Connection
    {
        
        foreach ($this->connections as $connection) {
            if ($connection->status === Connection::STATUS_IDLE) {
                return $connection->occupy();
            }
        }
        
        if (count($this->connections) < $this->size) {
            $connection = $this->createConnection();
        } else if ($num) {
            $connection = $this->getIdleConnection(--$num);
        } else {
            $connection = $this->createConnection();
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
        Log::info('createConnection', [
            count($this->getConnections())
        ]);
        $connection = new Connection($this->connectionConfig['driver'], $this->connectionConfig);
        $this->connections[] = $connection;
        
        return $connection;
    }
    
    public function closeConnection(Connection $connection)
    {
        $connection->close();
        
        $connections = [];
        foreach ($this->connections as $conn) {
            if ($conn === $connection) {
                continue;
            }
            $connections[] = $conn;
        }
        $this->connections = $connections;
        
        return $this;
    }
    
    public static function setFdConnection(int $fd, Connection $connection)
    {
        static::$fd_connections[$fd] = $connection;
    }
    
    public static function releaseConnection(int $fd)
    {
        if (!empty(static::$fd_connections[$fd])) {
            static::$fd_connections[$fd]->release();
            unset(static::$fd_connections[$fd]);
        }
    }
    
    public function occupyCounts()
    {
        $count = 0;
        
        foreach ($this->connections as $connection) {
            $connection->status !== Connection::STATUS_BUSY ? $count++ : null;
        }
        
        return $count;
    }
}