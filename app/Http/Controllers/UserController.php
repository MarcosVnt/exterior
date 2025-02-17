<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;

class UserController extends Controller

{

    public function horasPorDia(Request $request){
        
        if (!$request->dia){
            $dia = Carbon::now();  
            $manana= Carbon::now();  
            //echo '1';
        }else{
           //echo'2';
            $dia = Carbon::parse($request->dia);
            $manana = Carbon::parse($request->dia);
        }
        $manana = $manana->addDays(1); 

        $horasPorDia =  DB::table('obra_mano')
        ->join('users', 'obra_mano.user_id', '=', 'users.id')
        ->select('obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','users.name',DB::raw("COUNT(user_id) as usuario,SUM((timediff(a_fecha_hora,de_fecha_hora)*60)/10000) as minutos,SUM(TIME_TO_SEC(TIMEDIFF(a_fecha_hora, de_fecha_hora)))  as minutos2"),'obra_mano.user_id')
        ->groupBy('obra_mano.user_id')
        ->whereBetween('a_fecha_hora', [$dia,$manana])
        ->orderBy('obra_mano.user_id','DESC')
        ->get();

       $horasPorDiaDetalle2 =   DB::table('obra_mano')
       ->join('users', 'obra_mano.user_id', '=', 'users.id')
       ->select('obra_mano.de_fecha_hora','obra_mano.a_fecha_hora','users.name','obra_mano.user_id')
       //->groupBy('obra_mano.user_id')
       ->whereBetween('a_fecha_hora', [$dia,$manana])
       ->orderBy('obra_mano.user_id','DESC')
       ->get();

     




       return [
        'horasDiaUsuario' => $horasPorDia,
        'horasPorDiaDetalle2' => $horasPorDiaDetalle2,
        /*
             'horasPorDiaDetalle' => $horasPorDiaDetalle
 */        ];
    }

    public function tecladoExiste(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');
       
       $ok = 'nook';
       $flag = false;
        $user = User::findOrFail($request->usuario);

     //dd($user->teclado_id ,$request->codigo,$user->teclado_id ==  intval($request->codigo));
     //dd($user->teclado_id ,$request->codigo,strval($user->teclado_id) ==  $request->codigo);

     
        //if ($user->teclado_id === intval($request->codigo)){
            if (strval($user->teclado_id) ==  $request->codigo){
            $ok = 'oaaaaaaaaaaaaaak';
            $flag = true;
        }

        //dd($ok, $flag,$user->teclado_id,$request->codigo,$user->teclado_id = $request->codigo);
        return ['ok' => $ok, 'flag'=>$flag];
      
    }

    public function listaUsuariosTaller(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $rol_taller= 3;
        $usuariosTaller = User::where('rol_id',$rol_taller)->orderBy('id', 'desc')->paginate(30);

    
       return [
          
            'usuariosTaller' => $usuariosTaller
        ];
    }

    public function listaTaller(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        //$rol_taller= 3;
        $rol_taller=0;
       // $taller = User::where('rol_id',$rol_taller)->orderBy('id', 'desc')->paginate(10);
       $taller = User::where('rol_id','>=',$rol_taller)->orderBy('id', 'desc')->get();

    


    

       return [
          
            'taller' => $taller
        ];
    }


    public function obrasUsuario(Request $request)
    {
        //dd($request->usuario);
                //if (!$request->ajax()) return redirect('/');

       if($request->usuario){
        $user =$request->usuario ;
        $usuario = User::where('id','=',$user)->first();
        $user_nombre=$usuario->name;
        $user_rol= $usuario->rol_id;
       }else{
        $user = Auth::user()->id;
        $user_nombre = Auth::user()->name;
        $user_rol = Auth::user()->rol_id;

       }
       // dd($user_rol);       
       
        //dd(Auth::user());

        $hoy = (Carbon::today()->toDateString());
        $obrasUsuario = DB::table('obras')->orderby('id','DESC')->get();
        
        /* $obrasUsuario = DB::table('obras')
        ->join('obra_user', 'obra_user.obra_id', '=', 'obras.id')
         ->join('users', 'obra_user.user_id', '=', 'users.id')
         ->select('users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id')
          ->where('users.id' , $user)
          ->orderby('obras.codigo')
          ->get(); */
     //dd($data);

        
        
        /* 
        $obrasUsuario= ObraFoto::obra();
        dd($obrasUsuario); */
        return compact('obrasUsuario','user_nombre','hoy','user','user_rol');
    }







    

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

    
        if ($buscar==''){
            $personas = User::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $personas = User::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(10);
        }









/*         $personas2 = User::all();
 */     /*    if ($buscar==''){
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id', 'desc')->paginate(1);
        }
        else{
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(1);
        } */
/*         dump($personas2);
 */        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            /* $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();
 */
            $user = new User();
            //$user->id = $persona->id;
            $user->rol_id = $request->idrol;
            $user->name = $request->usuario;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';       
            $user->visual_id = $request->visual_id;       
            $user->teclado_id = $request->teclado_id;       
                 
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
       // dd($request);
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
           /*  $persona = Persona::findOrFail($user->id);
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save(); */

            
            $user->name = $request->usuario;
            $user->email = $request->email;
            
            if($request->password ){
             $user->password = bcrypt( $request->password);
            } 
            $user->condicion = '1';
            $user->rol_id = $request->idrol;
            $user->visual_id = $request->visual_id;       
            $user->teclado_id = $request->teclado_id; 
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
