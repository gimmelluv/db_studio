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
Route::get('/theory/test', function () {
    return view('theory.test');
})->name('theory.test');

Route::post('/theory/{theory}/mark-as-passed', [TheoryController::class, 'markAsPassed'])->name('theory.markAsPassed');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

// Отображение всех диаграмм
Route::get('/laboratory', [DiagramController::class, 'index'])->name('laboratory.index');

// Отображение формы для создания диаграммы
Route::get('/laboratory/create', [DiagramController::class, 'create'])->name('laboratory.create');

// Обработка сохранения диаграммы
Route::post('/laboratory/store', [DiagramController::class, 'store'])->name('laboratory.store');

// Маршрут для просмотра полной информации о диаграмме
Route::get('/laboratory/{id}', [DiagramController::class, 'show'])->name('laboratory.show');

Route::get('/laboratory/{id}/edit', [DiagramController::class, 'edit'])->name('laboratory.edit');

//update передаем айди в функцию в контроллере
Route::patch('/laboratory/{id}', [DiagramController::class, 'update'])->name('laboratory.update');

//delete передаем айди в функцию в контроллере
Route::delete('/laboratory/{id}', [DiagramController::class, 'destroy'])->name('laboratory.destroy');

Route::get('/progress', function () {
    return view('progress.index');
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');