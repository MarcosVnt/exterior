<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;

use Laravel\Nova\Fields\Number;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\DateTime;

use Laravel\Nova\Http\Requests\LensRequest;
use Carbon\Carbon;
use App\Nova\Filters\ListaUsuarios;

class UsuarioDiaHoras extends Lens
{

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    
    public static function query(LensRequest $request, $query)
    {
       
        return $request->withOrdering($request->withFilters(
           // $query
           /*OPCION A COLUMNS
           $query->select(self::columns())
                  ->join('obra_mano', 'users.id', '=', 'obra_mano.user_id')
                  ->orderBy('obra_mano.de_fecha_hora', 'desc')
                  ->groupBy('users.id', 'users.name') */

                  $query->select([
                    'users.id',
                    'users.name',
                    'obra_mano.de_fecha_hora',
                    'obra_mano.a_fecha_hora',
                    DB::raw('sum(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)) as horas'),
            
                  ])
                  ->join('obra_mano', 'users.id', '=', 'obra_mano.user_id')
                  ->where('obra_mano.de_fecha_hora', '>',Carbon::yesterday())
                //  $posts = Post::whereDate('created_at', Carbon::today())->get();

                  ->orderBy('obra_mano.de_fecha_hora', 'desc')
                 // ->groupBy('users.id', 'users.name')

        ));
    }
   /*  ObraMano::join('obras','obras.id', '=', 'obra_mano.obra_id')
    ->join('users', 'obra_mano.user_id', '=', 'users.id')
//          ->select('DATEDIFF(hh,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) as horas','obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')
   // ->select(DB::raw("DATEDIFF(hour,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS horas"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')
   ->select(DB::raw("TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS horas"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')

    ->where([['users.id' , '=',$user],['obra_mano.condicion' , '=', '1']]) 
   //->whereDate('obra_mano.de_fecha_hora', '=', Carbon::today()->toDateString())
   ->whereDate('obra_mano.de_fecha_hora', '=', $fecha)
   ->orderBy('obra_mano.a_fecha_hora','DESC')
    ->paginate(50); */

    protected static function columns()
    {
        return [
            /* 'users.id',
            'users.name',
            DB::raw('sum(licenses.price) as revenue'), */
            'users.id',
            Carbon::today(),
            'users.name',
            'obra_mano.de_fecha_hora',
            'obra_mano.a_fecha_hora',
            DB::raw('sum(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)) as horas'),
          //  DB::raw('sum(obramano.price) as revenue'),
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        //dd($request->columns);
       /*  return [
            ID::make('ID', 'id')->sortable(),
        ]; */
        return [
            ID::make('ID', 'id'),

            Text::make('NOmbre', 'name'),
            
Text::make('hoy', Carbon::today()),
            
            Text::make('De Fecha Hora', 'de_fecha_hora'),
            Text::make('A Fecha Hora', 'a_fecha_hora'),

           /*  DateTime::make('de_fecha_hora')
            ->format('YYYY-MM-DD HH:mm')
            ->sortable()
            ->rules('required'),  */

           /*  Number::make('Days to win', function () {
                return $this->de_fecha_hora->diffInDays($this->a_fecha_hora);
            }), */
            
            Number::make('Minutos', 'horas', function ($value) {
                return 'M:'.number_format($value, 2);
            }),
            Number::make('Horas', 'horas', function ($value) {
                
                if($value<=60) {
                    $value= $value/100;
                }else{
                    $value = $value/60;
                }
                
                return 'H:'.number_format($value, 2);
            }),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
           

            new ListaUsuarios,
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'usuario-dia-horas';
    }
}
