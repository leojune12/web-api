<?php

use Classes\Foundation\Route;
use Classes\Foundation\Request;
use Classes\Controllers\Api\RegionController;
use Classes\Controllers\Api\ProvinceController;

$uri = Request::uriSegments();

if (!isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

Route::get("regions", new RegionController, "index");

Route::get("provinces", new ProvinceController, "index");

header("HTTP/1.1 404 Not Found");
exit();
