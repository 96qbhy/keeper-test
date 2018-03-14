<?php

namespace App\Http\Controllers;

use App\Database\DB;
use App\Supports\Response\ResponseAble;
use Dybasedev\Keeper\Http\KeeperBaseController;
use Dybasedev\Keeper\Http\Request;
use Illuminate\Contracts\Container\Container;

class Controller extends KeeperBaseController
{
    use ResponseAble;
    
    /** @var \App\Database\DB */
    protected $db;
    
    public function setRequest(Request $request)
    {
        parent::setRequest($request); // TODO: Change the auto generated stub
        
        $this->db = new DB($this->container, $request);
        
    }
    
    /**
     * @return \App\Database\DB
     */
    public function getDb(): \App\Database\DB
    {
        return $this->db;
    }
    
}