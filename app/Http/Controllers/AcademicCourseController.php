<?php

namespace App\Http\Controllers;

use App\Models\AcademicCourse;
use App\Models\RobotKit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicCourseController extends Controller
{
    public function index()
    {
        $courses = AcademicCourse::with('robotKit')->latest()->get();
        return view('academic-courses.index', compact('courses'));
    }

    public function create()
    {
        $robotKits = RobotKit::where('is_available', true)->get();
        return view('academic-courses.create', compact('robotKits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:academic_courses',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'robot_kit_id' => 'nullable|exists:robot_kits,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Procesar la imagen si se subió
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
            $validated['image'] = $imagePath;
        }

        AcademicCourse::create($validated);

        return redirect()->route('academic-courses.index')
                         ->with('success', 'Curso creado exitosamente.');
    }

    public function show(AcademicCourse $academicCourse)
    {
        $academicCourse->load('robotKit');
        return view('academic-courses.show', compact('academicCourse'));
    }

    public function edit(AcademicCourse $academicCourse)
    {
        $robotKits = RobotKit::where('is_available', true)->get();
        return view('academic-courses.edit', compact('academicCourse', 'robotKits'));
    }

    public function update(Request $request, AcademicCourse $academicCourse)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:academic_courses,course_code,' . $academicCourse->id,
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
            'robot_kit_id' => 'nullable|exists:robot_kits,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Procesar la imagen si se subió
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($academicCourse->image) {
                Storage::disk('public')->delete($academicCourse->image);
            }
            
            $imagePath = $request->file('image')->store('courses', 'public');
            $validated['image'] = $imagePath;
        }

        $academicCourse->update($validated);

        return redirect()->route('academic-courses.index')
                         ->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(AcademicCourse $academicCourse)
    {
        // Eliminar imagen si existe
        if ($academicCourse->image) {
            Storage::disk('public')->delete($academicCourse->image);
        }

        $academicCourse->delete();

        return redirect()->route('academic-courses.index')
                         ->with('success', 'Curso eliminado exitosamente.');
    }
}