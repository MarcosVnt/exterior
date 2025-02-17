<?php

namespace App\Http\Controllers;

use App\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class PropietarioController extends Controller
{
    //
    public function index(Request $request){
        $buscar = $request->buscar;

        if ($buscar==''){
            // $vallas = Valla::orderBy('id', 'desc')->paginate(3);
          $propietarios = DB::table('propietarios')
                    
                     ->select('propietarios.*')
                  
                  ->paginate(10);
            
                   
         }
         else{
            // $propietarios = Valla::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
            $propietarios = DB::table('propietarios')
           
            ->select('propietarios.*')
          
            ->where('dni', 'like', '%'. $buscar . '%')
            ->orWhere('nombre', 'like', '%'. $buscar . '%')
            ->orWhere('email', 'like', '%'. $buscar . '%')
            ->orWhere('poblacion', 'like', '%'. $buscar . '%')
            ->orWhere('provincia', 'like', '%'. $buscar . '%')
            
            ->orderBy('id', 'desc')
            ->paginate(10);
        
         }
      
 
         return [
             'pagination' => [
                 'total'        => $propietarios->total(),
                 'current_page' => $propietarios->currentPage(),
                 'per_page'     => $propietarios->perPage(),
                 'last_page'    => $propietarios->lastPage(),
                 'from'         => $propietarios->firstItem(),
                 'to'           => $propietarios->lastItem(),
             ],
             'propietarios' => $propietarios
         ];

    }

    public function show($id){
        return Propietario::find($id);
     }

     public function terrenos($id){
         $propietario = Propietario::find($id);
         //return Response::json($propietario->terrenos);
         $terrenos =$propietario->terrenos;
        return [
            'terrenos' => $terrenos
        ];
     }
    
     public function vallas($id){
        $propietario = Propietario::find($id);
        return Response::json($propietario->vallas);
    }
   
 
}
