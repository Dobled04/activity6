<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AcademicCourse;
use Illuminate\Http\Request;

class CourseUserController extends Controller
{
    /**
     * Mostrar usuarios con sus cursos
     */
    public function usersWithCourses()
    {
        $users = User::with('courses')->get();
        
        return response()->json([
            'message' => 'Users with their courses',
            'data' => $users
        ]);
    }

    /**
     * Mostrar cursos con sus usuarios
     */
    public function coursesWithUsers()
    {
        $courses = AcademicCourse::with('users')->get();
        
        return response()->json([
            'message' => 'Courses with their enrolled users',
            'data' => $courses
        ]);
    }

    /**
     * Inscribir usuario en un curso
     */
    public function enrollUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:academic_courses,id'
        ]);

        $user = User::find($request->user_id);
        $user->courses()->attach($request->course_id);

        return response()->json([
            'message' => 'User enrolled in course successfully',
            'data' => $user->load('courses')
        ]);
    }

    /**
     * Desinscribir usuario de un curso
     */
    public function unenrollUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:academic_courses,id'
        ]);

        $user = User::find($request->user_id);
        $user->courses()->detach($request->course_id);

        return response()->json([
            'message' => 'User unenrolled from course successfully'
        ]);
    }
}