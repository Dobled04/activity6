@props([
    'title' => null,
    'footer' => null,
    'padding' => 'p-6',
    'hover' => false
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden' . ($hover ? ' hover:shadow-md transition-shadow duration-200' : '')]) }}>
    @if($title)
        <div class="border-b border-gray-100 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        </div>
    @endif
    
    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
    
    @if($footer)
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
            {{ $footer }}
        </div>
    @endif
</div>