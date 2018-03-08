<?php
/**
 * User: qbhy
 * Date: 2018/3/8
 * Time: 下午2:54
 */

namespace App\Database;

use Pixie\Connection;
use Pixie\QueryBuilder\QueryBuilderHandler;

/**
 * Class DB
 * @mixin QueryBuilderHandler
 * @package App\Database
 */
class DB extends QueryBuilderHandler
{
    /** @var QueryBuilderHandler */
    protected static $handler = null;
    
    public static function __callStatic($name, $arguments)
    {
        if (method_exists(static::$handler, $name)) {
            return static::$handler->$name(...$arguments);
        }
        
        return null;
    }
}