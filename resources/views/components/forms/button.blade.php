@props([
    'type' => 'submit',
    'class' => '',
    // Явно указываем другие возможные атрибуты
    'name' => null,
    'value' => null,
    // Добавляем поддержку всех остальных атрибутов
])

<button 
    type="{{ $type }}"
    @if($name) name="{{ $name }}" @endif
    @if($value) value="{{ $value }}" @endif
    class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300 {{ $class }}"
    {{ $attributes }}>
    {{ $slot }}
</button>