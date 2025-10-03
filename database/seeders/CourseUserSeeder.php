<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AcademicCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los usuarios y cursos
        $users = User::all();
        $courses = AcademicCourse::all();

        // Verificar que hay usuarios y cursos
        if ($users->count() === 0 || $courses->count() === 0) {
            $this->command->info('No hay usuarios o cursos para relacionar!');
            return;
        }

        // Para cada usuario, asignar aleatoriamente algunos cursos
        $users->each(function ($user) use ($courses) {
            // Asignar entre 1 y 3 cursos aleatorios a cada usuario
            $randomCourses = $courses->random(min(rand(1, 3), $courses->count()));
            $user->courses()->attach($randomCourses);
        });

        $this->command->info('Relaciones curso-usuario creadas exitosamente!');
    }
}