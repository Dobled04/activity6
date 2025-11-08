@props([
    'href' => '#',
    'icon' => '',
    'active' => false
])

@php
    $classes = $active 
        ? 'bg-white bg-opacity-20 text-white shadow-sm'
        : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white';
@endphp

<a href="{{ $href }}" 
   {{ $attributes->merge(['class' => 'flex items-center px-4 py-3 rounded-lg transition-all duration-200 ' . $classes]) }}>
    <span class="text-lg mr-3">{{ $icon }}</span>
    <span class="font-medium">{{ $slot }}</span>
    
    @if($active)
        <span class="ml-auto w-2 h-2 bg-white rounded-full"></span>
    @endif
</a>