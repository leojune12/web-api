<?php

namespace Classes\Controllers\Api;

use Classes\Models\Barangay;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class BarangayController extends ApiController
{
    public function index() {
        $request = Request::request();

        $model = new Barangay();
        
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
}