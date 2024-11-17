<?php

use Illuminate\Support\Facades\Route;

Route::any('{any}', [\App\Http\Controllers\ClientController::class, 'index'])
    ->where('any', '.*');

