<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Image;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\LocationResource;
use App\MoonShine\Resources\TransportResource;
use App\MoonShine\Resources\InfrastructureResource;
use App\MoonShine\Resources\ArchitectureResource;
use App\MoonShine\Resources\ProjectMediaResource;

/**
 * @extends ModelResource<Project>
 */
class ProjectResource extends ModelResource
{
    protected string $model = Project::class;

    protected string $title = 'Проекты';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название','name'),
            BelongsTo::make('Местоположение', 'location', fn($item) => $item->city ?? '-')
                    ->searchable(),
            Enum::make('Статус', 'status')
                ->attach(ProjectStatusEnum::class)
                ->default(ProjectStatusEnum::Uncompleted)
                ->required(),
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
                Text::make('Название','name'),
                Textarea::make('Описание','description'),
                Enum::make('Статус', 'status')
                    ->attach(ProjectStatusEnum::class)
                    ->default(ProjectStatusEnum::Uncompleted)
                    ->required(),
                Textarea::make('Инфраструктура (кратко)','infrastucture_info'),
                Textarea::make('Архитектура (кратко)','architecture_info'),
                Textarea::make('Окружение (кратко)','environment_info'),
                Textarea::make('Транспорт (кратко)','transport_info'),
                BelongsTo::make('Местоположение', 'location', fn($item) => $item->city ?? '-')
                    ->searchable(),
                RelationRepeater::make('Изображения', 'media', resource: ProjectMediaResource::class)
                    ->vertical()
                    ->fields([
                        ID::make(),
                        Enum::make('Тип', 'type')
                            ->attach(ProjectTypeEnum::class)
                            ->default(ProjectTypeEnum::title)
                            ->required(),
                        Image::make('Изображение', 'media_path')
                            ->disk('public')    
                            ->dir('images/projects')
                            ->removable()
                            ->required(),
                    ]),
                HasOne::make('Транспорт (Блок подробнее)', 'transports', resource: TransportResource::class)
                    ->fields([
                        Textarea::make('Описание', 'text'),
                        Image::make('Изображение', 'media_path')
                            ->disk('public')    
                            ->dir('images/projects')
                            ->removable()
                            ->required(),
                    ]),
                HasOne::make('Инфраструктура (Блок подробнее)','infrastructures', resource: InfrastructureResource::class)
                    ->fields([
                        Textarea::make('Описание', 'text'),
                        Image::make('Изображение', 'media_path')
                            ->disk('public')    
                            ->dir('images/projects')
                            ->required(),
                    ]),
                HasOne::make('Архитектура (Блок подробнее)', 'architectures', resource: ArchitectureResource::class)
                    ->fields([
                        Textarea::make('Описание', 'text'),
                        Image::make('Изображение', 'media_path')
                            ->disk('public')    
                            ->dir('images/projects')
                            ->required(),
                    ]),
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
            Text::make('Название','name'),
            BelongsTo::make('Местоположение', 'location', resource: LocationResource::class)
                    ->searchable()
                    ->nullable(),
        ];
    }

    /**
     * @param Project $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
