<x-layout>
    <h2 class="text-center">Создание диаграммы</h2>
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-5">
    
            <form action="/laboratory/create" method="POST" enctype="multipart/form-data">
                @csrf
                
                <x-forms.input id="type"
                    label="К какому заданию относится диаграмма?" type="select" name="type"
                    :options="['type1' => 'Задание 1', 'type2' => 'Задание 2', 'type3' => 'Задание 3']" required/>
                
                <x-forms.input id="title" label="Название" type="text" name="title" placeholder="Введите название диаграммы" required/>
                <x-forms.input id="description" label="Описание" type="textarea" name="description" placeholder="Введите описание диаграммы" required/>

                <div class="flex justify-center mt-5">
                    <a href="https://app.diagrams.net/" target="_blank" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 mt-2 mb-6">Создать диаграмму</a>
                </div>

                <div class="mb-4 mt-5">
                    <x-forms.input id="file" label="Загрузить файл" type="file" name="file"/>
                </div>

                <div class="flex justify-between mt-4">
                    <x-forms.button type="submit" hoverOpacity="40">Сохранить в лаборатории</x-forms.button>
                    <x-forms.button type="button" hoverOpacity="70">Отправить на проверку</x-forms.button>
                </div>
    
            </form>
        </div>
    
</x-layout>