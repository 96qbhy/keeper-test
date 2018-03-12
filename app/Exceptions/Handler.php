<?php
/**
 * User: qbhy
 * Date: 2018/3/8
 * Time: 下午6:04
 */

namespace App\Exceptions;


use App\Supports\Response\ResponseAble;
use Dybasedev\Keeper\Http\Interfaces\ExceptionHandler;
use Throwable;

class Handler implements ExceptionHandler
{
    use ResponseAble;
    
    public function handle(Throwable $throwable)
    {
        if (method_exists($throwable, 'render')) {
            $throwable->render($throwable);
        }
        
        return Exception::formatException($throwable);
    }
    
}