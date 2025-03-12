<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiagramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagrams = Auth::user()->diagrams;
        return view('laboratory.index', compact('diagrams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laboratory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Пожалуйста, авторизуйтесь.');
        }

        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:xml,drawio,xslt,xbl,xsl,svg,png',
        ]);

        $filePath = $request->file('file')->store('diagrams', 'public');
    
        // Автоматически добавляем user_id текущего пользователя
        Auth::user()->diagrams()->create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);
    
        return redirect()->route('laboratory.index')->with('success', 'Диаграмма успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagram $diagram)
    {
        // Проверка, что диаграмма принадлежит текущему пользователю
        if ($diagram->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этой диаграмме.');
        }

        return view('laboratory.show', compact('diagram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagram $diagram)
    {
        // Проверка, что диаграмма принадлежит текущему пользователю
        if ($diagram->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этой диаграмме.');
        }

        return view('laboratory.edit', compact('diagram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagram $diagram)
    {
        // Проверка, что диаграмма принадлежит текущему пользователю
        if ($diagram->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этой диаграмме.');
        }

        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $diagram->update([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('laboratory.index')->with('success', 'Диаграмма успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagram $diagram)
    {
        // Проверка, что диаграмма принадлежит текущему пользователю
        if ($diagram->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этой диаграмме.');
        }

        Storage::disk('public')->delete($diagram->file_path);
        $diagram->delete();

        return redirect()->route('laboratory.index')->with('success', 'Диаграмма успешно удалена!');
    }
}
