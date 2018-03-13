<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/5
 * Time: 下午6:24
 */

namespace App\Supports\Response;

use Dybasedev\Keeper\Http\Response;

trait ResponseAble
{
    /**
     * @return Response
     */
    protected function response($content, int $code = 200, array $headers = []): Response
    {
        return new Response($content, $code, $headers);
    }
    
    /**
     * @param array $content
     * @param int $code
     * @param array $headers
     * @return Response
     */
    public function json(array $content, int $code = 200, array $headers = []): Response
    {
        $content = json_encode($content);
        
        return $this->response($content, $code, $headers)->addHeader('Content-Type', 'application/json');
    }
    
    
}