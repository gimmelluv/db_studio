<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DiagramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Получаем текущего пользователя

        $diagrams = $user->diagrams()
            ->when(request('status'), fn($q, $status) => $q->where('status', $status))
            ->orderBy('status')
            ->orderByDesc('updated_at')
            ->paginate(9); // или simplePaginate()
    
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
    
        // Определяем статус
        $status = $request->input('action') === 'submit' ? 'review' : 'draft';

        // Создаем диаграмму
        $diagram = Diagram::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'user_id' => Auth::id(), // Явно указываем user_id
            'status' => $status,
        ]);

        $message = $status === 'review' ? 'Диаграмма отправлена на проверку!' : 'Диаграмма сохранена как черновик!';

        return redirect()->route('laboratory.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $diagram = Diagram::findOrFail($id);

        Log::info('Diagram data:', $diagram->toArray());

        return view('laboratory.show', compact('diagram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $diagram = Diagram::findOrFail($id);

        // Запрет редактирования проверенных работ
        if ($diagram->status === 'approved') {
            return redirect()->route('laboratory.show', $diagram)
                ->with('error', 'Проверенные работы нельзя редактировать.');
        }

        return view('laboratory.edit', compact('diagram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            // Попытка найти диаграмму по ID
        $diagram = Diagram::findOrFail($id);

        // Проверка, что диаграмма принадлежит текущему пользователю
        if ($diagram->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этой диаграмме.');
        }

        // Запрет редактирования проверенных работ
        if ($diagram->status === 'approved') {
            return redirect()->route('laboratory.show', $diagram)
                ->with('error', 'Проверенные работы нельзя редактировать.');
        }

        // Валидация входящих данных
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => 'sometimes|file|mimes:xml,drawio,xslt,xbl,xsl,svg,png',
        ]);

        $data = [
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Обновление файла если загружен новый
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($diagram->file_path);
            $data['file_path'] = $request->file('file')->store('diagrams', 'public');
        }

        // Обновление статуса если отправлено на проверку
        if ($request->input('action') === 'submit') {
            $data['status'] = 'review';
        }

        $diagram->update($data);

        $message = $request->input('action') === 'submit'
            ? 'Диаграмма отправлена на проверку!'
            : 'Изменения сохранены!';

        return redirect()->route('laboratory.index')->with('success', 'Диаграмма успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
            // Попытка найти диаграмму по ID
        $diagram = Diagram::findOrFail($id);

        // Проверка, что диаграмма принадлежит текущему пользователю
        if ($diagram->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этой диаграмме.');
        }

        Log::info('Attempting to delete diagram:', $diagram->toArray());

        // Проверяем, существует ли file_path
        if ($diagram->file_path) {
            // Удаляем файл из хранилища
            Storage::disk('public')->delete($diagram->file_path);
        } else {
            Log::warning('File path is null for diagram:', $diagram->toArray());
        }

        // Удаляем диаграмму из базы данных
        $diagram->delete();

        return redirect()->route('laboratory.index')->with('success', 'Диаграмма успешно удалена.');
    }
}
