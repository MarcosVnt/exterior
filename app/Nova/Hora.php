<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;

use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;


class Hora extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\ObraMano';
    public static $group = 'Tablas';

    public static function perPageOptions()
    {
        return [50, 100, 150];
    }


    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'texto';
   

    public static $perPageOptions = [15, 50, 100, 150];



    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','texto','de_fecha_hora','a_fecha_hora',
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
            ->sortable()
            ->rules('required'), 

            BelongsTo::make('Obra')
            ->sortable()
            ->rules('required'), 

           Text::make('texto')
            ->sortable()
            ->rules('required'), 

            DateTime::make('de_fecha_hora')
            ->format('YYYY-MM-DD HH:mm')
            ->sortable()
            ->rules('required'), 

            DateTime::make('a_fecha_hora')
            ->format('YYYY-MM-DD HH:mm')
            ->sortable()
            ->rules('required'), 

     /*        Number::make('Cantidad', function () {
                return round(($this->de_fecha_hora->diffInMinutes($this->a_fecha_hora))*0.0166667,4);
            }),
 */
  Text::make('Cantidad', function () {
             
if($this->de_fecha_hora || $this->a_fecha_hora){
    $uno =  $this->de_fecha_hora->diff($this->a_fecha_hora); 
    $dos = $uno->format('%h').'.'.$uno->format('%i'); 
    $dos = floatval($dos);
    $horas = $uno->format('%h');
    $horas = floatval($horas)*60;
    $min = $uno->format('%i');
    $min = floatval($min);
    $totalMin = $horas + $min;

    $h = 0.0166667;
    $dos = $totalMin *$h ;
    $dos = round($dos, 4);
}else {
    $dos = 0 ;
}

                return $dos;
          //  return $this->de_fecha_hora->diff($this->a_fecha_hora, 'hours');
            }), 

        ];
    }

    public function calcularCantidad($inicio , $fin){

    } 

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [new Metrics\HorasPorDia, new Metrics\HorasRealizadas];
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
            new Filters\FiltroPorUsuarioHoras,
            new Filters\FiltroPorUsuarioDia,
            new Filters\FiltroPorUsuarioHorasHasta,
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
