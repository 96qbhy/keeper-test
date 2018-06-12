<?php
/**
 * User: qbhy
 * Date: 2018/3/8
 * Time: 下午6:04
 */

namespace App\Exceptions;


use App\Supports\Response\ResponseAble;
use Dybasedev\Keeper\Http\Interfaces\ExceptionHandler;
use Dybasedev\Keeper\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler implements ExceptionHandler
{
    use ResponseAble;

    public function report(Throwable $throwable)
    {
        if (method_exists($throwable, 'report')) {
            $throwable->report($throwable);
        }
    }

    public function handle(Throwable $throwable, Request $request)
    {
        $this->report($throwable);

        if (method_exists($throwable, 'render')) {
            return $throwable->render($throwable);
        }

        $statusCode = 500;

        if ($throwable instanceof HttpException) {
            $statusCode = $throwable->getStatusCode();
        }

        return $this->json(
            Exception::formatException($throwable), $statusCode
        );
    }

}