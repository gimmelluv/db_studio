<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Theory;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\UI\Fields\Switcher;

/**
 * @extends ModelResource<Theory>
 */
class TheoryResource extends ModelResource
{
    protected string $model = Theory::class;

    protected string $title = 'Theories';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title', 'title')->sortable(),
            Text::make('Subtitle', 'subtitle')->sortable(),
            Date::make('Created At', 'created_at')->format('Y-m-d')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('Title', 'title')->required(),
                Text::make('Subtitle', 'subtitle')->required(),
                Textarea::make('Content', 'content')->required(),
                Date::make('Created At', 'created_at')->format('Y-m-d')->withTime(),
            ]),

            BelongsToMany::make('Users', 'users', 'name')
                ->fields([
                    Switcher::make('Пройдено', 'is_passed'),
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
            Text::make('Title', 'title'),
            Text::make('Subtitle', 'subtitle'),
            Textarea::make('Content', 'content'),
            Date::make('Created At', 'created_at')->format('Y-m-d'),
        ];
    }

    /**
     * @param Theory $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];
    }

}
