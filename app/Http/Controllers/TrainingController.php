<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{

    private $tasks = [
        [
            'id' => 1,
            'title' => 'Базовый SELECT',
            'description' => 'Выведите всех пользователей из таблицы users.',
            'solution' => 'SELECT * FROM users;',
            'check_query' => 'SELECT COUNT(*) as count FROM users;'
        ],
        [
            'id' => 2,
            'title' => 'SELECT с условием',
            'description' => 'Выведите пользователей старше 25 лет.',
            'solution' => 'SELECT * FROM users WHERE age > 25;',
            'check_query' => 'SELECT COUNT(*) as count FROM users WHERE age > 25;'
        ],
        [
            'id' => 3,
            'title' => 'JOIN таблиц',
            'description' => 'Выведите все заказы вместе с именами пользователей, которые их сделали.',
            'solution' => 'SELECT o.*, u.name FROM orders o JOIN users u ON o.user_id = u.id;',
            'check_query' => 'SELECT COUNT(*) as count FROM orders o JOIN users u ON o.user_id = u.id;'
        ],
        [
            'id' => 4,
            'title' => 'GROUP BY и агрегатные функции',
            'description' => 'Посчитайте общую сумму заказов для каждого пользователя.',
            'solution' => 'SELECT user_id, SUM(amount) as total_amount FROM orders GROUP BY user_id;',
            'check_query' => 'SELECT COUNT(*) as count FROM (SELECT user_id FROM orders GROUP BY user_id) as temp;'
        ],
        [
            'id' => 5,
            'title' => 'Подзапросы',
            'description' => 'Выведите пользователей, у которых есть хотя бы один завершенный заказ.',
            'solution' => 'SELECT * FROM users WHERE id IN (SELECT user_id FROM orders WHERE status = "completed");',
            'check_query' => 'SELECT COUNT(*) as count FROM users WHERE id IN (SELECT user_id FROM orders WHERE status = "completed");'
        ],
    ];

    public function showForm()
    {
        return view('training.index', ['tasks' => $this->tasks]);
    }

    public function executeQuery(Request $request)
    {
        $query = $request->input('query');
        $taskId = $request->input('task_id');

        try {
            // Выполнение запроса пользователя
            $userResults = DB::connection('training_sqlite')->select($query);
            
            // Проверка решения, если указан task_id
            $verification = null;
            if ($taskId) {
                $task = collect($this->tasks)->firstWhere('id', $taskId);
                if ($task) {
                    $expectedResults = DB::connection('training_sqlite')->select($task['check_query']);
                    $userCheckResults = DB::connection('training_sqlite')->select($task['check_query']);
                    
                    $verification = [
                        'is_correct' => $expectedResults == $userCheckResults,
                        'expected' => $expectedResults,
                        'solution' => $task['solution']
                    ];
                }
            }

            return response()->json([
                'success' => true, 
                'results' => $userResults,
                'verification' => $verification
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
