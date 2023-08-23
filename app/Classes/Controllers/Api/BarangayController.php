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

        if (isset($request['citymunCode']) && $request['citymunCode']) {
            $model->where('citymunCode', "=", $request['citymunCode']);
        }

        if (isset($request['brgyCode']) && $request['brgyCode']) {
            $model->where('brgyCode', "=", $request['brgyCode']);
        }

        if (isset($request['brgyDesc']) && $request['brgyDesc']) {
            $model->where('brgyDesc', "=", $request['brgyDesc']);
        }

        if (isset($request['zipCode']) && $request['zipCode']) {
            $model->where('zipCode', "=", $request['zipCode']);
        }

        Response::return(json_encode($model->get()));
    }
}