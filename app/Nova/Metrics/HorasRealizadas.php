<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use App\ObraMano;


class HorasRealizadas extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
       /*  $a =  $this->count($request, ObraMano::class,function () {
            return round(($request->de_fecha_hora->diffInMinutes($request->a_fecha_hora))*0.0166667,4);
        });  */
      //  dd($request->de_fecha_hora);
        return $this->count($request, ObraMano::class);
       // round(($request->de_fecha_hora->diffInMinutes($request->a_fecha_hora))*0.0166667,4)
   // );
      // $horas= DB::table('roles')->pluck('title', 'name');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => '30 Días',
            60 => '60 Días',
            365 => '365 Diías',
            'MTD' => 'Ultimo Mes',
            'QTD' => 'Ultimo Trimestre',
            'YTD' => 'Ultimo Año',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'horas-realizadas';
    }
}
