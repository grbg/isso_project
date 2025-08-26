<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\NewsMedia;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\NewsResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;

/**
 * @extends ModelResource<NewsMedia>
 */
class NewsMediaResource extends ModelResource
{
    protected string $model = NewsMedia::class;

    protected string $title = 'Изображения новостей';

    public static string $titleField = 'media_path';
    
    public function title(): string
    {
        // можно вывести название файла или путь, или, например, "Изображение #id"
        return basename($this->media_path);
    }

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'news.title'),
            Image::make('Изображение', 'media_path')
                ->disk('public')
                ->dir('images/news')
                ->allowedExtensions(['jpg','png','webp'])    
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
                HasOne::make('Новость', 'news', fn($item) => $item->title ?? '-'),
                Image::make('Изображение', 'media_path')
                    ->disk('public')
                    ->dir('images/news')
                    ->allowedExtensions(['jpg','png','webp'])    
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
            Image::make('Изображение', 'media_path')
                    ->disk('public')
                    ->dir('images/news')
                    ->allowedExtensions(['jpg','png','webp'])    
                    ->removable()
                    ->required()
        ];
    }

    /**
     * @param NewsMedia $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
