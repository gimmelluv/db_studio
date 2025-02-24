<x-layout>
    <h2 class="text-center">Редактирование</h2>
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-5">
    
            <form method="POST" action="/laboratory/{{ $diagram->id }}">
                @csrf
                @method('PATCH')
                
                <x-forms.input id="type"
                    label="К какому заданию относится диаграмма?" type="select" name="type"
                    :options="['type1' => 'Задание 1', 'type2' => 'Задание 2', 'type3' => 'Задание 3']" selectedValue="{{ $diagram->type }}" required/>
                
                <x-forms.input id="title" label="Название" type="text" name="title" placeholder="Введите название диаграммы" selectedValue="{{ $diagram->title }}" required/>
                <x-forms.input id="description" label="Описание" type="textarea" name="description" placeholder="Введите описание диаграммы" selectedValue="{{ $diagram->description }}" required/>

                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700">Файл</h4>
                    <p class="mt-1 text-lg">
                        <a href="{{ asset('storage/' . $diagram->file_path) }}" download class="text-blue-600 hover:underline">
                            {{ basename($diagram->file_path) }}
                        </a>
                    </p>
                </div>

                <div class="flex justify-between mt-4">
                    <div class="flex items-center">
                        <a href="/laboratory/{{ $diagram->id }}" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300 inline-block">Назад</a>
                    </div>

                    <div class="flex items-center gap-x-6">
                        <button form="delete-form" class="text-red-500 text-sm">Удалить</button>
                        <button type="submit" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300">Сохранить</button>
                    </div>
            </form>

            <form method="POST" action="/laboratory/{{ $diagram->id }}" id="delete-form" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    
</x-layout>