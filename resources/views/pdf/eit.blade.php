<html>
<head>
  <style>
    body{
      /* font-family: sans-serif; */

      font-size: 10px;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
    }
    @page {
      margin: 160px 50px;
    }
     header { position: fixed;
      left: 0px;
      top: -140px;
      right: 0px;
      height: 100px;
      /* background-color: #ddd; 
      text-align: center;*/
    }
   header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }


    #logo {

       

float: left;
width: 45%;
height: 100px;
padding-top: 30px;
padding-left: 30px;
margin-top: 1%;
margin-left: 1%;
margin-right: 1%;
}

#direccion {

border: 1px solid #000;
float: right;
width: 45%;
height: 145px;
margin-top: 0,5%;
margin-left: 5%;
margin-right: 1%;
background-color: #f1f5f9;
padding-left: 3%;
padding-top: 1%;

}

  #documento {
        background-color: #e6f2ff;
        width: 50%;
        margin-bottom: 5px;
    }

    .documentoCab {
        width: 14.666667%;
        margin: 1px;
        padding: 10px;
        height: 40px;
        background-color: #840084;
        text-align: center;
        color: white;

    }

    .agente {
        width: 100%;

    }

    .documentoLin {

        margin: 8px;
        margin-left: 2px;
        margin-right: 10px;

        padding: 10px;
        height: 40px;

        border: 1px solid #000;
        background-color: #CCCCCC;
        text-align: center
    }


    .azul {
        width: 37.666667%;
        margin: 8px;
        margin-left: 2px;
        margin-right: 10px;
        padding: 10px;
        height: 40px;

        border: 1px solid #000;
        background-color: #6767b3;
        text-align: center;
        color: white;


    }

    .descripcionArticulo {
        -webkit-column-break-inside: avoid;
          page-break-inside: avoid;
               break-inside: avoid;

                white-space:pre-line;
                text-align : left; 
                text-weight: bold;
                break-inside:auto; 
                clear: both;
    }
    #content {
        margin : 150px 50px 50px 50px;
    }

    .articulo {
        width: 100%;
        page-break-inside: allways !imortant;

    }

    .articuloLin {
        width: 14.666667%;
        margin: 1px;
        padding: 10px;
        background-color: #CCCCCC;
        text-align: center;
        page-break-inside: avoid !imortant;



    }
    tr    { page-break-inside:avoid; page-break-after:auto }
    table { page-break-inside:auto }



  </style>
<body>
<!-- https://desarrolloweb.com/articulos/generar-pdf-laravel-dompdf.html
 -->
 <header>
        <div id="logo">
            <img src="img/RotuleonNL.PNG" alt="ROTULEON" id="imagen">
        </div>

        <div id="direccion">
        <p style="font-weight:bold">
              
                @if($cabecera->cliente_descripcion === $cabecera->nombre_fiscal)
                    {{strtoupper($cabecera->cliente_descripcion)}}</p>
 
                @else
                    {{strtoupper($cabecera->cliente_descripcion)}}</p>
                    {{strtoupper($cabecera->nombre_fiscal)}}<br>

                @endif                
                {{strtoupper($cabecera->direccion)}}<br>
                {{strtoupper($cabecera->codigo_postal)}} - {{strtoupper($cabecera->poblacion)}}<br>
                {{strtoupper($cabecera->provincia)}}
                
                <p style="font-weight:bold">A LA ATENCIÓN DE : {{strtoupper($cabecera->contacto)}}</p>
                
                <p style="float: right">
            
                    @if($cabecera->movil) {{$cabecera->movil}} - @endif 
                    @if($cabecera->telefono) {{$cabecera->telefono}}@endif 
                    <br>
                    
                    {{strtoupper($cabecera->email)}}<br><br>                
                </p>
                
                <br>
        </div>

        <div>
            <table id="documento">
                <thead>
                    <tr class="documentoCab">
                        <th>Documento</th>
                        <th>Número</th>
                        <th></th>
                        <th>Fecha</th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="documentoLin">
                        <td>PRESUPUESTO</td>
                        <td>{{$cabecera->id}}</td>

                        <td></td>
                        <td>{{ date('d-m-Y', strtotime($cabecera->fecha_presupuesto)) }}</td>

                    </tr>
                </tbody>
            </table>
            <table class="agente">
            <thead>
                <tr class="azul">
                    <th>Nif</th>
                    <th>Agente</th>
                    <th> -</th>

                </tr>
            </thead>
            <tbody>
                <tr class="documentoLin">
                    <td style="width:20%">{{$cabecera->dni}}</td>
                    <td style="width:40%">{{strtoupper($cabecera->name)}}</td>
                    <td style="width:40%"></td>

                </tr>
            </tbody>
        </table>
        </div>
   
        </header>





 
<!-- 
    <section>
        <table class="agente">
            <thead>
                <tr class="azul">
                    <th>Nif</th>
                    <th>Agente</th>
                    <th> -</th>

                </tr>
            </thead>
            <tbody>
                <tr class="documentoLin">
                    <td style="width:20%">{{$cabecera->dni}}</td>
                    <td style="width:40%">{{strtoupper($cabecera->name)}}</td>
                    <td style="width:40%"></td>

                </tr>
            </tbody>
        </table>
    </section>
 -->
 
  <footer>
  <section>
        <p style="font-size:8px;">Sus datos de carácter personal han sido recogidos de acuerdo con lo dispuesto en el
            Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de
            2016, relativo a la protección de las personas físicas en lo que respecta a tratamiento de los datos
            personales y a la libre circulación de los mismos. Le ponemos en
            conocimiento que estos datos se encuentran almacenados en un fichero propiedad de ROTULEON, S.L., de acuerdo
            con la Ley anterior, tiene derecho a ejercer los derechos
            de acceso, rectificación, cancelación, limitación, oposición y portabilidad de manera gratuita mediante
            correo electrónico a: rotuleon@rotuleon.net o bien en la dirección:
            ROTULEON, S.L., PG. IND. DE LEON, FASE 1 - PARCELA G-30, 24231 - ONZONILLA (LEON).</p>
    </section>
    <section>
        <p style="text-align:center;  font-size: 10px;  font-weight: bold;">ROTULEON, S.L., REGISTRO MERCANTIL DE LEON,
            TOMO 822 FOLIO 90, HOJA LE-8764, INSCRIPCION 1ª, C.I.F.: B-24356966
        </p>
    </section>

  </footer>
  <div id="content">
   
  <table class="articulo">
            <thead>
                <tr class="articuloCab">
                 <!--    <th class="col-10">ARTICULO</th> -->
                    <th class="col-60">Descripción</th>
                    <th class="col-10">Cantidad</th>
                    <th class="col-10">Precio UD.</th>
                    <th class="col-10">Subtotal</th>
                    <th class="col-5">Dto.</th>
                    <th class="col-10">TOTAL</th>


                </tr>
            </thead>
            <tbody>
            @php($n=1)
            {{$n}}-----------------------------
            @foreach ($articulos as $articulo)  
    
         

            <tr class="articuloLin">
                <td class="descripcionArticulo"> 
                {{$n}}-
                {!! nl2br(e($articulo->descripcion)) !!}

                </td>
                    <td>{{number_format($articulo->bultos,2)}}</td>
                    <td>{{$articulo->preciofinal}}</td>
                    <td>{{$articulo->base}}</td>
                    <td>{{$articulo->descuento}}</td>
                    <td>{{$articulo->importefinal}}</td>
                
            </tr>
                
                @if ( $n % 15 == 0 )
                        <div style="page-break-before:always;"> </div>
                    @endif
                    <?php $n++ ?>



                @endforeach
            </tbody>
        </table>


<!-- style=" page-break-inside: avoid !imortant;white-space:pre-wrap;text-align : left; text-weight: bold;"> -->
<!-- @foreach ($articulos as $articulo)  
{!! nl2br(e($articulo->descripcion)) !!}}

@endforeach 
 --><!-- <div class="descripcionArticulo"> {{$articulo->descripcion}} </div> -->

                <!-- {{strtoupper($articulo->descripcion)}}  -->
                    <!-- {{nl2br(strtoupper($articulo->descripcion))}}  -->
                 <!--  {{ str_replace("/r/n", "<br/>", $articulo->descripcion)}} -->
                


  </div>
</body>
</html>