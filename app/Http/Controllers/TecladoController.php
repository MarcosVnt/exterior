<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Jornada;
use App\Horario;
use Carbon\Carbon;


class TecladoController extends Controller
{
    //
    public function index()
    {
        return view('teclado');
        //https://laravel-news.com/using-vue-router-laravel
    }


    public function validar(Request $request){
      
         // if (!$request->ajax()) return redirect('/');
       $flag = false;
       $validar='ok';
       $turnosLleva=1;
       $turnosTiene=0;

       $horasReales = [];

        $validar = User::select('id','teclado_id','name')->where('teclado_id', '=', $request->codigo)->get();
        //dd($validar->isNotEmpty());

        if ($validar->isNotEmpty()){
            $ok = 'oaaaaaaaaaaaaaak';
            $flag = true;
            $turnosTieneDetalle = Horario::select('user_id','hora_inicio','hora_fin')->where('user_id', '=',$validar[0]['id'])->orderBy('hora_inicio','ASC')->get();
            $turnosTiene = Horario::select('user_id')->where('user_id', '=',$validar[0]['id'])->count();

           
            $i=0;
            foreach($turnosTieneDetalle as $key => $value)
           {
            $i++;

                     //$horasReales[] = $value;   
                    // array_push($horasReales, 'hora_'.$i => $value->hora_inicio);
                    $horasReales[$i] =  $value->hora_inicio;                     
                       // 0ok  $horasReales[] = ['hora_'.$i => $value->hora_inicio];         
  

                        $i++;
                        $horasReales[$i] = $value->hora_fin;   
                       // ok $horasReales[] = ['hora_'.$i => $value->hora_fin];    
                        //array_push($horasReales, $value->hora_fin);

                     
                     //dd($key,$value);
                    
           }
          // dd($turnosTiene,$horasReales,$turnosTieneDetalle);
           



            

            

            $turnosLleva = //Jornada::all();
            Jornada::select('user_id','fecha')->where('user_id', '=',$validar[0]['id'])->where('fecha','=',$request->fecha)->count();
           

            //->where('fecha','=',$request->fecha)->count();
            //dd($turnosLleva,$turnosTiene);
        }
       

        return ['validar' => $validar, 'flag'=>$flag, 'turnosLleva'=>$turnosLleva, 'turnosTiene'=>$turnosTiene,'horasReales'=>$horasReales];
    }


    public function registrar(Request $request){


        $horario = Horario::select('hora_inicio','hora_fin')->where('user_id', '=',$request->id)->get();
        //dd($request,$horario,gettype($horario),$horario->isEmpty(), $horaAGuardar);

        $mytime= Carbon::now('Europe/Madrid');

        $jornada = new Jornada();
        $jornada->user_id = $request->id;
        $jornada->fecha = $request->fecha;
        $jornada->hora = $request->hora;  
        $jornada->hora_real = $request->horasReales;
        $jornada->fecha_real = $mytime->toDateString();

       // $jornada->hora_real = $horaAGuardar;//$request->horasReales[$tl];  
        
        $jornada->save();




    }
}
