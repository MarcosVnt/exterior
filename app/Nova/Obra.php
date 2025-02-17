<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

use Rotunova2\MailCard\MailCard;

class Obra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Obra';
    public static $group = 'Tablas';


    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nombre';


     public function title() {

        return $this->nombre .'-'.$this->codigo;
    } 

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','codigo','nombre','descripcion'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('codigo')
                ->rules('required')
                ->sortable(),
            Text::make('nombre')
                ->rules('required')
                ->sortable(),
            Textarea::make('descripcion')
                ->sortable(),
                Text::make('movil')
                ->sortable(),
                Text::make('email')
                ->sortable(),
                Text::make('slug')
                ->rules('required')
                ->sortable(),
            Text::make('cliente')
                ->sortable(),
            Text::make('fecha_alta')
                ->sortable(),
                BelongsToMany::make('Users'),
                HasMany::make('Horas'),
                HasMany::make('Fotos'),


        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
         (new Metrics\HorasPorDia)->width('1/3')->onlyOnDetail(), 
          (new MailCard)->width('full')->onlyOnDetail(),
        // (new CardUltimasFotos)->width('full')->onlyOnDetail(),



        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\FiltroPorObra,

        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,

        ];
    }
}
