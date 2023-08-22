<?php

namespace Classes\Foundation;

class Request
{
    /** 
    * Get URI elements. 
    * 
    * @return array 
    */
    public static function uriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }

    /** 
    * Get querystring params. 
    * 
    * @return array 
    */
    public static function request() {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    /** 
    * Get request method. 
    * 
    * @return string 
    */
    public static function requestMethod() {
        return strtoupper($_SERVER["REQUEST_METHOD"]);
    }
}