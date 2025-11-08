<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CourseUserController;
use App\Http\Controllers\AcademicCourseController;
use App\Http\Controllers\RobotKitController; // ← AÑADE ESTA LÍNEA
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

// === RUTA CRUD PARA CURSOS ACADÉMICOS (Nueva actividad) ===
Route::resource('academic-courses', AcademicCourseController::class)->middleware('auth');

// === 🚨 AÑADE ESTA LÍNEA PARA KITS DE ROBÓTICA 🚨 ===
Route::resource('robot-kits', RobotKitController::class)->middleware('auth');

require __DIR__.'/auth.php';

use Illuminate\Http\Request;

Route::prefix('api')->group(function () {
    
    // Ruta de prueba básica
    Route::get('/test', function () {
        return response()->json([
            'message' => '✅ API funcionando correctamente',
            'status' => 'success',
            'timestamp' => now(),
            'endpoints' => [
                'GET /api/test',
                'GET /api/academic-courses',
                'POST /api/academic-courses', 
                'GET /api/robot-kits',
                'POST /api/robot-kits',
                'GET /api/stats'
            ]
        ]);
    });

    // GET - Listar todos los cursos
    Route::get('/academic-courses', function () {
        try {
            $courses = \App\Models\AcademicCourse::with('robotKit')->get();
            return response()->json([
                'success' => true,
                'data' => $courses,
                'count' => $courses->count(),
                'message' => 'Cursos obtenidos exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    });

    // POST - Crear nuevo curso
    Route::post('/academic-courses', function (Request $request) {
        try {
            $validated = $request->validate([
                'course_code' => 'required|string|max:20|unique:academic_courses',
                'course_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'credits' => 'required|integer|min:1',
                'is_active' => 'boolean'
            ]);

            $course = \App\Models\AcademicCourse::create($validated);

            return response()->json([
                'success' => true,
                'data' => $course,
                'message' => 'Curso creado exitosamente'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el curso: ' . $e->getMessage()
            ], 500);
        }
    });

    // GET - Listar todos los kits de robótica
    Route::get('/robot-kits', function () {
        try {
            $kits = \App\Models\RobotKit::all();
            return response()->json([
                'success' => true,
                'data' => $kits,
                'count' => $kits->count(),
                'message' => 'Kits obtenidos exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    });

    // POST - Crear nuevo kit
    Route::post('/robot-kits', function (Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'model' => 'required|string|max:100',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'is_available' => 'boolean'
            ]);

            $kit = \App\Models\RobotKit::create($validated);

            return response()->json([
                'success' => true,
                'data' => $kit,
                'message' => 'Kit creado exitosamente'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el kit: ' . $e->getMessage()
            ], 500);
        }
    });

    // GET - Estadísticas del sistema
    Route::get('/stats', function () {
        try {
            return response()->json([
                'success' => true,
                'data' => [
                    'total_courses' => \App\Models\AcademicCourse::count(),
                    'active_courses' => \App\Models\AcademicCourse::where('is_active', true)->count(),
                    'total_kits' => \App\Models\RobotKit::count(),
                    'available_kits' => \App\Models\RobotKit::where('is_available', true)->count(),
                    'timestamp' => now()
                ],
                'message' => 'Estadísticas obtenidas exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    });

});