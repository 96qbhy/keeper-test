<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Modules\Database\DB;
use App\Supports\Log\Log;

class IndexController extends Controller
{
    public function index()
    {
        Log::info('啦啦啦');

        return DB::table('tests')->get();
    }

}