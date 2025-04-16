<x-layout>
    <div class="flex">
        <div class="sticky top-0 bg-white z-10 shadow-md h-screen w-64 p-4 rounded-lg">
            {{-- <h2 class="font-bold text-lg mb-2">Навигация</h2> --}}
            <ul class="list-none pl-5 space-y-2">
                @foreach ($theories as $theory)
                    <x-theory-head-nav sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                @endforeach
            </ul>
        </div>

        <div class="ml-8 flex-1 bg-white p-6 rounded-lg shadow-md max-w-3xl">
            @foreach ($theories as $theory)
                <x-theory-head sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>

                <div class="mt-10 mb-10 whitespace-pre-wrap">{!! $theory->content !!}</div>

                @auth
                    @php
                        // Проверяем, отмечен ли материал как пройденный
                        $isPassed = Auth::user()->theories->contains($theory->id) && 
                                    Auth::user()->theories->find($theory->id)->pivot->is_passed;
                    @endphp

                    <div class="flex space-x-4 mt-4">
                        <form id="markAsPassedForm{{ $theory->id }}" action="{{ route('theory.markAsPassed', $theory) }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $isPassed ? 'bg-green-500 hover:bg-green-400' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-bold py-2 px-4 rounded-full transition duration-300">
                                {{ $isPassed ? 'Пройдено' : 'Отметить пройденным' }}
                            </button>
                        </form>

                        @if($theory->test)
                            <a href="{{ route('tests.show', $theory->test) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                                Пройти тест
                            </a>
                        @endif
                    </div>
                    
                @else
                    <p class="text-gray-500">Войдите, чтобы отметить материал как пройденный.</p>
                @endauth

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