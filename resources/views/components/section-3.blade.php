@props(['title', 'description', 'icon', 'color' => 'bg-gray-100 text-gray-800'])

<div class="{{ $color }} p-6 rounded-lg hover:shadow-md transition-all hover:-translate-y-1">
    <div class="text-3xl mb-4">{{ $icon }}</div>
    <h3 class="font-bold text-xl mb-2">{{ $title }}</h3>
    <p class="opacity-90">{{ $description }}</p>
</div>