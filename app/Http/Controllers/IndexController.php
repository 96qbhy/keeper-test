<?php

namespace App\Http\Controllers;

use App\Database\Connection\ConnectionPool;
use App\Database\DB;
use App\Exceptions\Exception;

class IndexController extends Controller
{
    
    public function index(ConnectionPool $pool, DB $DB)
    {
        
        $data = $DB->table('merchants')->where('id', '>', 1)->get();
        
        return $this->json([
            'data' => $data,
            'count' => count($pool->getConnections())
        ]);
        
        
    }
    
    public function ab()
    {
        return $this->json([
        ]);
    }
    
    public function qb(DB $db)
    {
        return $this->json([
            'lal' => '',
        ]);
    }
}