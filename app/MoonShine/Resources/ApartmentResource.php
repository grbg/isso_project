<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;
use App\Enums\ApartmentTypeEnum;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\ApartmentMediaResource;

/**
 * @extends ModelResource<Apartment>
 */
class ApartmentResource extends ModelResource
{
    protected string $model = Apartment::class;

    protected string $title = 'Квартиры';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Проект', 'project', fn($item) => $item->name ?? '-')
                ->searchable()
                ->nullable(),
            Enum::make('Тип', 'type')
                    ->attach(ApartmentTypeEnum::class)
                    ->default(ApartmentTypeEnum::studio)
                    ->required(),
            Number::make('Этаж','floor')
                    ->buttons(),
            Number::make('Площадь','area'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                BelongsTo::make('Проект', 'project', fn($item) => $item->name ?? '-')
                    ->searchable()
                    ->nullable(),
                Enum::make('Тип', 'type')
                    ->attach(ApartmentTypeEnum::class)
                    ->default(ApartmentTypeEnum::studio)
                    ->required(),
                Number::make('Этаж','floor')
                    ->buttons(),
                Number::make('Площадь','area'),
                BelongsTo::make('Чертеж', 'media', formatted: 'path', resource: ApartmentMediaResource::class)
                    ->withImage('path', 'public','images/apartments')
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
            BelongsTo::make('Проект', 'project', fn($item) => $item->name ?? '-')
                    ->searchable()
                    ->nullable(),
            Enum::make('Тип', 'type')
                ->attach(ApartmentTypeEnum::class)
                ->default(ApartmentTypeEnum::studio)
                ->required(),
            Number::make('Этаж','floor')
                ->buttons(),
            Number::make('Площадь','area'),
        ];
    }

    /**
     * @param Apartment $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
