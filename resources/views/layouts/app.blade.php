<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Sistema Académico')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Styles para el nuevo diseño -->
        <style>
            .sidebar-gradient {
                background: linear-gradient(180deg, #4f46e5 0%, #7c3aed 100%);
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Layout para páginas de administración -->
        @if(request()->routeIs('academic-courses.*') || request()->routeIs('robot-kits.*'))
        
        <!-- NUEVO DISEÑO CON SIDEBAR -->
        <div class="min-h-screen flex bg-gray-50">
            <!-- Sidebar Navigation -->
            <div class="sidebar-gradient w-64 min-h-screen shadow-xl">
                <div class="p-6">
                    <h2 class="text-white text-2xl font-bold text-center mb-8">{{ config('app.name') }}</h2>
                    <nav class="space-y-2">
                        <x-nav-item href="{{ route('dashboard') }}" icon="📊" active="{{ request()->routeIs('dashboard') }}">
                            Dashboard
                        </x-nav-item>
                        <x-nav-item href="{{ route('academic-courses.index') }}" icon="📚" active="{{ request()->routeIs('academic-courses.*') }}">
                            Cursos Académicos
                        </x-nav-item>
                        <x-nav-item href="{{ route('robot-kits.index') }}" icon="🤖" active="{{ request()->routeIs('robot-kits.*') }}">
                            Kits de Robótica
                        </x-nav-item>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Header -->
                <header class="bg-white shadow-sm border-b">
                    <div class="flex justify-between items-center px-8 py-4">
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Sistema Académico')</h1>
                            <p class="text-gray-500 text-sm">@yield('page-description', 'Gestión académica')</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            @auth
                            <x-user-dropdown :user="auth()->user()" />
                            @endauth
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                    <div class="container mx-auto px-6 py-8">
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <x-alert type="success" :message="session('success')" class="mb-6" />
                        @endif

                        @if(session('error'))
                            <x-alert type="error" :message="session('error')" class="mb-6" />
                        @endif

                        @if($errors->any())
                            <x-alert type="error" :message="'Por favor, corrige los errores en el formulario.'" class="mb-6" />
                        @endif

                        <!-- Page Content -->
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @else
        <!-- DISEÑO ORIGINAL (para otras páginas) -->
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @endif

        <!-- Scripts adicionales -->
        @stack('scripts')
    </body>
</html>