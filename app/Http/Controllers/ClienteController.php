<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;

        if ($buscar==''){
            // $vallas = Valla::orderBy('id', 'desc')->paginate(3);
          $clientes = DB::table('clientes')                    
                     ->select('clientes.*')
                  ->paginate(10);
            
                   
         }
         else{
            // $clientes = Valla::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
            $clientes = DB::table('clientes')
           
            ->select('clientes.*')
            ->where('dni', 'like', '%'. $buscar . '%')
            ->orWhere('nombre', 'like', '%'. $buscar . '%')
            ->orWhere('email', 'like', '%'. $buscar . '%')
            ->orWhere('poblacion', 'like', '%'. $buscar . '%')
            ->orWhere('provincia', 'like', '%'. $buscar . '%')
            ->orWhere('observaciones', 'like', '%'. $buscar . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        
         }
      
 
         return [
             'pagination' => [
                 'total'        => $clientes->total(),
                 'current_page' => $clientes->currentPage(),
                 'per_page'     => $clientes->perPage(),
                 'last_page'    => $clientes->lastPage(),
                 'from'         => $clientes->firstItem(),
                 'to'           => $clientes->lastItem(),
             ],
             'clientes' => $clientes
         ];

    }


}
