<?php

use Classes\Foundation\Route;
use Classes\Controllers\Api\RegionController;
use Classes\Foundation\Request;

$uri = Request::uriSegments();

if (!isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

Route::get("regions", new RegionController, "index");

header("HTTP/1.1 404 Not Found");
exit();
