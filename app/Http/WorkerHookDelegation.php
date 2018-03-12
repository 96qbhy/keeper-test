<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/12
 * Time: 下午5:24
 */

namespace App\Http;

use Closure;
use Dybasedev\Keeper\Http\Interfaces\WorkerHookDelegation as WorkerHookDelegationInterface;

class WorkerHookDelegation implements WorkerHookDelegationInterface
{
    public function processBegin(Closure $callback)
    {
        // TODO: Implement processBegin() method.
    }
    
    public function processEnd(Closure $callback)
    {
        // TODO: Implement processEnd() method.
    }
    
}