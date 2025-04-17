<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function show(Theory $theory, Test $test)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // Проверяем, существует ли тест для этого раздела теории
        // $test = $theory->test()->with('questions')->first();

        if (!$test) {
            abort(404, 'Тест для этого раздела не найден');
        }

        // Проверяем, пройден ли уже тест
        $testResult = $user->tests()->where('test_id', $test->id)->first();

        if ($testResult) {
            return redirect()
                ->route('tests.results', $test->id)
                ->with('info', 'Вы уже проходили этот тест');
        }

        return view('tests.show', [
            // 'theory' => $theory,
            'test' => $test,
            'testResult' => null,
        ]);
    }

    public function store(Request $request, Test $test)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        // Проверяем, не проходил ли пользователь уже этот тест
        if ($user->tests()->where('test_id', $test->id)->exists()) {
            return redirect()
                ->route('tests.results', $test->id)
                ->with('error', 'Тест уже пройден! Повторная отправка невозможна.');
        }

        // Валидация ответов
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        // Проверяем ответы и подсчитываем баллы
        $score = 0;
        $correctAnswers = 0;
        $totalQuestions = $test->questions->count();

        foreach ($test->questions as $question) {
            if (isset($validated['answers'][$question->id])) {
                if ($validated['answers'][$question->id] === $question->correct_answer) {
                    $score += $question->score;
                    $correctAnswers++;
                }
            }
        }

        // Определяем, пройден ли тест
        $isPassed = $score >= $test->min_score;

        // Сохраняем результат
        $user->tests()->attach($test->id, [
            'score' => $score,
            'is_passed' => $isPassed,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Если тест пройден, отмечаем теорию как пройденную (если еще не отмечена)
        if ($isPassed) {
            $user->theories()->syncWithoutDetaching([
                $test->theory_id => ['is_passed' => true]
            ]);
        }

        return redirect()
            ->route('tests.results', $test->id)
            ->with([
                'score' => $score, // Добавляем в корень сессии
                'is_passed' => $isPassed, // Добавляем в корень сессии
                'min_score' => $test->min_score,
                'test_result' => [
                    'score' => $score,
                    'total' => $test->questions->sum('score'),
                    'correct' => $correctAnswers,
                    'total_questions' => $totalQuestions,
                    'is_passed' => $isPassed,
                    'min_score' => $test->min_score,
                ]
            ]);
    }

    public function results(Test $test)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $result = $user->tests()->where('test_id', $test->id)->first();

        if (!$result) {
            return redirect()
                ->route('theory.index', $test->theory_id)
                ->with('error', 'Вы еще не проходили этот тест');
        }
        
        return view('tests.results', [
            'test' => $test,
            'result' => $result->pivot, // Явно передаём только pivot-данные
        ]);
    }
}
