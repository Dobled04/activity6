@props(['user'])

<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" 
            class="flex items-center space-x-3 text-gray-700 hover:text-gray-900 transition-colors">
        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="text-left">
            <p class="font-medium text-sm">{{ $user->name }}</p>
            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
        </div>
        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
        <a href="{{ route('profile.edit') }}" 
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
            👤 Mi Perfil
        </a>
        <div class="border-t border-gray-100 my-1"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">
                🚪 Cerrar Sesión
            </button>
        </form>
    </div>
</div>