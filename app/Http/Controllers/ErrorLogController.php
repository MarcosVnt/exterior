<?php

namespace App\Http\Controllers;

use App\ErrorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorLogController extends Controller
{
    //

    public function store(Request $request)
    {
        $user = Auth::user()->id;

        $errorLog = new ErrorLog;
        $errorLog->user_id = $user ; 
        $errorLog->type = $request->type ; 
        $errorLog->message = $request->message ; 
        $errorLog->stack = $request->stack ; 
        $errorLog->save();       



        //$errorLog = ErrorLog::create($request->all());
        return response()->json($errorLog, 201);
    }
    
}
