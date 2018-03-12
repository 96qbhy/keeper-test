<?php
/**
 * Created by PhpStorm.
 * User: xiejianlai
 * Date: 2018/3/5
 * Time: 下午6:24
 */

namespace App\Supports\Response;

use Dybasedev\Keeper\Http\Response as BaseResponse;

class Response extends BaseResponse
{
    public function addHeader(string $key, string $value): Response
    {
        $this->headers->set($key, $value);
        
        return $this;
    }
    
    public function addHeaders(array $headers = []): Response
    {
        foreach ($headers as $key => $header) {
            $this->headers->set($key, $header);
        }
        
        return $this;
    }
    
}