<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class InicioController extends Controller
{

    public function muestraContenido(){

        $user = Auth::user()->id;

       /*  if ($user === 6 ){
            Auth::logout();
           // $request->session()->invalidate();
            return redirect('/');

        }else{
            return view('contenido/contenido');

        } */
        return view('contenido/contenido');


    }
}
