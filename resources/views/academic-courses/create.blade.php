<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Curso</h1>

                    <form action="{{ route('academic-courses.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="course_name" class="block text-sm font-medium text-gray-700">Nombre del Curso *</label>
                                    <input type="text" name="course_name" id="course_name" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           required>
                                </div>

                                <div>
                                    <label for="course_code" class="block text-sm font-medium text-gray-700">Código del Curso *</label>
                                    <input type="text" name="course_code" id="course_code" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           required>
                                </div>

                                <div>
                                    <label for="credits" class="block text-sm font-medium text-gray-700">Créditos *</label>
                                    <input type="number" name="credits" id="credits" min="1" max="10"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           required>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha Inicio *</label>
                                    <input type="date" name="start_date" id="start_date" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           required>
                                </div>

                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha Fin *</label>
                                    <input type="date" name="end_date" id="end_date" 
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           required>
                                </div>

                                <div>
                                    <label for="robot_kit_id" class="block text-sm font-medium text-gray-700">Kit de Robótica</label>
                                    <select name="robot_kit_id" id="robot_kit_id" 
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                        <option value="">Seleccionar kit...</option>
                                        @foreach($robotKits as $kit)
                                            <option value="{{ $kit->id }}">
                                                {{ $kit->name }} - ${{ $kit->price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                        </div>

                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked
                                       class="rounded border-gray-300 text-blue-600 shadow-sm">
                                <span class="ml-2 text-sm text-gray-600">Curso activo</span>
                            </label>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('academic-courses.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                Crear Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>