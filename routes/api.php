<?php

use App\Http\Controllers\Api\V1\RealEstateController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// This single line creates all 5 API endpoints for you.
Route::apiResource('v1/real-estates', RealEstateController::class);