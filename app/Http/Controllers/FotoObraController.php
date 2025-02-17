<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Obra;
use App\ObraUser;
use App\Obrafoto;
use App\PresupuestosFichero;

use Illuminate\Support\Facades\Storage; //Laravel Filesystem
use Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\FILE;



use Illuminate\Support\Facades\Mail;
use App\Mail\FotosClienteExterno;



class FotoObraController extends Controller
{
    //
 
    public function __construct(Request $request)
    {
        //echo 'constructor';
       // dd( $request);

        $this->middleware('auth');
    }

    
public function enviarEmailColaborador(Request $request){

    
    $a = $request->obraI;
    $url = "http://rotuleon.rotuleon.net:8081/externo?az=chos098oiuasd98uasdfzzz&oi=$a&akjois123456900";

//    dd($a, $url);

  /*   $datosEmail = collect(['obraId' => $request->obraI, 'obraDE' => $request->obraD, 'obraCo' => $request->obraC ]);
  

$datosEmail->put('email', $request->email);
$datosEmail->put('url', $url);
$datos = $datosEmail->all(); */
$objDemo = new \stdClass();
$objDemo->email = $request->email;
$objDemo->obraI = $request->obraI;
$objDemo->obraD = $request->obraD;
$objDemo->obraC = $request->obraC;
$objDemo->url = $url;


//dd($objDemo,$request);




//dd($datosEmail->all(), $datosEmail);

//NUEVO CON MARKDON
   Mail::to($request->email)->send(new FotosClienteExterno($objDemo));

//ANTES CON MAIL

    //dd($request);

}



public function borrarFoto(Request $request)
{
    if (!$request->ajax()) return redirect('/');
    $foto = Obrafoto::findOrFail($request->id);
 
    if (Storage::disk('local')->exists('public/'.$foto->imagen)) {

        Storage::delete('public/'.$foto->imagen);

    }
    

    $foto = $foto->delete();
  
}

public function obrasUsuario()
{
    $user = Auth::user()->id;
    $user_nombre = Auth::user()->name;
    //dd(Auth::user());
    
    $data = DB::table('obras')
    ->join('obra_user', 'obra_user.obra_id', '=', 'obras.id')
  ->join('users', 'obra_user.user_id', '=', 'users.id')
 ->select('users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id')
 ->where('users.id' , $user)
 ->get();
 //dd($data);

    
    
    /* 
    $obrasUsuario= ObraFoto::obra();
    dd($obrasUsuario); */
    return [
       
        'obrasUsuario' => $data
    ];
}




public function listarFotosDeUnaObra(Request $request){
   
    //dd($request->buscar);
    if($request->buscar==="undefined") {

        $fotosObraUrl =  ObraFoto::orderBy('obra_fotos.updated_at','DESC')->paginate(35)->pluck('imagen');
        foreach($fotosObraUrl AS $index => $image){
        $fotosObraUrl[$index] = url("/storage/".$image);
        }
    }else{
        $fotosObraUrl = ObraFoto::where('obra_id',$request->buscar)->orderBy('obra_fotos.updated_at','DESC')->pluck('imagen');
        foreach($fotosObraUrl AS $index => $image){
          $fotosObraUrl[$index] = url("/storage/".$image);
        }
        

    }

    return [
        'fotosObraUrl' => $fotosObraUrl,
    ];
}


    public function externofotos(Request $request){


        $user = $request->u;
        $obra = $request->o;

        $obraNombre = Obra::select('nombre','codigo')->where('id',$obra)->get();

        $obraFoto = Obra::join('obra_user','obras.id', '=', 'obra_user.obra_id')
        ->join('users', 'obra_user.user_id', '=', 'users.id')
        ->join('obra_fotos', 'obra_fotos.obra_id', 'obras.id')
        ->select('users.name as nombreUsuario', 'obras.nombre as nombreObra', 'obras.codigo as codigoObra','users.id as userid','obras.id as obraid','obra_fotos.imagen','obra_fotos.texto','obra_fotos.updated_at','obra_fotos.id as obrafotoid')
        ->where('users.id' , '=',$user) 
        ->where('obras.id' , '=',$obra) 
        /*   ->where('obra_fotos.user_id' , '=',$user) 
        ->where('obra_fotos.obra_id' , '=',$obra)  */
        
       // ->whereDate('obra_fotos.updated_at', '=', Carbon::today()->toDateString())
     //  ->where('obra_fotos.updated_at', '>', Carbon::now()->subDays(7))
        ->orderBy('obra_fotos.updated_at','DESC')
        ->get();
      //  ->paginate(10);

            return [
            
            'obraFoto' => $obraFoto,
            'obraNombre' => $obraNombre,
           
        ];


    }


    public function index(Request $request)
    {

        $user = Auth::user()->id;
      

       // $posts = ObraFoto::all();
            //echo $posts;

            $posts = ObraFoto::where('obra_fotos.user_id' , '=',$user)
            ->orderBy('obra_fotos.updated_at','DESC')
            ->paginate(35)->pluck('imagen');
            
            foreach($posts AS $index => $image){
              $posts[$index] = url("/storage/".$image);
            }

//dd($posts1);

       /*  foreach($posts AS $post){
            echo $post;

          foreach($post->imagen AS  $image){
              echo  $image;
            $posts->imagen = url("/imagen/".$image);
          }
        }

        dd($posts);
 */
       // if (!$request->ajax()) return redirect('/');
        // 29/03
      
       // dd(Auth::user());
        //dd($request);
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $user_id = 'user_id';

        $obraFoto = Obra::join('obra_user','obras.id', '=', 'obra_user.obra_id')
        ->join('users', 'obra_user.user_id', '=', 'users.id')
        ->join('obra_fotos', 'obra_fotos.obra_id', 'obras.id')
        ->select('users.name as nombreUsuario', 'obras.nombre as nombreObra', 'obras.codigo as codigoObra','users.id as userid','obras.id as obraid','obra_fotos.imagen','obra_fotos.texto','obra_fotos.updated_at','obra_fotos.id as obrafotoid')
        ->where('users.id' , '=',$user) 
       // ->whereDate('obra_fotos.updated_at', '=', Carbon::today()->toDateString())
       ->where('obra_fotos.updated_at', '>', Carbon::now()->subDays(7))
        ->orderBy('obra_fotos.updated_at','DESC')
       // ->get();
        ->paginate(10);
//dd($obraFoto);
  /*     $obraFoto = DB::table('obras')
        ->join('obra_user', 'obra_user.obra_id', '=', 'obras.id')
        ->join('users', 'obra_user.user_id', '=', 'users.id')
        ->join('obra_fotos','obras.id', '=', 'obra_fotos.obra_id' )
        ->select('users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id as obraid','obra_fotos.imagen','obra_fotos.texto','obra_fotos.updated_at')
      ->where('users.id' , '=',$user) 
     //    ->whereDate('obra_fotos.created_at', '=', Carbon::today()->toDateString())
        ->paginate(3); */

            return [
            'pagination' => [
                'total'        => $obraFoto->total(),
                'current_page' => $obraFoto->currentPage(),
                'per_page'     => $obraFoto->perPage(),
                'last_page'    => $obraFoto->lastPage(),
                'from'         => $obraFoto->firstItem(),
                'to'           => $obraFoto->lastItem(),
            ],
            'obraFoto' => $obraFoto,
            'posts' => $posts,
        ];

       // dd($obraFoto);
    }   

   

   





    public function altaunafoto()
    {
        $user = Auth::user()->id;
        $user_nombre = Auth::user()->name;
       // dd(Auth::user());
        
        $data = DB::table('obras')
        ->join('obra_user', 'obra_user.obra_id', '=', 'obras.id')
      ->join('users', 'obra_user.user_id', '=', 'users.id')
     ->select('users.name', 'obras.nombre', 'obras.codigo','users.id as userid','obras.id')
     ->where('users.id' , $user)
     ->get();
     //dd($data);

        
        
        /* 
        $obrasUsuario= ObraFoto::obra();
        dd($obrasUsuario); */
        return view('altafotoobra', compact('data','user_nombre'));
    }
    
   

   
    public function rotarFotoObra(Request $request)
    {

        //dd($request);
        if (!$request->ajax()) return redirect('/');
       // $foto = Obrafoto::findOrFail($request->id);


        if (!File::exists('storage/'.$request->url)) {
           // dd('no existe',$foto->imagen);

            return [
                'img' => 'imagen no existe']; 
            

        }else{
    
            $img = Image::make('storage/'.$request->url);

           
            $img->rotate(-90);
           // $img->save();


        $exif = exif_read_data('storage/'.$request->url, 0, true);
        

       // dd($exif,$foto->imagen);
        //$exif['Orientation']);

            
            //$img->save(public_path($img));
            Storage::put('public/'.$request->url, (string) $img->encode());

            //sleep(5);






            return [
                'img' => '$img']; 
            
        



            

        }
        
       /*  if (! Storage::exists('storage/' .$foto->imagen)) {

       

            dd(Storage::get('storage/' .$foto->imagen));

            $path = storage_path($foto->imagen);

            if (!File::exists($path)) {
                abort(404);
            }
        
            $file = File::get($path);
            $type = File::mimeType($path);




            dd($contents,$file);


            $img = Image::make($contents);
            $img->rotate(-45); 

            return [
                'img' => $contents]; 
            */


            //dd($foto->imagen,$request,$img);

            // do something
          //  Storage::delete($foto->imagen);
          // unlink($foto->imagen);
           // unlink(public_path("/storage/".$foto->imagen));
        
        



    }


    public function guardaAltaFoto(Request $request)
    {

       // dd($request);
        $image = $request->file('file');
        
        $mensa = $request->file('file');
        
     
        $error = '';
        
        
        if ($request->hasFile('file')){
            //https://medium.com/@just4sky/photo-management-with-laravel-resize-image-57a3cc0daafd
            $dt = now();
            $dt=substr($dt,0,19);
            $dt=str_replace("-","",$dt);
            $dt=str_replace(" ","",$dt);
            $dt=str_replace(":","",$dt);
            
           // foreach ($request->file('image') as $key => $file) {
                $imagen = $request->file('file');
                $extension = $imagen->getClientOriginalExtension();
                
                $codigoObra=$request->obraCodigo;
                $nombreObra=$request->obraNombre;
                $idObra=$request->obraCodigo;

                $idObra = str_replace("/", "",$codigoObra);
                if ( !empty( $request->nombreFoto ) ){
                  
                    $nombreFoto = str_replace(" ", "_",$nombreObra);
                    $nombreFoto = $nombreFoto.'_';
               

                }else{
                    $nombreFoto ='';

                }
             

               // $nombreImagen = $idObra.'/'.$nombreFoto.$dt.'_'.$imagen->getClientOriginalName();
              // $nombreImagen = $nombreFoto.$dt.'_'.$imagen->getClientOriginalName();
              $nombreImagen = uniqid().$nombreFoto.$dt.'.'.$imagen->getClientOriginalExtension();


              //220421 
               $input['nombreFoto'] = $idObra.'\\'.$nombreFoto.$dt.'_'.$imagen->getClientOriginalName();
             // $input['nombreFoto'] = $idObra.'\\'.$nombreFoto.$dt.'_'.$imagen->getClientOriginalExtension();

//dd($nombreImagen,$input['nombreFoto']);

                $destinationPath = public_path().'\obras\images';

                $img = Image::make($image->getRealPath())->orientate();


                $ruta = $destinationPath.'\\'.$input['nombreFoto'];
 

                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                });
              //  dd($destinationPath,$img,$ruta);

                Storage::disk('local')->makeDirectory('public/obras/images/'. $idObra.'/');

                Storage::put('public/obras/images/'.$idObra.'/'.$nombreImagen, (string) $img->encode());
 
     



    // CREAR OBRA
            //$obraNueva = Obra::firstOrCreate(['codigo' => $idObra],['nombre'=> '--')];
            $obraNueva = Obra::where('codigo', $codigoObra)->first();
            if (!$obraNueva) {
                Obra::create([
                'codigo' => $codigoObra,
                'nombre' => $nombreObra,
                'slug'   => $codigoObra
            ]);
        $mensa = $mensa +' Obra nueva creada .';

            }else{
                
                
            }
            $obraNueva = Obra::where('codigo', $codigoObra)->first();
    //AÑADIR OBRA_USER
            //$obraNueva = Obra::firstOrCreate(['codigo' => $idObra],['nombre'=> '--')];
            $user = Auth::user()->id;
            $obraUsuarioNueva = ObraUser::where([['obra_id','=',$obraNueva->id],['user_id','=',$user]])->first();
            if (!$obraUsuarioNueva) {
                ObraUser::create([
                'obra_id' => $obraNueva->id,
                'user_id' => $user,
                'condicion'   => '1'
               
            ]);
            $mensa = $mensa .' Obra Uusario Nueva creada .';

            }else{
               
            }
            $obraUsuarioNueva = ObraUser::where([['obra_id','=',$obraNueva->id],['user_id','=',$user]])->first();
         

//TODO BUSCAR OBRA POR CODIGO , si no existe alta .. 
             $imagemodel= new ObraFoto();
            // $imagemodel->filename=time().$originalImage->getClientOriginalName();
            $user = Auth::user()->id;
           // $idObra=$request->selectobra;

            //dd($idObra);

            $imagemodel->user_id = $user;
            $imagemodel->texto=$request->nombreFoto;

            $imagemodel->obra_id =$obraNueva->id;
            $imagemodel->imagen ='obras/images/'.$idObra.'/'.$nombreImagen;  
            
            $imagemodel->slug ='obras/images/'.$idObra.'/'.$nombreImagen;  
            $imagemodel->save();

            $mensa = ' Parte Foto creado.'.$idObra.'--'.$nombreImagen;

     
        }else{
            $mensa = 'NO HAY FICHERO';
        } 
        return [
            'mensaje' => $mensa]; 

    }




    
public function ultimasFotos(Request $request){



    $date =  Carbon::now(); //  DateTime string will be 2014-04-03 13:57:34

    //$date->subWeek(); // or 
    $date->subDays(3);//  2014-03-27 13:58:25
    $a=$date->subWeek()->toDateString();

    //News::where('created_at', '>', $date->toDateTimeString() )->get();

   
    $ultimasFotos = ObraFoto::
    join('obras', 'obras.id', '=', 'obra_fotos.obra_id')
    //->where('obra_fotos.created_at','>',$date->toDateTimeString() )
    
    ->orderBy('obra_fotos.updated_at','DESC')
    ->select('obra_fotos.imagen','obras.nombre','obra_fotos.id as obra_id','obras.id','obras.codigo')
    ->paginate(40);
    //->get();


    $ultimasFotosPaginate = ObraFoto::
    join('obras', 'obras.id', '=', 'obra_fotos.obra_id')
    ->where('obra_fotos.created_at','>',$date->toDateTimeString() )->orderBy('obra_fotos.updated_at','DESC')
    ->select('obra_fotos.imagen','obras.nombre','obra_fotos.id as obra_id','obras.id','obras.codigo')
    ->paginate(40);
    //->get();
    //->pluck('obra_fotos.imagen');
    
    //->select('obra_fotos.imagen');

    
    /* join('obras', 'obras.id', '=', 'obra_fotos.obra_id')
    ->where('obra_fotos.created_at','>',$date->toDateTimeString() )->orderBy('obra_fotos.updated_at','DESC')->select('obra_fotos.imagen','obras.nombre');
     */
    //->pluck('obra_fotos.imagen');

 $ultimasFotos2 = ObraFoto::orderBy('obra_fotos.updated_at','DESC')->select('imagen')->paginate(40);
        //dd($date->subDays(7),$date,$a, $ultimasFotos);

        //$request->buscar)->orderBy('obra_fotos.updated_at','DESC')->pluck('imagen');

      foreach($ultimasFotos AS $index => $image){
          $ultimasFotos[$index]['imagen'] = url("/storage/".$image['imagen']);
        }   
        
        foreach($ultimasFotos2 AS $index => $image){
            $ultimasFotos2[$index] = url("/storage/".$image->imagen);

          } 
          

    /* 

    return [
        'ultimasFotos' => $ultimasFotos,
        'dia' => $a
    ]; 
 */
     return [
        'pagination' => [
            'total'        => $ultimasFotos2->total(),
            'current_page' => $ultimasFotos2->currentPage(),
            'per_page'     => $ultimasFotos2->perPage(),
            'last_page'    => $ultimasFotos2->lastPage(),
            'from'         => $ultimasFotos2->firstItem(),
            'to'           => $ultimasFotos2->lastItem(),
        ],
        'ultimasFotos' => $ultimasFotos,
        'ultimasFotos2' => $ultimasFotos2,
        'ultimasFotosPaginate' => $ultimasFotosPaginate,

      //  'dia' => $a,
    ]; 

    
}


   
        
}


        

