<x-layout>
    <div class="container mt-4">
        <h1 class="text-2xl font-bold mb-6">SQL Training</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            @foreach($tasks as $task)
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition cursor-pointer relative 
                            {{ in_array($task['id'], $completedTasks) ? 'border-green-500 bg-green-50' : '' }}" 
                     data-task-id="{{ $task['id'] }}"
                     data-er-diagram="{{ $task['er_diagram'] ?? '' }}"> <!-- Добавьте этот атрибут -->
                    
                    @if(in_array($task['id'], $completedTasks))
                        <div class="absolute top-2 right-2 bg-green-500 text-white rounded-full p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    @endif
                    
                    <h3 class="font-bold text-lg mb-2">{{ $task['title'] }}</h3>
                    <p class="text-gray-600 mb-3">{{ $task['description'] }}</p>

                    @if($task['er_diagram'])
                        <div class="mb-3">
                            <h4 class="text-sm font-semibold mb-1">ER-диаграмма:</h4>
                            <img src="{{ asset('storage/' . $task['er_diagram']) }}" 
                                alt="ER-диаграмма" 
                                class="max-w-full h-32 object-contain mx-auto">
                        </div>
                    @endif

                    <button class="select-task bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm">
                        Выбрать это задание
                    </button>
                </div>
            @endforeach
        </div>

        <div class="border rounded-lg p-6 bg-white shadow-sm">
            <h2 id="current-task-title" class="text-xl font-semibold mb-2">Выберите задание</h2>
            <p id="current-task-description" class="text-gray-600 mb-4"></p>
            
            <!-- Добавьте этот блок для отображения диаграммы -->
            <div id="current-task-diagram" class="mb-4 hidden">
                <h3 class="text-lg font-semibold mb-2">ER-диаграмма:</h3>
                <img id="er-diagram-image" src="" alt="ER-диаграмма задания" class="max-w-full h-auto rounded border">
            </div>

            <form id="query-form">
                <input type="hidden" id="task-id" name="task_id">
                @csrf
                <textarea id="query" name="query" rows="4" class="w-full p-2 border rounded mb-3" 
                          placeholder="Введите SQL-запрос"></textarea>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                    Проверить запрос
                </button>
            </form>

            <h3 class="text-lg font-semibold mt-6 mb-2">Результат:</h3>
            <pre id="result" class="bg-gray-100 p-3 rounded overflow-auto"></pre>
            
            <div id="verification-result" class="hidden mt-6">
                <h3 class="text-lg font-semibold mb-2">Проверка:</h3>
                <p id="verification-message"></p>
                <div id="solution" class="hidden mt-3">
                    <h4 class="font-medium mb-1">Правильное решение:</h4>
                    <pre id="solution-query" class="bg-gray-100 p-3 rounded overflow-auto"></pre>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.select-task').forEach(button => {
            button.addEventListener('click', function() {
                const taskCard = this.closest('[data-task-id]');
                const taskId = taskCard.dataset.taskId;
                
                // Устанавливаем выбранное задание
                document.getElementById('task-id').value = taskId;
                document.getElementById('current-task-title').textContent = taskCard.querySelector('h3').textContent;
                document.getElementById('current-task-description').textContent = taskCard.querySelector('p').textContent;

                // Добавьте этот код для отображения диаграммы
                const diagramContainer = document.createElement('div');
                diagramContainer.className = 'mb-4';
                
                if (taskCard.dataset.erDiagram) {
                    diagramContainer.innerHTML = `
                        <h3 class="text-lg font-semibold mb-2">ER-диаграмма:</h3>
                        <img src="/storage/${taskCard.dataset.erDiagram}" 
                            alt="ER-диаграмма" 
                            class="max-w-full h-auto rounded border">
                    `;
            
                    // Вставляем перед формой
                    const form = document.getElementById('query-form');
                    form.parentNode.insertBefore(diagramContainer, form);
                }
                
                // Сбрасываем предыдущие результаты
                document.getElementById('result').textContent = '';
                document.getElementById('verification-result').classList.add('hidden');
                document.getElementById('query').focus();
            });
        });

        document.getElementById('query-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const query = document.getElementById('query').value;
            const taskId = document.getElementById('task-id').value;

            try {
                const response = await fetch('/training/execute-query', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ query, task_id: taskId })
                });

                const data = await response.json();

                if (data.success) {
                    document.getElementById('result').textContent = JSON.stringify(data.results, null, 2);
                    
                    // Показываем результаты проверки, если есть
                    if (data.verification) {
                        const verification = document.getElementById('verification-result');
                        verification.classList.remove('hidden');
                        
                        if (data.verification.is_correct) {
                            verification.classList.remove('text-red-500');
                            verification.classList.add('text-green-500');
                            document.getElementById('verification-message').textContent = '✅ Правильно! Запрос работает как ожидалось.';
                            document.getElementById('solution').classList.add('hidden');
                        } else {
                            verification.classList.remove('text-green-500');
                            verification.classList.add('text-red-500');
                            document.getElementById('verification-message').textContent = '❌ Неправильно. Запрос не возвращает ожидаемый результат.';
                            document.getElementById('solution-query').textContent = data.verification.solution;
                            document.getElementById('solution').classList.remove('hidden');
                        }
                    }
                } else {
                    document.getElementById('result').textContent = 'Ошибка: ' + data.error;
                }
            } catch (error) {
                document.getElementById('result').textContent = 'Ошибка сети: ' + error.message;
            }
        });
    </script>
</x-layout>