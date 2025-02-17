<?php

namespace App\Http\Controllers;

use App\RutaVallaLinea;
use Illuminate\Http\Request;

class RutaVallaLineaController extends Controller
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
        //dd($request,$request['ruta']['id']);
        //$propietario = $request['data']['propietario'];
        $rutaVallaLinea = new RutaVallaLinea();

        $rutaVallaLinea->ruta_valla_id = $request['ruta']['id'];
        $rutaVallaLinea->valla_id = $request['valla']['id'];


         $rutaVallaLinea->descripcion = $request['valla']['nombre'];

        // $rutaVallaLinea->orden = $request[''];
         $rutaVallaLinea->notas = $request['valla']['observaciones'];
         
         $rutaVallaLinea->save();

         return [
       
          
            'rutaVallaLinea' => $rutaVallaLinea
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
     * @param  \App\RutaVallaLinea  $rutaVallaLinea
     * @return \Illuminate\Http\Response
     */
    public function show(RutaVallaLinea $rutaVallaLinea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RutaVallaLinea  $rutaVallaLinea
     * @return \Illuminate\Http\Response
     */
    public function edit(RutaVallaLinea $rutaVallaLinea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RutaVallaLinea  $rutaVallaLinea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RutaVallaLinea $rutaVallaLinea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RutaVallaLinea  $rutaVallaLinea
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //$user = User::findOrFail($request->usuario);

        $rutaVallaLinea = RutaVallaLinea::where('ruta_valla_id',$request->ruta_id)
        ->where('valla_id',$request->valla_id);
       // dd($request->ruta_id, $request->valla_id,$rutaVallaLinea);
       
        $rutaVallaLinea->delete();
        
    }
}
