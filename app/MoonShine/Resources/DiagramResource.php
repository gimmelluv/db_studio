<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Diagram;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Diagram>
 */
class DiagramResource extends ModelResource
{
    protected string $model = Diagram::class;

    protected string $title = 'Диаграммы';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title')->sortable(), // Добавляем название диаграммы
            Select::make('Тип', 'type') // Добавляем тип диаграммы
                ->options([
                    'type1' => 'Задание 1',
                    'type2' => 'Задание 2',
                    'type3' => 'Задание 3',
                ])
                ->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->sortable(),

                Select::make('Тип', 'type')
                    ->options([
                        'type1' => 'Задание 1',
                        'type2' => 'Задание 2',
                        'type3' => 'Задание 3',
                    ])
                    ->required(),

                Text::make('Название', 'title')
                    ->required(),

                Textarea::make('Описание', 'description')
                    ->required(),

                File::make('Файл', 'file_path')
                    ->dir('diagrams') // Папка для хранения файлов
                    ->allowedExtensions(['xml', 'drawio', 'xslt', 'xbl', 'xsl', 'svg', 'png'])
                    ->removable(),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Textarea::make('Описание', 'description'),
            Select::make('Тип', 'type')
                ->options([
                    'type1' => 'Задание 1',
                    'type2' => 'Задание 2',
                    'type3' => 'Задание 3',
                ]),
            File::make('Файл', 'file_path'),
        ];
    }

    /**
     * @param Diagram $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file_path' => 'sometimes|file|mimes:xml,drawio,xslt,xbl,xsl,svg,png',
        ];
    }

    // public function onSave(Model $item): Model      здесь создание диаграммы через админа
    // {
    //     // Автоматически заполняем user_id текущего пользователя
    //     if (auth('moonshine')->check()) {
    //         $item->user_id = auth('moonshine')->user()->id;
    //     }

    //     return $item;
    // }
}
