<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectMedia;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Image;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<ProjectMedia>
 */
class ProjectMediaResource extends ModelResource
{
    protected string $model = ProjectMedia::class;

    protected string $title = 'Изображения проектов';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            BelongsTo::make('Проект', 'project', fn($item) => $item->name ?? '-')
                    ->searchable(),
            Select::make('Расположение изображения', 'type')
                ->options([
                    'title' => 'Баннер проекта',
                    'description' => 'Блок описания'
                ]),
            Image::make('Изображение', 'media_path')                    
                ->disk('public')
                ->dir('images/projects')
                ->removable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Image::make('Изображение', 'media_path')
                    ->disk('public')
                    ->dir('images/projects')
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
        ];
    }

    /**
     * @param ProjectMedia $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
