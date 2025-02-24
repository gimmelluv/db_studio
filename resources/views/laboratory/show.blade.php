<x-layout>
    <section class="max-w-4xl mx-auto p-4">
        <h3 class="text-2xl font-bold mb-6">Полная информация о диаграмме</h3>

        <div class="bg-black/5 p-6 rounded-xl">
            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-700">Задание</h4>
                <p class="mt-1 text-lg">{{ $diagram->type }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-700">Название</h4>
                <p class="mt-1 text-lg">{{ $diagram->title }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-700">Описание</h4>
                <p class="mt-1 text-lg">{{ $diagram->description }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-700">Файл</h4>
                <p class="mt-1 text-lg">
                    <a href="{{ asset('storage/' . $diagram->file_path) }}" download class="text-blue-600 hover:underline">
                        {{ basename($diagram->file_path) }}
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('laboratory.index') }}" class="bg-castom_blue/50 px-4 py-2 rounded-full text-white hover:bg-castom_blue/60 transition-colors">Назад</a>
            <a href="/laboratory/{{ $diagram->id }}/edit" class="bg-castom_blue/50 px-4 py-2 rounded-full text-white hover:bg-castom_blue/60 transition-colors">Редактировать</a>
        </div>
    </section>
</x-layout>