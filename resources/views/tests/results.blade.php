<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Результаты теста: {{ $test->title }}</h1>
        <p>Ваш результат: {{ $result->score }} из {{ $test->questions->sum('score') }}</p>
        <p>Минимальный проходной балл: {{ $test->min_score }}</p>
        <p class="font-bold">{{ $result->is_passed ? 'Тест пройден!' : 'Тест не пройден' }}</p>
    </div>
</x-layout>