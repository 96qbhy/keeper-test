<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/12
 * Time: 下午3:31
 */

namespace App\Exceptions;

use App\Supports\Response\Response;
use App\Supports\Response\ResponseAble;
use Dybasedev\Keeper\Http\Request;
use Exception as BaseException;
use Throwable;

class Exception extends BaseException
{
    use ResponseAble;
    
    public static function formatException(Throwable $throwable)
    {
        return [
            'message' => $throwable->getMessage(),
            'exception' => get_class($throwable),
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
            'traces' => $throwable->getTrace(),
        ];
    }
    
    public function render(Request $request, Throwable $throwable)
    {
        return $this->json(static::formatException($throwable), $throwable->getCode())->setStatusCode($throwable->getCode());
    }
}