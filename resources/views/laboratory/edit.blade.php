<x-layout>
    <h2 class="text-center">Редактирование</h2>
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-5">
    
            <form method="POST" action="/laboratory/{{ $diagram->id }}">
                @csrf
                @method('PATCH')
                
                <!-- Скрытое поле для статуса -->
                <input type="hidden" name="status" value="{{ $diagram->status }}">

                <x-forms.input id="type"
                    label="К какому заданию относится диаграмма?" type="select" name="type"
                    :options="['type1' => 'Задание 1', 'type2' => 'Задание 2', 'type3' => 'Задание 3']" selectedValue="{{ $diagram->type }}" required/>
                
                <x-forms.input id="title" label="Название" type="text" name="title" placeholder="Введите название диаграммы" selectedValue="{{ $diagram->title }}" required/>
                <x-forms.input id="description" label="Описание" type="textarea" name="description" placeholder="Введите описание диаграммы" selectedValue="{{ $diagram->description }}" required/>


                     <!-- Блок статуса -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700">Статус</h4>
                    <p class="mt-1 text-lg">
                        @if($diagram->status === 'draft')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Черновик</span>
                        @elseif($diagram->status === 'review')
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">На проверке</span>
                        @else
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Проверено</span>
                        @endif
                    </p>
                </div>

                <!-- Комментарий администратора (только для просмотра) -->
                @if($diagram->admin_comment)
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700">Комментарий преподавателя</h4>
                    <p class="mt-1 text-lg bg-gray-50 p-3 rounded">{{ $diagram->admin_comment }}</p>
                </div>
                @endif

                <!-- Поле для загрузки нового файла -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700">Текущий файл</h4>
                    <p class="mt-1 text-lg">
                        <a href="{{ asset('storage/' . $diagram->file_path) }}" download class="text-blue-600 hover:underline">
                            {{ basename($diagram->file_path) }}
                        </a>
                    </p>
                    <x-forms.input id="file" 
                        label="Заменить файл" 
                        type="file" 
                        name="file"
                        accept=".xml,.drawio,.xslt,.xbl,.xsl,.svg,.png"/>
                    <p class="text-sm text-gray-600 mt-1">
                        Допустимые форматы: XML (*.drawio, *.xml, *.xslt, *.xbl, *.xsl), SVG, PNG
                    </p>
                </div>

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
                        <!-- Кнопка отправки на проверку (если статус не "на проверке") -->
                        @if($diagram->status !== 'review')
                            <button type="submit" name="action" value="submit" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition duration-300">
                                Отправить на проверку
                            </button>
                        @endif

                        <!-- Основная кнопка сохранения -->
                        <button type="submit" name="action" value="save" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>

            <form method="POST" action="/laboratory/{{ $diagram->id }}" id="delete-form" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    
</x-layout>