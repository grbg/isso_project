<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Architecture;
use App\Models\Project;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Select;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Architecture>
 */
class ArchitectureResource extends ModelResource
{
    protected string $model = Architecture::class;

    protected string $title = 'Блок архитектуры';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Проект', 'project', fn($item) => $item->name ?? '-')
                    ->searchable(),
            Textarea::make('Описание', 'text'),
            Image::make('Изображение', 'media_path')
                    ->disk('public')
                    ->dir('images/projects')    
                    ->removable()
                    ->required()
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
                Select::make('Проект', 'project_id')
                    ->options(
                        Project::query()
                            ->whereDoesntHave('architectures')
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->required(),
                Textarea::make('Описание', 'text'),
                Image::make('Изображение', 'media_path')
                    ->disk('public')    
                    ->dir('images/projects')
                    ->removable()
                    ->required()
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
            Textarea::make('Описание', 'text'),
            Image::make('Изображение', 'media_path')
                ->disk('public')   
                ->dir('images/projects') 
                ->removable()
                ->required()
        ];
    }

    /**
     * @param Architecture $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
