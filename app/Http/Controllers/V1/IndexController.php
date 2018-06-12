<?php

namespace App\Http\Controllers\V1;

use App\Database\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return DB::table('tests')->get();
    }

}