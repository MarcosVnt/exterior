<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PresupuestoComponente;


class PresupuestoComponenteController extends Controller
{
    //

    public function guardar(Request $request){

        // dd($request->idpresupuesto);

        $componente =  New PresupuestoComponente();

        $componente->idpresupuesto =  $request->idpresupuesto;
        $componente->idpresupuestolinea =  $request->idpresupuestolinea;
        
        $componente->articulo_principal = $request->articulo_principal;
        $componente->articulo = $request->articulo;
        $componente->descripcion = $request->descripcion;

        $componente->m2 = $request->m2;
        $componente->ancho = $request->ancho;
        $componente->longitud = $request->longitud;
        $componente->tipounidad = $request->tipounidad;
        $componente->mermas = $request->mermas;
        $componente->precio = $request->precio;

        $componente->bultos = $request->bultos;
        $componente->linea = $request->linea;

        $componente->cantidad = $request->cantidad;
        $componente->montaje = $request->montaje;
        $componente->gastos = $request->gastos;
        $componente->subcontratado = $request->subcontratado;
        $componente->beneficios = $request->beneficios;
        $componente->costes = $request->costes;
        $componente->descuento = $request->descuento;

            //costes???

        $componente->preciofinal = $request->preciofinal;
        $componente->importefinal = $request->importefinal;
        $componente->base = $request->base;
        
        
        
                //todo, agastos, beneficios

        $componente->save();
        return [
            'componente' => $componente,

        ];
    }


    public function actualizar(Request $request){

        // dd($request->idpresupuesto);
 
         $componente =  PresupuestoComponente::where('id',$request->id)->firstOrFail();
        //dd($detalle);
        

     /*    $componente->idpresupuesto =  $request->idpresupuesto;
        $componente->idpresupuestolinea =  $request->idpresupuestolinea;
        
        $componente->articulo_principal = $request->articulo_principal;
        $componente->articulo = $request->articulo; */
        $componente->descripcion = $request->descripcion;

        $componente->m2 = $request->m2;
        $componente->ancho = $request->ancho;
        $componente->longitud = $request->longitud;
        $componente->tipounidad = $request->tipounidad;
        $componente->mermas = $request->mermas;
        $componente->precio = $request->precio;


        $componente->bultos = $request->bultos;
        $componente->linea = $request->linea;

        $componente->cantidad = $request->cantidad;
        $componente->montaje = $request->montaje;
        $componente->gastos = $request->gastos;
        $componente->subcontratado = $request->subcontratado;
        $componente->beneficios = $request->beneficios;
        $componente->costes = $request->costes;
        

            //costes???
            $componente->base = $request->base;


        $componente->preciofinal = $request->preciofinal;
        $componente->importefinal = $request->importefinal;
        $componente->descuento = $request->descuento;
        
        
                //todo, agastos, beneficios

        $componente->save();
        return [
            'componente' => $componente,

        ];
 
     }


    public function eliminar(Request $request)
    {
        //dd($request);
        if (!$request->ajax()) return redirect('/');
        
        $componente = PresupuestoComponente::find($request->id);
       
        $componente->delete();
        
        
        
        return [
         
            'id' => $request->id,
            'componente' => $componente,

        ];
    }


}
