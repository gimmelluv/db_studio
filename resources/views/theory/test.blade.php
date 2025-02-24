<x-layout>
    <div class="flex flex-col items-center p-8">
        <!-- Блок с тестом -->
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-3xl">
            <h2 class="text-2xl font-bold mb-4">Тест: Основы программирования</h2>

            <!-- Вопрос 1 -->
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">1. Что такое переменная?</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="question1" class="form-radio">
                        <span class="ml-2">Контейнер для хранения данных</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question1" class="form-radio">
                        <span class="ml-2">Тип данных</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question1" class="form-radio">
                        <span class="ml-2">Функция</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question1" class="form-radio">
                        <span class="ml-2">Цикл</span>
                    </label>
                </div>
            </div>

            <!-- Вопрос 2 -->
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">2. Какой язык программирования является статически типизированным?</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="question2" class="form-radio">
                        <span class="ml-2">Python</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question2" class="form-radio">
                        <span class="ml-2">JavaScript</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question2" class="form-radio">
                        <span class="ml-2">Java</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question2" class="form-radio">
                        <span class="ml-2">Ruby</span>
                    </label>
                </div>
            </div>

            <!-- Вопрос 3 -->
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">3. Что выведет следующий код: `print(2 + 2 * 2)`?</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="question3" class="form-radio">
                        <span class="ml-2">6</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question3" class="form-radio">
                        <span class="ml-2">8</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question3" class="form-radio">
                        <span class="ml-2">4</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="question3" class="form-radio">
                        <span class="ml-2">Ошибка</span>
                    </label>
                </div>
            </div>

            <!-- Кнопка завершения теста -->
            <div class="flex justify-end mt-6">
                <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Завершить тест</button>
            </div>
        </div>
    </div>
</x-layout>