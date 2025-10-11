<?php

namespace Database\Seeders;

use App\Models\AcademicCourse;
use App\Models\RobotKit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicCourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'course_name' => 'Introduction to Programming',
                'course_code' => 'CS101',
                'description' => 'Basic programming concepts and fundamentals',
                'credits' => 3,
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_active' => true,
                'robot_kit_id' => 1 // Asignar el kit básico
            ],
            [
                'course_name' => 'Database Systems',
                'course_code' => 'CS102',
                'description' => 'Introduction to database design and SQL',
                'credits' => 4,
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_active' => true,
                'robot_kit_id' => 2 // Asignar el kit avanzado
            ],
            [
                'course_name' => 'Web Development',
                'course_code' => 'CS103',
                'description' => 'Building web applications with modern technologies',
                'credits' => 3,
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_active' => true,
                'robot_kit_id' => 3 // Asignar el kit IoT
            ],
            [
                'course_name' => 'Software Engineering',
                'course_code' => 'CS201',
                'description' => 'Software development methodologies and practices',
                'credits' => 4,
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_active' => true,
                'robot_kit_id' => 4 // Asignar el kit de drones
            ],
            [
                'course_name' => 'Data Structures',
                'course_code' => 'CS202',
                'description' => 'Fundamental data structures and algorithms',
                'credits' => 3,
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'is_active' => true,
                'robot_kit_id' => null // Sin kit asignado
            ]
        ];

        foreach ($courses as $course) {
            AcademicCourse::create($course);
        }
    }
}