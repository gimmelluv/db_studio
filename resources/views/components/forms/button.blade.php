@props(['type' => 'submit', 'class' => ''])

<button 
    type="{{ $type }}" 
    class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300 {{ $class }}"
>
    {{ $slot }}
</button>