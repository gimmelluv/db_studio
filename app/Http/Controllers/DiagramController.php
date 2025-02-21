<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use Illuminate\Http\Request;

class DiagramController extends Controller
{
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
}
