<?php

namespace App\Http;

use App\Http\Controllers;
use Dybasedev\Keeper\Routing\RouteCollector;
use Dybasedev\Keeper\Routing\RouteRegister as BaseRegister;

class RouteRegister extends BaseRegister
{
    public function register(RouteCollector $collector)
    {
        $collector->get('/test', [Controllers\IndexController::class, 'test']);
        $collector->get('/', [Controllers\IndexController::class, 'index']);
        $collector->get('ab', [Controllers\IndexController::class, 'ab']);
        $collector->get('qb', [Controllers\IndexController::class, 'qb']);
    }
}