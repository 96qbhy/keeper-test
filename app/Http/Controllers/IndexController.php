<?php

namespace App\Http\Controllers;

use App\Database\Connection\ConnectionPool;
use App\Database\DatabaseModule;
use App\Database\DB;
use App\Supports\Log\Log;
use Pixie\Connection;

class IndexController extends Controller
{
    public function formatException(\Exception $exception)
    {
        return $this->response([
            'traces' => $exception->getTrace(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'exception' => get_class($exception)
        ]);
    }
    
    public function index(ConnectionPool $pool, DB $DB)
    {
        try {
            
            $data = $DB->query('select * from merchants')->get();
            
            return $this->response([
                'data' => $data,
                'count' => count($pool->getConnections())
            ]);
            
            
        } catch (\LogicException $exception) {
            return $this->formatException($exception);
        } catch (\RuntimeException $exception) {
            return $this->formatException($exception);
        } catch (\Exception $exception) {
            return $this->formatException($exception);
        }
    }
    
    /**
     * @return \App\Http\Response
     * @throws \Exception
     */
    public function ab(ConnectionPool $pool)
    {
        return $this->response([
            $pool
        ]);
    }
    
    public function qb(DB $db)
    {
        return $this->response([
            'lalal' => '',
        ]);
    }
}