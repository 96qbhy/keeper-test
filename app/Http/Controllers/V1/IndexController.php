<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Modules\Database\DB;

class IndexController extends Controller
{
    public function index()
    {
        return DB::table('tests')->get();
    }

}