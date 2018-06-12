<?php

namespace App\Http;

use App\Http\Controllers;
use Dybasedev\Keeper\Routing\RouteCollector;
use Dybasedev\Keeper\Routing\RouteRegister as BaseRegister;

class RouteRegister extends BaseRegister
{
    public function register(RouteCollector $router)
    {
        // web 路由
        $router->group([], function (RouteCollector $router) {
            require __DIR__ . '/../../routes/web.php';
        });

        // API 路由
        $router->group([
        ], function (RouteCollector $router) {
            require __DIR__ . '/../../routes/api.php';
        });
    }
}