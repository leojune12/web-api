<?php

use Classes\Controllers\Api\BarangayController;
use Classes\Foundation\Route;
use Classes\Foundation\Request;
use Classes\Controllers\Api\RegionController;
use Classes\Controllers\Api\ProvinceController;
use Classes\Controllers\Api\CityMunicipalityController;

$uri = Request::uriSegments();

if (!isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

Route::get("regions", new RegionController, "index");

Route::get("provinces", new ProvinceController, "index");

Route::get("city-municipalities", new CityMunicipalityController, "index");

Route::get("barangays", new BarangayController, "index");

header("HTTP/1.1 404 Not Found");
exit();
