<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticuloNotaController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
}
