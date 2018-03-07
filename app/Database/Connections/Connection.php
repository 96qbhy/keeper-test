<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/6
 * Time: 下午5:17
 */

namespace App\Database\Connections;

use PDO;
use PDOStatement;

class Connection implements ConnectionInterface
{
    /**
     * @var int
     */
    public $status;
    
    private $dsn;
    private $user;
    private $charset;
    private $password;
    /** @var PDO */
    private $connection;
    
    protected $lastSQL;
    
    public function __construct(array $config)
    {
        $this->dsn = "mysql:dbname=$config[database];host=$config[host]";
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->charset = $config['charset'];
        $this->connect();
    }
    
    /**
     * 占用这个链接
     *
     * @return $this
     */
    public function occupy(): Connection
    {
        $this->status = $this::STATUS_BUSY;
        
        return $this;
    }
    
    
    /**
     * 释放这个链接
     *
     * @return $this
     */
    public function release(): Connection
    {
        $this->status = $this::STATUS_IDLE;
        
        return $this;
    }
    
    /**
     * 连接数据库
     */
    public function connect(): void
    {
        if (!$this->connection) {
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $this->charset,
            ];
            $this->connection = new PDO($this->dsn, $this->user, $this->password, $options);
            $this->status = $this::STATUS_IDLE;
        }
    }
    
    /**
     * 执行一条查询
     *
     * @param $sql
     * @param array $parameters
     * @return PDOStatement
     */
    public function query($sql, array $parameters = []): PDOStatement
    {
        $this->occupy()->lastSQL = $sql;
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);
        
        return $statement;
    }
    
    /**
     * 获取一条数据
     *
     * @param $sql
     * @param array $parameters
     * @return array
     */
    public function fetch($sql, array $parameters = []): array
    {
        $statement = $this->query($sql, $parameters);
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $this->release();
        
        return $data;
    }
    
    /**
     * 获取所有数据
     *
     * @param $sql
     * @param array $parameters
     * @return array
     */
    public function fetchAll($sql, array $parameters = []): array
    {
        $statement = $this->query($sql, $parameters);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->release();
        
        return $data;
    }
    
}