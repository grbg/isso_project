<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transport;
use App\Models\Project;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\TransportResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Transport>
 */
class TransportResource extends ModelResource
{
    protected string $model = Transport::class;

    protected string $title = 'Блок транспортной деятельности';
    
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
            Select::make('Проект', 'project_id')
                ->options(
                    Project::query()
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
        ];
    }

    /**
     * @param Transport $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
