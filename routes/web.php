<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\indexController;


Route::get('/aoi', [indexController::class, 'aoi']);
