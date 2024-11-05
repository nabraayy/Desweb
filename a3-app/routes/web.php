<?php

use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;

Route::get('/',NoticiaController:('index'));
Route:: get('/search')
