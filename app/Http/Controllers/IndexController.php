<?php

namespace App\Http\Controllers;

use App\Database\DB;
use Dybasedev\Keeper\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request, DB $DB)
    {
        $data = $DB->table('merchants')->where('id', '>', 1)->get();
        
        return $this->json([
            'data' => $data,
            'fd' => $request->getFd(),
        ]);
        
        
    }
    
    public function ab()
    {
        return $this->json([
        ]);
    }
    
    public function qb(DB $db)
    {
        return $this->json([
            'lal' => '',
        ]);
    }
}