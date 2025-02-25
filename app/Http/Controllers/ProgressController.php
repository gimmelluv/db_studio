<?php

namespace App\Http\Controllers;

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
    
        // Подсчет пройденных теорий
        $passedCount = $user->theories()->where('is_passed', true)->count();
        $totalCount = $theories->count(); // Общее количество теорий
    
        // Рассчитываем процент прогресса
        $progress = $totalCount > 0 ? ($passedCount / $totalCount) * 100 : 0;
    
        return view('progress.index', compact('theories', 'progress', 'user'));
    }
}
