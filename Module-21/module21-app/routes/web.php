<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextController;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/test-array', [TextController::class, 'textGet']);
//Route::post('/test-array', [TextController::class, 'textPost']);
//Route::get('/show-array', [TextController::class, 'showText'])->name('show-array');

Route::get('/', [\App\Http\Controllers\FileStorage::class, 'view']);
