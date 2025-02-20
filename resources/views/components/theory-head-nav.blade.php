@props(['sectionId', 'sectionTitle'])

<li>
    <a href="#{{ $sectionId }}" class="text-blue-500 hover:underline">
        {{ $sectionTitle }}
    </a>
</li>
