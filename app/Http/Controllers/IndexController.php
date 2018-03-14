<?php

namespace App\Http\Controllers;

use App\Database\Connection\ConnectionPool;
use App\Database\DB;

class IndexController extends Controller
{
    public function index(ConnectionPool $pool)
    {
        return $this->json([
            'data' => $this->db->table('merchants')->count(),
            'connections_count' => count($pool->getConnections())
        ]);
    }
    
    public function ab()
    {
        return $this->json([]);
    }
    
    public function qb()
    {
        return $this->json([
        ]);
    }
}