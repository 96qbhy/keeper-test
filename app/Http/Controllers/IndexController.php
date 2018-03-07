<?php

namespace App\Http\Controllers;

use App\Database\Connections\ConnectionPool;
use App\Database\Pool;

class IndexController extends Controller
{
    public function formatException(\Exception $exception)
    {
        return $this->response([
            'traces' => $exception->getTrace(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
        ]);
    }
    
    public function index()
    {
        try {
            $pool = Pool::getPool();
            
            $connection = $pool->fetchIdleConnection();
            
            $data = $connection->fetchAll('select * from merchants');
            
            return $this->response([
                'pool_connections_count' => count($pool->getConnections()),
                'data' => $data,
                'max_connections_count'=>$pool->max_size
            ]);
            
            
        } catch (\RuntimeException $exception) {
            return $this->formatException($exception);
        } catch (\Exception $exception) {
            return $this->formatException($exception);
        }
    }
}