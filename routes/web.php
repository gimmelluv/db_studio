<?php

use App\Http\Controllers\TheoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/theory', [TheoryController::class, 'index']);

Route::get('/laboratory', function () {
    return view('laboratory.index');
});

Route::get('/laboratory/create', function () {
    return view('laboratory.create');
});