<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Presupuesto Rotuleon</title>

<style>

    html {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        scroll-behavior: smooth;
    }

    body {
        font-size: 10px;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;

    }

    *,
    *:before,
    *:after {
        -webkit-box-sizing: inherit;
        box-sizing: inherit;
    }

    section {
        clear: left;
        margin-bottom: 10px;
    }

    #logo {

       

        float: left;
        width: 45%;
        height: 100px;
        padding-top: 40px;
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

    .col-5 {
        width: 5%;

    }

    .col-10 {
        width: 10%;

    }

    .col-20 {
        width: 20%;

    }

    .col-30 {
        width: 30%;

    }
    .col-60 {
        width: 50%;

    }
    .articulo {
        width: 100%;

        page-break-inside: allways !imortant;

    }
    .page-break {
    page-break-after: always;
}

    .articuloCab {
        width: 14.666667%;
        margin: 1px;
        padding: 10px;
        height: 40px;
        background-color: #840084;
        text-align: center;
        color: white;

    }

    .articuloLin {
        width: 14.666667%;
        margin: 1px;
        padding: 10px;
        padding-right: 10px;
        background-color: #CCCCCC;
        text-align: right;
        page-break-inside: avoid !imortant;



    }


    .bases {
        width: 100%;


    }

    .basesCab {
        width: 14.666667%;
        margin: 1px;
        padding: 10px;

        background-color: #6767b3;
        text-align: center;
        color: white;

    }

    .baseLin {
        width: 14.666667%;
        margin: 1px;
        padding: 10px;
        background-color: #CCCCCC;
        text-align: center;
        color: red;

    }



    #imagen {
        width: 250px;
    }




    .titulo {

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

</style>

<body>


    <header>
        <div id="logo">
            <img src="img/RotuleonNL.PNG" alt="ROTULEON" id="imagen">
        </div>
<h1>VENTA DOSs {{$muestroTotal}}</h1>
{{$cabecera}}
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
    </header>

    <section>
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
                        <!-- <td>{{$cabecera->fecha_presupuesto}}</td> -->
                        <td>{{ date('d-m-Y', strtotime($cabecera->fecha_presupuesto)) }}</td>

                    </tr>
                </tbody>
            </table>

    </section>

    <section>
        <table class="agente">
            <thead>
                <tr class="azul">
                    <th>CIF/NIF</th>
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
    <section>


  <!--   <section>
{{$cabecera}}

</section> -->
<!-- <section>
{{$articulos}}

</section>
 --><!-- <section>
{{$componentes}}

</section>
 -->
    </section>
     <section  style="height: 55.9999999%; background-color:#CCCCCC">

  <table class="articulo" style="background-color:white">
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

            @php($c=0)
            @foreach ($articulos as $articulo)  
                    <!--  {{$articulo->descripcion}}   -->
                    <!--  {!! nl2br(($articulo->descripcion)) !!} -->
                    @php($lines = preg_split('/\n|\r/',$articulo->descripcion))
                    
                        @php($contador=count($lines))
                        @php($c=$c+$contador)
          
            @if($articulo->activado)
            
            <tr class="articuloLin">
                <td class="descripcionArticulo"> 
              
    



                {!! nl2br(($articulo->descripcion)) !!}
                
                </td>
                    <td>{{number_format($articulo->bultos,2)}}</td>
                    @if(number_format($articulo->preciofinal,2,',','.') === "0,00")
                       <td></td>
                    @else
                    <td>{{number_format($articulo->preciofinal,2,',','.')}}</td>

                    @endif

                    @if(number_format($articulo->base,2,',','.') === "0,00")
                       <td></td>
                    @else
                    <td>{{number_format($articulo->base,2,',','.')}}</td>
                    @endif

                    
                    @if(number_format($articulo->descuento,2,',','.') === "0,00")
                       <td></td>
                    @else
                       <td>{{number_format($articulo->descuento,2,',','.')}}</td>

                    @endif
                
                    @if(number_format($articulo->importefinal,2,',','.') === "0,00")
                       <td></td>
                    @else
                    <td>{{number_format($articulo->importefinal,2,',','.')}}</td>

                    @endif
                
                 
                
                
                
                
                


                
                </tr>
                @endif
              @if ( $n % 15 == 0 )
                        <div style="page-break-before:always;"> </div>
                    @endif
                    @php($n++);



                @endforeach
            </tbody>
            
        </table>


        </div>
    </section>
    <section>

    </section>
    <section>
        <table class="bases">
            <thead>
                <tr class="basesCab">
                    <th class="col-10">Tipo I.V.A.</th>
                    <th class="col-20">Importe</th>
                    <th class="col-15">DTO</th>
                    <th class="col-10">P.Pago</th>
                    <th class="col-10">Portes</th>
                    <th class="col-5">Financiacion</th>
                    <th class="col-20">BASE</th>
                    <th class="col-10">I.V.A.</th>
                    <th class="col-10">R.E.</th>



                </tr>
            </thead>
            muestro : {{$muestroTotal}}
            <tbody>
            @if($muestroTotal === 'true')
                <tr class="documentoLin" >
                    <td>21,000 %</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{number_format($base,2,',','.')}}</td>
                    <td>{{number_format($total_iva,2,',','.')}}</td>
                    <td></td>

                </tr>
            @else
                <tr class="documentoLin" >
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
            @endif
            </tbody>
        </table>


        </div>
    </section>
    <section>
        <!-- IVA NO INCLUIDO -->

    </section>
    <section>
        <table class="agente">
            <thead>
                <tr class="azul">
                    <th>Forma de Pago </th>
                    <th> </th>
                    <th> TOTAL </th>

                </tr>
            </thead>
            <tbody>
            @if($muestroTotal === 'true')

                <tr class="documentoLin" >
                    <td>{{$cabecera->forma_pago}}</td>
                    <td></td>
                   <!--  <td>{{$cabecera->importefinal}}</td> -->
                   <td>{{number_format($total_iva_incluido,2,',','.')}}</td>

                </tr>
            @else
                <tr class="documentoLin" >
                <td></td>
                    <td></td>
                   <!--  <td>{{$cabecera->importefinal}}</td> -->
                   <td></td>

                </tr>
            @endif
            </tbody>
        </table>


        </div>
    </section>
   <!--  <section>
        <table class="agente">
            <thead>
                <tr class="azul">
                    <th class="col-10">Vencimientos</th>
                    <th class="col-10">Importe </th>
                    <th class="col-30"> Domiciliacion </th>
                    <th class="col-30"> Numero de Cuenta </th>

                </tr>
            </thead>
            <tbody>
                <tr class="documentoLin">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
            </tbody>
        </table>


        </div>
    </section> -->
    <section>
    <p style="font-size:8px; text-align:left">
                EXTERIORCYL S.L., CIF B47675756 responsable del tratmiento informa, de conformidad con lo establecido en el REGLAMENTO (UE) 2016/679, que los datos de carácter personal son tratados con la finalidad de : 
                <br> - Prestar un servicio o suministrar un producto.
                <br> - Facturar un producto o servicio contratado.
                <br> - Cumplir con las obligaciones legales impuestas a la actividad.
           <br> Podrá ejercer sus derechos de acceso, rectificación, limitación de tratamiento, supresión , portabilidad y oposición al tratamiento de sus datos de carácter personal así como revocar los consentimientos
           que en su caso haya prestado u obtener más información, dirigiendo su petición al correo electrónico gestion@exteriorplay.com o al domicilio social POLIGONO INDUSTRIA DE LEON, FASE 1, PARCELA G30 D.P 24231 ONZONILLA (LEÓN). 



            </p>
    </section>
    <section>
        <p style="text-align:center;  font-size: 10px;  font-weight: bold;">ROTULEON, S.L., REGISTRO MERCANTIL DE LEON,
            TOMO 822 FOLIO 90, HOJA LE-8764, INSCRIPCION 1ª, C.I.F.: B-24356966
        </p>
    </section>

</body>

</html>