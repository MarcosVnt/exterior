<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        width: 500px;
        }


        #fac, #fv, #fa ,#fas{
        color: #FFFFFF;
        font-size: 15px;
        }


        
        #trabajo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #trabajo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        }

        #trabajo td{
        padding: 20px;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        }





        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        position: relative;
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
        #contenedor{
            display:block;
        }

        #datosenvio{
        /* position: relative; */
        
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        min-width:100px;
       
        }
        #datospresupuesto{
       /*  position: relative; */
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        min-width:100px;
      
        }
        #componente{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #componente table{
            border: 1px solid #c2cfd6; 
            width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
        }

        #componente thead{
        padding: 20px;
        
        text-align: center;
         
        }

        #componente th{
         
        vertical-align: bottom;
    border-bottom: 2px solid #c2cfd6;
        }

       #articulos table, th, td {
  border: 1px solid #c2cfd6;
  width : 100%;
  padding : 10 px;
  
  
}
        #articulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        padding : 10px;
        }

        #articulo table{
            border: 1px solid #c2cfd6; 
            width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
        }

        #articulo thead{
        padding: 20px;
        
        text-align: center;
        margin-bottom: 10px;

        }
        #articulo tr{
      
        margin-bottom: 10px;

        }

        #articulo th{
         
        vertical-align: bottom;
        text-align: center;
        
        border-bottom: 2px solid #c2cfd6;

        }

        #articulo td{
         
         vertical-align: bottom;
         text-align: center;
         font-weight: bold;
         font-size : 15px;
 
         }




    


        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #dpresupuesto{
            float:left;
        width: 60%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #envio{
            float:left;
        width: 30%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-left:15px;
        margin-bottom: 15px;
        }

      
        #envio thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #dpresupuesto thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #red;
          
        }

        #gracias{
        text-align: center; 
        }




        html {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        body {
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }
        *,
        *:before,
        *:after {
            -webkit-box-sizing: inherit;
            box-sizing: inherit;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        input {
            margin: 0;
        }
        .l-wrap {
            width: 100%;
            max-width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .padding {
            padding-top: 3rem;
            /*padding-bottom: 4rem;*/
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col-13, .col-14, .col-15, .col-16, .col-17, .col-18, .col-19, .col-20, .col-21, .col-22, .col-23, .col-24 {
            position: relative;
            width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }
        .col-0-2 {
            width: 2.083333%;
        }
        .col-1 {
            width: 4.166667%;
        }
        .col-1-2 {
            width: 6.250000%;
        }
        .col-2 {
            width: 8.333333%;
        }
        .col-3 {
            width: 12.5%;
        }
        .col-4 {
            width: 16.666667%;
        }
        .col-5 {
            width: 20.833333%;
        }
        .col-6 {
            width: 25%;
        }
        .col-7 {
            width: 29.166667%;
        }
        .col-8 {
            width: 33.33337%;
        }
        .col-9 {
            width: 37.5%;
        }
        .col-10 {
            width: 41.666667%;
        }
        .col-10-2 {
            width: 43.750000%;
        }
        .col-11 {
            width: 45.833334%;
        }
        .col-12 {
            width: 50%;
        }
        .col-13 {
            width: 54.166667%;
        }
        .col-14 {
            width: 58.333334%;
        }
        .col-15 {
            width: 62.500001%;
        }
        .col-16 {
            width: 66.666667%;
        }
        .col-17 {
            width: 70.833334%;
        }
        .col-18 {
            width: 75%;
        }
        .col-19 {
            width: 79.166667%;
        }
        .col-20 {
            width: 83.333333%;
        }
        .col-21 {
            width: 87.500001%;
        }
        .col-22 {
            width: 91.666667%;
        }
        .col-22-2 {
            width: 93.750001%;
        }
        .col-23 {
            width: 95.833333%;
        }
        .col-23-2 {
            width: 97.916667%;
        }
        .col-24 {
            width: 100%;
        }
        .col-auto {
            width: auto;
            max-width: 100%;
        }
        .no-gutters {
            margin-right: 0;
            margin-left: 0;
        }
        .no-gutters > .col,
        .no-gutters > [class*="col-"] {
            padding-right: 0;
            padding-left: 0;
        }
        .header {
            justify-content: center;
            text-align: center;
        }
        .logo {
            width: 200px;
            margin-bottom: .5rem;
        }
        .title {
            font-size: 16px;
            font-weight: 700;
        }
        .subtitle {
            font-size: 12px;
        }
        .numero {
            font-size: 12px;
            font-weight: 700;
            padding: .5rem 0;
        }
        .square {
            border: 1px solid #000;
            padding: 2px 8px;
        }
        .square:first-child {
            margin-left: 8px;
        }
        .square + .square {
            border-left: none;
        }
        .rectangle {
            border: 1px solid #000;
            padding: 2px;
            margin-right: 5px;
        }
        .rectangle + .rectangle {
            border-top: none;
        }
        .grid {
            border: 1px solid #000;
            margin-top: .5rem;
        }
        .grid + .grid {
            border-left: none;
        }
        .footer {
            font-size: 10px;
            margin-top: .5rem;
            justify-content: center;
        }
        .footer .cell, .signature, .footer-end {
            padding: .1rem;
        }
        .footer-end {
            font-size: 13px;
            font-weight: 700;
            padding: .35rem;
        }
        .date {
            font-size: 11px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .dotted {
            border-bottom: 1px dotted #000;
        }
        .border-right {
            border-right: 1px solid #000;
        }
        .signature {
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .signature .row {
            justify-content: center;
        }
        .signature .row div:first-child {
            margin-bottom: 40px;
        }
        .vertical, .vertical-empty {
            display: flex;
            justify-content: center;
            align-items: center;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            color: #fff;
            font-weight: 700;
            background-color: rgb(192,192,192);
            text-align: center;
        }
        .vertical-empty {
            align-items: flex-start;
            color: grey;
            background-color: transparent;
            margin-top: .5rem;
        }
        .rowTable {
            display: flex;
            flex-wrap: wrap;
        }
        .rowTable .cell {
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
            padding: .05rem .25rem;
        }
        .rowTable:last-child .cell {
            border-bottom: none;
        }<
        .marginNegativo {
            margin-top: -.05rem;
            margin-bottom: -.05rem;
        }
        .bold {
            font-weight: 700;
        }
        .italic {
            font-style: italic;
        }
        sub {
            font-size: 6px;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 8px;
        }
        .inline-container {
            display: flex;
            width: 100%;
            flex-direction: row;
            flex-wrap: nowrap;
        }
        li {
            padding: .1rem 0;
        }
    </style>
    <body>
<!-- 
    {{$cabecera}}
    <br />
    {{$articulos}}
    <br />
    {{$componentes}}
    <br />
     -->
   
        <header>
            <div id="logo">
                <img src="../img/LOGO_EXTERIOR_PLAY.PNG" alt="ROTULEON" id="imagen">
            </div>
         
            <div id="fact">
            <p>Nº Presupuesto :{{$cabecera->id}}<br>
            Fecha : {{$cabecera->fecha_presupuesto}}</p>
            </div>
        </header>
        <br>
      
        <br>
  </div>


        
        <section>
        <div id="contenedor">
            <div id="datospresupuesto">
                <table id="dpresupuesto">
                    <thead>                        
                        <tr>
                            <th id="fac">DATOS DEL PRESUPUESTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">
                            <br>
                            {{$cabecera->cliente_descripcion}}<br>
                             {{$cabecera->trabajo_descripcion}}<br><br>

                            Contacto: {{$cabecera->contacto}}<br>
                            Fecha Entrega: {{$cabecera->fecha_entrega}}<br>
                            Estado : {{$cabecera->estado}}<br>
                            Ref: {{$cabecera->referencia_pedido}}</</p></th>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div id="datosenvio">
                    <table id="envio">
                        <thead>                        
                            <tr>
                                <th id="fac">DATOS DE ENVIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><p id="cliente">{{$cabecera->tipo_envio}}
                                <br>{{$cabecera->fecha_envio}}
                                <br>{{$cabecera->opcion_envio}}
                                <br>{{$cabecera->direccion_envio}}<br>
                                 {{$cabecera->contacto_envio}}<br>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
        
        </div>
        </section>

        <section>
            <div>
                <table id="trabajo">
                    <thead>
                        <tr id="fv">
                            <th >DESCRIPCION DEL TRABAJO</th>
                            <th>FECHA ENTREGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="min-width:60%">{{$cabecera->trabajo_descripcion}}</td>
                            <td>{{$cabecera->fecha_entrega}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>

        @foreach ($articulos as $art)

        <div class="row no-gutters">
            <div class="col-1 vertical-empty">
                <div>R O T U L E O N  ----  P R E S U P U E S T O</div>
            </div>
            
            <div class="col-23">
                <div class="row grid no-gutters">
                    <div class="col-1-2 vertical">
                        <div>ARTICULO</div>
                    </div>
                    <div class="col-22-2 no-gutters">
                        <div class="rowTable col-24 no-gutters">
                            <div class="col-12 cell bold">
                                DESCRIPCION
                            </div>
                            <div class="col-4 cell bold">
                                CANTIDAD
                            </div>
                            <div class="col-4 cell bold">
                                PRECIO
                            </div>
                            <div class="col-4 cell bold">
                                IMPORTE
                            </div>
                        </div>
                        <div class="rowTable col-24 no-gutters">
                            <div class="col-12 cell bold">
                            {{$art->descripcion}}
                            </div>
                            <div class="col-4 cell bold">
                            {{$art->cantidad}}
                            </div>
                            <div class="col-4 cell bold">
                            {{$art->precio}}
                            </div>
                            <div class="col-4 cell bold">
                            {{$art->importefinal}}
                            </div>
                        </div>

                       
                        @foreach ($componentes as $c)

                            @if ($art->articulo===$c->articulo_principal) 
                            <div class="row no-gutters">
                                <div class="col-1 vertical-empty">
                                    <div> C O M P O N E N T E S</div>
                                </div>
                                
                                <div class="col-23">
                                    <div class="row grid no-gutters">
                                        <div class="col-1-2 vertical">
                                            <div>Componente</div>
                                        </div>
                                        <div class="col-22-2 no-gutters">
                                            <div class="rowTable col-24 no-gutters">
                                                <div class="col-12 cell ">
                                                    DESCRIPCION
                                                </div>
                                                <div class="col-4 cell ">
                                                    ANCHO
                                                </div>
                                                <div class="col-4 cell ">
                                                    ALTO
                                                </div>
                                                <div class="col-4 cell ">
                                                    M2
                                                </div>
                                            </div>
                                            <div class="rowTable col-24 no-gutters">
                                                <div class="col-12 cell bold">
                                                {{$c->descripcion}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->ancho}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->alto}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->m2}}
                                                </div>
                                            </div>

                                            <!-- LINEA DOS -->


                                            <div class="rowTable col-24 no-gutters">
                                                <div class="col-4 cell ">
                                                    TIPO UNIDAD
                                                </div>
                                                <div class="col-4 cell ">
                                                    PRECIO
                                                </div>
                                                <div class="col-4 cell ">
                                                    MONTAJE
                                                </div>
                                                <div class="col-4 cell ">
                                                    SUBCONTRATADO
                                                </div>
                                                <div class="col-4 cell ">
                                                    BENEFICIOS
                                                </div>
                                                <div class="col-4 cell ">
                                                    IMPORTE FINAL
                                                </div>
                                            </div>
                                            <div class="rowTable col-24 no-gutters">
                                                <div class="col-4 cell bold">
                                                {{$c->tipounidad}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->precio}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->montaje}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->subcontratado}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->benficios}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$c->importefinal}}
                                                </div>
                                            </div>



                                            <div class="rowTable col-24 no-gutters">
                                                <!-- <div class="col-19 cell">
                                                    Nombre: UNIVERSIDAD DE LEÓN
                                                </div>
                                                <div class="col-5 cell">
                                                    NIF/CIF: Q2432001B
                                                </div> -->
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                            @endif
                        @endforeach
                      
                       
                        
                    </div>
                </div>
            </div>





            
        </div>

        @endforeach


        <!-- TOTALES -->

        <section>
        <br><br><br>
        
                                <div class="col-23">
                                    <div class="row grid no-gutters">
                                        <div class="col-1-2 vertical">
                                            <div>TOTALES</div>
                                        </div>
                                        <div class="col-22-2 no-gutters">
                                            <div class="rowTable col-24 no-gutters">
                                                <div class="col-4 cell ">
                                                    MONTAJE
                                                </div>
                                                <div class="col-4 cell ">
                                                    SUBCONTRADO
                                                </div>
                                                <div class="col-4 cell ">
                                                    GASTOS
                                                </div>
                                                <div class="col-4 cell ">
                                                    BASE
                                                </div>
                                                <div class="col-4 cell ">
                                                    BENEFICIO %
                                                </div>
                                                <div class="col-4 cell ">
                                                    TOTAL PRESUPUESTO
                                                </div>

                                            </div>
                                          
                                            <div class="rowTable col-24 no-gutters">
                                                <div class="col-4 cell bold">
                                                {{$cabecera->fecha_presupuesto}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$cabecera->fecha_presupuesto}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$cabecera->fecha_presupuesto}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$cabecera->fecha_presupuesto}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$cabecera->fecha_presupuesto}}
                                                </div>
                                                <div class="col-4 cell bold">
                                                {{$cabecera->fecha_presupuesto}}
                                                </div>
                                                
                                            </div>

                                            <!-- LINEA DOS -->


                                          
                                        </div>
                                    </div>
                                </div>
        
        </section>





   
</body>
</html>