<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\DateFilter;
use Carbon\Carbon;

class FiltroJornadasPorDia extends DateFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
 
    public $title = 'Filtra por Dia Desde';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {


        
        $value = Carbon::parse($value);
        return $query->where('fecha', '=', Carbon::parse($value));
        


        $hoy = Carbon::parse($value);
        $value = Carbon::parse($value);
        $tumorro = Carbon::parse($value);
        
       
       // $tumorro = Carbon::parse(Carbon::tomorrow('Europe/Madrid'));
       $tumorro = $tumorro->addDay();
   
        return $query->where('fecha', '>=', Carbon::parse($hoy))
        ->where( 'fecha','<=', Carbon::parse($tumorro)); 
    
    }

}
