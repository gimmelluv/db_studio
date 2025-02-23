<x-layout>
    <div class="flex flex-col items-center p-8">
        <!-- Блок с прогрессом -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-3xl mb-8">
            <h2 class="text-2xl font-bold mb-4">Прогресс по курсу</h2>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-blue-500 h-4 rounded-full" style="width: 75%;"></div>
            </div>
            <p class="text-center mt-4 text-gray-700">Прогресс: <span class="font-bold">75%</span></p>
        </div>

        <!-- Роадмап по курсу -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-3xl">
            <h2 class="text-2xl font-bold mb-4">Roadmap</h2>
            <ul>
                <!-- Пример разделов теории -->
                <li class="mb-4">
                    <div class="flex items-center">
                        <!-- Иконка статуса -->
                        <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 bg-green-500">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <!-- Название раздела -->
                        <div>
                            <h3 class="font-bold">Введение в курс</h3>
                            <p class="text-sm text-gray-600">Теория</p>
                        </div>
                    </div>
                </li>
                <li class="mb-4">
                    <div class="flex items-center">
                        <!-- Иконка статуса -->
                        <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 bg-gray-300">
                        </div>
                        <!-- Название раздела -->
                        <div>
                            <h3 class="font-bold">Основы программирования</h3>
                            <p class="text-sm text-gray-600">Теория и задания</p>
                        </div>
                    </div>
                </li>
                <li class="mb-4">
                    <div class="flex items-center">
                        <!-- Иконка статуса -->
                        <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 bg-gray-300">
                        </div>
                        <!-- Название раздела -->
                        <div>
                            <h3 class="font-bold">Практика: Создание проекта</h3>
                            <p class="text-sm text-gray-600">Задания</p>
                        </div>
                    </div>
                </li>
                <li class="mb-4">
                    <div class="flex items-center">
                        <!-- Иконка статуса -->
                        <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 bg-gray-300">
                        </div>
                        <!-- Название раздела -->
                        <div>
                            <h3 class="font-bold">Итоговый тест</h3>
                            <p class="text-sm text-gray-600">Тест</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</x-layout>