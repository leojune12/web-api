<?php

namespace Classes\Controllers\Api;

use Classes\Models\Province;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class ProvinceController extends ApiController
{
    public function index() {
        $request = Request::request();

        $model = new Province();
        
        if (isset($request['id']) && $request['id']) {
            $model->orWhere('id', "=", $request['id']);
        }

        if (isset($request['psgcCode']) && $request['psgcCode']) {
            $model->orWhere('psgcCode', "=", $request['psgcCode']);
        }

        if (isset($request['regCode']) && $request['regCode']) {
            $model->orWhere('regCode', "=", $request['regCode']);
        }

        if (isset($request['provCode']) && $request['provCode']) {
            $model->orWhere('provCode', "=", $request['provCode']);
        }

        if (isset($request['provDesc']) && $request['provDesc']) {
            $model->orWhere('provDesc', "=", $request['provDesc']);
        }

        Response::return(json_encode($model->get()));
    }
}