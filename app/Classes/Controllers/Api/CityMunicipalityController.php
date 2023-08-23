<?php

namespace Classes\Controllers\Api;

use Classes\Models\CityMunicipality;
use Classes\Foundation\Request;
use Classes\Foundation\Response;
use Classes\Controllers\Api\ApiController;

class CityMunicipalityController extends ApiController
{
    public function index() {
        $request = Request::request();

        $model = new CityMunicipality();
        
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

        if (isset($request['citymunDesc']) && $request['citymunDesc']) {
            $model->orWhere('citymunDesc', "=", $request['citymunDesc']);
        }

        if (isset($request['zipCode']) && $request['zipCode']) {
            $model->orWhere('zipCode', "=", $request['zipCode']);
        }

        Response::return(json_encode($model->get()));
    }
}
