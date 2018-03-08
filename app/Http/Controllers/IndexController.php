<?php

namespace App\Http\Controllers;

use App\Database\Connections\ConnectionPool;
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
    
    public function index()
    {
        try {
            
            $pool = DatabaseModule::getPool();
            
            $connection = $pool->fetchIdleConnection();
            
            $data = $connection->fetchAll('select * from merchants');
            
            return $this->response([
                'pool_connections_count' => count($pool->getConnections()),
                'data' => $data,
                'max_connections_count' => $pool->max_size,
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
    public function ab()
    {
        return $this->response([
            'logger' => Log::info('aaa', [
                '啦啦'
            ]),
            'd' => Log::error('aaa', [
                '啦啦'
            ]),
            'a' => Log::debug('aaa', [
                '啦啦'
            ]),
            'q' => Log::alert('a'),
        ]);
    }
    
    public function qb(DB $db)
    {
        return $this->response([
            'lalal' => '',
        ]);
    }
}