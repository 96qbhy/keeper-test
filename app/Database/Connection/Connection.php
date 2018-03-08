<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/6
 * Time: 下午5:17
 */

namespace App\Database\Connection;

use Pixie\Connection as BaseConnection;

class Connection extends BaseConnection implements ConnectionInterface
{
    /**
     * @var int
     */
    public $status;
    
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
    
}