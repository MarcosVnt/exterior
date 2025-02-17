<?php

namespace App\Http\Controllers;

use App\Terreno;
use App\contrato;
use App\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class TerrenoController extends Controller
{
    
    public function maxDni()
    {
        $maxDni = Terreno::MaxDNI();

       // dd($maxDni);
        return response()->json(['maxDni' => $maxDni]);
    }

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $estado = $request->estado;


        if ($buscar === null) {

            $terrenos = Terreno::
                //withCount('contratos')->
                //withCount('vallas')->
                with('propietario')->with(['contratos' => function ($query) {
                    $query->orderBy('contratos.referencia', 'ASC');
                    
                }])->with('vallas')
                ->withCount(['vallas' => function ($query) {
                    $query->where('vallas.baja', '=', '1');
                    $query->select(DB::raw('SUM(vallas.alquiler_anual)'));
                   

                }])
                ->withCount(['contratos' => function ($query) {
                    $query->where('contratos.baja', '=', '1');
                    $query->select(DB::raw('SUM(contratos.alquiler_anual)'));
                    $query->orderBy('vallas.dni', 'ASC');

                }])



                ->orderBy('terrenos.dni', 'ASC')
                ->paginate(10);



            /*ORIGINAL  $terrenos = DB::table('terrenos')
            ->join('propietarios','terrenos.propietario_id','propietarios.id')
            ->select('terrenos.*','propietarios.nombre as propietarioNombre')

            ->orderBy('terrenos.dni', 'ASC')
            ->paginate(10);
             */
            return [
                'pagination' => [
                    'total'        => $terrenos->total(),
                    'current_page' => $terrenos->currentPage(),
                    'per_page'     => $terrenos->perPage(),
                    'last_page'    => $terrenos->lastPage(),
                    'from'         => $terrenos->firstItem(),
                    'to'           => $terrenos->lastItem(),
                ],
                'terrenos' => $terrenos
            ];
        } else {

            /*   ORIGINAL 
             $terrenos = DB::table('terrenos')
            ->join('propietarios','terrenos.propietario_id','propietarios.id')
    
            ->select('terrenos.*','propietarios.nombre as propietarioNombre')

            //  ->orWhere('terrenos.baja','>=', '1')
            ->orWhere('propietarios.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.dni', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.direccion', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.poblacion', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.postal', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.observaciones', 'like', '%'. $buscar . '%') */


           
            if ($criterio==='referencia'){
             /*    $terrenos = Terreno::with(['contratos' => function ($query) {
                    $query->where('contratos.baja', '=', '1');
                }]) */
                $terrenos = Terreno::with('contratos')
                ->with(['propietario' => function ($query) use ($buscar) {
                    $query->orWhere('nombre', 'like', '%' . $buscar . '%'); 
                }]) 
                ->with('vallas')
                ->withCount(['vallas' => function ($query) {
                    $query->where('vallas.baja', '=', '1');
                    $query->select(DB::raw('SUM(vallas.alquiler_anual)'));
                   

                }])
                
                
                ->withCount(['contratos' => function ($query) {
                    $query->where('contratos.baja', '=', '1');
                    $query->select(DB::raw('SUM(contratos.alquiler_anual)'));
                }])->orWhere('terrenos.dni', 'like', '%' . $buscar . '%')
               
                ->orderBy('terrenos.dni', 'ASC')
                ->paginate(10);

            }else{
                
                
                /* $terrenos = Terreno::with(['contratos' => function ($query) {
                    $query->where('contratos.baja', '=', '1');
                }]) */
                $terrenos = Terreno::with('contratos')
                ->with(['propietario' => function ($query) use ($buscar) {
                    $query->orWhere('nombre', 'like', '%' . $buscar . '%'); 
                }]) 
                ->with('vallas')->withCount(['contratos' => function ($query) {
                    $query->where('contratos.baja', '=', '1');
                    $query->select(DB::raw('SUM(contratos.alquiler_anual)'));
                }])->orWhere('terrenos.dni', 'like', '%' . $buscar . '%')
                ->orWhere('terrenos.nombre', 'like', '%' . $buscar . '%')
                ->orWhere('terrenos.direccion', 'like', '%' . $buscar . '%')
                ->orWhere('terrenos.poblacion', 'like', '%' . $buscar . '%')
                ->orWhere('terrenos.postal', 'like', '%' . $buscar . '%')
                ->orWhere('terrenos.observaciones', 'like', '%' . $buscar . '%')
                ->orderBy('terrenos.dni', 'ASC')
                ->paginate(10);
            }



               


            /*   $vallas = Terreno::withCount(['vallas' => function (Builder $query) {
                $query->where('baja', '>=', '1');
            }])->get(); */

            //$terrenoss = Terreno::withCount('vallas')->where('id','=','17')->get();





            //dd($terrenoss[0]->vallas_count);


            return [
                'pagination' => [
                    'total'        => $terrenos->total(),
                    'current_page' => $terrenos->currentPage(),
                    'per_page'     => $terrenos->perPage(),
                    'last_page'    => $terrenos->lastPage(),
                    'from'         => $terrenos->firstItem(),
                    'to'           => $terrenos->lastItem(),
                ],
                'terrenos' => $terrenos

            ];
        }
    }


    public function datos(Request $request, $id)
    {

       
        if (!$request->ajax()) return redirect('/');

      /*   $terreno = Terreno::find($id);
        dd($terreno, $terreno->propietario);
 */
        $terreno = Terreno::with('propietario')->with('vallas')->withCount(['vallas' => function ($query) {
            $query->where('vallas.baja', '=', '1');
            $query->select(DB::raw('SUM(vallas.alquiler_anual)'));
        }])->find($id);
        //->where('terrenos.id',$id)->get();

      //  dd($terreno,$terreno->propietario);


        $propietario= '';

        if ($terreno) {
            //  $cliente = cliente::find($terreno->cliente_id);
            // $agencia = cliente::find($terreno->agencia_id);
            $propietario = $terreno->propietario;
          
        }
        return [
            'terreno' => $terreno,

        ];
    }




    public function createDesdeForm(Request $request){
        
        //dd($request);
            $propietario = $request['data']['propietario'];
            $terreno = $request['data']['terreno'];

           
             //dd($request,$propietario,$terreno,$terreno['id']=== 0);

            try{
                DB::beginTransaction();
    
             
                if ($propietario['id']=== 0){
                    if($propietario['dni'] == null && $propietario['nombre'] == null){
                        $prop = (object) array('id' => 1);

                    }else{
                        $prop = new Propietario();
                        $prop->dni = $propietario['dni'];
                        $prop->nombre = $propietario['nombre'];
                        $prop->direccion = $propietario['direccion'];
                        $prop->poblacion = $propietario['poblacion'];
                        $prop->postal = $propietario['postal'];
                        $prop->provincia = $propietario['provincia'];
                        $prop->email = $propietario['email'];
                        $prop->telefono = $propietario['telefono'];
                        $prop->observaciones = $propietario['observaciones'];
        
                        $prop->save();
                    }
    
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
                    $terre->baja = $terreno['baja'];
                    $terre->calculo_costes = $terreno['calculo_costes'];


    
                    $terre->save();
    
                } else {
                    $terre = (object) array('id' => $terreno['id']);
                  

                    
                     
                }
                   DB::commit();
     
                


    
                 return [
                     'propietario' => $prop,
                     'terreno' => $terre,
                    
     
                 ];
                
             } catch (Exception $e){
                 DB::rollBack();
             }

    }

    public function updateInput(Request $request){

        dd($request);

        if (!$request->ajax()) return redirect('/');

        $terre = terreno::findOrFail($terreno['id']);

        $terre->save();



    }


    public function updateDesdeForm(Request $request){
       // dd($request,$request['data']);
        //, $request['data']['propietario'],$request['data']['propietario']['id']);
        
            $terreno = $request['data']['terreno'];
            // dd($request, $terreno, $terreno['ejercicio'], $terreno['id']);
            try{
                DB::beginTransaction();
    
                $terre = terreno::findOrFail($terreno['id']);
                
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
                    $terre->baja = $terreno['baja'];
                    $terre->calculo_costes = $terreno['calculo_costes'];
                    


                $terre->save();

    
               
                
     
                 
     
                 DB::commit();
    
                 return [
                     'terreno' => $terre,
                  
     
                 ];
                
             } catch (Exception $e){
                 DB::rollBack();
             }

    }











    public function indexDemo(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $estado = $request->estado;




        $terrenos = DB::table('terreratos')
            ->join('agencias', 'contratos.agencia_id', 'agencias.id')
            ->join('clientes', 'contratos.cliente_id', 'clientes.id')
            ->join('vallas', 'contratos.valla_id', 'vallas.id')
            ->join('terrenos', 'terrenos.id', 'vallas.terreno_id')

            ->select(
                'contratos.*',
                'vallas.dni',
                'clientes.nombre as clienteNombre',
                'agencias.nombre as agenciaNombre',
                'terrenos.nombre as terrenoNombre',
                'vallas.nombre as vallaNombre'
            )

            //  ->orWhere('contratos.baja','>=', '1')
            ->orWhere('clientes.nombre', 'like', '%' . $buscar . '%')
            ->orWhere('agencias.nombre', 'like', '%' . $buscar . '%')


            /*  ->orWhere('contratos.referencia', 'like', '%'. $buscar . '%')
            ->orWhere('agencias.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('clientes.nombre', 'like', '%'. $buscar . '%')
            ->orWhere('terrenos.nombre', 'like', '%'. $buscar . '%')

            ->orWhere('contratos.descripcion', 'like', '%'. $buscar . '%')
            ->orWhere('contratos.observaciones', 'like', '%'. $buscar . '%') */

            ->orderBy('contratos.id', 'desc')


            ->paginate(10);
        return [
            'pagination' => [
                'total'        => $terrenos->total(),
                'current_page' => $terrenos->currentPage(),
                'per_page'     => $terrenos->perPage(),
                'last_page'    => $terrenos->lastPage(),
                'from'         => $terrenos->firstItem(),
                'to'           => $terrenos->lastItem(),
            ],
            'terrenos' => $terrenos
        ];


        //   dd($contratoss);

        /*  $terreno = Terreno::find(18);
            
            $a =$terreno->vallas()->where('baja','>=', 1)->get();
            $b =$terreno->contratos()->where('baja','>=', 1)->get();
            $c = Terreno::with('contratos')
            ->where('baja','>=', '1')->get();
            */
        /* $e= Contrato::find(30);
            $f=$e->valla->terreno->propietario;
            //$d= $f->terreno()->get;


                dd($e,$f,$f->terreno);
            */
    }
}
