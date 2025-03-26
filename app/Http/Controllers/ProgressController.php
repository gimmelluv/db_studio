<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Получаем текущего пользователя

        // Получаем все теории
        $theories = Theory::all();
        $tasks = Task::all();
    
        // Рассчитываем общий прогресс
        $totalItems = $theories->count() + $tasks->count();
        $completedItems = $user->theories()->wherePivot('is_passed', true)->count() 
                        + $user->tasks()->wherePivot('is_passed', true)->count();
        
        $progress = $totalItems > 0 ? round(($completedItems / $totalItems) * 100) : 0;

        return view('progress.index', [
            'progress' => $progress,
            'theories' => $theories,
            'tasks' => $tasks,
            'user' => $user
        ]);
    }
}
