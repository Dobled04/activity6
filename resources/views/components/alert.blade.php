@props([
    'type' => 'info',
    'message' => '',
    'dismissible' => false
])

@php
    $styles = [
        'success' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-200',
            'text' => 'text-green-800',
            'icon' => '✅'
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-200',
            'text' => 'text-red-800',
            'icon' => '❌'
        ],
        'warning' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-200',
            'text' => 'text-yellow-800',
            'icon' => '⚠️'
        ],
        'info' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-200',
            'text' => 'text-blue-800',
            'icon' => 'ℹ️'
        ]
    ];
    
    $style = $styles[$type];
@endphp

<div x-data="{ show: true }" x-show="show" 
     class="{{ $style['bg'] }} {{ $style['border'] }} {{ $style['text'] }} border-l-4 p-4 mb-4 rounded-lg shadow-sm">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <span class="text-lg mr-3">{{ $style['icon'] }}</span>
            <div>
                <p class="font-medium">{{ ucfirst($type) }}</p>
                <p class="text-sm mt-1">{{ $message ?? $slot }}</p>
            </div>
        </div>
        @if($dismissible)
            <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                <span class="text-2xl">&times;</span>
            </button>
        @endif
    </div>
</div>