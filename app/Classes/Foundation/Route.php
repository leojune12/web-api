<?php

namespace Classes\Foundation;

use Error;
use Classes\Foundation\Request;
use Classes\Foundation\Response;

class Route
{
    public static function get($uri_for, $controllerName, $method) {
        $uri_for_array = explode('/', $uri_for);
        $uri = Request::uriSegments();
        
        if ($uri[2] == $uri_for_array[0]) {
            if (Request::requestMethod() == 'GET') {
                try {
                    $controller = new $controllerName;
                    $controller->$method();
                } catch (Error $e) {
                    Response::return(
                        json_encode([
                            'error' => $e->getMessage()
                        ]), 
                        [
                            'Content-Type: application/json',
                            'HTTP/1.1 500 Internal Server Error'
                        ]
                    );
                }
            } else {
                Response::return(
                    json_encode([
                        'error' => 'Method not supported'
                    ]), 
                    [
                        'Content-Type: application/json',
                        'HTTP/1.1 422 Unprocessable Entity'
                    ]
                );
            }
        }
    }
}
