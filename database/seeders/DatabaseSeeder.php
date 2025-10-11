<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RobotKitSeeder::class, // Primero los kits de robótica
            AcademicCourseSeeder::class, // Luego los cursos
            CourseUserSeeder::class, // Finalmente las relaciones
        ]);
    }
}