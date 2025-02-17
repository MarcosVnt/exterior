<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\horario;

class HorarioController extends Controller
{
    //
    public function turnosUsuario(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $usuario = $request->usuario;
       // $criterio = $request->criterio;
        
    
            $turnosUsuario = horario::where('user_id', '=',  $usuario )->orderBy('id', 'desc')->get();
        
        

        return [
           /*  'pagination' => [
                'total'        => $turnosUsuario->total(),
                'current_page' => $turnosUsuario->currentPage(),
                'per_page'     => $turnosUsuario->perPage(),
                'last_page'    => $turnosUsuario->lastPage(),
                'from'         => $turnosUsuario->firstItem(),
                'to'           => $turnosUsuario->lastItem(),
            ], */
            'turnosUsuario' => $turnosUsuario
        ];
    }

    public function store(Request $request){
        //if (!$request->ajax()) return redirect('/');
       // dd($request);


        $horaInicioA = $request->horaInicio['HH']."".$request->horaInicio['mm']."".'00';
        $horaFinA = $request->horaFin['HH']."".$request->horaFin['mm']."".'00';
        //dd($horaInicioA);
        $horario = new horario();
        $horario->user_id = $request->usuario_id;
  
        $horario->hora_inicio = $horaInicioA;
        $horario->hora_fin =$horaFinA;

        $horario->descripcion = $request->descripcion;
        $horario->observaciones = $request->observaciones;

     
        $horario->save();

  
    }

    public function desactivar(Request $request)
    {
        //dd($request);
       // if (!$request->ajax()) return redirect('/');
        
        $horario = horario::find($request->id);
       
        $horario->delete();
        
        
        }

}
