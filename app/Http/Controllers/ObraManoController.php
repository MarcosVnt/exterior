<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\ObraMano;
use App\Obra;
use App\ObraUser;
use App\Presupuesto;
use App\Events\MessageSent;

class ObraManoController extends Controller
{
   
  //
  
      public function index(Request $request)
      {
          
         // if (!$request->ajax()) return redirect('/');


         if($request->usuario){
            $user =$request->usuario ;
           }else{
            $user = Auth::user()->id;
           }
            //$user = Auth::user()->id;


  //dd($request->fecha);
          //dd(Auth::user());
          $buscar = $request->buscar;
          $criterio = $request->criterio;
          $fecha = $request->fecha;
          $user_id = 'user_id';
          
        $obraMano = ObraMano::join('obras','obras.id', '=', 'obra_mano.obra_id')
          ->join('users', 'obra_mano.user_id', '=', 'users.id')
//          ->select('DATEDIFF(hh,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) as horas','obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')
         // ->select(DB::raw("DATEDIFF(hour,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS horas"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')
         ->select(DB::raw("TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS horas"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto','obra_mano.tipo_trabajo','obra_mano.fin')

          ->where([['users.id' , '=',$user],['obra_mano.condicion' , '=', '1']]) 
         //->whereDate('obra_mano.de_fecha_hora', '=', Carbon::today()->toDateString())
         ->whereDate('obra_mano.de_fecha_hora', '=', $fecha)
         ->orderBy('obra_mano.a_fecha_hora','DESC')
          ->paginate(50);

//dd($obraMano);
          
          
              return [
              'pagination' => [
                  'total'        => $obraMano->total(),
                  'current_page' => $obraMano->currentPage(),
                  'per_page'     => $obraMano->perPage(),
                  'last_page'    => $obraMano->lastPage(),
                  'from'         => $obraMano->firstItem(),
                  'to'           => $obraMano->lastItem(),
              ],
              'obraMano' => $obraMano
          ];
  
          //dd($obraMano);
      }   

      public function listaHorasObra(Request $request)
      {
          //dd($request->obra);
         $obra = $request->obra;
          $buscar = $request->buscar;
          $criterio = $request->criterio;
          $fecha = $request->fecha;
          $user_id = 'user_id';
          
        $listaHorasObra = ObraMano::join('obras','obras.id', '=', 'obra_mano.obra_id')
          ->join('users', 'obra_mano.user_id', '=', 'users.id')
          ->select(DB::raw("TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS minutos"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')
          ->where([['obras.id' , '=',$obra],['obra_mano.condicion' , '=', '1']])
          ->orderBy('obra_mano.de_fecha_hora','DESC')
         //->whereDate('obra_mano.de_fecha_hora', '=', Carbon::today()->toDateString())
         //->whereDate('obra_mano.de_fecha_hora', '=', $fecha)
         // DB::raw("SUM(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)/ 3600) as result"),
          ->paginate(10);

          $listaTodasHorasObra = ObraMano::join('obras','obras.id', '=', 'obra_mano.obra_id')
          ->join('users', 'obra_mano.user_id', '=', 'users.id')
          ->select(DB::raw("TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS minutos"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto')
          ->where([['obras.id' , '=',$obra],['obra_mano.condicion' , '=', '1']])
            ->get();

//dd($listaHorasObra);
          
          
              return [
              'paginationH' => [
                  'total'        => $listaHorasObra->total(),
                  'current_page' => $listaHorasObra->currentPage(),
                  'per_page'     => $listaHorasObra->perPage(),
                  'last_page'    => $listaHorasObra->lastPage(),
                  'from'         => $listaHorasObra->firstItem(),
                  'to'           => $listaHorasObra->lastItem(),
              ], 
              'listaHorasObra' => $listaHorasObra,
              'listaTodasHorasObra' =>$listaTodasHorasObra
          ];
  
          //dd($obraMano);
      }   
      public function store(Request $request)
    {
       // dd($request);
        if ($request->obraId == 0){
            $obraNueva = Obra::where('codigo', $request->obraCodigo)->first();
            if (!$obraNueva) {
                Obra::create([
                'codigo' => $request->obraCodigo,
                'nombre' => $request->obraNombre,
                'slug'   => $request->obraCodigo
            ]);
            }else{
                //return;
                
            }
            $obraNueva = Obra::where('codigo',  $request->obraCodigo)->first();

        }
        //dd($obraNueva);


        $obraNueva = Obra::where('codigo',  $request->obraCodigo)->first();
    //echo($obraNueva);
//AÑADIR OBRA_USER
        //$obraNueva = Obra::firstOrCreate(['codigo' => $idObra],['nombre'=> '--')];
       // $user = Auth::user()->id;
        if($request->usuarioId){
            $user =$request->usuarioId ;
           }else{
            $user = Auth::user()->id;
           }



        $obraUsuarioNueva = ObraUser::where([['obra_id','=',$obraNueva->id],['user_id','=',$user]])->first();
        
        if (!$obraUsuarioNueva) {
            ObraUser::create([
            'obra_id' => $obraNueva->id,
            'user_id' => $user,
            'condicion'   => '1'
           
        ]);
        }else{
           
        }
        $obraUsuarioNueva = ObraUser::where([['obra_id','=',$obraNueva->id],['user_id','=',$user]])->first();
      //  dd($obraUsuarioNueva);
     
       
      //  if (!$request->ajax()) return redirect('/');
$fechaD=  $request->hoy.' '.$request->obraHoraD.':'.$request->obraMinutoD.':00';
$fechaA=  $request->hoy.' '.$request->obraHoraA.':'.$request->obraMinutoA.':00';
//dd( $fechaD);
echo  $fechaD.'<br>';
echo  $fechaA;
echo '<br>'.'----------------'.'<br>';
//$dateTimeString = $aDateString." ".$aTimeString;
$fechaDD = Carbon::createFromFormat('Y-m-d H:i:s', $fechaD, 'Europe/Madrid');   
$fechaAA = Carbon::createFromFormat('Y-m-d H:i:s', $fechaA, 'Europe/Madrid');   
echo  $fechaDD.'<br>';

echo  $fechaAA;


/* 
$fechaDD= DateTime::createFromFormat( 'Y-m-d H:i:s', $fechaDD);
$fechaAA= DateTime::createFromFormat( 'Y-m-d H:i:s', $fechaAA); */

echo($obraNueva);
      $obramano = new ObraMano();
      $obramano->obra_id =  $obraNueva->id;
      $obramano->user_id = $user;

      $obramano->de_fecha_hora = $fechaDD;
      $obramano->a_fecha_hora = $fechaAA;
      $obramano->tipo_hora = 'hora';

      $obramano->texto = $request->descripcionParte;
   
      $obramano->tipo_trabajo = $request->obraFamiliaHora;
      $obramano->fin = $request->obraFamiliaFin;

      $obramano->save();

      $obramano2 = (object) ['obra' => 'obranueva'];     
       $obramano2->obra_id =  $obraNueva->id;
      $obramano2->user_id = $user;

      $obramano2->de_fecha_hora = $fechaDD;
      $obramano2->a_fecha_hora = $fechaAA;
      $obramano2->tipo_hora = 'hora';

      $obramano2->texto = $request->descripcionParte;
   
      $obramano2->tipo_trabajo = $request->obraFamiliaHora;
      $obramano2->fin = $request->obraFamiliaFin;
      $obramano2->codigo = $obraNueva->codigo;

     // dd($obramano);

      event(new MessageSent($obramano2));

     
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        /* $obraMano = ObraMano::findOrFail($request->id);
        $obraMano->condicion = '0';
        $obraMano->save(); */
        $obraMano = ObraMano::find($request->id);
        $obraMano->delete();
        
        
        }


    public function demo2(Request $request){
              
        $obraMano = ObraMano::join('obras','obras.id', '=', 'obra_mano.obra_id')
        ->join('users', 'obra_mano.user_id', '=', 'users.id')
       ->select(DB::raw("TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora) AS horas"),'obra_mano.condicion','obra_mano.id as obraManoId','users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','obra_mano.texto','obra_mano.tipo_trabajo','obra_mano.fin')
        
        ->where([['obras.id' , '=','2006'],['obra_mano.condicion' , '=', '1']]) 
       //->whereDate('obra_mano.de_fecha_hora', '=', $fecha)
       ->groupBy('tipo_trabajo')
       ->orderBy('obra_mano.a_fecha_hora','DESC')
        ->paginate(50);



        $orders = DB::table('obra_mano')
        ->select('tipo_trabajo', 'user_id','obra_id','fin',
        DB::raw("SUM(fin) as final"),
        DB::raw("SUM(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)) AS horas"))
        ->groupBy('user_id','tipo_trabajo')
        //->havingRaw('SUM(horas) > ?', [2500])
        ->where([['obra_mano.obra_id' , '=','1828'],['obra_mano.condicion' , '=', '1']]) 
        ->get();



        
        $obras = DB::table('obra_mano')
        ->select('tipo_trabajo', 'user_id','obra_id','fin',
        DB::raw("SUM(fin) as final"),
        DB::raw("SUM(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)) AS horas"))
        ->groupBy('user_id','tipo_trabajo','obra_id')
        //->havingRaw('SUM(horas) > ?', [2500])
       // ->where([['obra_mano.obra_id' , '=','1828'],['obra_mano.condicion' , '=', '1']]) 
        ->get();






        return [
            //'obraMano' => $obraMano,
        'orders' => $orders,
        'obras' => $obras
    
    
    ];

        }




        

 public function demo(Request $request)
 {
     //if (!$request->ajax()) return redirect('/');

     $buscar = $request->buscar;
     $criterio = $request->criterio;
     $aceptado = "ACEPTADO";
     
     if ($buscar==''){
         $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
         ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion','presupuestos.fecha_entrega',
         'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name','presupuestos.codigo_obra')
         ->orWhere('presupuestos.estado', 'like', '%'. $aceptado . '%')
         
         ->orderBy('presupuestos.fecha_entrega', 'ASC')->paginate(30);
     }
     else{
         $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
         ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion','presupuestos.fecha_entrega',
         'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name','presupuestos.codigo_obra')
         ->Where('presupuestos.estado', 'like', '%'. $aceptado . '%')
         ->where(function ($query) use ($aceptado, $criterio,$buscar){

             $query->orWhere('presupuestos.'.$criterio, 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.nombre_fiscal', 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.trabajo_descripcion', 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.contacto', 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.id',  '=', $buscar )
             
                 ->orWhere('users.name',  'like', '%'. $buscar . '%');
                
         })
             
         ->orderBy('presupuestos.fecha_entrega', 'ASC')->paginate(30);

      

     }

     $datos = new collection();
     $obra = new collection();

     foreach ($presupuestos as $presupuesto){

        if($presupuesto->codigo_obra){
        
            $obra = Obra::where('codigo', $presupuesto->codigo_obra)->first();
            //echo $obra;

            if($obra){
          // dd($obra,$presupuesto->codigo_obra);    
                $orders = DB::table('obra_mano')
                ->join('obras', 'obra_mano.obra_id', '=', 'obras.id')
                ->join('users', 'obra_mano.user_id', '=', 'users.id')
                ->select('obra_mano.tipo_trabajo', 'obra_mano.user_id','obra_mano.obra_id','obra_mano.fin','obra_mano.id','users.name','obras.codigo',
                DB::raw("SUM(fin) as final"),
                DB::raw("SUM(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)) AS horas"))
                ->groupBy('obra_mano.user_id','obra_mano.tipo_trabajo')
                //->havingRaw('SUM(horas) > ?', [2500])
                ->where([['obra_mano.obra_id' , '=',$obra->id],['obra_mano.condicion' , '=', '1']])
                ->orderBy('obra_mano.tipo_trabajo') 
                ->get();

                
                if($orders->isNotEmpty())  {
                    $datos = $datos->concat(collect($orders));
            // dd($presupuesto->codigo_obra,$orders,$datos);
                }
            }

        }

    }

     
     return [
         'pagination' => [
             'total'        => $presupuestos->total(),
             'current_page' => $presupuestos->currentPage(),
             'per_page'     => $presupuestos->perPage(),
             'last_page'    => $presupuestos->lastPage(),
             'from'         => $presupuestos->firstItem(),
             'to'           => $presupuestos->lastItem(),
         ],
         'presupuestos' => $presupuestos,
         'datos' => $datos,
         'obra' => $obra,
         

     ];
 }




}
