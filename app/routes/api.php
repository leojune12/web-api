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

Route::get("regions", RegionController::class, "index");

Route::get("provinces", ProvinceController::class, "index");

Route::get("city-municipalities", CityMunicipalityController::class, "index");

Route::get("barangays", BarangayController::class, "index");

header("HTTP/1.1 404 Not Found");
exit();
