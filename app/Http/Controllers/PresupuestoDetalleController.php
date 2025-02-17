<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PresupuestosDetalle;
use App\PresupuestoComponente;


class PresupuestoDetalleController extends Controller
{
    //

    public function guardar(Request $request){

      //   dd($request);

        $detalle =  New PresupuestosDetalle();

        $detalle->idpresupuesto =  $request->idpresupuesto;
        $detalle->articulo = $request->articulo;
        $detalle->descripcion = $request->descripcion;

        $detalle->ancho = $request->anchura;
        $detalle->longitud = $request->altura;
        $detalle->m2 = $request->m2;
        $detalle->mermas = $request->mermas;

        $detalle->bultos = $request->bultos;

        $detalle->cantidad = $request->cantidad;
        $detalle->tipounidad = $request->tipounidad;
        $detalle->precio = $request->precio;
        $detalle->descuento = $request->dto;

        $detalle->preciofinal = $request->preciofinal;

        $detalle->gastos = $request->gastos;
        $detalle->montaje = $request->montaje;
        $detalle->subcontratado = $request->subcontratado;

        $detalle->base = $request->base;

        $detalle->beneficios = $request->beneficio;

        $detalle->importefinal = $request->importefinal;
        $detalle->costes = $request->costes;
        $detalle->linea = $request->linea;

        $detalle->save();
        return [
            'detalle' => $detalle,

        ];
    }

    public function desactivar(Request $request){

        //dd($request);
        $detalle =  PresupuestosDetalle::where('id',$request->id)->firstOrFail();
        if($detalle->activado===0){
            $detalle->activado=1;
            $a ="1";
        }else{
            $detalle->activado=0;
            $a="0";

        }
        //$detalle->activado = 0 ;
        $detalle->save();

        return [
            'a' => $a,
        ];


    }


    public function actualizar(Request $request){

       // dd($request , $request->idpresupuesto);

        $detalle =  PresupuestosDetalle::where('id',$request->id)->firstOrFail();
       //dd($detalle);
       
        //$detalle->idventa = $venta->id;
        //$detalle->idpresupuesto =  $request->idpresupuesto;
       // $detalle->articulo = $request->articulo;
        $detalle->descripcion = $request->descripcion;

        $detalle->ancho = $request->anchura;
        $detalle->longitud = $request->altura;
        $detalle->m2 = $request->m2;
        $detalle->mermas = $request->mermas;

        
        $detalle->bultos = $request->bultos;
         $detalle->cantidad = $request->cantidad;
         $detalle->tipounidad = $request->tipounidad;


         $detalle->precio = $request->precio;
         $detalle->descuento = $request->dto;
 
        $detalle->preciofinal = $request->preciofinal;

        $detalle->gastos = $request->gastos;
        $detalle->montaje = $request->montaje;
        $detalle->subcontratado = $request->subcontratado;


        $detalle->importefinal = $request->importefinal;
        $detalle->costes = $request->costes;
        $detalle->beneficios = $request->beneficio;
        $detalle->base = $request->base;


        
                //todo, agastos, beneficios


        $detalle->save();
        return [
            'detalle' => $detalle,

        ];

    }


    public function actualizarcoste(Request $request){

        // dd($request->idpresupuesto);
 
         $detalle =  PresupuestosDetalle::where('id',$request->id)->firstOrFail();
        //dd($detalle);
        
         //$detalle->idventa = $venta->id;
         //$detalle->idpresupuesto =  $request->idpresupuesto;
         $detalle->preciofinal = $request->preciofinal;


         $detalle->base = $request->base;

         $detalle->beneficios = $request->beneficio;
         $detalle->costes = $request->costes;

         $detalle->descuento = $request->dto;

         $detalle->importefinal = $request->importefinal;
         $detalle->mermas = $request->mermas;


         
         $detalle->precio = $request->precio;
         $detalle->preciofinal = $request->preciofinal;
         
         $detalle->save();
         return [
             'id' => $detalle->id,
             'detalle' => $detalle
 
         ];
 
     }
 



    public function eliminar(Request $request)
    {

       //dd($request);
       // if (!$request->ajax()) return redirect('/');
        
        $articulo = PresupuestosDetalle::find($request->id);
       
        $articulo->delete();

        $componentes = PresupuestoComponente::where('idpresupuestolinea', $request->id)->delete();
        
        
        return [
            'componentes' => $componentes,
            'articulo' => $articulo

        ];
     }



     public function actualizarlinea(Request $request){

      
        $detalles = $request['data']['articulos'];
            
      //  dd($request, $request['data']['articulos']);

     // dd($detalles);
        $i=0;
        foreach($detalles as $ep=>$det)
        {
            $i++;
          
//dd($det);
            $detalle = PresupuestosDetalle::find($det['id']);

            //dd($detalle);
            //$detalle->idventa = $venta->id;
          /*   $detalle->idpresupuesto = $presupuesto->id;
            $detalle->articulo = $det['articulo'];
            $detalle->descripcion = $det['descripcion'];
            $detalle->cantidad = $det['cantidad'];
            $detalle->preciofinal = $det['preciofinal'];  */
            $detalle->linea =$i; 
                    //todo, agastos, beneficios

            $detalle->save();

        }


     }


    }
