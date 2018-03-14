<?php
/**
 * User: qbhy
 * Date: 2018/3/14
 * Time: 下午3:21
 */

namespace App\Http\Middleware;

use App\Supports\Response\ResponseAble;
use Closure;
use Dybasedev\Keeper\Routing\Middleware as BaseMiddleware;

class Middleware extends BaseMiddleware
{
    use ResponseAble;
    
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
    
}