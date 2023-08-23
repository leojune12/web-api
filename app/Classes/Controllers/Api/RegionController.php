<?php

namespace Classes\Controllers\Api;

use Classes\Models\Region;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class RegionController extends ApiController
{
    /**
     * Returns a list of requested data
     * 
     * @return array
    */
    public function index() {
        $request = Request::request();

        $model = new Region();
        
        // Additional query
        if (isset($request['id']) && $request['id']) {
            $model->orWhere('id', "=", $request['id']);
        }

        if (isset($request['psgcCode']) && $request['psgcCode']) {
            $model->orWhere('psgcCode', "=", $request['psgcCode']);
        }

        if (isset($request['regCode']) && $request['regCode']) {
            $model->orWhere('regCode', "=", $request['regCode']);
        }

        if (isset($request['regDesc']) && $request['regDesc']) {
            $model->orWhere('regDesc', "=", $request['regDesc']);
        }

        Response::return(json_encode($model->get()));
    }
}