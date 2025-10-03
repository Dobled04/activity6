<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CourseUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Ruta existente para usuarios
Route::get('/users', [UserController::class, 'index'])->middleware(['auth'])->name('users.index');

// ====================
// NUEVAS RUTAS AGREGADAS
// ====================

// === RUTAS PARA TESTCONTROLLER (Actividad anterior) ===
Route::get('/test/courses', [TestController::class, 'index'])->name('test.index');
Route::post('/test/courses', [TestController::class, 'create'])->name('test.create');
Route::get('/test/courses/{id}', [TestController::class, 'read'])->name('test.read');
Route::put('/test/courses/{id}', [TestController::class, 'update'])->name('test.update');
Route::delete('/test/courses/{id}', [TestController::class, 'delete'])->name('test.delete');

// === RUTAS PARA LA RELACIÓN MUCHOS A MUCHOS (Actividad 7) ===
Route::get('/course-user/users', [CourseUserController::class, 'usersWithCourses'])->name('course-user.users');
Route::get('/course-user/courses', [CourseUserController::class, 'coursesWithUsers'])->name('course-user.courses');
Route::post('/course-user/enroll', [CourseUserController::class, 'enrollUser'])->name('course-user.enroll');
Route::post('/course-user/unenroll', [CourseUserController::class, 'unenrollUser'])->name('course-user.unenroll');

require __DIR__.'/auth.php';