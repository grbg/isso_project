<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\LocationResource;
use App\MoonShine\Resources\ApartmentResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\TransportResource;
use App\MoonShine\Resources\InfrastructureResource;
use App\MoonShine\Resources\ArchitectureResource;
use App\MoonShine\Resources\ProjectMediaResource;
use App\MoonShine\Resources\ApartmentMediaResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\NewsMediaResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $config 
            ->locale('ru')
            ->locales(['en', 'ru']);
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                LocationResource::class,
                ApartmentResource::class,
                ProjectResource::class,
                TransportResource::class,
                InfrastructureResource::class,
                ArchitectureResource::class,
                ProjectMediaResource::class,
                ApartmentMediaResource::class,
                NewsResource::class,
                NewsMediaResource::class,            
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
