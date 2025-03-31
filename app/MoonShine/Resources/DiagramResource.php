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
use MoonShine\Filters\SelectFilter;

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
            Select::make('Статус', 'status')
                ->options([
                    Diagram::STATUS_DRAFT => 'Черновик',
                    Diagram::STATUS_REVIEW => 'На проверке',
                    Diagram::STATUS_APPROVED => 'Проверено',
                ])
                ->badge(function($status) {
                    return match($status) {
                        Diagram::STATUS_DRAFT => 'warning',
                        Diagram::STATUS_REVIEW => 'info',
                        Diagram::STATUS_APPROVED => 'success',
                        default => 'default',
                    };
                })
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

                Select::make('Статус', 'status')
                    ->options([
                        Diagram::STATUS_DRAFT => 'Черновик',
                        Diagram::STATUS_REVIEW => 'На проверке',
                        Diagram::STATUS_APPROVED => 'Проверено',
                    ])
                    ->required(),

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

                Textarea::make('Комментарий администратора', 'admin_comment')
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
            Textarea::make('Комментарий администратора', 'admin_comment'),
            Select::make('Статус', 'status')
                ->options([
                    Diagram::STATUS_DRAFT => 'Черновик',
                    Diagram::STATUS_REVIEW => 'На проверке',
                    Diagram::STATUS_APPROVED => 'Проверено',
                ]),
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
            'status' => 'required',
            'file_path' => 'sometimes|file|mimes:xml,drawio,xslt,xbl,xsl,svg,png',
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         TextFilter::make('Статус', 'status')
    //     ];
    // }
}
