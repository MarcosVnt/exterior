<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tarifaproducto;
use App\PresupuestosDetalle;
use App\PresupuestoComponente;

class TarifaproductoController extends Controller
{
    //

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        $componentes = Tarifaproducto::where('tipo','C')->orderBy('id', 'ASC')->get();
        
        if ($buscar==''){
            $tarifaproductos = Tarifaproducto::where('tipo','A')->orderBy('id', 'desc')->paginate(15);
          
        }
        else{
            $tarifaproductos = Tarifaproducto::where('tipo','A')->where('referencia', 'like', '%'. $buscar . '%')->orWhere($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(15);
            
        }
        

        return [
            'pagination' => [
                'total'        => $tarifaproductos->total(),
                'current_page' => $tarifaproductos->currentPage(),
                'per_page'     => $tarifaproductos->perPage(),
                'last_page'    => $tarifaproductos->lastPage(),
                'from'         => $tarifaproductos->firstItem(),
                'to'           => $tarifaproductos->lastItem(),
            ],
            'articulos' => $tarifaproductos,
            'componentes' => $componentes
        ];
    }

    public function buscar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        //dd($request);

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $tarifaproductos = Tarifaproducto::orderBy('id', 'desc')->where('tipo','A')->get();
        }
        else{
            $tarifaproductos = Tarifaproducto::where($criterio, 'like', '%'. $buscar . '%')->where('tipo','A')->orWhere('referencia' ,'like', '%'. $buscar . '%')->orderBy('id', 'desc')->get();
        }
        



        return [
          
            'tarifaproductos' => $tarifaproductos
        ];
    }


    public function traer(Request $request){

        //dd($request->lin);

            $articulo =  New PresupuestosDetalle();

            $articulo->idpresupuesto = $request->cabecera['id'];

            $articulo->articulo =  $request->articulos['articulo'];
    
            $articulo->descripcion = $request->articulos['descripcion'];
            $articulo->proveedor =  $request->articulos['proveedor'];
            $articulo->ancho =  $request->articulos['ancho'];
            $articulo->longitud =  $request->articulos['longitud'];
            $articulo->m2 =  $request->articulos['m2'];
            $articulo->tipounidad =  $request->articulos['tipounidad'];
    
            $articulo->cantidad = $request->articulos['cantidad'];
            $articulo->preciofinal = $request->articulos['preciofinal'];
            $articulo->importefinal = $request->articulos['importefinal'];
    
            $articulo->precio =  $request->articulos['precio'];
            $articulo->descuento =  $request->articulos['descuento'];
    
            $articulo->montaje =  $request->articulos['montaje'];
            $articulo->subcontratado =  $request->articulos['subcontratado'];
            $articulo->gastos =  $request->articulos['gastos'];
            $articulo->beneficios =  $request->articulos['beneficios'];
            $articulo->costes =  $request->articulos['costes'];
            $articulo->comentarios =  $request->articulos['comentarios'];
            $articulo->mermas =  $request->articulos['mermas'];
            $articulo->base =  $request->articulos['base'];
            //$articulo->referencia =  $request->articulos['referencia'];
            $articulo->linea =  $request->lin;
            $articulo->bultos =  $request->articulos['bultos'];
            //$articulo->documento =  $request->articulos['documento'];

            //todo, agastos, beneficios
    
            $articulo->save();

            $articulo_principal =  $request->articulos['articulo'];


            $componentes = Tarifaproducto::where('articulo', $request->articulos['articulo'])->where('tipo','C')->orderBy('id', 'desc')->get();
            $linea = $articulo->id;
         //  dd($componentes, $linea, $articulo,$articulo->id);

            foreach($componentes as $ep=>$comp)
            {
    
                     $componente = new PresupuestoComponente();
                        //$detalle->idventa = $venta->id;
                      
                        $componente->idpresupuesto = $request->cabecera['id'];
                        $componente->idpresupuestolinea = $articulo->id;
                        
                        $componente->articulo_principal = $articulo_principal;
                        $componente->articulo = $comp['componente'];
                        
    
                        $componente->descripcion = $comp['descripcion'];
                        // $componente->proveedor = $comp['proveedor'];
    
                        $componente->ancho = $comp['ancho'];
                        $componente->longitud = $comp['longitud'];
                        $componente->m2 = $comp['m2'];
                        $componente->tipounidad = $comp['tipounidad'];
                        
                        $componente->cantidad = $comp['cantidad'];
                        $componente->preciofinal = $comp['preciofinal']; 

                        $componente->mermas = $comp['mermas']; 

                    // $componente->descuento = $comp['descuento'];
                    // $componente->preciofinal = $comp['preciofinal']; 
    
                        $componente->montaje = $comp['montaje'];
                        $componente->subcontratado = $comp['subcontratado'];
                        $componente->gastos = $comp['gastos'];
                        $componente->mermas = $comp['mermas'];

                        $componente->beneficios = $comp['beneficios'];
                        $componente->importefinal = $comp['importefinal'];

                        $componente->base = $comp['base'];
                        $componente->bultos = $comp['bultos'];
                        $componente->costes = $comp['costes'];
                        $componente->descuento = $comp['descuento'];
                        $componente->linea = $comp['linea'];
                        $componente->precio = $comp['precio'];

    
                    // $componente->comentarios = $comp['comentarios'];
                                                
                        $componente->save();
        
                    }
        
    
    
    
                    return [
                        'articulo' => $articulo,
                        'componentes' => $componentes,
                        'id' => $request->cabecera['id'],

            
                    ];
            



    }



    public function guardar(Request $request){

        //VIENE DE ARTICULOS PRODUCTO TARIFA GUARDAR..

     //   dd($request->articulos['articulo'], $request->componentes);


     if (!$request->ajax()) return redirect('/');

     try{
         DB::beginTransaction();


        if(Tarifaproducto::where('articulo', $request->articulos['articulo'])->first()){

                $existe = true;
                return ['existe'=> $existe];
                
        }

            

        $articulo =  New Tarifaproducto();

        $articulo->articulo =  $request->articulos['articulo'];

        $articulo->descripcion = $request->articulos['descripcion'];
        $articulo->proveedor =  $request->articulos['proveedor'];
        $articulo->ancho =  $request->articulos['ancho'];
        $articulo->longitud =  $request->articulos['longitud'];
        $articulo->m2 =  $request->articulos['m2'];
        $articulo->tipounidad =  $request->articulos['tipounidad'];
        $articulo->tipo =  "A";
        $articulo->bultos = $request->articulos['bultos'];

        $articulo->cantidad = $request->articulos['cantidad'];
        $articulo->preciofinal = $request->articulos['preciofinal'];
        $articulo->importefinal = $request->articulos['importefinal'];

        $articulo->precio =  $request->articulos['precio'];
        
        $articulo->descuento =  $request->articulos['descuento'];

        $articulo->montaje =  $request->articulos['montaje'];
        $articulo->subcontratado =  $request->articulos['subcontratado'];
        $articulo->gastos =  $request->articulos['gastos'];
        $articulo->beneficios =  $request->articulos['beneficios'];
        $articulo->costes =  $request->articulos['costes'];
        $articulo->comentarios =  $request->articulos['comentarios'];
        $articulo->base =  $request->articulos['base'];
        $articulo->descuento =  $request->articulos['descuento'];
        $articulo->linea =  $request->articulos['linea'];
        $articulo->mermas =  $request->articulos['mermas'];
        $articulo->tipounidad =  $request->articulos['tipounidad'];
       $articulo->referencia =  $request->referencia;




        
                //todo, agastos, beneficios

        $articulo->save();

        $articulo_principal =  $request->articulos['articulo'];

        foreach($request->componentes as $ep=>$comp)
        {

                 $componente = new Tarifaproducto();
                    //$detalle->idventa = $venta->id;
                  
                    //$componente->idpresupuestolinea = $comp['idpresupuestolinea'];
                    
                    $componente->articulo = $articulo_principal;
                    $componente->componente = $comp['articulo'];
                    
                    $componente->tipo = 'C';

                    $componente->descripcion = $comp['descripcion'];
                    // $componente->proveedor = $comp['proveedor'];

                    $componente->ancho = $comp['ancho'];
                    $componente->longitud = $comp['longitud'];
                    $componente->m2 = $comp['m2'];
                    $componente->tipounidad = $comp['tipounidad'];
                    
                    $componente->cantidad = $comp['cantidad'];
                    $componente->bultos = $comp['bultos'];
                    
                    $componente->preciofinal = $comp['preciofinal']; 
                    $componente->precio = $comp['precio'];
                    $componente->mermas = $comp['mermas']; 
 

                // $componente->descuento = $comp['descuento'];
                // $componente->preciofinal = $comp['preciofinal']; 

                    $componente->montaje = $comp['montaje'];
                    $componente->subcontratado = $comp['subcontratado'];
                    $componente->gastos = $comp['gastos'];
                    $componente->mermas = $comp['mermas'];

                    $componente->base = $comp['base'];


                    $componente->beneficios = $comp['beneficios'];
                    $componente->importefinal = $comp['importefinal'];

                  
                        $componente->costes = $comp['costes'];
                        $componente->descuento = $comp['descuento'];
                        $componente->linea = $comp['linea'];


                // $componente->comentarios = $comp['comentarios'];
                                            
                    $componente->save();
    
                }
    
            

            DB::commit();
            return [
                'articulo' => $articulo,
                'componentes' => $componente
    
            ];

        } catch (Exception $e){
            DB::rollBack();
        }

    





       
    }


    public function eliminar(Request $request)
    {
      // dd($request);
       // if (!$request->ajax()) return redirect('/');
        
        $componente = Tarifaproducto::find($request->id);
       
        $componente->delete();
        
        
        }


        public function eliminarArticulo(Request $request)
    {
       // dd($request);
       // if (!$request->ajax()) return redirect('/');
        
        $articulo = Tarifaproducto::find($request->id);
       
        $articulo->delete();

        $componentes = Tarifaproducto::where('articulo', $request->articulo)->delete();
        
        
        return [
            'componentes' => $componentes,
            'articulo' => $articulo

        ];
        }


        public function guardarcomponente(Request $request){

       // dd($request);
    
            $tarifaProducto =  New TarifaProducto();
    
         //   $tarifaProducto->idpresupuesto =  $request->idpresupuesto;
         //   $tarifaProducto->idpresupuestolinea =  $request->idpresupuestolinea;
            
            $tarifaProducto->componente = $request->componente;
            $tarifaProducto->articulo = $request->articulo;
            $tarifaProducto->tipo = 'C';
            $tarifaProducto->descripcion = $request->descripcion;
    
            $tarifaProducto->m2 = $request->m2;
            $tarifaProducto->ancho = $request->ancho;
            $tarifaProducto->longitud = $request->longitud;
            $tarifaProducto->tipounidad = $request->tipounidad;
    
            $tarifaProducto->bultos = $request->bultos;
            $tarifaProducto->linea = $request->linea;
    
            $tarifaProducto->cantidad = $request->cantidad;
            $tarifaProducto->montaje = $request->montaje;
            $tarifaProducto->gastos = $request->gastos;
            $tarifaProducto->subcontratado = $request->subcontratado;
            $tarifaProducto->beneficios = $request->beneficio;
            $tarifaProducto->costes = $request->costes;
            
            $tarifaProducto->base = $request->base;
            $tarifaProducto->descuento = $request->dto;
            
                   
                //costes???
                $tarifaProducto->preciofinal = $request->preciofinal;

                $tarifaProducto->precio = $request->precio;
                $tarifaProducto->mermas = $request->mermas;
    
            $tarifaProducto->importefinal = $request->importefinal;
            
            
         
          

                    //todo, agastos, beneficios
    
            $tarifaProducto->save();
            return [
                'tarifaProducto' => $tarifaProducto,
    
            ];
        }


        public function actualizarcomponente(Request $request){

            // dd($request , $request->idpresupuesto);
     
             $tarifaProducto =  TarifaProducto::where('id',$request->id)->firstOrFail();
           
             //$tarifaProducto->componente = $request->componente;
            // $tarifaProducto->articulo = $request->articulo;
             //$tarifaProducto->tipo = 'C';
             $tarifaProducto->descripcion = $request->descripcion;
     
             $tarifaProducto->m2 = $request->m2;
             $tarifaProducto->ancho = $request->altura;
             $tarifaProducto->longitud = $request->anchura;
             $tarifaProducto->tipounidad = $request->tipounidad;
     
             $tarifaProducto->bultos = $request->bultos;
             //$tarifaProducto->linea = $request->linea;
     
             $tarifaProducto->cantidad = $request->cantidad;
             $tarifaProducto->montaje = $request->montaje;
             $tarifaProducto->gastos = $request->gastos;
             $tarifaProducto->subcontratado = $request->subcontratado;
             $tarifaProducto->beneficios = $request->beneficio;
             $tarifaProducto->costes = $request->costes;
             
             $tarifaProducto->base = $request->base;
             $tarifaProducto->descuento = $request->dto;
             
                    
                 //costes???
                 $tarifaProducto->preciofinal = $request->preciofinal;
 
                 $tarifaProducto->precio = $request->precio;
                 $tarifaProducto->mermas = $request->mermas;
     
             $tarifaProducto->importefinal = $request->importefinal;
             $tarifaProducto->referencia = $request->referencia;

             
                     //todo, agastos, beneficios
     
             $tarifaProducto->save();
             return [
                 'tarifaProducto' => $tarifaProducto,
     
             ];
     
         }
     


        public function actualizarcoste(Request $request){

            // dd($request->idpresupuesto);
     
             $detalle =  Tarifaproducto::where('id',$request->id)->firstOrFail();
            //dd($detalle);
            
             //$detalle->idventa = $venta->id;
             //$detalle->idpresupuesto =  $request->idpresupuesto;
             $detalle->beneficios = $request->beneficio;
             $detalle->importefinal = $request->importefinal;
    
             $detalle->costes = $request->costes;
             $detalle->save();
             return [
                 'id' => $detalle->id,
                 'tarifaProducto' => $detalle
     
             ];
     
         }


         public function actualizarArticulo(Request $request){

            //dd($request , $request->idpresupuesto);
     
             $tarifaProducto =  TarifaProducto::where('id',$request->id)->firstOrFail();
            //dd($detalle);
            
             //$detalle->idventa = $venta->id;
             //$detalle->idpresupuesto =  $request->idpresupuesto;
            // $detalle->articulo = $request->articulo;
             
            $tarifaProducto->descripcion = $request->descripcion;
       
               $tarifaProducto->m2 = $request->m2;
               $tarifaProducto->ancho = $request->altura;
               $tarifaProducto->longitud = $request->anchura;
               $tarifaProducto->tipounidad = $request->tipounidad;
       
               $tarifaProducto->bultos = $request->bultos;
               $tarifaProducto->linea = $request->linea;
       
               $tarifaProducto->cantidad = $request->cantidad;
               $tarifaProducto->montaje = $request->montaje;
               $tarifaProducto->gastos = $request->gastos;
               $tarifaProducto->subcontratado = $request->subcontratado;
               $tarifaProducto->beneficios = $request->beneficio;
               $tarifaProducto->costes = $request->costes;
               
               $tarifaProducto->descuento = $request->dto;
               $tarifaProducto->gastos = $request->gastos;
               $tarifaProducto->linea = $request->linea;
               $tarifaProducto->mermas = $request->mermas;
               $tarifaProducto->base = $request->base;
               

               $tarifaProducto->precio = $request->precio;




       
                   //costes???
       
               $tarifaProducto->preciofinal = $request->preciofinal;
               $tarifaProducto->importefinal = $request->importefinal;
               $tarifaProducto->referencia = $request->referencia;
               
               
                       //todo, agastos, beneficios
       
               $tarifaProducto->save();
                        return [
                 'tarifaProducto' => $tarifaProducto,
     
             ];
     
         }



         public function guardarArticulo(Request $request){

            //dd($request , $request->idpresupuesto);
     
            $tarifaProducto =  New TarifaProducto();
    
               
               $tarifaProducto->componente = $request->componente;
               $tarifaProducto->articulo = $request->articulo;
               $tarifaProducto->tipo = 'A';
               $tarifaProducto->descripcion = $request->descripcion;
       
               $tarifaProducto->m2 = $request->m2;
               $tarifaProducto->ancho = $request->altura;
               $tarifaProducto->longitud = $request->anchura;
               $tarifaProducto->tipounidad = $request->tipounidad;
       
               $tarifaProducto->bultos = $request->bultos;
               $tarifaProducto->linea = $request->linea;
       
               $tarifaProducto->cantidad = $request->cantidad;
               $tarifaProducto->montaje = $request->montaje;
               $tarifaProducto->gastos = $request->gastos;
               $tarifaProducto->subcontratado = $request->subcontratado;
               $tarifaProducto->beneficios = $request->beneficio;
               $tarifaProducto->costes = $request->costes;
               
               $tarifaProducto->descuento = $request->dto;
               $tarifaProducto->gastos = $request->gastos;
               $tarifaProducto->linea = $request->linea;
               $tarifaProducto->mermas = $request->mermas;
               $tarifaProducto->base = $request->base;
               

               $tarifaProducto->precio = $request->precio;




       
                   //costes???
       
               $tarifaProducto->preciofinal = $request->preciofinal;
               $tarifaProducto->importefinal = $request->importefinal;
               
               $tarifaProducto->referencia = $request->referencia;
               
               
                       //todo, agastos, beneficios
       
               $tarifaProducto->save();
               return [
                   'tarifaProducto' => $tarifaProducto,
       
               ];
         }
     


         



}
