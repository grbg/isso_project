<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\ApartmentMediaResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\ApartmentResource;
use App\MoonShine\Resources\ArchitectureResource;
use App\MoonShine\Resources\InfrastructureResource;
use App\MoonShine\Resources\LocationResource;
use App\MoonShine\Resources\NewsMediaResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\ProjectMediaResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\TransportResource;

final class MoonShineLayout extends CompactLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuItem::make('ApartmentMedia', ApartmentMediaResource::class),
            MenuItem::make('Apartments', ApartmentResource::class),
            MenuItem::make('Architectures', ArchitectureResource::class),
            MenuItem::make('Infrastructures', InfrastructureResource::class),
            MenuItem::make('Locations', LocationResource::class),
            MenuItem::make('NewsMedia', NewsMediaResource::class),
            MenuItem::make('News', NewsResource::class),
            MenuItem::make('ProjectMedia', ProjectMediaResource::class),
            MenuItem::make('Projects', ProjectResource::class),
            MenuItem::make('Transports', TransportResource::class),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
