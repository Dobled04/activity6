<?php

use App\Http\Controllers\Api\AcademicCourseController;
use App\Http\Controllers\Api\RobotKitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas para Cursos Académicos
Route::apiResource('academic-courses', AcademicCourseController::class);

// Rutas para Kits de Robótica  
Route::apiResource('robot-kits', RobotKitController::class);

// Ruta para estadísticas
Route::get('/stats', function () {
    return response()->json([
        'total_courses' => \App\Models\AcademicCourse::count(),
        'active_courses' => \App\Models\AcademicCourse::where('is_active', true)->count(),
        'total_kits' => \App\Models\RobotKit::count(),
        'timestamp' => now()
    ]);
});

// Ruta de prueba simple
Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando correctamente',
        'timestamp' => now(),
        'status' => 'success'
    ]);
});