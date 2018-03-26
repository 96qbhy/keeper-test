<?php

namespace App\Http\Controllers;

use App\Database\Connection\ConnectionPool;
use App\Database\DB;
use App\Models\A;
use App\Supports\Log\Log;
use Swoole\Http\Response;
use Swoole\Mysql;

class IndexController extends Controller
{

    public function test(ConnectionPool $pool)
    {
        $pdo = $pool->getIdleConnection()->getPdoInstance();

        $sth = $pdo->prepare('select * from a');

        $sth->execute();

        $a = $sth->fetchObject(A::class);

        return [
            'id' => $a->id,
            'dd' => $a->dd
        ];

    }

    public function index(ConnectionPool $pool)
    {
        return $this->json([
            'data' => $this->db->table('merchants')->count(),
            'connections_count' => count($pool->getConnections()),
            'busy' => $pool->occupyCounts(),
        ]);
    }

    public function ab(ConnectionPool $pool)
    {
        return $this->json([
            'connections_count' => count($pool->getConnections()),
        ]);
    }

    public function qb()
    {
        return 'hello world';
    }
}