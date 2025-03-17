@php
    $classes = 'p-4 bg-gradient-to-r from-gray-200 via-blue-200 to-gray-300 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-300';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>