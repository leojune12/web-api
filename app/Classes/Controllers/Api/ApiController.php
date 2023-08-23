<?php

namespace Classes\Controllers\Api;

class ApiController
{
    /** 
    * __call magic method.
    * Called if no method name matches
    */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
}