<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PresupuestosFichero;

use Illuminate\Support\Facades\Storage; //Laravel Filesystem
use Image;


class PresupuestosFicheroController extends Controller
{
    //

    

    public function documentacion(Request $request){

        //dd($request->id);
    //if (!$request->ajax()) return redirect('/');

    $documentos = PresupuestosFichero::where('presupuesto_id',$request->id)->where('texto','FICHERO')->get();
    $imagenes = PresupuestosFichero::where('presupuesto_id',$request->id)->where('texto','IMAGEN')->get();
  /* 
    $path = Storage::path($imagenes[0]['nombre']);
    $url = Storage::url($imagenes[0]['nombre']);
    $a = asset(($imagenes[0]['nombre']));
    $b = asset($url); */

  // dd($documentos,$imagenes[0]['nombre'],$imagenes->get('nombre'),$path,$url,$a,$b);
    return [
        'imagenes' => $imagenes,
        'documentos' => $documentos,
    ];

}




public function eliminar(Request $request){

    //dd($request);
//if (!$request->ajax()) return redirect('/');
//$doc = str_slug($request['data']['documento'], "-");
$doc = $request['data']['documento'];
$id = $request['data']['id'];


//dd($doc);

$documento = PresupuestosFichero::where('presupuesto_id',$id)->where('slug',$doc)->first();
if($documento->delete())
{
;
    $borrado = Storage::disk('local')->delete('public/'.$documento['nombre']);

}

//dd($request,'--',$request['data']['documento'],'---',$documentos,'1611563739-rotuleon-presupuesto-n-131-marcos-v-56pdf',$request->documento);


return [
    
    'documento' => $documento,
    'borrado' =>  $borrado
];

}


public function guardaFichero(Request $request)
{

    //dd($request,$request->id);
    $request->validate([
       
        'id' => 'required',
        'file' => 'required',
       
      ]);

      

  $uploadedFile = $request->file('file');
  $filename = time().'-'.$uploadedFile->getClientOriginalName();

  Storage::disk('local')->putFileAs(
    'public/presupuesto/'.$request->id.'/ficheros/',
    $uploadedFile,
    $filename
  );

  $upload = new PresupuestosFichero;
  
  //$upload->nombre = 'presupuesto/ficheros/'.$request->id.'/'.$filename;
  $upload->nombre = 'presupuesto/'.$request->id.'/ficheros/'.$filename;

  $upload->presupuesto_id = $request->id;
  //$upload->slug = str_slug($filename, "-");
  $upload->slug = $uploadedFile->getClientOriginalName();
  
  $upload->texto ="FICHERO";

  $upload->user()->associate(auth()->user());

  $upload->save();

  return response()->json([
    'id' => $upload
  ]);
}
public function guardaAltaFotoPresupuesto(Request $request)
{
  //  dd($request);
    $request->validate([          
        'id' => 'required',
        'file' => 'required',
      ]);

    $image = $request->file('file');
    $imageName = $image->getClientOriginalName();


    $img = Image::make($image->getRealPath());

   /*  dd('guardaAltaFotoPres',$image,$imageName,$image->getRealPath(),$img); */

    $img->resize(1200, 1200, function ($constraint) {
        $constraint->aspectRatio();
    });

    
    $imageName= str_replace(" ","_",$imageName);
    $imageName = time().'-'.$imageName; 

    
    Storage::disk('local')->makeDirectory('public/presupuesto/'. $request->id.'/imagenes/');

    Storage::put('public/presupuesto/'.$request->id.'/imagenes/'.$imageName, (string) $img->encode());


    /* $image->move(public_path('presupuestos/'.$request->id.'/imagenes/'),$imageName); */
   /*  Storage::disk('local')->putFileAs(
        'public/presupuestos/'.$request->id.'/imagenes/',
        $img,
        $imageName
      ); */

     // Storage::disk('images')->get('firmas.jpg');

    
    $upload = new PresupuestosFichero;
  $upload->nombre = 'presupuesto/'.$request->id.'/imagenes/'.$imageName;
 
  $upload->presupuesto_id = $request->id;
 // $upload->slug = str_slug('presupuesto/imagenes/'.$request->id.'/'.$imageName, "-");
 //$upload->slug = str_slug($imageName, "-");
 $upload->slug = $image->getClientOriginalName();
  $upload->texto ="IMAGEN";

  $upload->user()->associate(auth()->user());

  $upload->save();

    return response()->json(['success'=>$imageName]);



}




}
