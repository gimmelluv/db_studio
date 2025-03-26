<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{

    public function showForm()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Получаем текущего пользователя
    
        $tasks = Task::all()->map(function ($task) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'solution' => $task->solution,
                'check_query' => $task->check_query,
                'difficulty' => $task->difficulty
            ];
        });
    
        $completedTasks = $user->tasks()
            ->wherePivot('is_passed', true)
            ->pluck('id')
            ->toArray();
    
        return view('training.index', [
            'tasks' => $tasks,
            'completedTasks' => $completedTasks
        ]);
    }

    public function executeQuery(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Получаем текущего пользователя
        $query = $request->input('query');
        $taskId = $request->input('task_id');

        try {
            // Выполнение в учебной БД
            $userResults = DB::connection('training_sqlite')->select($query);
            
            if ($taskId) {
                $task = Task::find($taskId);
                $expectedResults = DB::connection('training_sqlite')
                    ->select($task->check_query);
                
                $isCorrect = $expectedResults == $userResults;
                
                if ($isCorrect) {
                    $user->tasks()->syncWithoutDetaching([
                        $taskId => ['is_passed' => true]
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'results' => $userResults,
                    'verification' => [
                        'is_correct' => $isCorrect,
                        'solution' => $task->solution
                    ]
                ]);
            }

            return response()->json([
                'success' => true,
                'results' => $userResults
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
