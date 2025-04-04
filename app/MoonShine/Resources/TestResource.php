<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

use App\MoonShine\Resources\TestQuestionResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Test>
 */
class TestResource extends ModelResource
{
    protected string $model = Test::class;

    protected string $title = 'Tests';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title')->sortable(),
            BelongsTo::make('Раздел теории', 'theory', 'title')->sortable(),
            Number::make('Мин. балл', 'min_score')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make(),
                BelongsTo::make('Раздел теории', 'theory', 'title')
                    ->required()
                    ->searchable(),
                Text::make('Название теста', 'title')
                    ->required(),
                Textarea::make('Описание', 'description'),
                Number::make('Минимальный проходной балл', 'min_score')
                    ->required()
                    ->min(1),
            ]),
            
            Box::make('Вопросы теста', [
                HasMany::make('Вопросы', 'questions', resource: TestQuestionResource::class) // Убедитесь, что вы передаете класс напрямую
                    ->creatable(),
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
            BelongsTo::make('Раздел теории', 'theory', 'title'),
            Text::make('Название', 'title'),
            Textarea::make('Описание', 'description'),
            Number::make('Мин. балл', 'min_score'),
            HasMany::make('Вопросы', 'questions', resource: TestQuestionResource::class)
                    ->creatable(),
        ];
    }

    /**
     * @param Test $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'theory_id' => 'required|exists:theories,id',
            'title' => 'required|string|max:255',
            'min_score' => 'required|integer|min:1',
        ];
    }
}
