@extends('layouts.app')

@section('title', 'Gestión de Cursos')
@section('page-title', 'Gestión de Cursos Académicos')
@section('page-description', 'Administra los cursos académicos del sistema')

@section('content')
<div class="space-y-6">
    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <div class="text-center">
                <p class="text-3xl font-bold">{{ $courses->total() }}</p>
                <p class="text-blue-100">Total Cursos</p>
            </div>
        </x-card>
        
        <x-card class="bg-gradient-to-r from-green-500 to-green-600 text-white">
            <div class="text-center">
                <p class="text-3xl font-bold">{{ $courses->where('is_active', true)->count() }}</p>
                <p class="text-green-100">Cursos Activos</p>
            </div>
        </x-card>
        
        <x-card class="bg-gradient-to-r from-purple-500 to-purple-600 text-white">
            <div class="text-center">
                <p class="text-3xl font-bold">{{ $courses->where('robot_kit_id', '!=', null)->count() }}</p>
                <p class="text-purple-100">Con Kits</p>
            </div>
        </x-card>
    </div>

    <!-- Barra de Acciones -->
    <x-card>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Lista de Cursos</h2>
                <p class="text-gray-600">Gestiona todos los cursos académicos del sistema</p>
            </div>
            <x-button href="{{ route('academic-courses.create') }}" variant="primary" size="large">
                <span class="mr-2">+</span> Nuevo Curso
            </x-button>
        </div>
    </x-card>

    <!-- Tabla de Cursos -->
    <x-card title="Cursos Registrados" padding="p-0">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Curso
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Información
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($course->image_url)
                                        <img class="h-12 w-12 rounded-full object-cover" 
                                             src="{{ $course->image_url }}" 
                                             alt="{{ $course->course_name }}">
                                    @else
                                        <div class="h-12 w-12 bg-gradient-to-r from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($course->course_name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $course->course_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $course->course_code }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <span class="font-mono bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                    {{ $course->credits }} créditos
                                </span>
                            </div>
                            <div class="text-sm text-gray-500 mt-1 max-w-xs truncate">
                                {{ $course->description }}
                            </div>
                            @if($course->robotKit)
                            <div class="text-sm text-purple-600 mt-1">
                                🤖 {{ $course->robotKit->name }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($course->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactivo
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <x-button href="{{ route('academic-courses.show', $course) }}" 
                                         variant="outline" size="small">
                                    Ver
                                </x-button>
                                <x-button href="{{ route('academic-courses.edit', $course) }}" 
                                         variant="secondary" size="small">
                                    Editar
                                </x-button>
                                <form action="{{ route('academic-courses.destroy', $course) }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar este curso?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" variant="danger" size="small">
                                        Eliminar
                                    </x-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($courses->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">📚</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay cursos registrados</h3>
            <p class="text-gray-500 mb-4">Comienza agregando el primer curso académico al sistema.</p>
            <x-button href="{{ route('academic-courses.create') }}" variant="primary">
                Crear Primer Curso
            </x-button>
        </div>
        @endif

        <!-- Paginación -->
        @if($courses->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $courses->links() }}
        </div>
        @endif
    </x-card>
</div>
@endsection