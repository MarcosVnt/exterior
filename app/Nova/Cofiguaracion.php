<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;


use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laraning\NovaTimeField\TimeField;

use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;


class Cofiguaracion extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Jornada';
    
    
    public static $group = 'ZAdmin';

        /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Configuracion';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'descripcion';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','fecha','hora','descripcion','fecha_real','hora_real'
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
            BelongsTo::make('User')
            ->searchable()
            
            ->rules('required'), 
            DateTime::make('fecha')
            ->format('YYYY-MM-DD')
            ->sortable()
            ->rules('required'), 
            TimeField::make('hora'),
         
            DateTime::make('fecha_real')
            ->format('YYYY-MM-DD')
            ->sortable()
            ->rules('required'), 
            TimeField::make('hora_real'),
            Text::make('descripcion')
            ->sortable(), 
            Text::make('observaciones')
            ->sortable(), 

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
        return [];
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
            new Filters\FiltroJornadasPorUsuario,
            new Filters\FiltroJornadasPorDia,
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
