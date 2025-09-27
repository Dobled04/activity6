<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Nueva ruta para los usuarios
Route::get('/users', [UserController::class, 'index'])->middleware(['auth'])->name('users.index');

require __DIR__.'/auth.php';