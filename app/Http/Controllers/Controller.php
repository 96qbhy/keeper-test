<?php

namespace App\Http\Controllers;

use App\Http\Response;
use Dybasedev\Keeper\Http\KeeperBaseController;

class Controller extends KeeperBaseController
{
    /**
     * @return Response
     */
    protected function response($content, int $code = 200, array $headers = []): Response
    {
        if (is_array($content)) {
            $content = json_encode($content);
            $response = (new Response($content, $code, $headers))->addHeader('Content-Type', 'application/json');
        } else {
            $response = new Response($content, $code, $headers);
        }
        
        return $response;
    }
    
}