<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Presupuesto;
use App\PresupuestosDetalle;
use App\PresupuestoComponente;
use App\PresupuestosFichero;
use App\Obra;

use LynX39\LaraPdfMerger\Facades\PdfMerger;


use Illuminate\Support\Facades\Mail;
use App\Mail\AceptarComoPresupuestado;


class PresupuestoController extends Controller
{
    //

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
            ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
            'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
            ->orderBy('presupuestos.id', 'desc')->paginate(25);
        }
        else{
            $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
            ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
            'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
            ->where('presupuestos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.nombre_fiscal', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.trabajo_descripcion', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.estado', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.contacto', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.id',  '=', $buscar )
            ->orWhere('presupuestos.observaciones',  'like', '%'. $buscar . '%')
        
            ->orWhere('users.name',  'like', '%'. $buscar . '%')
            
            ->orderBy('presupuestos.id', 'desc')->paginate(25);
        }
        
        return [
            'pagination' => [
                'total'        => $presupuestos->total(),
                'current_page' => $presupuestos->currentPage(),
                'per_page'     => $presupuestos->perPage(),
                'last_page'    => $presupuestos->lastPage(),
                'from'         => $presupuestos->firstItem(),
                'to'           => $presupuestos->lastItem(),
                'next_page_url'           => $presupuestos->nextPageUrl(),
                'prev_page_url'           => $presupuestos->previousPageUrl(),
                
            ],
            'presupuestos' => $presupuestos
        ];
    }

    public function aceptados(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $aceptado = "ACEPTADO";
        
        if ($buscar==''){
            $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
            ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
            'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
            ->orWhere('presupuestos.estado', 'like', '%'. $aceptado . '%')
            
            ->orderBy('presupuestos.id', 'desc')->paginate(25);
        }
        else{
            /* $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
            ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
            'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
            ->where('presupuestos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.nombre_fiscal', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.trabajo_descripcion', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.contacto', 'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.id',  '=', $buscar )
        
            ->orWhere('users.name',  'like', '%'. $buscar . '%')
            ->orWhere('presupuestos.estado', 'like', '%'. $aceptado . '%')
            
            ->orderBy('presupuestos.id', 'desc')->paginate(25);
 */
    $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
            ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
            'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
            ->Where('presupuestos.estado', 'like', '%'. $aceptado . '%')
            ->where(function ($query) use ($aceptado, $criterio,$buscar){



                $query->orWhere('presupuestos.'.$criterio, 'like', '%'. $buscar . '%')
                    ->orWhere('presupuestos.nombre_fiscal', 'like', '%'. $buscar . '%')
                    ->orWhere('presupuestos.trabajo_descripcion', 'like', '%'. $buscar . '%')
                    ->orWhere('presupuestos.contacto', 'like', '%'. $buscar . '%')
                    ->orWhere('presupuestos.id',  '=', $buscar )
                
                    ->orWhere('users.name',  'like', '%'. $buscar . '%');
                   
            })
            
           
           
            
            ->orderBy('presupuestos.id', 'desc')->paginate(25);




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
            'presupuestos' => $presupuestos
        ];
    }



public function duplicar(Request $request)
{

  //dd($request);
    if (!$request->ajax()) return redirect('/');

    try{
        DB::beginTransaction();

         $detalles = $request->articulos;
       
            $detalle = new PresupuestosDetalle();
            //$detalle->idventa = $venta->id;
            $det= $request->articulos;
            $idPresupuesto = $request->cabecera['id'];
        
            $linea = $request->lin;

//           dd($id,$request,$det['articulo'],$det,$request->cabecera['id']);

            $detalle->articulo = $det['articulo'];
            $detalle->ancho =  $det['ancho'];
            $detalle->base =  $det['base'];
            $detalle->beneficios =  $det['beneficios'];
            $detalle->bultos =  $det['bultos'];
            $detalle->cantidad = $det['cantidad'];
            $detalle->costes =  $det['costes'];
            $detalle->descripcion = $det['descripcion'];
            $detalle->descuento =  $det['descuento'];
            $detalle->gastos =  $det['gastos'];

            $detalle->idpresupuesto = $idPresupuesto;
            
            $detalle->importefinal =  $det['importefinal'];
            
            $detalle->linea = $linea;
            
                    $detalle->longitud = $det['longitud'];
                    $detalle->m2 =  $det['m2'];
                    $detalle->mermas =  $det['mermas'];
                    $detalle->montaje =  $det['montaje'];
                    $detalle->precio =  $det['precio'];
                    $detalle->preciofinal =  $det['preciofinal'];
                    $detalle->subcontratado =  $det['subcontratado'];
            
            
                    $detalle->tipounidad =  $det['tipounidad'];
            
            
            
            
            
            


            $detalle->save();


            $componentes = $request->componentes;
            $componente="";
        
         //   dd($componentes, $presupuesto->id);
            $lineaPresupuesto = $detalle->id;

            if($componentes){

          
        foreach($componentes as $ep=>$comp)
        {
         /*    echo $detalle->articulo.'-' ;
            echo $comp['articulo_principal'].'-';
            echo $detalle->articulo === $comp['articulo_principal'].'<br>' */;

            if ($detalle->articulo === $comp['articulo_principal']) {
             /*    echo 'es igual ';*/
            
                $componente = new PresupuestoComponente();
                //$detalle->idventa = $venta->id;

                $componente->idpresupuesto =    $idPresupuesto;//$request->cabecera[id];
            
                $componente->idpresupuestolinea =$lineaPresupuesto;
                
                //$componente->idpresupuestolinea = $comp['idpresupuestolinea'];
                $componente->articulo_principal = $comp['articulo_principal'];
                
                $componente->articulo = $comp['articulo'];

                $componente->descripcion = $comp['descripcion'];
                // $componente->proveedor = $comp['proveedor'];

               
                $componente->precio = $comp['precio'];
                $componente->descuento = $comp['descuento'];
                $componente->mermas = $comp['mermas'];
                $componente->costes = $comp['costes'];
                $componente->bultos = $comp['bultos'];
                $componente->linea = $comp['linea'];
                $componente->base = $comp['base'];
               
               
                $componente->ancho = $comp['ancho'];
                $componente->longitud = $comp['longitud'];
                $componente->m2 = $comp['m2'];
                $componente->tipounidad = $comp['tipounidad'];
                
                $componente->cantidad = $comp['cantidad'];
                $componente->preciofinal = $comp['preciofinal']; 

            // $componente->descuento = $comp['descuento'];
            // $componente->preciofinal = $comp['preciofinal']; 

                $componente->montaje = $comp['montaje'];
                $componente->subcontratado = $comp['subcontratado'];
                $componente->gastos = $comp['gastos'];

                $componente->beneficios = $comp['beneficios'];
                $componente->importefinal = $comp['importefinal'];

            // $componente->comentarios = $comp['comentarios'];
                                        
                $componente->save();

            }

        }

        }     

        

        DB::commit();
        return [
            'articulo' => $detalle,
            'componente' => $componente,
            'id'=>$idPresupuesto,

        ];
    } catch (Exception $e){
        DB::rollBack();
    }
}






    public function registrar(Request $request)
    {

      //  dd($request);
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

          
            

           // $mytime= Carbon::now('Europe/Madrid');

            $presupuesto = new Presupuesto();
            $presupuesto->idusuario = \Auth::user()->id;
            

            $presupuesto->cliente_descripcion = $request->cliente_descripcion;
            $presupuesto->trabajo_descripcion = $request->trabajo_descripcion;

            $presupuesto->contacto = $request->contacto;
            $presupuesto->contacto_envio = $request->contacto_envio;
            $presupuesto->direccion_envio = $request->direccion_envio;
            
            //$presupuesto->fecha_hora = $mytime->toDateString();
            
            $presupuesto->estado = $request->estado;
            $presupuesto->opcion_envio = $request->opcion_envio;
            $presupuesto->referencia_pedido = $request->referencia;
            $presupuesto->tipo_envio = $request->tipo_envio;

            $presupuesto->fecha_entrega = $request->fecha_entrega;
            $presupuesto->fecha_envio = $request->fecha_envio;
            $presupuesto->fecha_presupuesto = $request->fecha_presupuesto;
            
            //130121
            $presupuesto->costes = $request->sumatotales;

            
            $presupuesto->subcontratado = $request->subcontratado;
            $presupuesto->gastos = $request->gastos;
            $presupuesto->montaje = $request->montaje;
            
            $presupuesto->beneficios = $request->beneficios;
            $presupuesto->importefinal = $request->importefinal;
            
            
            $presupuesto->nombre_fiscal = $request->nombre_fiscal;
            $presupuesto->dni = $request->dni;
            $presupuesto->direccion = $request->direccion;
            $presupuesto->codigo_postal = $request->codigo_postal;
            $presupuesto->poblacion = $request->poblacion;
            $presupuesto->provincia = $request->provincia;
            $presupuesto->telefono = $request->telefono;
            $presupuesto->movil = $request->movil;
            $presupuesto->email = $request->email;

            $presupuesto->observaciones = $request->observaciones;

            $presupuesto->forma_pago = $request->forma_pago;
            $presupuesto->codigo_obra = $request->codigo_obra;



            $presupuesto->save();

             $detalles = $request->articulos;
            

            foreach($detalles as $ep=>$det)
            {
                $detalle = new PresupuestosDetalle();
                //$detalle->idventa = $venta->id;
                $detalle->idpresupuesto = $presupuesto->id;
                $detalle->articulo = $det['articulo'];
                $detalle->descripcion = $det['descripcion'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->preciofinal = $det['preciofinal']; 
                $detalle->importefinal = $det['importefinal']; 
                        //todo, agastos, beneficios










                $detalle->save();
   
   
                $componentes = $request->componentes;
            
                //dd($componentes, $presupuesto->id);
                $linea = $detalle->id;

            foreach($componentes as $ep=>$comp)
            {
             /*    echo $detalle->articulo.'-' ;
                echo $comp['articulo_principal'].'-';
                echo $detalle->articulo === $comp['articulo_principal'].'<br>' */;

                if ($detalle->articulo === $comp['articulo_principal']) {
                 /*    echo 'es igual ';*/
                
                    $componente = new PresupuestoComponente();
                    //$detalle->idventa = $venta->id;
                    $componente->idpresupuesto =$presupuesto->id;
                    $componente->idpresupuestolinea =$linea;
                    
                    //$componente->idpresupuestolinea = $comp['idpresupuestolinea'];
                    $componente->articulo_principal = $comp['articulo_principal'];
                    
                    $componente->articulo = $comp['articulo'];

                    $componente->descripcion = $comp['descripcion'];
                    // $componente->proveedor = $comp['proveedor'];

                    $componente->ancho = $comp['ancho'];
                    $componente->longitud = $comp['longitud'];
                    $componente->m2 = $comp['m2'];
                    $componente->tipounidad = $comp['tipounidad'];
                    
                    $componente->cantidad = $comp['cantidad'];
                    $componente->preciofinal = $comp['preciofinal']; 

                // $componente->descuento = $comp['descuento'];
                // $componente->preciofinal = $comp['preciofinal']; 

                    $componente->montaje = $comp['montaje'];
                    $componente->subcontratado = $comp['subcontratado'];
                    $componente->gastos = $comp['gastos'];

                    $componente->beneficios = $comp['beneficios'];
                    $componente->importefinal = $comp['importefinal'];

                // $componente->comentarios = $comp['comentarios'];
                                            
                    $componente->save();
    
                }
    
   
            }     

            /* 
            $componentes = $request->componentes;
            
                //dd($componentes, $presupuesto->id);
                $linea = 3;
            foreach($componentes as $ep=>$comp)
            {
                $componente = new PresupuestoComponente();
                //$detalle->idventa = $venta->id;
                $componente->idpresupuesto =$presupuesto->id;
                $componente->idpresupuestolinea =$linea;
                
                //$componente->idpresupuestolinea = $comp['idpresupuestolinea'];
                $componente->articulo_principal = $comp['articulo_principal'];
                
                $componente->articulo = $comp['articulo'];

                $componente->descripcion = $comp['descripcion'];
               // $componente->proveedor = $comp['proveedor'];

                $componente->ancho = $comp['anchura'];
                $componente->longitud = $comp['altura'];
                $componente->m2 = $comp['metros'];
        
                
                $componente->cantidad = $comp['unidades'];
                $componente->precio = $comp['pvp']; 

               // $componente->descuento = $comp['descuento'];
               // $componente->preciofinal = $comp['preciofinal']; 

                $componente->montaje = $comp['montaje'];
                $componente->subcontratado = $comp['subcontratacion'];

                $componente->beneficios = $comp['beneficios'];
                //$componente->importefinal = $comp['importefinal'];

               // $componente->comentarios = $comp['comentarios'];
                                        
                $componente->save(); */
            }  

            DB::commit();
            return [
                'id' => $presupuesto->id,

            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }




    public function view(Request $request)
    {
        //dd($request->id);
         //   $cabecera = Presupuesto::where('id', '=', $request->id)->get();
          // dd($cabecera);
        $cabecera = Presupuesto::find($request->id);
        $articulos =  PresupuestosDetalle::where('idpresupuesto', '=', $request->id)->orderBy('linea')->get();
        $componentes =  PresupuestoComponente::where('idpresupuesto', '=', $request->id)->get();


        return ['cabecera' => $cabecera,
        'articulos' => $articulos,
        'componentes' => $componentes];
        
   
            //return [compact('cabecera')];

 
        /* ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get(); */

    }

    public function generarPdf(Request $request) {

        //$cabecera = '';
       // dd($request);

        $cabecera = Presupuesto::find($request->id);
        $muestroTotal = $request->T;

        //dd($muestroTotal);


        $cabecera = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
        ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
        'presupuestos.importefinal','presupuestos.nombre_fiscal','presupuestos.dni','presupuestos.direccion','presupuestos.codigo_postal','presupuestos.poblacion','presupuestos.provincia','presupuestos.telefono','presupuestos.movil','presupuestos.email','presupuestos.observaciones','presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','presupuestos.forma_pago','users.name')
        ->where('presupuestos.id', $request->id)->first();



        $articulos =  PresupuestosDetalle::where('idpresupuesto', '=', $request->id)->orderBy('linea')->get();
        $componentes =  PresupuestoComponente::where('idpresupuesto', '=', $request->id)->get();
      
        $total_iva_incluido= 0;
        $total_iva = 0 ;
        $base = $cabecera->importefinal;

        $total_iva = round(($base * 21) / 100,2);
        $total_iva_incluido = round($base+ $total_iva,2); 

       // dd($cabecera,$total_iva_incluido,$total_iva,$base);
    
        /* dd( $articulos, $componentes,$request->id,$request);
      */

        /*  return view('pdf.informeobra', [ 'datosObra' => $datosObra,
        'fotosObra' => $fotosObra,
            'horasObra' => $horasObra,]); */ 
  

      //  dd($cabecera, $articulos, $componentes,$base,$total_iva,$total_iva_incluido);
        /*         return ['cabecera' => $cabecera,
                'articulos' => $articulos,
                'componentes' => $componentes];
        */
       //return view('pdf.rotuleon',['cabecera' => $cabecera,'articulos' => $articulos, 'componentes'=> $componentes]);
       
       //return view('pdf.demo',['cabecera' => $cabecera,'articulos' => $articulos, 'componentes'=> $componentes]);



       //return view('pdf.venta',['cabecera' => $cabecera,'articulos' => $articulos, 'componentes'=> $componentes]);

               //  $pdf = \PDF::loadView('pdf.presupuesto',['cabecera'=>$cabecera,'articulos'=>$articulos, 'componentes'=>$componentes])->setPaper('a4', 'landscape');
             //  $pdfMerger = PDFMerger::init();
            




            
               $name = 'Exterior_Presupuesto_N_'.$request->id.'_'.strtoupper(ltrim(substr($cabecera->cliente_descripcion,0,8))).'.pdf';
               $name2 = 'Exterior_Presupuesto_NN_'.$request->id.'_'.strtoupper(ltrim(substr($cabecera->cliente_descripcion,0,8))).'.pdf';

               $pdf = \PDF::loadView('pdf.venta2hojas',['cabecera'=>$cabecera,
               'articulos'=>$articulos, 
               'muestroTotal'=>$muestroTotal,
               'componentes'=>$componentes,
               'base'=>$base,
               'total_iva'=>$total_iva,
               'total_iva_incluido'=>$total_iva_incluido]
               
               
            
            );
            $pdf->save('pdf/'.$name);

            $pdfMerger = \PdfMerger::init();
            $pdfMerger->addPDF(public_path('pdf/PLANTILLA.pdf'), 'all');

            $pdfMerger->addPDF(public_path('pdf/'.$name), 'all');

            $pdfMerger->merge();

            $pdfMerger->save(public_path('pdf/'.$name2), "file");



            $filePath =public_path('pdf/'.$name2);
            $headers = ['Content-Type: application/pdf'];
            //$fileName = time().'.pdf';

            //dd($filePath, $name2,$headers);
    
            return response()->download($filePath, $name2, $headers);
    



               //->setPaper('a4', 'landscape');
              // return $pdf->download($name2);
              // return $pdf->download($name);
              //return $pdf->stream($name);
        

    }

    public function generarPdfFabricacion(Request $request) {

      

        $cabecera = Presupuesto::find($request->id);
        $muestroTotal = $request->T;

      

        $cabecera = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
        ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
        'presupuestos.importefinal','presupuestos.nombre_fiscal','presupuestos.dni','presupuestos.direccion','presupuestos.codigo_postal','presupuestos.poblacion','presupuestos.provincia','presupuestos.telefono','presupuestos.movil','presupuestos.email','presupuestos.observaciones','presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','presupuestos.forma_pago','users.name')
        ->where('presupuestos.id', $request->id)->first();



        $articulos =  PresupuestosDetalle::where('idpresupuesto', '=', $request->id)->orderBy('linea')->get();
        $componentes =  PresupuestoComponente::where('idpresupuesto', '=', $request->id)->get();
      
        $total_iva_incluido= 0;
        $total_iva = 0 ;
        $base = $cabecera->importefinal;

        $total_iva = round(($base * 21) / 100,2);
        $total_iva_incluido = round($base+ $total_iva,2); 

            
               $name = 'Exterior_Presupuesto_N_'.$request->id.'_'.strtoupper(ltrim(substr($cabecera->cliente_descripcion,0,8))).'.pdf';
               $name2 = 'Exterior_Presupuesto_NN_'.$request->id.'_'.strtoupper(ltrim(substr($cabecera->cliente_descripcion,0,8))).'.pdf';

        
               
       /*   return view('pdf/venta2hojas2',
            ['cabecera'=>$cabecera,
            'articulos'=>$articulos, 
            'muestroTotal'=>$muestroTotal,
            'componentes'=>$componentes,
            'base'=>$base,
            'total_iva'=>$total_iva,
            'total_iva_incluido'=>$total_iva_incluido]); */ 
            
           /*  dd('cabecera',$cabecera,
            'articulos',$articulos, 
            'muestroTotal',$muestroTotal,
            'componentes',$componentes,
            'base',$base,
            'total_iva',$total_iva,
            'total_iva_incluido',$total_iva_incluido) */;


      /*   $pdf = \PDF::loadView('pdf.venta',['cabecera'=>$cabecera,
               'articulos'=>$articulos, 
               'muestroTotal'=>$muestroTotal,
               'componentes'=>$componentes,
               'base'=>$base,
               'total_iva'=>$total_iva,
               'total_iva_incluido'=>$total_iva_incluido]
               
               
            
            );
        */
            $pdf = \PDF::loadView('pdf.venta2hojas2',['cabecera'=>$cabecera,
            'articulos'=>$articulos, 
            'muestroTotal'=>$muestroTotal,
            'componentes'=>$componentes,
            'base'=>$base,
            'total_iva'=>$total_iva,
            'total_iva_incluido'=>$total_iva_incluido]

            );





            

            $pdf->save('pdf/'.$name);


            $pdfMerger = \PdfMerger::init();
           // $pdfMerger->addPDF(public_path('pdf/PLANTILLA.pdf'), 'all');
           $pdfMerger->addPDF(public_path('pdf/PLANTILLA_SIMPLE.pdf'), 'all');


            $pdfMerger->addPDF(public_path('pdf/'.$name), 'all');

            $pdfMerger->merge();

            $pdfMerger->save(public_path('pdf/'.$name2), "file");



            $filePath =public_path('pdf/'.$name2);
            $headers = ['Content-Type: application/pdf'];
            //$fileName = time().'.pdf';
    
            return response()->download($filePath, $name2, $headers);
    



               //->setPaper('a4', 'landscape');
              // return $pdf->download($name2);
              // return $pdf->download($name);
              //return $pdf->stream($name);
        

    }
    

    public function generarPdfFabricacionOriginal(Request $request) {

      
        $cabecera = Presupuesto::find($request->id);


        $cabecera = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
        ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
        'presupuestos.importefinal','presupuestos.nombre_fiscal','presupuestos.dni','presupuestos.direccion','presupuestos.codigo_postal','presupuestos.poblacion','presupuestos.provincia','presupuestos.telefono','presupuestos.movil','presupuestos.email','presupuestos.observaciones','presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','presupuestos.forma_pago','users.name')
        ->where('presupuestos.id', $request->id)->first();



        $articulos =  PresupuestosDetalle::where('idpresupuesto', '=', $request->id)->orderBy('linea')->get();
        $componentes =  PresupuestoComponente::where('idpresupuesto', '=', $request->id)->get();
      
        $total_iva_incluido= 0;
        $total_iva = 0 ;
        $base = $cabecera->importefinal;

        $total_iva = round(($base * 21) / 100,2);
        $total_iva_incluido = round($base+ $total_iva,2); 


        //return view('pdf.eit',['cabecera' => $cabecera,'articulos' => $articulos, 'componentes'=> $componentes]);

        return view('pdf/venta2',['cabecera' => $cabecera,'articulos' => $articulos, 'componentes'=> $componentes]);

        //  $pdf = \PDF::loadView('pdf.presupuesto',['cabecera'=>$cabecera,'articulos'=>$articulos, 'componentes'=>$componentes])->setPaper('a4', 'landscape');
        $name = 'Exterior_Presupuesto_N_'.$request->id.'_'.strtoupper(ltrim(substr($cabecera->cliente_descripcion,0,8))).'.pdf';
               //$pdf = \PDF::loadView('pdf.eit',['cabecera'=>$cabecera,
        $pdf = \PDF::loadView('pdf/venta2',['cabecera'=>$cabecera,
               'articulos'=>$articulos, 
               'componentes'=>$componentes,
               'base'=>$base,
               'total_iva'=>$total_iva,
               'total_iva_incluido'=>$total_iva_incluido]
               
               
            
            )->setPaper('a4', 'landscape');
                
               return $pdf->download($name);
              //return $pdf->stream($name);
        

    }

    public function update(Request $request)
    {
       //ojo no vale  por???
        dd($request->id);
        if (!$request->ajax()) return redirect('/');


        try{
            DB::beginTransaction();

            $presupuesto =  Presupuesto::findOrFail($request->id);

            $presupuesto->cliente_descripcion = $request->cliente_descripcion;
            $presupuesto->trabajo_descripcion = $request->trabajo_descripcion;

            $presupuesto->contacto = $request->contacto;
            $presupuesto->contacto_envio = $request->contacto_envio;
            $presupuesto->direccion_envio = $request->direccion_envio;
            
            //$presupuesto->fecha_hora = $mytime->toDateString();
            
            $presupuesto->estado = $request->estado;
            $presupuesto->opcion_envio = $request->opcion_envio;
            $presupuesto->referencia_pedido = $request->referencia;
            $presupuesto->tipo_envio = $request->tipo_envio;

            $presupuesto->fecha_entrega = $request->fecha_entrega;
            $presupuesto->fecha_envio = $request->fecha_envio;
            $presupuesto->fecha_presupuesto = $request->fecha_presupuesto;
            $presupuesto->gastos = $request->gastos;
            $presupuesto->subcontratado = $request->subcontratado;
            
            $presupuesto->montaje = $request->montaje;
            $presupuesto->beneficios = $request->beneficios;
            $presupuesto->importefinal = $request->importefinal;

            //130121
            //$presupuesto->costes = $request->costes;
            $presupuesto->costes = $request->costes;

            $presupuesto->nombre_fiscal = $request->nombre_fiscal;
            $presupuesto->dni = $request->dni;
            $presupuesto->direccion = $request->direccion;
            $presupuesto->codigo_postal = $request->codigo_postal;
            $presupuesto->poblacion = $request->poblacion;
            $presupuesto->provincia = $request->provincia;
            $presupuesto->telefono = $request->telefono;
            $presupuesto->movil = $request->movil;
            $presupuesto->email = $request->email;
            $presupuesto->observaciones = $request->observaciones;

             $presupuesto->save();
             $detalles = $request->articulos;
            

             foreach($detalles as $ep=>$det)
             {
                 //dd($det);

                if(isset($det['id'])){
                   // dd($det['id'],'if');
                    $detalle =  PresupuestosDetalle::where('idpresupuesto',$request->id)->firstOrFail();
                    //$detalle->idventa = $venta->id;
                    $detalle->idpresupuesto =  $det['idpresupuesto'];;
                    $detalle->articulo = $det['articulo'];
                    $detalle->descripcion = $det['descripcion'];
                    $detalle->cantidad = $det['cantidad'];
                    $detalle->preciofinal = $det['preciofinal']; 
                    $detalle->importefinal = $det['importefinal']; 
                    $detalle->costes = $det['costes'];

                            //todo, agastos, beneficios
    
                    $detalle->save();

                }else{

                    //dd('else');
                 $detalle = new PresupuestosDetalle();
                 //$detalle->idventa = $venta->id;
                 $detalle->idpresupuesto = $presupuesto->id;
                 $detalle->articulo = $det['articulo'];
                 $detalle->descripcion = $det['descripcion'];
                 $detalle->cantidad = $det['cantidad'];
                 $detalle->preciofinal = $det['preciofinal']; 
                 $detalle->importefinal = $det['importefinal']; 
                 $detalle->costes = $det['costes'];
                         //todo, agastos, beneficios
 
                 $detalle->save();
    
    
                
                
                 
                
                }
                $linea = $detalle->id;
            
            
             $componentes = $request->componentes;
            //  dd($componentes, $detalle, $linea);
             foreach($componentes as $ep=>$comp)
             {
                
                /*                 echo $detalle->articulo.'-' ;
                                echo $comp['articulo_principal'].'-';
                                echo $detalle->articulo === $comp['articulo_principal'].'<br>';

                                echo $detalle->id;
                */
                 


                 if ($detalle->articulo === $comp['articulo_principal']) {
 

                    if(isset($comp['id'])){
                        $componente =  PresupuestoComponente::where('id',$comp['id'])->firstOrFail();

                      //  dd($compoente , 'encontrado');
                  
                        //$componente->idpresupuesto =$presupuesto->id;
                       // $componente->idpresupuestolinea =$linea;
                        
                        //$componente->idpresupuestolinea = $comp['idpresupuestolinea'];
                        //$componente->articulo_principal = $comp['articulo_principal'];
                        
                        //$componente->articulo = $comp['articulo'];
    
                        $componente->descripcion = $comp['descripcion'];
                        // $componente->proveedor = $comp['proveedor'];
    
                        $componente->ancho = $comp['ancho'];
                        $componente->longitud = $comp['longitud'];
                        $componente->m2 = $comp['m2'];
                        $componente->tipounidad = $comp['tipounidad'];
                        
                        $componente->cantidad = $comp['cantidad'];
                        $componente->preciofinal = $comp['preciofinal']; 
    
                           // $componente->descuento = $comp['descuento'];
                           // $componente->preciofinal = $comp['preciofinal']; 
    
                        $componente->montaje = $comp['montaje'];
                        $componente->subcontratado = $comp['subcontratado'];
                        $componente->gastos = $comp['gastos'];
    
                        $componente->beneficios = $comp['beneficios'];
                        $componente->importefinal = $comp['importefinal'];
                        $componente->costes = $comp['costes'];
                        // $componente->comentarios = $comp['comentarios'];
                                                
                        $componente->save();

                     
                    }else{
                        
                    
                      //  dd($comp, 'no existe');

                     $componente = new PresupuestoComponente();
                     //$detalle->idventa = $venta->id;
                     $componente->idpresupuesto =$presupuesto->id;
                     $componente->idpresupuestolinea =$linea;
                     
                     //$componente->idpresupuestolinea = $comp['idpresupuestolinea'];
                     $componente->articulo_principal = $comp['articulo_principal'];
                     
                     $componente->articulo = $comp['articulo'];
 
                     $componente->descripcion = $comp['descripcion'];
                     // $componente->proveedor = $comp['proveedor'];
 
                     $componente->ancho = $comp['ancho'];
                     $componente->longitud = $comp['longitud'];
                     $componente->m2 = $comp['m2'];
                     $componente->tipounidad = $comp['tipounidad'];
                     
                     $componente->cantidad = $comp['cantidad'];
                     $componente->preciofinal = $comp['preciofinal']; 
 
                        // $componente->descuento = $comp['descuento'];
                        // $componente->preciofinal = $comp['preciofinal']; 
 
                     $componente->montaje = $comp['montaje'];
                     $componente->subcontratado = $comp['subcontratado'];
                     $componente->gastos = $comp['gastos'];
 
                     $componente->beneficios = $comp['beneficios'];
                     $componente->importefinal = $comp['importefinal'];
                     $componente->costes = $comp['costes'];
 
                     // $componente->comentarios = $comp['comentarios'];
                                             
                     $componente->save();
                    }
                 }
     
               }
               
 
             }  
 
             DB::commit();
             return [
                 'id' => $presupuesto->id,
                 'presupuesto' => $presupuesto
 
             ];
            
         } catch (Exception $e){
             DB::rollBack();
         }
    }



    
    public function updatedos(Request $request)
    {
        //dd($request);
        if (!$request->ajax()) return redirect('/');


        try{
            DB::beginTransaction();

            $presupuesto =  Presupuesto::findOrFail($request->id);

            $presupuesto->cliente_descripcion = $request->cliente_descripcion;
            $presupuesto->trabajo_descripcion = $request->trabajo_descripcion;

            $presupuesto->contacto = $request->contacto;
            $presupuesto->contacto_envio = $request->contacto_envio;
            $presupuesto->direccion_envio = $request->direccion_envio;
            
            //$presupuesto->fecha_hora = $mytime->toDateString();
            
            $presupuesto->estado = $request->estado;
            $presupuesto->opcion_envio = $request->opcion_envio;
            $presupuesto->referencia_pedido = $request->referencia;
            $presupuesto->tipo_envio = $request->tipo_envio;

            $presupuesto->fecha_entrega = $request->fecha_entrega;
            $presupuesto->fecha_envio = $request->fecha_envio;
            $presupuesto->fecha_presupuesto = $request->fecha_presupuesto;
           
            $presupuesto->gastos = $request->gastos;
            $presupuesto->subcontratado = $request->subcontratado; 
            $presupuesto->montaje = $request->montaje;

            $presupuesto->costes = $request->costes;
            
            $presupuesto->beneficios = $request->beneficios;
            
            $presupuesto->importefinal = $request->importefinal;

            $presupuesto->nombre_fiscal = $request->nombre_fiscal;
            $presupuesto->dni = $request->dni;
            $presupuesto->direccion = $request->direccion;
            $presupuesto->codigo_postal = $request->codigo_postal;
            $presupuesto->poblacion = $request->poblacion;
            $presupuesto->provincia = $request->provincia;
            $presupuesto->telefono = $request->telefono;
            $presupuesto->movil = $request->movil;
            $presupuesto->email = $request->email;
            $presupuesto->observaciones = $request->observaciones;


            $presupuesto->forma_pago = $request->forma_pago;
            $presupuesto->codigo_obra = $request->codigo_obra;


             $presupuesto->save();
             $detalles = $request->articulos;
            

       // dd($presupuesto->observaciones,$request->observaciones);
 
             DB::commit();
             return [
                 'id' => $presupuesto->id,
                 'presupuesto' => $presupuesto, 
                 'comentarios' => $presupuesto->observaciones,
 
             ];
            
         } catch (Exception $e){
             DB::rollBack();
         }
    }



    public function actualizartotales(Request $request)
    {
       // dd($request->id);
        if (!$request->ajax()) return redirect('/');


      

            $presupuesto =  Presupuesto::findOrFail($request->id);

            $presupuesto->gastos = $request->gastos;
            $presupuesto->subcontratado = $request->subcontratado;
            
            $presupuesto->montaje = $request->montaje;
            $presupuesto->beneficios = $request->beneficios;
            $presupuesto->importefinal = $request->importefinal;

            $presupuesto->save();
            
             return [
                 'id' => $presupuesto->id,
 
             ];

            
        
    }

   


    public function eliminarcomponente(Request $request)
    {
        //dd($request);
       // if (!$request->ajax()) return redirect('/');
        
        $componente = PresupuestoComponente::find($request->id);

        
       
        $componente->delete();
        
        
        }

        
    public function aceptarcomopresupuestado(Request $request){
        $presupuesto = Presupuesto::find($request->cabecera['id']);


        //$esta = $request->cabecera['estado'];
       // dd($request->cabecera['id'],$request->cabecera['estado'],$request['estado'],$request->estado,$request);


       $presupuesto->fecha_entrega =$request->cabecera['fecha_entrega'];

        $presupuesto->estado =$request->cabecera['estado'];

        
        $presupuesto->save();

        return [
            'actualizado' => $presupuesto,

        ];


       /*  $objDemo = new \stdClass();
        $objDemo->email = $request->cabecera['email'];
        $objDemo->cliente = $request->cabecera['cliente_descripcion'];
        $objDemo->trabajo = $request->cabecera['trabajo_descripcion']; */

//dd($objDemo,$request);

       // Mail::to($request->email)->send(new AceptarComoPresupuestado($objDemo));



    }

    public function eliminarPresupuesto(Request $request)
    {
        //dd($request->id);
        if (!$request->ajax()) return redirect('/');

        $componentes = PresupuestoComponente::where('idpresupuesto', $request->id)->delete();
        $articulos = PresupuestosDetalle::where('idpresupuesto', $request->id)->delete();
        $presupuesto =   Presupuesto::where('id', $request->id)->delete();
        //Presupuesto::findOrFail($request->id)->delete();

         


         return [
             'id' => $presupuesto,
             'componentes' => $componentes,
             'artiuclos' => $componentes,

         ];


/*         try{
            DB::beginTransaction();

         
            $componentes = PresupuestoComponente::where('idpresupuesto', $request->id)->delete();
            $articulos = PresupuestosDetalle::where('idpresupuesto', $request->id)->delete();
            $presupuesto =   Presupuesto::where('id', $request->id)->delete();
            //Presupuesto::findOrFail($request->id)->delete();
 
             
 
             DB::commit();

             return [
                 'id' => $presupuesto,
                 'componentes' => $componentes,
                 'artiuclos' => $componentes,
 
             ];
            
         } catch (Exception $e){
             DB::rollBack();
         }
 */    }








 public function aceptadosconhoras(Request $request)
 {
     //if (!$request->ajax()) return redirect('/');

     $buscar = $request->buscar;
     $criterio = $request->criterio;
     $aceptado = "ACEPTADO";
     
     if ($buscar==''){
         $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
         ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
         'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
         ->orWhere('presupuestos.estado', 'like', '%'. $aceptado . '%')
         
         ->orderBy('presupuestos.id', 'desc')->paginate(25);
     }
     else{
         $presupuestos = Presupuesto::join('users','presupuestos.idusuario','=','users.id')
         ->select('presupuestos.id','presupuestos.fecha_presupuesto','presupuestos.cliente_descripcion',
         'presupuestos.trabajo_descripcion','presupuestos.contacto','presupuestos.fecha_entrega','presupuestos.estado','users.name')
         ->Where('presupuestos.estado', 'like', '%'. $aceptado . '%')
         ->where(function ($query) use ($aceptado, $criterio,$buscar){

             $query->orWhere('presupuestos.'.$criterio, 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.nombre_fiscal', 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.trabajo_descripcion', 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.contacto', 'like', '%'. $buscar . '%')
                 ->orWhere('presupuestos.id',  '=', $buscar )
             
                 ->orWhere('users.name',  'like', '%'. $buscar . '%');
                
         })
             
         ->orderBy('presupuestos.id', 'desc')->paginate(25);

      

     }

     foreach ($presupuestos as $presupuesto){

            

        $orders = DB::table('obra_mano')
        ->select('tipo_trabajo', 'user_id','obra_id','fin',
        DB::raw("SUM(fin) as final"),
        DB::raw("SUM(TIMESTAMPDIFF(MINUTE,obra_mano.de_fecha_hora,obra_mano.a_fecha_hora)) AS horas"))
        ->groupBy('user_id','tipo_trabajo')
        //->havingRaw('SUM(horas) > ?', [2500])
        ->where([['obra_mano.obra_id' , '=',$presupuesto->obra_id],['obra_mano.condicion' , '=', '1']]) 
        ->get();

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
         'presupuestos' => $presupuestos
     ];
 }

 public function ponerCodigoObra(Request $request)

 {

    //dd($request);
    if (!$request->ajax()) return redirect('/');


 

        $presupuesto =  Presupuesto::findOrFail($request->presupuesto);
        if($presupuesto){
            $obra = Obra::where('codigo','=',$request->obra)->first();
            //dd($presupuesto,$obra,$obra->id);
           //  echo $obra;
            if($obra){
              /*   echo                 $presupuesto->codigo_obra ;
                echo  $obra->id; */

                $presupuesto->codigo_obra = $obra->codigo;
                $presupuesto->save();
                return ['mensajeOk'=> 'Guardado Correctamente'];
                
            }else{


                $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=tblobras&campo1=codigo&valor1='.$request->obra.'&identico=SI');
                if ($xml){
                   // echo 'hay $xml ';
                    //dd($xml, $xml->tblobras_registro->CODIGO,$xml->tblobras_registro->TEXTO );
                   // $json_string = json_encode($xml); 

                    $c = $xml->tblobras_registro->CODIGO->__toString();
                    $t = $xml->tblobras_registro->TEXTO->__toString();
                  //  dd($c, $t,json_encode($xml), $xml);
                    Obra::create([
                        'codigo' => $request->obra,
                        'nombre' => $t,
                        'slug'   => $t
                        ]);
                        return ['mensajeOk'=> 'Obra creada'];

                }else {
                   // echo 'no hayxmla '.$xml;
                    return ['mensaje'=> 'Error XML no existe'];


                   // 306 – ES LA OBRAS 0157/2021 
                }
 
                return ['mensaje'=> 'Obra no existe'];
                // ir a visual a buscar obra y dar de alta..
              
            }
        }else{
            return ['mensaje'=> 'Presupuesto no existe'];
        }

        

 }



 public function ponerFechaEntrega(Request $request)
 {
   // dd($request);
    if (!$request->ajax()) return redirect('/');

       $presupuesto =  Presupuesto::findOrFail($request->presupuesto);
        if($presupuesto){
                $presupuesto->fecha_entrega = $request->fechaEntrega;
                $presupuesto->save();
                return ['mensajeOk'=> 'Guardado Correctamente'];
                
        }else{
            return ['mensaje'=> 'Presupuesto no existe'];
        }
    }


    public function duplicarPresupuestoRotuleon(Request $request)
    {
    
        if (!$request->ajax()) return redirect('/');

       /*  $cabeceraExiste = Presupuesto::on('mysql2')->find($request->id);
        if(!$cabeceraExiste){
            dd($cabecera)
            return ; 
        } */

        $presupuesto = '';
        $componente = '';
        $detalle = '';
        $componentes= "";
        $detalles = '';
      
        $numeroLineasInsertadasDetalle=0;
        $numeroLineasInsertadasComponente=0;
        



    
        try{

            DB::connection('mysql')->beginTransaction();
    
            $cabecera = Presupuesto::on('mysql')->find($request->id);
       
            $presupuesto = new Presupuesto();
            $presupuesto->setConnection('mysql');
            $presupuesto->idusuario = \Auth::user()->id;
            

            $presupuesto->cliente_descripcion = $cabecera->cliente_descripcion;
            $presupuesto->trabajo_descripcion = $cabecera->trabajo_descripcion;

            $presupuesto->contacto = $cabecera->contacto;
            $presupuesto->contacto_envio = $cabecera->contacto_envio;
            $presupuesto->direccion_envio = $cabecera->direccion_envio;
            
            //$presupuesto->fecha_hora = $mytime->toDateString();
            
            $presupuesto->estado = $cabecera->estado;
            $presupuesto->opcion_envio = $cabecera->opcion_envio;
            $presupuesto->referencia_pedido = $cabecera->referencia;
            $presupuesto->tipo_envio = $cabecera->tipo_envio;

            $presupuesto->fecha_entrega = $cabecera->fecha_entrega;
            $presupuesto->fecha_envio = $cabecera->fecha_envio;
            $presupuesto->fecha_presupuesto = $cabecera->fecha_presupuesto;
            
            //130121
            $presupuesto->costes = $cabecera->sumatotales;

            
            $presupuesto->subcontratado = $cabecera->subcontratado;
            $presupuesto->gastos = $cabecera->gastos;
            $presupuesto->montaje = $cabecera->montaje;
            
            $presupuesto->beneficios = $cabecera->beneficios;
            $presupuesto->importefinal = $cabecera->importefinal;
            
            
            $presupuesto->nombre_fiscal = $cabecera->nombre_fiscal;
            $presupuesto->dni = $cabecera->dni;
            $presupuesto->direccion = $cabecera->direccion;
            $presupuesto->codigo_postal = $cabecera->codigo_postal;
            $presupuesto->poblacion = $cabecera->poblacion;
            $presupuesto->provincia = $cabecera->provincia;
            $presupuesto->telefono = $cabecera->telefono;
            $presupuesto->movil = $cabecera->movil;
            $presupuesto->email = $cabecera->email;

            $presupuesto->observaciones = $cabecera->observaciones;
           // $presupuesto->observaciones_taller = $cabecera->observaciones_taller;


            $presupuesto->forma_pago = $cabecera->forma_pago;
            $presupuesto->codigo_obra = $cabecera->codigo_obra;


             $presupuesto->save();


            $detalles = PresupuestosDetalle::on('mysql')->where('idpresupuesto','=',$request->id)->get();
            $componentes = PresupuestoComponente::on('mysql')->where('idpresupuesto','=',$request->id)->get();
            $numeroLineasDetalles = $detalles->count();    
            $numeroLineasComponentes = $componentes->count();   
            //dd($numeroLineasDetalles, $numeroLineasComponentes);     


           // dd($request->id,$cabecera, $detalles, $componentes);
            $idLineaDetalle = 0;
            

            
            if($detalles){
                foreach($detalles as $ep=>$det)
                {
                   

                    $detalle = new PresupuestosDetalle();
                    //$detalle->setConnection('mysql');
                    //$detalle->idventa = $venta->id;
                    $detalle->idpresupuesto = $presupuesto->id;
                    $detalle->articulo = $det['articulo'];
                    $detalle->descripcion = $det['descripcion'];

                    $detalle->ancho = $det['ancho'];
                    $detalle->longitud = $det['longitud'];
                    $detalle->m2 = $det['m2'];
                    $detalle->tipounidad = $det['tipounidad'];

                    $detalle->cantidad = $det['cantidad'];

                    $detalle->precio = $det['precio'];
                    $detalle->descuento = $det['descuento'];


                    $detalle->preciofinal = $det['preciofinal']; 
                   
                    $detalle->montaje = $det['montaje'];
                    $detalle->subcontratado = $det['subcontratado'];
                    $detalle->gastos = $det['gastos'];
                    $detalle->beneficios = $det['beneficios'];
                    $detalle->costes = $det['costes'];

                   
                    $detalle->bultos = $det['bultos'];
                    $detalle->linea = $det['linea'];
                    $detalle->base = $det['base'];

                    $detalle->mermas = $det['mermas'];

                   
                    $detalle->importefinal = $det['importefinal'];
                    
                    $detalle->comentarios = $det['comentarios'];

                            //todo, agastos, beneficios

                   $detalle->save();


                  
                    //dd($componentes, $presupuesto->id);
                    $linea = $detalle->id;
                    $idLineaDetalle = $det['id'];

                    // x cada id de detalle.linea hay varrios componetes 
                    //  componente.articulo_principal === detalle.articulo

                
                    if($componentes){
                        foreach($componentes as $ep=>$comp)
                        {
                    
                        //if ($detalle->articulo === $comp['articulo_principal']) {
                            if (
                                $idLineaDetalle === $comp['idpresupuestolinea']
                                &&
                                $detalle->articulo === $comp['articulo_principal']) {
                          
                          /*   dd('detalle:',$detalle,$detalle->articulo, 
                            'comp:', $comp, $comp['articulo_principal'],
                            'idLineaDetalle:',$idLineaDetalle,
                            'lineaComponente ',$comp['idpresupuestolinea'],
                                 ( $idLineaDetalle === $comp['idpresupuestolinea']
                                    &&
                                     $detalle->articulo === $comp['articulo_principal']),

                               ($idLineaDetalle === $comp['idpresupuestolinea']),
                               ($detalle->articulo === $comp['articulo_principal'])
                            );
                           */


                            $numeroLineasInsertadasComponente = $numeroLineasInsertadasComponente +1;
                        
                            $componente = new PresupuestoComponente();
                           // $componente->setConnection('mysql');
                            $componente->idpresupuesto =$presupuesto->id;
                            $componente->idpresupuestolinea =$linea;
                            
                            $componente->articulo_principal = $comp['articulo_principal'];
                            
                            $componente->articulo = $comp['articulo'];

                            $componente->descripcion = $comp['descripcion'];

                            $componente->ancho = $comp['ancho'];
                            $componente->longitud = $comp['longitud'];
                            $componente->m2 = $comp['m2'];
                            $componente->tipounidad = $comp['tipounidad'];
                            
                            $componente->cantidad = $comp['cantidad'];
                            $componente->precio = $comp['precio'];
                            $componente->descuento = $comp['descuento'];


                            $componente->preciofinal = $comp['preciofinal']; 

                
                            $componente->montaje = $comp['montaje'];
                            $componente->subcontratado = $comp['subcontratado'];
                            $componente->gastos = $comp['gastos'];

                            $componente->beneficios = $comp['beneficios'];
                            $componente->mermas = $comp['mermas'];
                            $componente->costes = $comp['costes'];

                        
                            $componente->importefinal = $comp['importefinal'];
                            $componente->comentarios = $comp['comentarios'];

                            $componente->bultos = $det['bultos'];
                            $componente->linea = $det['linea'];
                            $componente->base = $det['base'];
        
        
                            // si las lineas calculadas !== lineas inserrtadas salir    
                            $componente->save(); 
            
                            }
                        }
                    }
                }
            }

          //  dd($presupuesto, $detalles, $componentes);
              

        if($numeroLineasComponentes === $numeroLineasInsertadasComponente){
            DB::connection('mysql')->commit();


            return [
                'presupuesto' => $presupuesto,
                'detalles' => $detalles,
            'componentes' => $componentes,
            'numeroLineasComponentes' => $numeroLineasComponentes,
            'numeroComoentes' => $numeroLineasInsertadasComponente,

                

            ];
        }else{


            throw new \Exception("Fallo en el testeo de la tabla.");

        }
            
            } catch (\Exception $e){
                DB::rollBack();
                //dd('rollback');
            }
    }
    




}
