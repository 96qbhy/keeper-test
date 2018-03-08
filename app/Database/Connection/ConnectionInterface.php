<?php
/**
 * User: qbhy
 * Date: 2018/3/7
 * Time: 下午5:05
 */

namespace App\Database\Connection;


interface ConnectionInterface
{
    const STATUS_CONNECTING = 1;
    const STATUS_BUSY = 2;
    const STATUS_IDLE = 3;
    const STATUS_CLOSED = 4;
    
    
    /**
     * @return ConnectionInterface
     */
    public function occupy();
    
    /**
     * @return ConnectionInterface
     */
    public function release();
    
}