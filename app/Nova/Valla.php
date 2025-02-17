<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;



class Valla extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Valla';
    public static $group = 'Vallas';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nombre';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','dni','nombre','direccion','poblacion','postal','email'
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
            Text::make('dni')->sortable()->rules('required','max:255'),

           
            Text::make('nombre')->sortable()->rules('required','max:255'),
            Text::make('direccion')->sortable()->rules('required','max:255'),
            Text::make('poblacion')->sortable()->rules('required','max:255'),
            Text::make('postal')->sortable()->rules('required','max:255'),
            Text::make('provincia')->sortable()->rules('required','max:255'),
            Number::make('telefono')->sortable(),
            Text::make('email')->sortable()->rules('required','max:255'),

            Number::make('latitud')->sortable(),
            Number::make('longitud')->sortable(),
            Number::make('ancho')->sortable(),
            Number::make('alto')->sortable(),
            Number::make('m2')->sortable(),
            Text::make('tipo')->sortable()->rules('required','max:255'),
            Text::make('elemento')->sortable()->rules('required','max:255'),
            Text::make('estado')->sortable()->rules('required','max:255'),





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
