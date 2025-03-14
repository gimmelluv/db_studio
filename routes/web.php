<?php

use App\Http\Controllers\DiagramController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
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

Route::middleware('auth')->group(function () {
    Route::resource('laboratory', DiagramController::class);
});

Route::post('/theory/{theory}/mark-as-passed', [TheoryController::class, 'markAsPassed'])->name('theory.markAsPassed');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');


// Route::get('/laboratory', [DiagramController::class, 'index'])->name('laboratory.index');
// Route::get('/laboratory/create', [DiagramController::class, 'create'])->name('laboratory.create');
// Route::post('/laboratory/store', [DiagramController::class, 'store'])->name('laboratory.store');
// Route::get('/laboratory/{id}', [DiagramController::class, 'show'])->name('laboratory.show');
// Route::get('/laboratory/{id}/edit', [DiagramController::class, 'edit'])->name('laboratory.edit');
// Route::patch('/laboratory/{id}', [DiagramController::class, 'update'])->name('laboratory.update');
// Route::delete('/laboratory/{id}', [DiagramController::class, 'destroy'])->name('laboratory.destroy');

Route::get('/progress', [ProgressController::class, 'index'])->name('progress');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});