<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestorCompra;
use Orchestra\Parser\Xml\Facade as XmlParser;


class GestorcompraController extends Controller
{
    //
   /*  public function __construct()
    {
        $this->middleware('auth');
    }
     */

    public function index(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');



        $buscar = $request->buscar;
        
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $gestorcompras = Gestorcompra::orderBy('id', 'desc')->paginate(30);
            $gestorcompras2 = Gestorcompra::orderBy('id', 'desc');

        }
        else{
           // $gestorcompras = Gestorcompra::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
       
           $gestorcompras = Gestorcompra::where('descripcion', 'like', '%'. $buscar . '%')->orWhere('proveedor', 'like', '%'. $buscar . '%')
           ->orWhere('comentarios', 'like', '%'. $buscar . '%')
           ->orderBy('id', 'desc')->paginate(30);
       
       
        }
        
       // dd($gestorcompras2);
        //die();
        
        return [
            'pagination' => [
                'total'        => $gestorcompras->total(),
                'current_page' => $gestorcompras->currentPage(),
                'per_page'     => $gestorcompras->perPage(),
                'last_page'    => $gestorcompras->lastPage(),
                'from'         => $gestorcompras->firstItem(),
                'to'           => $gestorcompras->lastItem(),
            ],
            'gestorcompras' => $gestorcompras
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
        //if (!$request->ajax()) return redirect('/');
        $gestorcompras = new Gestorcompra();
        $gestorcompras->referencia = $request->referencia;
        $gestorcompras->descripcion = $request->descripcion;
        $gestorcompras->codigoProveedor = $request->codigoProveedor;
        $gestorcompras->proveedor = $request->proveedor;
        $gestorcompras->anchura = $request->anchura;
        $gestorcompras->altura = $request->altura;
        $gestorcompras->metros = $request->metros;
        $gestorcompras->costeunidad = $request->costeunidad;
        $gestorcompras->bultos = $request->bultos;

        $gestorcompras->unidades = $request->unidades;
        $gestorcompras->tipoUnidad = $request->tipoUnidad;

        $gestorcompras->dto = $request->dto;
        $gestorcompras->costefinal = $request->costefinal;
        $gestorcompras->comentarios = $request->comentarios;
        $gestorcompras->costetotal = $request->costetotal;

        $gestorcompras->fecha = $request->fecha;
        $gestorcompras->compra =  '1';

        $gestorcompras->oferta = '1';

        $gestorcompras->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
         {

            //dd($request,$request->id);
        if (!$request->ajax()) return redirect('/');
        $gestorcompras =  Gestorcompra::findOrFail($request->id);
        $gestorcompras->referencia = $request->referencia;
        $gestorcompras->descripcion = $request->descripcion;
        $gestorcompras->codigoProveedor = $request->codigoProveedor;
        $gestorcompras->proveedor = $request->proveedor;
        $gestorcompras->anchura = $request->anchura;
        $gestorcompras->altura = $request->altura;
        $gestorcompras->metros = $request->metros;
        $gestorcompras->costeunidad = $request->costeunidad;
        $gestorcompras->bultos = $request->bultos;

        $gestorcompras->unidades = $request->unidades;
        $gestorcompras->tipoUnidad = $request->tipoUnidad;

        $gestorcompras->dto = $request->dto;
        $gestorcompras->costefinal = $request->costefinal;
        $gestorcompras->comentarios = $request->comentarios;
        $gestorcompras->costetotal = $request->costetotal;

        $gestorcompras->fecha = $request->fecha;
        $gestorcompras->compra =  '1';

        $gestorcompras->oferta = '1';

        $gestorcompras->save();
    }




    public function escompra(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $gestorcompras = Gestorcompra::findOrFail($request->id);
        $gestorcompras->compra = '0';
        $gestorcompras->save();
    }

    public function esoferta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $gestorcompras = Gestorcompra::findOrFail($request->id);
        $gestorcompras->oferta = '0';
        $gestorcompras->save();
    }


    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         Gestorcompra::destroy($request->id);
    }


}
