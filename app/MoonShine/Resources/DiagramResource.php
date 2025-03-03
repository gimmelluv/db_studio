<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\MoonShine\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use App\Models\Diagram;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo as RelationshipsBelongsTo;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Diagram>
 */
class DiagramResource extends ModelResource
{
    protected string $model = Diagram::class;

    protected string $title = 'Diagrams';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Тип', 'type'),
            Text::make('Название', 'title'),
            Text::make('Описание', 'description'),
            File::make('Файл', 'file_path'),
            RelationshipsBelongsTo::make('Пользователь', 'user', 'name')
            ->resource(UserResource::class), // Укажите ресурс
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Тип', 'type')->required(),
                Text::make('Название', 'title')->required(),
                Textarea::make('Описание', 'description')->required(),
                File::make('Файл', 'file_path')
                ->dir('diagrams')
                ->disk('public')
                ->allowedExtensions(['jpg', 'png', 'pdf']),
                RelationshipsBelongsTo::make('Пользователь', 'user', 'name')
                    ->resource(UserResource::class) // Укажите ресурс
                    ->nullable(),
            ]),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Тип', 'type'),
            Text::make('Название', 'title'),
            Text::make('Описание', 'description'),
            File::make('Файл', 'file_path'),
            RelationshipsBelongsTo::make('Пользователь', 'user', 'name')
            ->resource(UserResource::class),
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
            'type' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file_path' => ['nullable', 'file', 'mimes:xml,drawio,xslt,xbl,xsl,svg,png'],
        ];
    }
}
