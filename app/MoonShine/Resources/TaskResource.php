<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Task>
 */
class TaskResource extends ModelResource
{
    protected string $model = Task::class;

    protected string $title = 'SQL задания';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title'),
            Text::make('Описание', 'description'),
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
                Text::make('Название', 'title')
                    ->required(),
                Textarea::make('Описание', 'description')
                    ->required(),
                Textarea::make('Решение', 'solution')
                    ->required(),
                Textarea::make('Проверочный запрос', 'check_query')
                    ->required(),
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
            Textarea::make('Решение', 'solution'),
            Textarea::make('Проверочный запрос', 'check_query'),
        ];
    }

    /**
     * @param Task $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'solution' => ['required', 'string'],
            'check_query' => ['required', 'string'],
        ];
    }
}
