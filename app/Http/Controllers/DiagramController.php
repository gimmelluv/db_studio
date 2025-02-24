<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use Illuminate\Http\Request;

class DiagramController extends Controller
{
    public function update($id)
    {
        request()->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $diagram = Diagram::findOrFail($id);

        $diagram->update([
            'type' => request('type'),
            'title' => request('title'),
            'description' => request('description'),
        ]);

        return redirect('/laboratory/' . $diagram->id);
    }

    public function destroy($id)
    {
        $diagram = Diagram::findOrFail($id);
        $diagram->delete();

        return redirect()->route('laboratory.index');
    }

    public function edit($id)
    {
        $diagram = Diagram::find($id);

        return view('laboratory.edit', ['diagram' => $diagram]);
    }

    // Метод для отображения полной информации о диаграмме
    public function show($id)
    {
        $diagram = Diagram::findOrFail($id); // Находим диаграмму по ID
        return view('laboratory.show', compact('diagram')); // Передаем данные в шаблон
    }

    public function create()
    {
        return view('laboratory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => [
                'required',
                'file',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    $allowedExtensions = ['drawio', 'xml', 'xslt', 'xbl', 'xsl', 'svg', 'png'];
                    
                    if (!in_array($extension, $allowedExtensions)) {
                        $fail('Файл должен быть в одном из следующих форматов: ' . implode(', ', $allowedExtensions));
                    }

                    // Проверяем XML-подобные файлы
                    if (in_array($extension, ['drawio', 'xml', 'xslt', 'xbl', 'xsl'])) {
                        $content = file_get_contents($value->getRealPath());
                        if (!$this->isValidXML($content)) {
                            $fail('Файл должен быть корректным XML документом.');
                        }
                    }
                }
            ]
        ], [
            'file.required' => 'Необходимо загрузить файл',
        ]);

        try {
            // Получаем оригинальное имя файла
            $originalName = $request->file('file')->getClientOriginalName();
            
            // Сохраняем файл с оригинальным именем
            $filePath = $request->file('file')->storeAs(
                'diagrams',
                $originalName,
                'public'
            );

            // Создаем запись в БД
            Diagram::create([
                'type' => $request->type,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath
            ]);

            return redirect('/laboratory')->with('success', 'Диаграмма успешно сохранена');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Произошла ошибка при сохранении диаграммы')
                ->withInput();
        }
    }

    private function isValidXML($content)
    {
        try {
            $xml = new \DOMDocument();
            $xml->loadXML($content);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function index()
    {
        $diagrams = Diagram::orderBy('created_at', 'desc')->get();

        // Возврат представления с данными диаграмм
        return view('laboratory.index', compact('diagrams'));
        }
}
