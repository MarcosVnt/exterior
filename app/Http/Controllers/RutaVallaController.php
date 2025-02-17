<?php

namespace App\Http\Controllers;

use App\RutaValla;
use App\RutaVallaLinea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RutaVallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // dd($request['descripcion']);
        //$propietario = $request['data']['propietario'];


        $token = Str::random(40); // Genera un string aleatorio de longitud 40

        // Asigna una fecha de expiración, por ejemplo, 7 días desde ahora
        $expiresAt = Carbon::parse($request['fechaFinal']);
        //now()->addDays(7);


        $rutaValla = new RutaValla();
        $rutaValla->descripcion = $request['descripcion'];
        $rutaValla->email = $request['email'];
        $rutaValla->fecha_inicio = $request['fechaInicio'];
        $rutaValla->fecha_final = $request['fechaFinal'];
        $rutaValla->token = $token;
        $rutaValla->expires_at = $expiresAt;
        $rutaValla->save();

        return [
            'rutaValla' => $rutaValla
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RutaValla  $rutaValla
     * @return \Illuminate\Http\Response
     */
    public function show(RutaValla $rutaValla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RutaValla  $rutaValla
     * @return \Illuminate\Http\Response
     */
    public function edit(RutaValla $rutaValla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RutaValla  $rutaValla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RutaValla $rutaValla)
    {

        $rutaValla = RutaValla::find($request->id);
        // dd($rutaValla);
        $expiresAt = Carbon::parse($request['fechaFinal']);

        $rutaValla->descripcion = $request['descripcion'];
        $rutaValla->email = $request['email'];
        $rutaValla->fecha_inicio = $request['fechaInicio'];
        $rutaValla->fecha_final = $request['fechaFinal'];

        $rutaValla->expires_at = $expiresAt;

        $rutaValla->save();
        return [
            'rutaValla' => $rutaValla
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RutaValla  $rutaValla
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request)
    {
        //dd($rutaValla);
        $rutaValla = RutaValla::find($request->id);
        $rutaValla->delete();
    }

    public function listar(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        //dd($request,$request->buscar);
        // $rutasConVallas = RutaValla::all(); 

        if ($buscar !== '') {
            $rutasConVallas = RutaValla::with('vallaLineas')
                ->where('ruta_vallas.descripcion', 'like', '%' . $buscar . '%')
                ->orWhere('ruta_vallas.email', 'like', '%' . $buscar . '%')
                ->orderBy('ruta_vallas.id', 'DESC')

                ->get();
        } else {
            $rutasConVallas = RutaValla::with('vallaLineas')
                ->orderBy('ruta_vallas.id', 'DESC')

                ->get();
        }

        /*   $rutasConVallas = RutaValla::with('vallaLineas')
        ->where('ruta_vallas.descripcion', 'like', '%'. $buscar . '%')
        ->orWhere('ruta_vallas.email', 'like', '%'. $buscar . '%')

        ->get(); */
        //dd($rutasConVallas);
        return [
            'rutasConVallas' => $rutasConVallas
        ];
    }

    public function vallas(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $id = $request['id'];

        //dd($request, $id);

        $vallasDeUnaRuta = RutaVallaLinea::with('valla')->where('ruta_valla_id', $id)->get();
        //dd($vallasDeUnaRuta);
        return [
            'vallasDeUnaRuta' => $vallasDeUnaRuta

            // ruta y vallas 
        ];
    }


    public function accesoTemporal(Request $request, $token)
    {
       // dd($request->getPathInfo()=== '/nova');
      //  if($request->getPathInfo() === '/nova')
      //  {return [] ;
      //  }
        // Buscar el token en la base de datos
        $tokenData = RutaValla::where('token', $token)->first();
        if (!$tokenData) {
            return abort(403, 'Acceso denegado.');
        }
        $ruta = $tokenData->id;

        // Verificar si el token existe y no ha expirado
        if ($tokenData && now() <= $tokenData->expires_at) {
            // Lógica para permitir el acceso temporal
            //$vallas = RutaValla::with('vallaLineas')
            // ->where('ruta_vallas.token',$token)
            //  ->first();

            $vallas = DB::table('vallas')
                ->join('terrenos', 'vallas.terreno_id', 'terrenos.id')
                ->join('propietarios', 'terrenos.propietario_id', 'propietarios.id')
                ->leftJoin('ruta_valla_lineas', 'vallas.id', 'ruta_valla_lineas.valla_id')

                ->select('vallas.*', 'ruta_valla_lineas.ruta_valla_id as ruta_id', 'terrenos.nombre as terreno', 'propietarios.nombre as propietario')
                ->where('ruta_valla_lineas.ruta_valla_id', $ruta)

                ->orderBy('vallas.dni', 'ASC')

                ->get();




            // dd($vallas);

            //  return view('/rutaTemporal', compact('vallas'));
            return view('rutaTemporal', ['vallas' => $vallas]);
        } else {
            // Lógica para denegar el acceso
            return abort(403, 'Acceso denegado.');
        }
    }
}
