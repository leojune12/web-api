<?php

namespace Classes\Controllers\Api;

use Classes\Models\Region;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class RegionController extends ApiController
{
    public function index() {
        $request = Request::request();

        $model = new Region();
        
        if (isset($request['limit']) && $request['limit']) {
            $model->limit($request['limit']);
        }

        if (isset($request['order-by']) && $request['order-by']) {
            $model->orderBy($request['order-by']);
        }

        if (isset($request['order-by-column']) && $request['order-by-column']) {
            $model->orderByColumn($request['order-by-column']);
        }

        Response::return(json_encode($model->all()));
    }

    public function show($id) {

    }
}