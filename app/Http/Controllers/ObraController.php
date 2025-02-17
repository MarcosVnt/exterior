<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obra;
use App\ObraMano;
use App\ObraFoto;
use App\ObraUser;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ObraController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function informePdf(Request $request) {

      
        if(!$request->obra){
            return ;
        }

        $datosObra = Obra::where('id', $request->obra)->get();
       // dd($request,$request->obra,$datosObra[0]->id);


        $fotosObra = ObraFoto::where('obra_id',$datosObra[0]->id)->get();

        $horasObra = ObraMano::where('obra_id',$datosObra[0]->id)->get();

        //dd($request,$request->obra,$datosObra,$fotosObra,$horasObra);

      //  dd($request,$request->obra,$datosObra[0]->id,$fotosObra,$horasObra);

        /*  return view('pdf.informeobra', [ 'datosObra' => $datosObra,
             'fotosObra' => $fotosObra,
                'horasObra' => $horasObra,]); */
 
        $pdf = \PDF::loadView('pdf.informeobra',['datosObra'=>$datosObra,'fotosObra'=>$fotosObra,'horasObra'=>$horasObra]);
        
        //return $pdf;
        return $pdf->download('informeObra-'.$datosObra[0]->codigo.'.pdf');
        /* return [
            'datosObra' => $datosObra,
            'fotosObra' => $fotosObra,
            'horasObra' => $horasObra,



        ]; */


    }


    public function informePdfCliente(Request $request) {

      
        if(!$request->obra){
            return ;
        }

        //dd($request);




    // $obra = substr($request->fotosMarcadas,strpos($request->fotosMarcadas, "obras/"));    
    // $arrayObra = explode(",", $obra);
     $obra = $request->obra;
     
     $arrayObra = explode(",", $request->fotosMarcadas);

     $consulta = ObraFoto::select('id','obra_id','imagen') ->whereIn('imagen', $arrayObra)->get();


    
        
        $datosObra = Obra::where('id',$obra )->get();
      


        $fotosObra =  ObraFoto::select('id','obra_id','imagen') ->whereIn('imagen', $arrayObra)->get();
        //ObraFoto::where('obra_id',$datosObra[0]->id)->get();

       // dd($obra,$datosObra[0]->id,$fotosObra);

        $horasObra = ObraMano::where('obra_id',$datosObra[0]->id)->get();


        //dd($obra,$datosObra[0]->id,$horasObra,$fotosObra);

      
 
        $pdf = \PDF::loadView('pdf.informeobra',['datosObra'=>$datosObra,'fotosObra'=>$fotosObra,'horasObra'=>$horasObra]);
        
      
        return $pdf->download('informeObra-'.$datosObra[0]->codigo.'.pdf');
      


    }






    public function horasPorDiaUsuario(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

       // $dia = $request->dia;
        $dia = Carbon::now();
        $dia=$dia->format('Y-m-d');
        $manana = new Carbon('tomorrow');
        $manana = $manana->format('Y-m-d');
        //dd($manana);
        $user = Auth::user()->id;
        //dd($user);
            $horasPorDiaUsuario =  DB::table('obra_mano')
            ->join('obras', 'obra_mano.obra_id', '=', 'obras.id')
            ->select('obra_mano.user_id','obra_mano.de_fecha_hora','obras.codigo',DB::raw("COUNT(obra_id) as obra,SUM((timediff(a_fecha_hora,de_fecha_hora)*60)/10000) as minutos"),'obra_mano.obra_id')
            ->groupBy('obra_mano.obra_id')
            ->where('obra_mano.user_id','=',$user)
           // WHERE a_fecha_hora BETWEEN '2018-11-04 00:00:00' AND '2018-11-05 00:00:00'
            //->whereBetween('a_fecha_hora', ['2018-11-04 00:00:00','2018-11-15 00:00:00'])
            ->whereBetween('a_fecha_hora', [$dia,$manana])
            ->orderBy('obra_mano.obra_id','DESC')
            ->get();
          
       return [
       
          
            'horasPorDiaUsuario' => $horasPorDiaUsuario
        ];
    }
    
    public function horasPorDia(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
            //dd($request);
        if (!$request->dia){
            $dia = Carbon::now();  
            $manana= Carbon::now();  
            //echo '1';
        }else{
           //echo'2';
            $dia = Carbon::parse($request->dia);
            $manana = Carbon::parse($request->dia);
        }
                //  dd($dia);
            //      $dia = Carbon::now();
                    //$dia=$dia->format('Y-m-d');
                //    $manana = new Carbon('tomorrow');
            // $manana = $dia;
                $manana = $manana->addDays(1);  
            /*  echo $manana;
                //$manana = $manana->format('Y-m-d');
                    dd($dia); */
    
        
            $horasPorDia =  DB::table('obra_mano')
            ->join('obras', 'obra_mano.obra_id', '=', 'obras.id')
            ->select('obra_mano.de_fecha_hora','obras.codigo','obras.nombre',DB::raw("COUNT(obra_id) as obra,SUM((timediff(a_fecha_hora,de_fecha_hora)*60)/10000) as minutos"),'obra_mano.obra_id')
            ->groupBy('obra_mano.obra_id')
            //->where('obra_mano.de_fecha_hora','2018-11-05')
           // WHERE a_fecha_hora BETWEEN '2018-11-04 00:00:00' AND '2018-11-05 00:00:00'
            //->whereBetween('a_fecha_hora', ['2018-11-04 00:00:00','2018-11-15 00:00:00'])
            ->whereBetween('a_fecha_hora', [$dia,$manana])
            ->orderBy('obra_mano.obra_id','DESC')
            ->get();
            /* ObraMano::join('obras','obras.id', '=', 'obra_mano.obra_id')
            ->select('obra_mano.obra_id','obras.codigo')
            //->select(DB::raw("COUNT(obra_id) as obra,SUM((timediff(a_fecha_hora,de_fecha_hora)*60)/10000) as minutos"),'obra_mano.obra_id')
           // ->where('de_fecha_hora','=','2018-11-04')
            ->orderBy('obra_mano.a_fecha_hora','DESC')
            //->groupBy('obra_mano.obra_id')
            ->get();
 */
           // dd($horasPorDia);
            /* SELECT obra_id,COUNT(obra_id) AS obra,SUM((timediff(a_fecha_hora,de_fecha_hora)*60)/10000) as totales , obras.codigo as codigoObra
            FROM obra_mano
            INNER JOIN obras ON obra_mano.obra_id = obras.id
            WHERE a_fecha_hora BETWEEN '2018-11-04 00:00:00' AND '2018-11-05 00:00:00'
            AND user_id != 0
            GROUP BY obra_id */

    
       // dd($horasPorDia);
       return [
        /* 'pagination' => [
            'total'        => $horasPorDia->total(),
            'current_page' => $horasPorDia->currentPage(),
            'per_page'     => $horasPorDia->perPage(),
            'last_page'    => $horasPorDia->lastPage(),
            'from'         => $horasPorDia->firstItem(),
            'to'           => $horasPorDia->lastItem(),
        ], */
          
            'horasPorDia' => $horasPorDia
        ];
    }

    public function listaObras(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
     
    
    
        if ($buscar==''){
            $listaObras = Obra::orderBy('codigo', 'desc')->paginate(10);
        }
        else{
            $listaObras = Obra::where($criterio, 'like', '%'. $buscar . '%')->orderBy('codigo', 'desc')->paginate(20);
        }

    
       // dd($listaObras);
       return [
        'pagination' => [
            'total'        => $listaObras->total(),
            'current_page' => $listaObras->currentPage(),
            'per_page'     => $listaObras->perPage(),
            'last_page'    => $listaObras->lastPage(),
            'from'         => $listaObras->firstItem(),
            'to'           => $listaObras->lastItem(),
        ],
          
            'listaObras' => $listaObras
        ];
    }



    function index(Request $request)
    
    {
                //if (!$request->ajax()) return redirect('/');

       //  dd ($request->buscar);

                $buscar = $request->buscar;
                if ($buscar==''){
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=tblobras');
                }
                else{
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=tblobras&campo1=codigo&valor1='.$buscar.'&identico=SI');
                   
           
    
                }

                   
            //dd($xml);

            //$json_string = json_encode($xml); 
         return [
        'obra' => $xml]; 


    }

    function registrarObraUsuario(Request $request){
         //dd($request);
         if ($request->obraId == 0){
            $obraNueva = Obra::where('codigo', $request->obraCodigo)->first();
            if (!$obraNueva) {
                Obra::create([
                'codigo' => $request->obraCodigo,
                'nombre' => $request->obraNombre,
                'slug'   => $request->obraCodigo
            ]);
            }else{
                
            }
            $obraNueva = Obra::where('codigo',  $request->obraCodigo)->first();

        }else{

             //dd($obraNueva);


        $obraNueva = Obra::where('codigo',  $request->obraCodigo)->first();
       // echo($obraNueva->id);
        }
       
        //AÑADIR OBRA_USER
        //$obraNueva = Obra::firstOrCreate(['codigo' => $idObra],['nombre'=> '--')];
       // $user = Auth::user()->id;
       
        $user = $request->usuarioId;
        $obraUsuarioNueva = ObraUser::where([['obra_id','=',$obraNueva->id],['user_id','=',$user]])->first();
        
        if (!$obraUsuarioNueva) {
            ObraUser::create([
            'obra_id' => $obraNueva->id,
            'user_id' => $user,
            'condicion'   => '1'
           
        ]);
        }else{
           
        }
        echo($obraNueva->id);
        echo($user);
        $obraUsuarioNueva = ObraUser::where([['obra_id','=',$obraNueva->id],['user_id','=',$user]])->first();
        //dd($obraUsuarioNueva);
        echo($obraUsuarioNueva);

    }



    function buscarPorId(Request $request)
    
    {

                $buscar = $request->buscar;
                //dd($buscar);
                $anoObra="";
                $codObra="";
                $cliObra="";
                $idObra ="";

                if ($buscar==''){
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=tblobras');
                }
                else{




                   $anoObra=substr($buscar,0,2);
                    $codObra=substr($buscar,3,3);
                    //ojo si codigo obra es 9999 poner 2, 4
                    $cliObra=substr($buscar,6,4);
                    $idObra = $codObra.'/20'.$anoObra;
                   /*  echo($anoObra.'<br>');
                    echo($codObra.'<br>');
                    echo($cliObra.'<br>');
                    echo($idObra.'<br>');
 */
                   

                    /* $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=tblobras&campo1=codigo&valor1='.$buscar.'&identico=SI'); */
                   
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=tblobras&campo1=codigo&valor1='.$idObra.'&campo2=cliente&valor2='.$cliObra.'&identico=NO');
                    //dd($xml);
                }

                   
            //dd($xml);

      //$json_string = json_encode($xml); 
         return [
        'obra' => $xml]; 


    }
}
