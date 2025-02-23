<?php

use App\Http\Controllers\DiagramController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TheoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/theory', [TheoryController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
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

    Route::delete('/logout', [SessionController::class, 'destroy']);
});

//см что будет отображаться на странице если пользователь гость но нажимает на курс/мое обучение/лаборатория

// // Отображение всех диаграмм
// Route::get('/laboratory', [DiagramController::class, 'index'])->name('laboratory.index');
// // Отображение формы для создания диаграммы
// Route::get('/laboratory/create', [DiagramController::class, 'create'])->name('laboratory.create');
// // Route::post('/diagrams/store', [DiagramController::class, 'store'])->name('diagrams.store');
// // Обработка сохранения диаграммы
// Route::post('/laboratory/store', [DiagramController::class, 'store'])->name('laboratory.store');

// Route::get('/progress', function () {
//     return view('progress.index');
// });

// Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');