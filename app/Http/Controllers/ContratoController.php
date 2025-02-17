<?php

namespace App\Http\Controllers;

use App\Agencia;
use Illuminate\Http\Request;
use App\Contratos;
use App\Agencias;
use App\cliente;
use App\Clientes;
use App\contrato;
use App\Nova\Contrato as NovaContrato;
use App\Valla;
use App\Vallas;

use Illuminate\Support\Facades\DB;


use Illuminate\Database\Eloquent\Builder;



class ContratoController extends Controller
{
    //

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $estado = $request->estado;


        //dd($buscar, $buscar==='', $buscar!=='',$buscar===null);

        
        if ($buscar ===null){
          
           // $vallas = Valla::orderBy('id', 'desc')->paginate(3);

               /*
               ORIGINAL  */
                $contratos = DB::table('contratos')
                    ->join('agencias','contratos.agencia_id','agencias.id')
                    ->join('clientes','contratos.cliente_id','clientes.id')
                    ->join('vallas','contratos.valla_id','vallas.id')  
                    ->join('terrenos','terrenos.id','vallas.terreno_id')  
                       

                    ->select('contratos.*','vallas.dni','clientes.nombre as clienteNombre',
                    'agencias.nombre as agenciaNombre', 'terrenos.nombre as terrenoNombre',
                    'terrenos.dni as referencia',
                    'vallas.nombre as vallaNombre')
                    ->where('contratos.baja', '>=', '1')
                    ->orderByRaw('ABS(DATEDIFF(contratos.fecha_final, CURDATE()))')
                    ->paginate(10); 

                  /*   $data = contrato::findOrFail('30')->valla->terreno;

                    dd($data); */

                    
                //$contratos = contrato::with('cliente','agencia','valla','terreno')->where('baja','>=', '1')->paginate(10);
                
                /* whereHas('contrato', function ( Builder $query) use ( $buscar) {
                        $query->where('baja','>=', '1');
                       })->paginate(10); */
                    

            
        }

       else{


        //$contrato = contrato::with('agencia')->where('id', '24')->get();

      /*   $posts = Post::whereHas('comments', function (Builder $query) {
            $query->where('content', 'like', 'code%');
        })->get(); 
        
        
        $posts = Post::whereHas('category', function (Builder $q) use ($category_id) {
    $q->where('id', '=', $category_id);
})->paginate(12);
        
        */

     /*  OOOOOOKKKKKK  */
     
   /*  CON ELOQUENT  
   $contratos = contrato::with('cliente','agencia','valla')
        ->whereHas('cliente', function ( Builder $query) use ( $buscar) {
            $query->where('nombre','LIKE', '%'.$buscar.'%');
           })
        ->orWhereHas('agencia', function ( Builder $query) use ( $buscar) {
            $query->where('nombre','LIKE', '%'.$buscar.'%');
           })
           ->orWhereHas('valla', function ( Builder $query) use ( $buscar) {
            $query->where('nombre','LIKE', '%'.$buscar.'%');
           })
           
        
        ->paginate(10); */

         //  dd($contratos);
 


     /*    $contratos = contrato::with(['cliente' => function($query) use ($buscar) {
            
            $query->where('nombre', 'LIKE','SERNA');
          }])->paginate(10);
 */
           
      //    $query->where('name', 'like', "%{$value}%");

//->where('clientes.nombre.', 'LIKE', '%'. $buscar . '%')

//dd($buscar, $contratos);


           /*  
           ORIGINAL */
           $contratos = DB::table('contratos')
                    ->join('agencias','contratos.agencia_id','agencias.id')
                    ->join('clientes','contratos.cliente_id','clientes.id')
                    ->join('vallas','contratos.valla_id','vallas.id')     
                    ->join('terrenos','terrenos.id','vallas.terreno_id')  
             
                    ->select('contratos.*','vallas.dni','clientes.nombre as clienteNombre'
                    ,'agencias.nombre as agenciaNombre', 'terrenos.nombre as terrenoNombre',
                    'terrenos.dni as referencia',
                    'vallas.nombre as vallaNombre')
           
                   // ->where('contratos.baja','>=', '1')

            ->orWhere('contratos.referencia', 'like', '%'. $buscar . '%')
           ->orWhere('agencias.nombre', 'like', '%'. $buscar . '%')
           ->orWhere('clientes.nombre', 'like', '%'. $buscar . '%')
           ->orWhere('terrenos.nombre', 'like', '%'. $buscar . '%')
           ->orWhere('terrenos.dni', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.dni', 'like', '%'. $buscar . '%')

           ->orWhere('contratos.descripcion', 'like', '%'. $buscar . '%')
           ->orWhere('contratos.observaciones', 'like', '%'. $buscar . '%')
        
           ->orderBy('contratos.id', 'desc')
           
    
           ->paginate(10);
 
           
         }

       /*   $contratos = contrato::all();
         dd($contratos->cliente);
         $contratos->paginate(10); */


     

        return [
            'pagination' => [
                'total'        => $contratos->total(),
                'current_page' => $contratos->currentPage(),
                'per_page'     => $contratos->perPage(),
                'last_page'    => $contratos->lastPage(),
                'from'         => $contratos->firstItem(),
                'to'           => $contratos->lastItem(),
            ],
            'contratos' => $contratos
        ];
    }


    public function createDesdeForm(Request $request){
        //dd($request,$request['data'], $request['data']['propietario'],$request['data']['propietario']['id']);
        
            $agencia = $request['data']['agencia'];
            $cliente = $request['data']['cliente'];
            $contrato = $request['data']['contrato'];

           // dd($agencia, $cliente, $contrato);

           
            

            try{
                DB::beginTransaction();
    
             
                if ($agencia['id']=== 0){
                    if($agencia['dni'] == null && $agencia['nombre'] == null){
                        $age = (object) array('id' => 1);

                    }else{
                        $age = new Agencia();
                        $age->dni = $agencia['dni'];
                        $age->nombre = $agencia['nombre'];
                        $age->direccion = $agencia['direccion'];
                        $age->poblacion = $agencia['poblacion'];
                        $age->postal = $agencia['postal'];
                        $age->provincia = $agencia['provincia'];
                        $age->email = $agencia['email'];
                        $age->telefono = $agencia['telefono'];
                        $age->observaciones = $agencia['observaciones'];
        
                        $age->save();
                    }
    
                } else {
                    $age = (object) array('id' => $agencia['id']);

                
                     
                }
                if ($cliente['id']=== 0){
                    $cli = new cliente();
                    $cli->dni = $cliente['dni'];
                    $cli->nombre = $cliente['nombre'];
                    $cli->direccion = $cliente['direccion'];
                    $cli->poblacion = $cliente['poblacion'];
                    $cli->postal = $cliente['postal'];
                    $cli->provincia = $cliente['provincia'];
                    $cli->email = $cliente['email'];
                    $cli->telefono = $cliente['telefono'];
                    $cli->observaciones = $cliente['observaciones'];
                    
    
                    $cli->save();
    
                } else {
                    $cli = (object) array('id' => $cliente['id']);
                     
                }
                if ($contrato['id']=== 0){

                    $cont = new contrato();

                    $cont->agencia_id = $age->id;
                    $cont->cliente_id = $cli->id;
                    $cont->valla_id = $contrato['valla_id'];

                    $cont->ejercicio = $contrato['ejercicio'];
                    $cont->numero = $contrato['numero'];
                    $cont->referencia = $contrato['referencia'];
                    $cont->descripcion = $contrato['descripcion'];
                    $cont->observaciones = $contrato['observaciones'];
                    $cont->fecha_inicio = $contrato['fecha_inicio'];
                    $cont->fecha_final = $contrato['fecha_final'];
                    $cont->duracion = $contrato['duracion'];
                    $cont->forma_pago = $contrato['forma_pago'];
                    $cont->importe_periodo = $contrato['importe_periodo'];

                    $cont->alquiler_anual = $contrato['alquiler_anual'];
                    $cont->baja = 1;
    
                    $cont->save();
    
                }
                
     
                 
     
                 DB::commit();

                 $valla = Valla::findOrFail($cont->valla_id);
                 $valla->estado = 'Ocupada' ; 
                 
                 $valla->save();


    
                 return [
                     'agencia' => $age,
                     'cliente' => $cli,
                     'contrato' => $cont,
     
                 ];
                
             } catch (Exception $e){
                 DB::rollBack();
             }

    }


      public function updateDesdeForm(Request $request){
        //dd($request,$request['data'], $request['data']['propietario'],$request['data']['propietario']['id']);
        
        $agencia = $request['data']['agencia'];
        $cliente = $request['data']['cliente'];
        $contrato = $request['data']['contrato'];
         //dd($request, $contrato, $contrato['ejercicio'], $contrato['id']);
           
            try{
    
                DB::beginTransaction();
                $cont = contrato::findOrFail($contrato['id']);
                $cont->cliente_id = $contrato['cliente_id'];

                /**
                 * 
                 * 
                 */

         
                if ($agencia['id']=== 0){
                    if($agencia['dni'] == null && $agencia['nombre'] == null){
                        $age = (object) array('id' => 1);
                        //dd('$age',$age);

                    }else{
                        
                        $agenciaExiste = Agencia::where('nombre', $agencia['nombre'])->first();
                       // dd($agenciaExiste);
                        if($agenciaExiste){
                            $cont->agencia_id = $agenciaExiste['id'];
                          //  dd('cont',$cont);

                        }else{
                            $age = new Agencia();
                            $age->dni = $agencia['dni'];
                            $age->nombre = $agencia['nombre'];
                            $age->direccion = $agencia['direccion'];
                            $age->poblacion = $agencia['poblacion'];
                            $age->postal = $agencia['postal'];
                            $age->provincia = $agencia['provincia'];
                            $age->email = $agencia['email'];
                            $age->telefono = $agencia['telefono'];
                            $age->observaciones = $agencia['observaciones'];
            
                            $age->save();

                           //dd('age',$age);
                            $cont->agencia_id = $age->id;


                        }
                        
                    }
    

                }else{
                  //  $cont->agencia_id = $contrato['agencia_id'];
                  $cont->agencia_id = $agencia['id'];

                  //dd('else', $cont, $agencia);
                 // dd($cont->agencia_id , $agencia['id']);

                }
                //dd($cont, $agencia);
                //dd($agenciaExiste, $agencia['nombre'],$agencia,$cliente,$contrato);    

                //$cont->agencia_id = $contrato['agencia_id'];
                $cont->valla_id = $contrato['valla_id'];


              

                $cont->ejercicio = $contrato['ejercicio'];
                $cont->numero = $contrato['numero'];
                $cont->referencia = $contrato['referencia'];
                $cont->descripcion = $contrato['descripcion'];
                $cont->observaciones = $contrato['observaciones'];
                $cont->fecha_inicio = $contrato['fecha_inicio'];
                $cont->fecha_final = $contrato['fecha_final'];
                $cont->duracion = $contrato['duracion'];
                $cont->forma_pago = $contrato['forma_pago'];
                $cont->importe_periodo = $contrato['importe_periodo'];

                $cont->alquiler_anual = $contrato['alquiler_anual'];
                $cont->baja =  $contrato['baja'];;

                $cont->save();

    
               
                
     
                 
     
                 DB::commit();
    
                 return [
                     'contrato' => $cont,
                  
     
                 ];
                
             } catch (Exception $e){
                 DB::rollBack();
             }

    }





    
public function eliminar(Request $request)
{
   //s dd($request->id);

    if (!$request->ajax()) return redirect('/');
    $cont = contrato::findOrFail($request->id);
    $cont->baja = 2 ; 
    $cont->ejercicio = 9999;
    $cont->save();

    $valla = Valla::findOrFail($cont->valla_id);
    $valla->estado = 'Libre' ; 
    
    $valla->save();
    
}


public function datos($id){
    
   // dd($id);

    $contrato = contrato::find($id);

    if($contrato){
      //  $cliente = cliente::find($contrato->cliente_id);
       // $agencia = cliente::find($contrato->agencia_id);
       $cliente = $contrato->cliente;
       $agencia = $contrato->agencia; 
       $valla = $contrato->valla;
       $terreno = $valla->terreno;
        
    }
    return [
        'contrato' => $contrato,
       
    ];
   

}


    
public function finalizar(Request $request)
{
  // dd($request);

    if (!$request->ajax()) return redirect('/');
    $cont = contrato::findOrFail($request->id);
    $cont->baja = $request->estado; 
    $cont->ejercicio = 0;
    $cont->save();

    $valla = Valla::findOrFail($cont->valla_id);
    $valla->estado = 'Libre' ; 
    
    $valla->save();
    
}


    
public function activar(Request $request)
{
  // dd($request);

    if (!$request->ajax()) return redirect('/');
    $cont = contrato::findOrFail($request->id);
    $cont->baja = $request->estado; 
    $cont->ejercicio = 0;
    $cont->save();

    $valla = Valla::findOrFail($cont->valla_id);
    $valla->estado = 'Ocupada' ; 
    
    $valla->save();
    
}



}
