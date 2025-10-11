<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $academicCourse->course_name }}</h1>
                            <p class="text-gray-600 mt-2">{{ $academicCourse->course_code }}</p>
                        </div>
                        <div class="flex space-x-2">
                            @if($academicCourse->is_active)
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Activo</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">Inactivo</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-2">Información del Curso</h3>
                            <p><strong>Créditos:</strong> {{ $academicCourse->credits }}</p>
                            <p><strong>Fecha inicio:</strong> {{ $academicCourse->start_date->format('d/m/Y') }}</p>
                            <p><strong>Fecha fin:</strong> {{ $academicCourse->end_date->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-700 mb-2">Kit de Robótica</h3>
                            @if($academicCourse->robotKit)
                                <p><strong>Nombre:</strong> {{ $academicCourse->robotKit->name }}</p>
                                <p><strong>Precio:</strong> ${{ $academicCourse->robotKit->price }}</p>
                                <p><strong>Stock:</strong> {{ $academicCourse->robotKit->stock }}</p>
                            @else
                                <p class="text-gray-500">No asignado</p>
                            @endif
                        </div>
                    </div>

                    @if($academicCourse->description)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Descripción</h3>
                        <p class="text-gray-600">{{ $academicCourse->description }}</p>
                    </div>
                    @endif

                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="{{ route('academic-courses.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Volver
                        </a>
                        <a href="{{ route('academic-courses.edit', $academicCourse) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>