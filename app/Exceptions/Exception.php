<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/12
 * Time: 下午3:31
 */

namespace App\Exceptions;

use App\Supports\Response\ResponseAble;
use Exception as BaseException;
use Throwable;

class Exception extends BaseException
{
    use ResponseAble;

    public static function formatException(Throwable $throwable)
    {
        return [
            'message'   => $throwable->getMessage(),
            'exception' => get_class($throwable),
            'file'      => $throwable->getFile(),
            'line'      => $throwable->getLine(),
            'traces'    => $throwable->getTrace(),
        ];
    }

    /**
     * @param \Throwable $throwable
     *
     * @return \Dybasedev\Keeper\Http\Response
     */
    public function render(Throwable $throwable)
    {
        return $this->json(
            static::formatException($throwable)
        )->setStatusCode(500);
    }

    /**
     * @param \Throwable $throwable
     *
     * @return bool
     */
    public function report(Throwable $throwable): bool
    {
        return false;
    }
}