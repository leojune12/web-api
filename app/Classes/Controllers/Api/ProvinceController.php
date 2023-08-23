<?php

namespace Classes\Controllers\Api;

use Classes\Models\Province;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class ProvinceController extends ApiController
{
    /**
     * Returns a list of requested data
     * 
     * @return array
    */
    public function index() {
        $request = Request::request();

        $model = new Province();
        
        // Additional query
        if (isset($request['id']) && $request['id']) {
            $model->where('id', "=", $request['id']);
        }

        if (isset($request['psgcCode']) && $request['psgcCode']) {
            $model->where('psgcCode', "=", $request['psgcCode']);
        }

        if (isset($request['regCode']) && $request['regCode']) {
            $model->where('regCode', "=", $request['regCode']);
        }

        if (isset($request['provCode']) && $request['provCode']) {
            $model->where('provCode', "=", $request['provCode']);
        }

        if (isset($request['provDesc']) && $request['provDesc']) {
            $model->where('provDesc', "=", $request['provDesc']);
        }

        Response::return(json_encode($model->get()));
    }
}