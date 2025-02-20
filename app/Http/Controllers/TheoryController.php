<?php

namespace App\Http\Controllers;

use App\Models\Theory;
use Illuminate\Http\Request;

class TheoryController extends Controller
{
    public function index()
    {
        // Извлекаем все записи из таблицы theories
        $theories = Theory::all();

        // Передаем данные в представление
        return view('theory.index', compact('theories'));
    }
}
