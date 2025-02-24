@props(['id', 'label', 'type' => 'text', 'name', 'placeholder' => '', 'required' => false, 'options' => [], 'selectedValue' => ''])

<div class="mb-4">
    <label for="{{ $id }}" class="block">{{ $label }}</label>
    @if($type === 'select')
        <select id="{{ $id }}" name="{{ $name }}" class="mt-5 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" {{ $required ? 'required' : '' }}>
            @foreach($options as $value => $text)
                <option value="{{ $value }}" {{ $value == $selectedValue ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea id="{{ $id }}" name="{{ $name }}" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>{{ $selectedValue }}</textarea>
    @else
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="{{ $placeholder }}" value="{{ $selectedValue }}" {{ $required ? 'required' : '' }}>
    @endif
</div>