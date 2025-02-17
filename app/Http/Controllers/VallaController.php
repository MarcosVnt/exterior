<?php

namespace App\Http\Controllers;

use App\Propietario;
use App\Terreno;
use App\Valla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VallaController extends Controller
{

    public $costeTerreno; 


    private function actualizoCosteTerreno(Terreno $terreno){

        $terre = Terreno::findOrFail($terreno['id']);

        $importePeriodo= 0;

      //  dd($terre['calculo_costes'] === 'xValla',$terre['calculo_costes'] );

        if($terre['calculo_costes'] === 'xValla'){

            
        
            $consulta = Terreno::with('propietario')->with('vallas')->withCount(['vallas' => function ($query) {
                $query->where('vallas.baja', '=', '1');
                $query->select(DB::raw('SUM(vallas.alquiler_anual)'));
            }])->find($terreno['id']);
      //dd($terreno, $consulta);
        


            $terre->alquiler_anual = $consulta['vallas_count'];

           
            $importePeriodo = round(($consulta['vallas_count']  /  $consulta['forma_pago']),2);

            $terre->importe_periodo = $importePeriodo;


            $terre->save();

        }
      

        //dd($terre,$terre->alquiler_anual, $terreno,$terreno['vallas_count']);

    }

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $estado = $request->estado;

      /*   dd($buscar =='' && $estado =='Todas',
        $buscar !='' && $estado =='Todas',
        $buscar !='' && $estado !='Todas',
        $buscar =='' && $estado !='Todas'
        );  */
          // 4buscar =='' && estado !=='Todas'
            // 3buscar !=='' && estado !=='Todas'
            // 1***buscar =='' && estado ==='Todas'
            // 2buscar !=='' && estado ==='Todas'
            

        
        if ($buscar =='' && $estado =='Todas'){
          
           // $vallas = Valla::orderBy('id', 'ASC')->paginate(3);
                $vallas = DB::table('vallas')
                    ->join('terrenos','vallas.terreno_id','terrenos.id')
                    ->join('propietarios','terrenos.propietario_id','propietarios.id')
                    ->select('vallas.*', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
                    ->orderBy('vallas.dni', 'ASC')

                    ->paginate(10);
                    

            
        }

        if ($buscar !=='' && $estado =='Todas'){
           

            $vallas = DB::table('vallas')
           ->join('terrenos','vallas.terreno_id','terrenos.id')
           ->join('propietarios','terrenos.propietario_id','propietarios.id')
           ->select('vallas.*', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
           
           ->where('vallas.dni', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.nombre', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.email', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.direccion', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.postal', 'like', '%'. $buscar . '%')
           
           ->orWhere('vallas.poblacion', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.provincia', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.tipo', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.elemento', 'like', '%'. $buscar . '%')
           //->orWhere('vallas.estado', 'like', '%'. $buscar . '%')
          
           ->orderBy('vallas.dni', 'ASC')
           ->paginate(10);
 
             
         }



          
            
        if ($buscar !=='' && $estado !=='Todas'){
            

           // $vallas = Valla::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'ASC')->paginate(3);
          /*  $vallas = DB::table('vallas')
           ->join('terrenos','vallas.terreno_id','terrenos.id')
           ->join('propietarios','terrenos.propietario_id','propietarios.id')
           ->select('vallas.*', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
           ->where('vallas.estado', 'like', '%'. $estado . '%')
           ->where(function($query) use ($buscar) {

            $query->where('vallas.dni', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.email', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.direccion', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.postal', 'like', '%'. $buscar . '%')
            
            ->orWhere('vallas.poblacion', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.provincia', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.tipo', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.elemento', 'like', '%'. $buscar . '%');
            //->orWhere('vallas.estado', 'like', '%'. $buscar . '%')

           }) 
         
          
           ->orderBy('id', 'ASC')
           ->paginate(10);*/
           $vallas = DB::table('vallas')
           ->join('terrenos','vallas.terreno_id','terrenos.id')
           ->join('propietarios','terrenos.propietario_id','propietarios.id')
           ->select('vallas.*', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
          // ->where('vallas.estado', 'like', '%'. $estado . '%')
          

          ->orWhere('terrenos.nombre', 'like', '%'. $buscar . '%')
          ->orWhere('propietarios.nombre', 'like', '%'. $buscar . '%')

          ->orWhere('vallas.dni', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.email', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.direccion', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.postal', 'like', '%'. $buscar . '%')
            
            ->orWhere('vallas.poblacion', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.provincia', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.tipo', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.elemento', 'like', '%'. $buscar . '%')
            //->orWhere('vallas.estado', 'like', '%'. $buscar . '%')

          
         
          
            ->orderBy('vallas.dni', 'ASC')

           ->paginate(10);
       
        }

        if ($buscar=='' && $estado!=='Todas'){

            // $vallas = Valla::orderBy('id', 'ASC')->paginate(3);
                 $vallas = DB::table('vallas')
                     ->join('terrenos','vallas.terreno_id','terrenos.id')
                     ->join('propietarios','terrenos.propietario_id','propietarios.id')
                     ->select('vallas.*', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
                     ->where('vallas.estado', 'like', '%'. $estado . '%')
                     ->orderBy('vallas.dni', 'ASC')

                     ->paginate(10);
 
             
         }
     

        return [
            'pagination' => [
                'total'        => $vallas->total(),
                'current_page' => $vallas->currentPage(),
                'per_page'     => $vallas->perPage(),
                'last_page'    => $vallas->lastPage(),
                'from'         => $vallas->firstItem(),
                'to'           => $vallas->lastItem(),
            ],
            'vallas' => $vallas
        ];
    }



    public function listarVallas(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $estado = $request->estado;
        $ruta = $request->ruta; 

        /* dd($buscar =='' && $estado =='Todas',
        $buscar !='' && $estado =='Todas',
        $buscar !='' && $estado !='Todas',
        $buscar =='' && $estado !='Todas'
        ); */
          // 4buscar =='' && estado !=='Todas'
            // 3buscar !=='' && estado !=='Todas'
            // 1***buscar =='' && estado ==='Todas'
            // 2buscar !=='' && estado ==='Todas'
            
           
    
        
        if ($buscar =='' && $estado =='Todas'){
          
           // $vallas = Valla::orderBy('id', 'ASC')->paginate(3);
                $vallas = DB::table('vallas')
                    ->join('terrenos','vallas.terreno_id','terrenos.id')
                    ->join('propietarios','terrenos.propietario_id','propietarios.id')

                    ->leftJoin('ruta_valla_lineas','vallas.id','ruta_valla_lineas.valla_id')
                    ->select('vallas.*','ruta_valla_lineas.ruta_valla_id as ruta_id', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
                    
                    ->orderBy('vallas.dni', 'ASC')
                    ->groupBy('vallas.id')

                    ->get();
                    

            
        }

        if ($buscar !=='' && $estado =='Todas'){
           

            $vallas = DB::table('vallas')
           ->join('terrenos','vallas.terreno_id','terrenos.id')
           ->join('propietarios','terrenos.propietario_id','propietarios.id')
           ->leftJoin('ruta_valla_lineas','vallas.id','ruta_valla_lineas.valla_id')
           ->select('vallas.*','ruta_valla_lineas.ruta_valla_id as ruta_id', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
  
           ->where('vallas.dni', 'like', '%'. $buscar . '%')
           //->where('vallas.baja', '===', 1)

           ->orWhere('vallas.nombre', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.email', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.direccion', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.postal', 'like', '%'. $buscar . '%')
           
           ->orWhere('vallas.poblacion', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.provincia', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.tipo', 'like', '%'. $buscar . '%')
           ->orWhere('vallas.elemento', 'like', '%'. $buscar . '%')
           
           //->orWhere('vallas.estado', 'like', '%'. $buscar . '%')
          
           ->orderBy('vallas.dni', 'ASC')
           ->groupBy('vallas.id')

          ->get();
 
             
         }



          
            
        if ($buscar !=='' && $estado !=='Todas'){
            

            if ($estado ==='Baja'){
                $baja = 2;

            }else{
                $baja = 1; 

            }

           // $vallas = Valla::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'ASC')->paginate(3);
           $vallas = DB::table('vallas')
           ->join('terrenos','vallas.terreno_id','terrenos.id')
           ->join('propietarios','terrenos.propietario_id','propietarios.id')
           ->leftJoin('ruta_valla_lineas','vallas.id','ruta_valla_lineas.valla_id')
           ->select('vallas.*','ruta_valla_lineas.ruta_valla_id as ruta_id', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
           ->where('vallas.estado', 'like', '%'. $estado . '%')
          // ->Where('vallas.baja', '===', $baja)

           ->where(function($query) use ($buscar) {

            $query->where('vallas.dni', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.email', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.direccion', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.postal', 'like', '%'. $buscar . '%')
            
            ->orWhere('vallas.poblacion', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.provincia', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.tipo', 'like', '%'. $buscar . '%')
            ->orWhere('vallas.elemento', 'like', '%'. $buscar . '%')

            
            ;
            //->orWhere('vallas.estado', 'like', '%'. $buscar . '%')

           })
         
          
           ->orderBy('vallas.dni', 'ASC')
           ->groupBy('vallas.id')


          ->get();
       
        }

        if ($buscar=='' && $estado!=='Todas'){

            // $vallas = Valla::orderBy('id', 'ASC')->paginate(3);
                 $vallas = DB::table('vallas')
                     ->join('terrenos','vallas.terreno_id','terrenos.id')
                     ->join('propietarios','terrenos.propietario_id','propietarios.id')
                
                     ->leftJoin('ruta_valla_lineas','vallas.id','ruta_valla_lineas.valla_id')
                     ->select('vallas.*','ruta_valla_lineas.ruta_valla_id as ruta_id', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
     
                     ->where('vallas.estado', 'like', '%'. $estado . '%')

                     ->orderBy('vallas.dni', 'ASC')
                     
                     ->groupBy('vallas.id')

                    ->get();
 
             
         }

         if ($buscar=='' && $estado==='Rutas'){


        

            // $vallas = Valla::orderBy('id', 'ASC')->paginate(3);
                 $vallas = DB::table('vallas')
                     ->join('terrenos','vallas.terreno_id','terrenos.id')
                     ->join('propietarios','terrenos.propietario_id','propietarios.id')
                     ->leftJoin('ruta_valla_lineas','vallas.id','ruta_valla_lineas.valla_id')
                    
                     ->select('vallas.*','ruta_valla_lineas.ruta_valla_id as ruta_id', 'terrenos.nombre as terreno','propietarios.nombre as propietario')
                     ->where('ruta_valla_lineas.ruta_valla_id', $ruta)

                     ->orderBy('vallas.dni', 'ASC')

                    ->get();


                   // dd($vallas, $ruta, $request);
 
             
         }

     

        return [
          
            'vallas' => $vallas
        ];
    }

    public function createDesdeForm(Request $request){
        //dd($request,$request['data'], $request['data']['propietario'],$request['data']['propietario']['id']);
        
            $propietario = $request['data']['propietario'];
            $terreno = $request['data']['terreno'];
            $valla = $request['data']['valla'];

           
            

            try{
                DB::beginTransaction();
    
             
                if ($propietario['id']=== 0){
                    $prop = new Propietario();
                    $prop->dni = $propietario['dni'];
                    $prop->nombre = $propietario['nombre'];
                    $prop->direccion = $propietario['direccion'];
                    $prop->poblacion = $propietario['poblacion'];
                    $prop->postal = $propietario['postal'];
                    $prop->provincia = $propietario['provincia'];
                    $prop->email = $propietario['email'];
                    $prop->telefono = $propietario['telefono'];
    
                    $prop->save();
    
                } else {
                    $prop = (object) array('id' => $propietario['id']);
                     
                }
                if ($terreno['id']=== 0){
                    $terre = new Terreno();
                    $terre->propietario_id = $prop->id;
                    $terre->dni = $terreno['dni'];
                    $terre->nombre = $terreno['nombre'];
                    $terre->direccion = $terreno['direccion'];
                    $terre->poblacion = $terreno['poblacion'];
                    $terre->postal = $terreno['postal'];
                    $terre->provincia = $terreno['provincia'];
                    $terre->email = $terreno['email'];
                    $terre->telefono = $terreno['telefono'];
                    $terre->forma_pago = $terreno['forma_pago'];
                    $terre->importe_periodo = $terreno['importe_periodo'];
                    $terre->alquiler_anual = $terreno['alquiler_anual'];
    
                    $terre->save();
    
                } else {
                    $terre = (object) array('id' => $terreno['id']);
                     
                }
                if ($valla['id']=== 0){

                    $vall = new Valla();

                    $vall->terreno_id = $terre->id;
                    $vall->dni = $valla['dni'];
                    $vall->nombre = $valla['nombre'];
                    $vall->direccion = $valla['direccion'];
                    $vall->poblacion = $valla['poblacion'];
                    $vall->postal = $valla['postal'];
                    $vall->provincia = $valla['provincia'];
                    $vall->email = $valla['email'];
                    $vall->telefono = $valla['telefono'];
                    $vall->latitud = $valla['latitud'];
                    $vall->longitud = $valla['longitud'];

                    $vall->ancho = $valla['ancho'];
                    $vall->alto = $valla['alto'];
                    $vall->m2 = $valla['m2'];
                    $vall->tipo = $valla['tipo'];
                    $vall->elemento = $valla['elemento'];
                    $vall->estado = $valla['estado'];

                    $vall->forma_pago = $valla['forma_pago'];
                    $vall->importe_periodo = $valla['importe_periodo'];
                    $vall->alquiler_anual = $valla['alquiler_anual'];

                    if ($valla['estado']==='Baja')
                            {$vall->baja =2;

                    }else{
                            $vall->baja = 1;
                    }

                    
                    if ($valla['observaciones']===null)
                    {$vall->observaciones =' ';

               }else{
                    $vall->observaciones = $valla['observaciones'];
               }
                    
    
                    $vall->save();
    
                }
                
                $this->actualizoCosteTerreno($terre);
                 
     
                 DB::commit();
    
                 return [
                     'propietario' => $prop,
                     'terreno' => $terre,
                     'valla' => $vall,
     
                 ];
                
             } catch (Exception $e){
                 DB::rollBack();
                 
                 return redirect ('login');

                  
             }




    }
    

    public function updateDesdeForm(Request $request){
       //dd($request,$request['data'], $request['data']['propietario'],$request['data']['valla']['id']);
        
            $propietario = $request['data']['propietario'];
            $terreno = $request['data']['terreno'];
            $valla = $request['data']['valla'];

       // dd($valla);
          
       /*  if($request->exists(['data','valla','id']) ){

           
                $valla_id = $request['data']['valla']['id'];
                $valla_a_borrar = Valla::find($valla_id);
                if($valla_a_borrar){
                    $valla_a_borrar->delete();
                }
        } */
         


           
            

            try{
                DB::beginTransaction();
    
             
                if ($propietario['id']=== 0){
                    $prop = new Propietario();
                    $prop->dni = $propietario['dni'];
                    $prop->nombre = $propietario['nombre'];
                    $prop->direccion = $propietario['direccion'];
                    $prop->poblacion = $propietario['poblacion'];
                    $prop->postal = $propietario['postal'];
                    $prop->provincia = $propietario['provincia'];
                    $prop->email = $propietario['email'];
                    $prop->telefono = $propietario['telefono'];
    
                    $prop->save();
    
                } else {
                    $prop = (object) array('id' => $propietario['id']);
                    
                    $prop1 = Propietario::find($propietario['id']);
                    if($prop1){
                        $prop1->dni = $propietario['dni'];
                        $prop1->nombre = $propietario['nombre'];
                        $prop1->direccion = $propietario['direccion'];
                        $prop1->poblacion = $propietario['poblacion'];
                        $prop1->postal = $propietario['postal'];
                        $prop1->provincia = $propietario['provincia'];
                        $prop1->email = $propietario['email'];
                        $prop1->telefono = $propietario['telefono'];
        
                        $prop1->save();
                }
                     
                }
                if ($terreno['id']=== 0){
                    $terre = new Terreno();
                    $terre->propietario_id = $prop->id;
                    $terre->dni = $terreno['dni'];
                    $terre->nombre = $terreno['nombre'];
                    $terre->direccion = $terreno['direccion'];
                    $terre->poblacion = $terreno['poblacion'];
                    $terre->postal = $terreno['postal'];
                    $terre->provincia = $terreno['provincia'];
                    $terre->email = $terreno['email'];
                    $terre->telefono = $terreno['telefono'];
                    $terre->forma_pago = $terreno['forma_pago'];
                    $terre->importe_periodo = $terreno['importe_periodo'];
                    $terre->alquiler_anual = $terreno['alquiler_anual'];
 
                    $terre->save();
    
                } else {
                    $terre = Terreno::find($terreno['id']);
                    if($terreno['id']){
                        $terre->propietario_id = $prop->id;
                        $terre->dni = $terreno['dni'];
                        $terre->nombre = $terreno['nombre'];
                        $terre->direccion = $terreno['direccion'];
                        $terre->poblacion = $terreno['poblacion'];
                        $terre->postal = $terreno['postal'];
                        $terre->provincia = $terreno['provincia'];
                        $terre->email = $terreno['email'];
                        $terre->telefono = $terreno['telefono'];
                        $terre->forma_pago = $terreno['forma_pago'];
                        $terre->importe_periodo = $terreno['importe_periodo'];
                        $terre->alquiler_anual = $terreno['alquiler_anual'];
     
                        $terre->save();

                    }
                   // $terre = (object) array('id' => $terreno['id']);
                     
                }


                if ($valla['id']=== 0){

             

                    $vall = new Valla();

                    $vall->terreno_id = $terre->id;
                    $vall->dni = $valla['dni'];
                    $vall->nombre = $valla['nombre'];
                    $vall->direccion = $valla['direccion'];
                    $vall->poblacion = $valla['poblacion'];
                    $vall->postal = $valla['postal'];
                    $vall->provincia = $valla['provincia'];
                    $vall->email = $valla['email'];
                    $vall->telefono = $valla['telefono'];
                    $vall->latitud = $valla['latitud'];
                    $vall->longitud = $valla['longitud'];

                    $vall->ancho = $valla['ancho'];
                    $vall->alto = $valla['alto'];
                    $vall->m2 = $valla['m2'];
                    $vall->tipo = $valla['tipo'];
                    $vall->elemento = $valla['elemento'];

                    $vall->forma_pago = $valla['forma_pago'];
                    $vall->importe_periodo = $valla['importe_periodo'];
                    $vall->alquiler_anual = $valla['alquiler_anual'];
 
                   /*  $vall->estado = $valla['estado'];
                    if ($valla['estado']===2)
                         {$vall->estado =2;
    
                    }else{
                         $vall->estado = 1;
                    } */
                    $vall->estado = $valla['estado'];
                    if ($valla['estado']==='Baja')
                            {$vall->baja =2;

                    }else{
                            $vall->baja = 1;
                    }
    
                    if ($valla['observaciones']===null)
                         {$vall->observaciones =' ';
    
                    }else{
                         $vall->observaciones = $valla['observaciones'];
                    } 
                }else{

                    $vall = Valla::find($valla['id']);
                    if($valla['id']){
                        $vall->terreno_id = $terre->id;
                    $vall->dni = $valla['dni'];
                    $vall->nombre = $valla['nombre'];
                    $vall->direccion = $valla['direccion'];
                    $vall->poblacion = $valla['poblacion'];
                    $vall->postal = $valla['postal'];
                    $vall->provincia = $valla['provincia'];
                    $vall->email = $valla['email'];
                    $vall->telefono = $valla['telefono'];
                    $vall->latitud = $valla['latitud'];
                    $vall->longitud = $valla['longitud'];

                    $vall->ancho = $valla['ancho'];
                    $vall->alto = $valla['alto'];
                    $vall->m2 = $valla['m2'];
                    $vall->tipo = $valla['tipo'];
                    $vall->elemento = $valla['elemento'];

                    $vall->forma_pago = $valla['forma_pago'];
                    $vall->importe_periodo = $valla['importe_periodo'];
                    $vall->alquiler_anual = $valla['alquiler_anual'];
                   /*  $vall->estado = $valla['estado'];
                    if ($valla['estado']===2)
                         {$vall->estado =2;
    
                    }else{
                         $vall->estado = 1;
                    } */
                    $vall->estado = $valla['estado'];
                    if ($valla['estado']==='Baja')
                            {$vall->baja =2;

                    }else{
                            $vall->baja = 1;
                    }
    
                    if ($valla['observaciones']===null)
                         {$vall->observaciones =' ';
    
                    }else{
                         $vall->observaciones = $valla['observaciones'];
                    } 


                    }

                }


                   
    
                    $vall->save();
    
               
                
     
                 
     
                 DB::commit();
    
              
                 $this->actualizoCosteTerreno($terre);

                 return [
                     'propietario' => $prop,
                     'terreno' => $terre,
                     'valla' => $vall,
     
                 ];
                
             } catch (Exception $e){
                 DB::rollBack();
             }

    }
    public function vallaDatos($id){
    
        //dd($id);
        $terreno = Terreno::find($id);

        if($terreno){
            $propietario = Propietario::find($terreno->propietario_id);
        }
        return [
            'terreno' => $terreno,
            'propietario' => $propietario
        ];
       

    }

    public function eliminar(Request $request){
        $vall = Valla::find($request['id']);

        //dd($vall, $vall['estado']);
        if($vall){
           // $valla_a_borrar->delete();
           $vall['estado'] = "Baja";
           $vall['Baja'] = "2";

           $vall->save();

           
        }
        $terre = Terreno::find($vall['terreno_id']);
        $this->actualizoCosteTerreno($terre);

        return [
            'id' => $request->id,
            

        ];
    }
    public function activar(Request $request){
        $vall = Valla::with('terreno')->find($request['id']);

      //  dd($vall, $vall['estado'], $vall->load('terreno'));
        if($vall){
           // $valla_a_borrar->delete();
           $vall['estado'] = "Libre";
           $vall['Baja'] = "1";

           $vall->save();

           
        }
        $terre = Terreno::find($vall['terreno_id']);

        $this->actualizoCosteTerreno($terre);
        return [
            'id' => $request->id,
            

        ];
    }

    public function vallasindex(){
    
       
        $vallas = Valla::all();
       // dd('inicioa',$vallas);
        //return view('',compact('array1','array2'));

        return view('vallas.contenido', ['vallas' => $vallas]);
        //)->with(json_encode($vallas));
        //,compact('vallas'));
        //->with($vallas);
        //,['vallas',$vallas]);
        //,compact('vallas'));
        //      'view.name', ['some' => 'data'])


       

    }

    public function vallasexteriorindex(){
    
       
        $vallas = Valla::all();
    

        return view('vallas.exterior', ['vallas' => $vallas]);
      

       

    }
}
