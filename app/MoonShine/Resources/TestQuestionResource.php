<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\TestQuestion;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<TestQuestion>
 */
class TestQuestionResource extends ModelResource
{
    protected string $model = TestQuestion::class;

    protected string $title = 'TestQuestions';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Вопрос', 'question')->sortable(),
            Number::make('Баллы', 'score')->sortable(),
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
                Textarea::make('Текст вопроса', 'question')
                    ->required(),
                Json::make('Варианты ответов', 'options')
                    ->keyValue('Ключ (A, B, C...)', 'Текст ответа')
                    ->removable()
                    ->required(),
                Text::make('Правильный ответ', 'correct_answer')
                    ->required(),
                Number::make('Баллы за вопрос', 'score')
                    ->required()
                    ->min(1),
                BelongsTo::make('Тест', 'test', 'title') // Добавьте это поле
                    ->required() // Убедитесь, что это поле обязательно
                    ->searchable(), // Если хотите, чтобы оно было доступно для поиска
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
            Textarea::make('Текст вопроса', 'question'),
            Json::make('Варианты ответов', 'options'),
            Text::make('Правильный ответ', 'correct_answer'),
            Number::make('Баллы за вопрос', 'score'),
        ];
    }

    /**
     * @param TestQuestion $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'question' => 'required|string',
            'options' => 'required|array',
            'correct_answer' => 'required|string',
            'score' => 'required|integer|min:1',
        ];
    }
}
