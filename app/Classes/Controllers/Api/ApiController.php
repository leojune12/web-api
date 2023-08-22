<?php

namespace Classes\Controllers\Api;

class ApiController
{
    /** 
    * __call magic method. 
    */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
}