<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicCourse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AcademicCourseController extends Controller
{
    public function index()
    {
        try {
            $courses = AcademicCourse::with('robotKit')->get();
            return response()->json([
                'success' => true,
                'data' => $courses,
                'message' => 'Cursos obtenidos exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cursos: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'course_code' => 'required|string|max:20|unique:academic_courses',
                'course_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'credits' => 'required|integer|min:1',
                'is_active' => 'boolean'
            ]);

            $course = AcademicCourse::create($validated);

            return response()->json([
                'success' => true,
                'data' => $course,
                'message' => 'Curso creado exitosamente'
            ], Response::HTTP_CREATED);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el curso: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $course = AcademicCourse::with('robotKit')->find($id);

            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => $course,
                'message' => 'Curso obtenido exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el curso: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $course = AcademicCourse::find($id);

            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado'
                ], Response::HTTP_NOT_FOUND);
            }

            $validated = $request->validate([
                'course_code' => 'sometimes|required|string|max:20|unique:academic_courses,course_code,' . $id,
                'course_name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'credits' => 'sometimes|required|integer|min:1',
                'is_active' => 'boolean'
            ]);

            $course->update($validated);

            return response()->json([
                'success' => true,
                'data' => $course,
                'message' => 'Curso actualizado exitosamente'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el curso: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $course = AcademicCourse::find($id);

            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado'
                ], Response::HTTP_NOT_FOUND);
            }

            $course->delete();

            return response()->json([
                'success' => true,
                'message' => 'Curso eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el curso: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}