<?php

namespace App\Http\Controllers;

use App\contrato;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    //

    function demoBusqueda(Request $request){

        //dd($request);

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $estado = $request->estado;

        $contratos = contrato::with('cliente','agencia')->whereHas('cliente', function ( Builder $query) use ( $buscar) {
            $query->where('nombre','LIKE', '%'.$buscar.'%');
           })->paginate(10);

           dd($contratos);
 
    }
}
