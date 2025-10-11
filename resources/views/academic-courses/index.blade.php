<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">Gestión de Cursos Académicos</h1>
                        <a href="{{ route('academic-courses.create') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">
                            + Nuevo Curso
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Créditos</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kit de Robótica</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($courses as $course)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-mono text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                            {{ $course->course_code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $course->course_name }}</div>
                                        <div class="text-sm text-gray-500 truncate max-w-xs">{{ $course->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-sm">
                                            {{ $course->credits }} créditos
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($course->robotKit)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                                {{ $course->robotKit->name }}
                                            </span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">
                                                Sin asignar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($course->is_active)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">
                                                Activo
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('academic-courses.show', $course) }}" 
                                           class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                                        <a href="{{ route('academic-courses.edit', $course) }}" 
                                           class="text-green-600 hover:text-green-900 mr-3">Editar</a>
                                        <form action="{{ route('academic-courses.destroy', $course) }}" 
                                              method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($courses->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">No hay cursos registrados.</p>
                        <a href="{{ route('academic-courses.create') }}" 
                           class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                            Crear primer curso
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>