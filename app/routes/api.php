<?php

use Classes\Controllers\Api\BarangayController;
use Classes\Foundation\Route;
use Classes\Foundation\Request;
use Classes\Controllers\Api\RegionController;
use Classes\Controllers\Api\ProvinceController;
use Classes\Controllers\Api\CityMunicipalityController;

// If no third argument, return 404
$uri = Request::uriSegments();
if (!isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// Define route, controller, and method
Route::get("regions", RegionController::class, "index");

Route::get("provinces", ProvinceController::class, "index");

Route::get("city-municipalities", CityMunicipalityController::class, "index");

Route::get("barangays", BarangayController::class, "index");

// if no route matched, return 404
header("HTTP/1.1 404 Not Found");
exit();
