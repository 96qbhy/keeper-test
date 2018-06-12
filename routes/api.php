<?php
/**
 * User: qbhy
 * Date: 2018/6/12
 * Time: 下午4:05
 */

/** @var \Dybasedev\Keeper\Routing\RouteCollector $router */

use App\Http\Controllers\V1;

$router->get('api', [V1\IndexController::class, 'index']);