<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Test;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Получаем все элементы прогресса
        $theories = Theory::orderBy('created_at', 'asc')->get();
        $tasks = Task::all();
        $tests = Test::orderBy('created_at', 'asc')->get();

        // Считаем пройденные элементы
        $passedTheories = $user->theories()->wherePivot('is_passed', true)->count();
        $passedTasks = $user->tasks()->wherePivot('is_passed', true)->count();
        $passedTests = $user->tests()->wherePivot('is_passed', true)->count();

        // Общее количество элементов и пройденных
        $totalItems = $theories->count() + $tasks->count() + $tests->count();
        $completedItems = $passedTheories + $passedTasks + $passedTests;

        // Рассчитываем прогресс
        $progress = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;

        return view('progress.index', [
            'progress' => $progress,
            'theories' => $theories,
            'tasks' => $tasks,
            'tests' => $tests,
            'user' => $user,
            'stats' => [
                'theories' => [
                    'passed' => $passedTheories,
                    'total' => $theories->count()
                ],
                'tasks' => [
                    'passed' => $passedTasks,
                    'total' => $tasks->count()
                ],
                'tests' => [
                    'passed' => $passedTests,
                    'total' => $tests->count()
                ]
            ]
        ]);
    }
}
