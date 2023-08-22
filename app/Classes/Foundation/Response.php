<?php

namespace Classes\Foundation;

class Response
{
    public static function return($data, $httpHeaders = [
        'Content-Type: application/json',
        'HTTP/1.1 200 OK', 'Access-Control-Allow-Origin: *'
    ])
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
}