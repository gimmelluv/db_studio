<x-layout>
    <div class="flex">
        <div>
            <h2 class="font-bold text-lg mb-2">Навигация</h2>
            <ul class="list-disc pl-5">
                @foreach ($theories as $theory)
                    <x-theory-head-nav sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                @endforeach
            </ul>
        </div>

        <div class="ml-20">
            @foreach ($theories as $theory)
                <x-theory-head sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                <p class="mt-10 mb-10">{{ $theory->content }}</p>

                @auth
                    @php
                        // Проверяем, отмечен ли материал как пройденный
                        $isPassed = Auth::user()->theories->contains($theory->id) && 
                                    Auth::user()->theories->find($theory->id)->pivot->is_passed;
                    @endphp

                    <form id="markAsPassedForm{{ $theory->id }}" action="{{ route('theory.markAsPassed', $theory) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300">
                            {{ $isPassed ? 'Пройдено' : 'Отметить пройденным' }}
                        </button>
                    </form>
                @else
                    <p class="text-gray-500">Войдите, чтобы отметить материал как пройденный.</p>
                @endauth
                <!-- Добавьте дополнительный элемент для отступа -->
                <div class="mt-10"></div> <!-- Это создаст дополнительное пространство -->
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('[id^="markAsPassedForm"]').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Отменяем стандартную отправку формы
    
                const formData = new FormData(this);
                const url = this.action;
                const button = this.querySelector('button');
    
                axios.post(url, formData)
                    .then(response => {
                        // Обновляем текст кнопки
                        button.textContent = 'Пройдено';
                        // Меняем стиль кнопки (опционально)
                        button.classList.remove('bg-castom_blue/60', 'hover:bg-castom_blue/50');
                        button.classList.add('bg-green-500', 'hover:bg-green-400');
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                    });
            });
        });
    </script>

</x-layout>