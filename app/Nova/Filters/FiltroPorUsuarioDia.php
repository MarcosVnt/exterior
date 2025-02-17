<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Laravel\Nova\Filters\DateFilter;

class FiltroPorUsuarioDia extends DateFilter
{
    public $name = 'Filtro por Día DESDE';
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply2(Request $request, $query, $value)
    {
//dd($request, $query, $value);
        $value = Carbon::parse($value);
        return $query->where('de_fecha_hora', '=', Carbon::parse($value));
        
        $hoy = Carbon::parse($value);

        $value = Carbon::parse($value);
        $tumorro = Carbon::parse($value);

        $today = Carbon\Carbon::parse($value)->format('Y-m-d').'%';

return $query->where('de_fecha_hora', '>=', $today);
       
       // $tumorro = Carbon::parse(Carbon::tomorrow('Europe/Madrid'));
       $tumorro = $tumorro->addDay();
   /*   echo($value);
     echo($hoy);
     echo($tumorro); */
        
//dd($value);
//return $query->where('de_fecha_hora','>=','2019-02-21 00:00')->where('de_fecha_hora','<=', '2019-02-21 23:59');
        //return $query->where('de_fecha_hora','>=', $value.'00:00')->where('de_fecha_hora','<=', $value.' 23:59');
        //return $query->where('de_fecha_hora','>=', $value->format('m/d/Y'))->where('de_fecha_hora','<=', $value->format('m/d/Y'));
        //return $query->where('a_fecha_hora', '>=', Carbon::parse($value))->Orwhere('a_fecha_hora', '<=', Carbon::parse($value));
       // si oi
        return $query->where('de_fecha_hora', '>=', Carbon::parse($hoy))
        ->where( 'a_fecha_hora','<', Carbon::parse($to));
    }
    public function apply(Request $request, $query, $value)
    {



        $value = Carbon::parse($value);
        return $query->where('de_fecha_hora', '>=', Carbon::parse($value));


        //dd($request, $query, $value);


      /*  $value = Carbon::parse($value);
        return $query
        
        ->whereDate('de_fecha_hora', '<=', Carbon::parse($value))
        ->whereDate('de_fecha_hora', '>=', Carbon::parse($value)); 
 */

        //return $query->where('birthday', '<=', Carbon::parse($value));

        
     
    }
}
