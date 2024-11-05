<?php

use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;

Route::resource('/series',SerieController::class);
