<?php
/**
 * User: qbhy
 * Date: 2018/3/15
 * Time: 下午4:15
 */

namespace App\Database\Model;


interface ModelInterface
{
    public static function find($id, $filed = 'id');
    
}