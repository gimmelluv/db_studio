<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">{{ $test->title }}</h1>
        <p class="mb-6">{{ $test->description }}</p>
        
        {{-- Блок с сообщениями --}}
        @if(session('info'))
            <div class="mb-6 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded-lg">
                {{ session('info') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if(session('score') !== null)
            <div class="mb-6 p-4 rounded-lg {{ session('is_passed') ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
                <p>Ваш результат: {{ session('score') }} из {{ $test->questions->sum('score') }}</p>
                <p>Минимальный проходной балл: {{ session('min_score') }}</p>
                <p class="font-bold">{{ session('is_passed') ? 'Тест пройден!' : 'Тест не пройден' }}</p>
            </div>
        @endif
        
        {{-- Форма теста (показываем только если тест не пройден) --}}
        @if(!$testResult && !session('info') && !session('error'))
            <form action="{{ route('tests.store', $test) }}" method="POST">
                @csrf
                
                @foreach($test->questions as $index => $question)
                    <div class="mb-8 p-4 border rounded-lg">
                        <p class="font-bold mb-2">Вопрос {{ $index + 1 }}: {{ $question->question }}</p>
                        <p class="text-sm text-gray-500 mb-3">Баллов за вопрос: {{ $question->score }}</p>
                        
                        @foreach($question->options as $key => $option)
                            <div class="mb-2">
                                <input type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}_{{ $key }}" value="{{ $key }}" class="mr-2">
                                <label for="q{{ $question->id }}_{{ $key }}">{{ $option }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Отправить ответы
                </button>
            </form>
            
        @elseif(!session('score'))
            {{-- Кнопка просмотра результатов (если тест уже пройден ранее) --}}
            <div class="mt-6">
                <a href="{{ route('tests.results', $test->id) }}" 
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Посмотреть результаты теста
                </a>
            </div>
        @endif
    </div>
</x-layout>