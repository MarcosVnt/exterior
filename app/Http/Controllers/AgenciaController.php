<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Agencia;

class AgenciaController extends Controller
{
    //
    public function index(Request $request){
        $buscar = $request->buscar;

        if ($buscar==''){
            // $vallas = Valla::orderBy('id', 'desc')->paginate(3);
          $agencias = DB::table('agencias')                    
                     ->select('agencias.*')
                  ->paginate(10);
            
                   
         }
         else{
            // $agencias = Valla::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
            $agencias = DB::table('agencias')
           
            ->select('agencias.*')
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
                 'total'        => $agencias->total(),
                 'current_page' => $agencias->currentPage(),
                 'per_page'     => $agencias->perPage(),
                 'last_page'    => $agencias->lastPage(),
                 'from'         => $agencias->firstItem(),
                 'to'           => $agencias->lastItem(),
             ],
             'agencias' => $agencias
         ];

    }



}
