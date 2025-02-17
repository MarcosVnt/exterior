<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;


class Contrato extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Contrato';
    public static $group = 'Vallas';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','ejercicio','numero','referencia','descripcion','observaciones'
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
         
            
            Text::make('referencia')->sortable()->rules('required','max:255'),
            Text::make('descripcion')->sortable()->rules('required','max:255'),


            DateTime::make('fecha_inicio')
            ->format('DD-MM-YYYY')
            ->sortable()
            ->rules('required'), 

            DateTime::make('fecha_final')
            ->format('DD-MM-YYYY')
            ->sortable()
            ->rules('required'), 
            Text::make('forma_pago')->sortable()->rules('required','max:255'),
            Text::make('duracion')->sortable()->rules('required','max:255'),

            Number::make('importe_periodo')->sortable(),
            Number::make('alquiler_anual')->sortable(),


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
        return [];
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
        return [];
    }
}
