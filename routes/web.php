<?php

use App\Http\Controllers\DiagramController;
use App\Http\Controllers\TheoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/theory', [TheoryController::class, 'index']);

// Отображение всех диаграмм
Route::get('/laboratory', [DiagramController::class, 'index'])->name('laboratory.index');
// Отображение формы для создания диаграммы
Route::get('/laboratory/create', [DiagramController::class, 'create'])->name('laboratory.create');
// Route::post('/diagrams/store', [DiagramController::class, 'store'])->name('diagrams.store');

// Обработка сохранения диаграммы
Route::post('/laboratory/store', [DiagramController::class, 'store'])->name('laboratory.store');

Route::get('/progress', function () {
    return view('progress.index');
});