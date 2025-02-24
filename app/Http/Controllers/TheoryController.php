<?php

namespace App\Http\Controllers;

use App\Models\Theory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TheoryController extends Controller
{
    public function index()
    {
        // Извлекаем все записи из таблицы theories
        $theories = Theory::all();

        // Передаем данные в представление
        return view('theory.index', compact('theories'));
    }

    public function markAsPassed(Request $request, Theory $theory)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Проверяем, есть ли уже запись в таблице theory_user
        $theoryUser = $user->theories()->where('theory_id', $theory->id)->first();

        if ($theoryUser) {
            // Если запись есть, обновляем статус
            $theoryUser->pivot->update(['is_passed' => true]);
        } else {
            // Если записи нет, создаем новую
            $user->theories()->attach($theory->id, ['is_passed' => true]);
        }

        return redirect()->back()->with('success', 'Раздел отмечен как пройденный');
    }
}
