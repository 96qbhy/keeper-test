<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/7
 * Time: 上午11:11
 */

namespace App\Database;

use App\Database\Connections\ConnectionPool;

class Pool
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
        }
        
        return self::$pool;
    }
}