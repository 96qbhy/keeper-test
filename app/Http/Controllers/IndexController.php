<?php

namespace App\Http\Controllers;

use Dybasedev\Keeper\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return $this->response([
            '啦啦' => '11',
        ]);
    }
}