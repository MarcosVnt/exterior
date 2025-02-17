<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\JornadasExport;
use App\Exports\xmlExport;


class ExcelController extends Controller
{
    //

     function simpleXmlToArray($xmlObject, $out = array ())
    {
        foreach ($xmlObject as $index => $node ){
            if(count($node) === 0){
                $out[$node->getName()] = $node->__toString ();
            }else{
                $out[$node->getName()][] = $this->simpleXmlToArray($node);
            }
        }
    
        return $out;
    }


    function comprasvntXls(Request $request){
        

                $buscar = $request->buscar;
                if ($buscar==''){
                    //$xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?&dfecha=01.01.2017&EMPRESA=ROTULEON');
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?dfecha=01.01.2019&EMPRESA=ROTULEON');

                }
                else{
                    $xml = simplexml_load_file('http://127.0.0.1:12380/vnt/compras.vnt?buscar='.$buscar.'&dfecha=01.01.2019&EMPRESA=ROTULEON');
      
                }


                                    // Convert into json 
                    $con = json_encode($xml); 
                    
                    // Convert into associative array 
                    $newArr = json_decode($con, true); 


                    $export = new xmlExport([
                        $newArr
                    ]);
                    
                    /* 
                    $export = new xmlExport([
                        [1, 2, 3],
                        [4, 5, 6]
                    ]);
                    */

                    //dd($xml->articulo,$con,$newArr,$export);



                    return Excel::download($export, 'COMPRAS_DE_ARTICULOS.xlsx');
                    //https://docs.laravel-excel.com/3.1/exports/collection.html






    }

}






