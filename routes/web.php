<?php

use App\Http\Controllers\TheoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/theory', function () {
//     return view('theory.index');
// });

Route::get('/theory', [TheoryController::class, 'index']);