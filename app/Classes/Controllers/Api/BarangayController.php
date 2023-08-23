<?php

namespace Classes\Controllers\Api;

use Classes\Models\Barangay;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class BarangayController extends ApiController
{
    /**
     * Returns a list of requested data
     * 
     * @return array
    */
    public function index() {
        $request = Request::request();

        $model = new Barangay();
        
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

        if (isset($request['provCode']) && $request['provCode']) {
            $model->orWhere('provCode', "=", $request['provCode']);
        }

        if (isset($request['citymunCode']) && $request['citymunCode']) {
            $model->orWhere('citymunCode', "=", $request['citymunCode']);
        }

        if (isset($request['brgyCode']) && $request['brgyCode']) {
            $model->orWhere('brgyCode', "=", $request['brgyCode']);
        }

        if (isset($request['brgyDesc']) && $request['brgyDesc']) {
            $model->orWhere('brgyDesc', "=", $request['brgyDesc']);
        }

        if (isset($request['zipCode']) && $request['zipCode']) {
            $model->orWhere('zipCode', "=", $request['zipCode']);
        }

        Response::return(json_encode($model->get()));
    }
}