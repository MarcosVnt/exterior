<?php

namespace App\Http\Controllers\Auth;

use App\ErrorLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Valla;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout','externo');

        
    }
    


    public function externo(Request $request){

      //  dd($request);
        //echo 'externo';

        if($request->oi){
            Auth::loginUsingId(6);
            $user = Auth::user()->id;
            $obra = $request->oi;

            $vallas = Valla::all();
            // dd('inicioa',$vallas);
             //return view('',compact('array1','array2'));
     
             return view('vallas.contenido', ['vallas' => $vallas]);
            
           // return view('principalexterno', compact('user', 'obra'));
            //->with('user=> $user','obra=> $obra');
      
        }else{
          
            Auth::logout();
            $request->session()->invalidate();
            return redirect('/');
    
        }

      
    
        //dd($user);
        
    }
    

    public function showLoginForm(){
        //dd(Auth::check());
        //dd(Auth);
        if(Auth::check()){
           
            return view('contenido/contenido');
        }else{
            return view('auth.login');
        }
        
    }
    public function name()
    {
        return 'name';
    }
    public function login(Request $request){

       /*  $user = User::all();

        dd(password_verify('12345678',$user[0]->password),
            $user,$request->name,$request->password,
            Auth::attempt(['name' => $request->name,'password' => $request->password,'condicion'=>1])

             );
 */
        $this->validateLogin($request);  
     
     
       if ($request->name=='1'){
        return redirect()->route('main');
       }
        if (Auth::attempt(['name' => $request->name,'password' => $request->password,'condicion'=>1],true)){
            
            $user = Auth::user()->id;
//dd($user);
            ErrorLog::create(
                [
                    'user_id' => $user,
                    'message' => 'Conectado',


                ]
            );
            
            return redirect()->route('main');
        }

        return back()
        ->withErrors(['name' => trans('auth.failed')])
        ->withInput(request(['name']));

    }

    protected function validateLogin(Request $request){
       // dd($request);
        $this->validate($request,[
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){

         
        $user = Auth::user()->id;
       // dd($request->session());
                    ErrorLog::create(
                        [
                            'user_id' => $user,
                            'message' => 'DESConectado',
        
        
                        ]
                    );
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
