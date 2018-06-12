<?php

namespace App\Http\Controllers;

use App\Supports\Response\ResponseAble;
use Dybasedev\Keeper\Http\KeeperBaseController;
use Dybasedev\Keeper\Http\Request;

class Controller extends KeeperBaseController
{
    use ResponseAble;

    public function setRequest(Request $request)
    {
        parent::setRequest($request); // TODO: Change the auto generated stub
    }

}