<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrador Principal',
                'email' => 'admin@school.edu',
                'password' => Hash::make('admin123'),
                'role' => 'Administrator'
            ],
            [
                'name' => 'Profesor de Programación',
                'email' => 'teacher@school.edu',
                'password' => Hash::make('teacher123'),
                'role' => 'Teacher'
            ],
            [
                'name' => 'Estudiante Ejemplo',
                'email' => 'student@school.edu',
                'password' => Hash::make('student123'),
                'role' => 'Student'
            ]
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        $this->command->info('✅ Usuarios actualizados/creados exitosamente');
    }
}