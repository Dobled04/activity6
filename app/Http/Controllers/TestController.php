<?php

namespace App\Http\Controllers;

use App\Models\AcademicCourse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * index - Get all records
     */
    public function index()
    {
        $courses = AcademicCourse::all();
        return response()->json([
            'message' => 'All academic courses retrieved successfully',
            'data' => $courses,
            'count' => $courses->count()
        ]);
    }

    /**
     * create - Create a new record
     */
    public function create(Request $request)
    {
        $course = AcademicCourse::create([
            'course_name' => 'Introduction to Programming',
            'course_code' => 'CS101',
            'description' => 'Basic programming concepts and fundamentals',
            'credits' => 3,
            'start_date' => '2024-01-15',
            'end_date' => '2024-05-15',
            'is_active' => true
        ]);

        return response()->json([
            'message' => 'Course created successfully',
            'data' => $course
        ]);
    }

    /**
     * read - Get one specific record
     */
    public function read($id)
    {
        $course = AcademicCourse::find($id);
        
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Course retrieved successfully',
            'data' => $course
        ]);
    }

    /**
     * update - Update a specific record
     */
    public function update(Request $request, $id)
    {
        $course = AcademicCourse::find($id);
        
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        $course->update([
            'course_name' => 'Advanced Programming',
            'description' => 'Updated description for advanced programming concepts',
            'credits' => 4
        ]);

        return response()->json([
            'message' => 'Course updated successfully',
            'data' => $course
        ]);
    }

    /**
     * delete - Delete a specific record
     */
    public function delete($id)
    {
        $course = AcademicCourse::find($id);
        
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
}