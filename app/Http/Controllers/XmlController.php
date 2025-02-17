<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Vnt\XmlPaginador;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\ArticuloNota;
use App\Gestorcompra;



class XmlController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    //
    public function index(Request $request){


//        http://212.183.204.149:12388/vfp/select.sql?DBTableName=Pesadas DBRecordName=pesada DATABASE=//uagcylservidor/d/VISUALNT/datos/Gesco/99999999 SQL=SELECT * from asocexpl.dbf
//        http://212.183.204.149:12388/vnt/uagcyl/partrans.vnt
        //$xml = XmlParser::load('https://www.w3schools.com/xml/cd_catalog.xml');
        //simplexml_load_file(Storage::get('public/XML/myfile.xml'))


       $xml = simplexml_load_file('https://www.w3schools.com/xml/cd_catalog.xml');
        //CD -> 0 -> TITLE
       //echo $xml->CD[1]->TITLE;

      //  dd($xml);

      $json_string = json_encode($xml); 
        return [
        'gestorcompras' => $xml];
    }


    function buscar(Request $request) {

       // dd($request->buscar,$request->criterio);


        $buscar = $request->buscar;
        if ($buscar==''){
            //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
            $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?dfecha=01.01.2019&EMPRESA=ROTULEON');

        }
        else{
            $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON');

        }


        return [
                'gestorcompras' => $xml]; 







    }

    function nota(Request $request) {
            //dd($request);
        if (!$request->ajax()) return redirect('/');
       
    if(ArticuloNota::where('codigo','=',$request->articulo)->where('codigo_proveedor','=',$request->proveedor)->first()){
        $nota =ArticuloNota::where('codigo','=',$request->articulo)->where('codigo_proveedor','=',$request->proveedor)->first();

//dd($nota);
            $nota->nota = $request->nota;
            $nota->save();
        }else{
            $nota = new ArticuloNota();

            $nota->codigo = $request->articulo;
            $nota->nota = $request->nota;
            $nota->codigo_proveedor = $request->proveedor;
            $nota->save();
        }
       
        return [
            'nota' => $nota]; 





    }
    function eliminarnota(Request $request) {
        //dd($request);
    if (!$request->ajax()) return redirect('/');
   
   
   
    $nota =ArticuloNota::where('codigo','=',$request->articulo)->where('codigo_proveedor','=',$request->proveedor)->first();

//dd($nota);
      
        $nota->delete();
   
    
   
    return [
        'nota' => $nota]; 





}

    function clientesvnt(Request $request) {

        // dd($request->buscar,$request->criterio);
 
 
         $buscar = $request->buscar;
         $criterio = $request->criterio;
         if ($buscar==''){
             //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
             $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=clientes&identico=NO&EMPRESA=EXTERIOR');
 
         }
         else{
             $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/tblbuscar.vnt?tabla=clientes&campo1='.$criterio.'&valor1='.$buscar.'&identico=NO&EMPRESA=EXTERIOR');
             //http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON');
 
         }
 
 
         return [
                 'clientesvnt' => $xml]; 
 
 
 
 
 
 
 
     }


    function SimpleXml(){

       // $xml = simplexml_load_file('https://www.w3schools.com/xml/cd_catalog.xml');
        $URL = 'http://192.168.10.66:8081/rotuleon/compras_.php?articulo=TORNILLO&almacen=01&dfecha=01.01.2017&hfecha=18.06.2018';
        //$URL2 = 'https://www.w3schools.com/xml/cd_catalog.xml';

        
        $xml = simplexml_load_file($URL);

       // dd($_compras_->articulo[0]->PROVEEDOR);
       // dd($xml);
        $json_string = json_encode($xml);  
                
        $result_array = json_decode($json_string, TRUE);

        $json_string = json_encode($xml);    
        $result_array = json_decode($json_string, TRUE);



       dd($result_array);
            /*     foreach($result_array as $cd){
                
                    //      echo '1'.$result_array;
            
        echo 'hola';   
                } */
   
        
       /*  echo gettype($xml). "<br>";
        echo $xml->CD[0]->TITLE . "<br>";
        echo $xml->CD[0]->ARTIST . "<br>";
        echo $xml->CD[0]->COUNTRY. "<br>";
        echo $xml->CD[0]->COMPANY . "<br>";
        echo $xml->CD[0]->PRICE . "<br>";
        echo $xml->CD[0]->YEAR . "<br>"; */
       
        /* foreach ($xml->entry as $xml2 ){
            $title = $xml2->title;
        }

      
        dd($xml2); */

    }

    function xml3(){
       // https://es.stackoverflow.com/questions/97240/duda-con-xml-y-laravel
        
       
       $url = 'http://192.168.10.66:8081/rotuleon/compras_.php?articulo=TORNILLO&almacen=01&dfecha=01.01.2017&hfecha=18.06.2018';
        $xml = simplexml_load_file($url);

        /* Aquí lo mejor es manipular la información de tu XML de acuerdo a lo que se mostrará en la vista */

        return view('xml3', ['xmlContent' => $xml]);
    }





    // para filtro demo
    function getFilteredArray($params, $data) {
        $filtredArray = [];
        foreach($params as $key => $value) {
            foreach($data as $index => $item) {
                if(array_key_exists($key, $item) && in_array($value, $params)) {
                    if($item[$key] == $value ){
                        $filtredArray[$index] = $item;
                    } else {
                        continue;
                    }
                }
            }
        }
        return $filtredArray;
     }


     
     function comprasvntDemo(Request $request)
    
     {
 
 
         $date = \Carbon\Carbon::today()->subDays(7);
 
                 $buscar = $request->buscar;
                 $notas = '';
                 if ($buscar==''){
                     //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                     $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?dfecha=01.01.2019&EMPRESA=ROTULEON');
 
                 }
                 else{
                     $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON');
 
                   
       
                 }
 
                  $notas = ArticuloNota::all();
 
 
                  $filtered = [];
 
                 /*  echo gettype($xml), "\n";
                  echo gettype($notas), "\n"; */
 

                  /* $xml2 = json_decode(json_encode((array) simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON')), 1);

                  $xml_data = ((array)$xml);

 */
                  
                    $i = 0 ;                 
 
                  foreach ($xml as $articulo){
                   
                    $valProveedor =  (string) $articulo->PROVEEDOR;


                 //  dd($articulo,$articulo->PROVEEDOR->__toString());


                 //  $valArticulo =  $articulo->ARTICULO->__toStirng();
                // Opciones	EMPRESA	DENOMINA	PRECIO	DTO	COSTE UNIDAD	UNIDAD	ANC	LON	M2	COMENTARIOS	FECHA
                    
                        $compras[$i]=array(
                         
                        'codigo_proveedor' => (string) $articulo->PROVEEDOR, 
                        'empresa' => (string) $articulo->EMPRESA, 
                        'articulo' => (string) $articulo->ARTICULO,
                        'denomina' => (string) $articulo->DENOMINA, 
                        'precio' => (string) $articulo->PRECIO, 
                        'dto' => (string) $articulo->DTO, 
                        'coste' => (string) $articulo->COSTE, 
                        'unidad' => (string) $articulo->UNIDAD, 
                        'longitud' => (string) $articulo->LONGITUD, 
                        'ancho' =>(string) $articulo->ANCHO, 
                        'm2' =>(string) $articulo->M2, 
                        'comentarios' =>(string) $articulo->COMENTARIOS,
                       // 'notas ' => "",
                        );


                        //$not= "no ahy notas2";

                        $not = $notas->filter(function ($value, $key) use ($articulo,$i,$compras) { 
                            $nota = "";

                            if($value['codigo'] == $articulo->ARTICULO[0] && $value['codigo_proveedor'] == $articulo->PROVEEDOR[0]){
                               // var_dump($articulo->ARTICULO[0],$articulo->PROVEEDOR[0] ); 
                              // $nota[$i]= array('nota' => $value['nota']);
                              $nota = array('natas' => (string) $value['nota']);

                             // $compras[$i] += [ 'notass' => $not ];

                              //dd($compras);
                              
                              //var_dump($compras);
                              //echo 'siii--'.$value['codigo'].'--->'.$value['nota'] ;
                             
                              //['vnt'] = (string) 'vnt';

                             //  $a = array_merge($compras[$i], $nota[$i]);

                               
                              // $compras[$i]['nota'] = (string) $not;
                               //var_dump($compras[$i]);
                               //echo 'IIII'.$i.'---'.$compras[$i]['notas'],"\n";

                               //echo 'siiiii'.$not.'-->'.$value['codigo'].'--->'.$value['nota']. "\n";
                            
                            }else{
                                $nota = array('natas' => (string) $value['nota']);


                                echo 'no ';
                                //var_dump($compras[$i]);
                                //$not= "no ahy notas";
                                //$compras[$i]['notasa']= (string) 'no hay notas';
                               //  echo $not.'nooo'.$value['codigo'].'--->'.$value['nota'] ;
                            }
                            return $nota ; 



                           
                        });

                        //$compras2 = array_merge($compras, $not);

                       // dd($not);
                       //$compras['aaa']= 'bbbb';
                       //$compras[$i] += [ "element$i" => $i ];
                     //  dd($compras, $compras[$i],$not);


                       // $compras[$i]['notasa2']= $not;
                        $i++;
                        
                  }//foreahc
dd($compras);
        //  dd($xml->articulo[0]->ARTICULO->__toString());
                // los envio para saber si esa linea ya esta pedida???

                 $pedidosCompras =    Gestorcompra::where('created_at','>=',$date)->orderBy('created_at','DESC')->get();
 
                 //Gestorcompra::all();

 
                 return [
                         'notas' => $notas,
                         'gestorcompras' => $xml,
                         'pedidosCompras' => $pedidosCompras,
                         'filterArray' => $compras,
                     
                     ]; 
 
 
                  }
     



    function comprasvnt(Request $request){

               $date = \Carbon\Carbon::today()->subDays(30);

                $buscar = $request->buscar;
                $notas = '';
              
                if ($buscar==''){
                    //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?dfecha=01.01.2019&EMPRESA=ROTULEON');

                }
                else{
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON');

                  
      
                }

                // mandamos todas las notas para filtro en vista    
                $notas = ArticuloNota::all();

                // mandamos todos los pedidos , para saber si esta pedido????
                $pedidosCompras =    Gestorcompra::where('created_at','>=',$date)->orderBy('created_at','DESC')->get();


                return [
                        'notas' => $notas,
                        'gestorcompras' => $xml,
                        'pedidosCompras' => $pedidosCompras,
                        'filterArray' => $xml->articulo,
                    
                    ]; 


    }
    
    
        function clientes(Request $request){
                       $buscar = $request->buscar;
                                if ($buscar==''){
                                    //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/
                                    ventas.vnt?dfecha=01.01.2019&EMPRESA=ROTULEON');
                
                                }
                                else{
                                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/ventas.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON');
                      
                                }
                
                
                                return [
                                        'clientes' => $xml]; 
                
                
          }
                    
                    
    
    function demo(Request $request){

          

                $buscar = $request->buscar;
                if ($buscar==''){
                    //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar=metacrilato&dfecha=01.01.2020&EMPRESA=ROTULEON');

                }
                else{
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar=metacrilato&dfecha=01.01.2020&EMPRESA=ROTULEON');
      
                }
                json_encode($xml); 
                json_decode($xml, true);
               // print_r($xml);

                return [
                        'gestorcompras' => $xml]; 


    }
    


    function comprasvnt2(Request $request){
        $paginas = '';
        
        $paginas == isset($request['page']) || $request['page'] = 3;


                $buscar = $request->buscar;
                if ($buscar==''){
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                }
                else{
                    //$gestorcompras = Gestorcompra::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&articulo='.$buscar.'&dfecha=01.01.2017&EMPRESA=ROTULEON');
                    //http://127.0.0.1:12380/vnt/comprasss.vnt?&articulo='.$buscar.'&dfecha=01.01.2017&EMPRESA=ROTULEON');
    
                }

            $compras = $xml;
           // $pagination = new XmlPaginador($paginas,$compras->count(),$perPage = 3);

          //  dd($pagination);

      //$json_string = json_encode($xml); 
           /*  dd($json_string);
echo 'HOllllllllaaaaa : '+$json_string;
die(); */
          return [
        'gestorcompras' => $xml]; 

 

     
       /*  return    [
            'pagination' => [
                'total'        => $pagination->getTotalCount(),
                'current_page' => $pagination->getPage(),
                'per_page'     => $pagination->getPerPage(),
                'last_page'    => $pagination->getTotalPages(),
                'from'         => $pagination->getCount(),//$compras->firstItem(),
                'to'           => 10,//$compras->lastItem(),
               
               
               
                'getNextPage'    => $pagination->getNextPage(),
                'getPreviousPage'    => $pagination->getPreviousPage(),
                'isFirstPage'    => $pagination->isFirstPage(),
                'isLastPage'    => $pagination->isLastPage(),
 
                'last_page'    => $pagination->getTotalPages(),
                'isLastPage'    => $pagination->isLastPage(),
                'getSqlLimit'    => $pagination->getSqlLimit(),
               // 'getLimitIterator'    => $pagination->getLimitIterator(),
                'getPageRange'    => $pagination->getPageRange(),


            ],
            'compras' => $compras
        ];  */

      


    }
    
    function comprasvntpaginador(Request $request)
    
    {
        $paginas = '';
        
        $paginas == isset($request['page']) || $request['page'] = 3;


                $buscar = $request->buscar;
                if ($buscar==''){
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                }
                else{
                    //$gestorcompras = Gestorcompra::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&articulo='.$buscar.'&dfecha=01.01.2017&EMPRESA=ROTULEON');
                    //http://127.0.0.1:12380/vnt/comprasss.vnt?&articulo='.$buscar.'&dfecha=01.01.2017&EMPRESA=ROTULEON');
    
                }
//https://gist.github.com/stojg/3045663
                echo (is_array($xml) ? 'ES Array' : 'No es un array<br>');
                echo (is_object($xml) ? 'Es Objeto' : 'No es un objeto');
                echo (get_class($xml));

                echo 'xml simplexml_load_file';
                dump($xml);

                foreach($xml as $record){
                    
                   foreach($record as $key => $value){
                      //$table_data[$table_id][$key][] = $value['option'];
                       print_r($value['ARTICULO']->attributes());
                   }
                }

                dd($xml);


/* 
                if(is_object($xml) && get_class($xml) == 'SimpleXMLElement') {
                    $attributes = $xml->attributes();
                    foreach($attributes as $k=>$v) {
                        $a[$k] = (string) $v;
                    }
                    $x = $xml;
                    $xml = get_object_vars($xml);
                }
                echo 'objeto to array <br>';
                dump($xml); */




                if(is_object($xml) && get_class($xml) == 'SimpleXMLElement') {
                    $attributes = $xml->attributes();
                    $children = $xml->children();
                    $cuenta=0;
                    $compras= [];
                   
                    
                    foreach($xml->children() as $child) {

                        foreach($xml->children() as $child) {
                        $EMPRESA = $child->EMPRESA;
                        
                        $ARTICULO =  $child->ARTICULO;
                        $DENOMINA =  $child->DENOMINA;
                        $PRECIO =  $child->PRECIO;
                       


                        $compras[$cuenta] = [
                             $EMPRESA, 
                             $ARTICULO,
                             $DENOMINA,
                            $PRECIO ];

                        /* echo $child->EMPRESA . ", "; 
                        echo $child->ARTICULO . ", "; 
                        echo $child->DENOMINA . ", ";
                        echo $child->DENOMINA . "<br>"; */ 
                        $cuenta ++;
                        }
                    }
                  
                }
echo 'to array de <br>';
dump($compras);
$array = json_decode(json_encode($compras), TRUE);
                dd($array);
            $compras = $xml;
            $collection0 = [];

            foreach($xml->children() as $child) {
    
                $role = $child->attributes();
        
                foreach($child as $key => $value) {
                    
                    
                    //echo("[".$key ."] ".$value . "<br />");
                    $collection0[$key] = $value; 
                    
                }
                //print_r($newArray);

                }
        dump($collection0);


            $array = json_decode(json_encode($xml), TRUE);
            //Debugbar($compras);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($collection0);
            dump($collection);
            dump($xml->toArray);

            //$collection = array_slice($xml);
            $per_page = 5;
            $currentPageResults = $collection->slice(($currentPage-1) * $per_page, $per_page)->all();
            $data['results'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);
            $data['results']->setPath($request->url());

            $collection2 = Collection::times(10, function ($number) {
                return $number * 9;
            });
            
            /* dump($collection2->all());
            
            dump($compras);
            dump($array);*/

            dd($collection2); 
    }



    function exiteObra(Request $request) {

        // dd($request->buscar,$request->criterio);
 
 
         $buscar = $request->obra;
         if ($obra==''){
             //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
            // $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?dfecha=01.01.2019&EMPRESA=ROTULEON');
            $xml = "obra obligatoria";
         }
         else{
             $xml = simplexml_load_file('
             http://127.0.0.1:12380/vnt/existe_obra.vnt?&obra='.$obra);

            // http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$obra.'&dfecha=01.01.2019&EMPRESA=ROTULEON');
 
         }
 
 
         return [
                 'gestorcompras' => $xml]; 
 
 
     }
 






}
