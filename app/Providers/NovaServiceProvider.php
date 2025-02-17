<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use Rotunova2\MailCard\MailCard;
use Rotunova2\Accesoemailfoto\Accesoemailfoto;
use Rotunova2\FotosultimasCard\FotosultimasCard;

//use DmitryBubyakin\NovaMedialibraryField\Fields\MediaLibrary;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
       /*  Nova::resources([
            \DmitryBubyakin\NovaMedialibraryField\Resources\Media::class,
        ]); */
       
    }

    /**
     * Register the Nova routes.
     *
     * @return voidcom
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            //new Help,
           // new MailCard,
          (new FotosultimasCard)->width('full'),

          (new Accesoemailfoto)->width('2/3'),

          
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
