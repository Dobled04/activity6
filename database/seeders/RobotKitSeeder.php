<?php

namespace Database\Seeders;

use App\Models\RobotKit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RobotKitSeeder extends Seeder
{
    public function run(): void
    {
        $kits = [
            [
                'name' => 'Kit Básico Arduino',
                'description' => 'Kit introductorio para programación con Arduino',
                'price' => 89.99,
                'stock' => 15,
                'is_available' => true
            ],
            [
                'name' => 'Kit Robótica Avanzada',
                'description' => 'Kit para proyectos avanzados de robótica',
                'price' => 199.99,
                'stock' => 8,
                'is_available' => true
            ],
            [
                'name' => 'Kit IoT Educativo',
                'description' => 'Kit para Internet de las Cosas educacional',
                'price' => 149.99,
                'stock' => 5,
                'is_available' => true
            ]
        ];

        foreach ($kits as $kit) {
            RobotKit::create($kit);
        }
    }
}