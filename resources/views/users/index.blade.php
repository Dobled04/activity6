"<x-app-layout>...</x-app-layout>" 
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Lista de Usuarios - Activity6</h1>
                    
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-3 px-4 border-b text-left">Nombre</th>
                                        <th class="py-3 px-4 border-b text-left">Email</th>
                                        <th class="py-3 px-4 border-b text-left">Fecha de Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 border-b">{{ $user->name }}</td>
                                        <td class="py-3 px-4 border-b">{{ $user->email }}</td>
                                        <td class="py-3 px-4 border-b">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 text-sm text-gray-600">
                            Total de usuarios: <strong>{{ $users->count() }}</strong>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No hay usuarios registrados.</p>
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                                Registrar primer usuario
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>