<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{

    public function showForm()
    {
        return view('training.index'); // Возвращает файл resources/views/training.blade.php
    }

    public function executeQuery(Request $request)
    {
        $query = $request->input('query');

        try {
            // Выполнение запроса в учебной базе данных
            $results = DB::connection('training_sqlite')->select($query);
            return response()->json(['success' => true, 'results' => $results]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
