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
        width: 100px;
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
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #art{
        color: #090909;
        font-size: 18px;
        text-align:center;
        background: #c3d8ed;
        font-weight: bold;


        }
        #com{
        color: #090909;
        font-size: 18px;
        text-align:center;
        background: #c3d8ed;
        font-weight: bold;


        }
        #com2{
        color: #090909;
        font-size: 18px;
        text-align:center;
        background: #eaf1f8;
        font-weight: bold;


        }
        .des{
        text-align:left;
        margin-left: 10 px;
     

        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        text-align:center;
        }

        #facliente thead{
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
        background: #c3d8ed;
        }

        #facomponente{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        background: #c3d8ed;
        }

        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #gracias{
        text-align: center; 
        }
    </style>
    <body>
       
        <header>
            <div id="logo">
                <img src="../img/rotuleon.png" alt="Grupo Rotuleon" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Rotuleon </b><br>P.I. de León Fase I, Parcela G30
                    <br>24231 - Onzonilla 
                    <br>León
                    <br>Telefono:987 22 39 37
                    <br>Email: info@gruporotuleon.net
                </p>
            </div>
            <div id="fact">
                <p>Fecha : {{$cabecera->fecha_presupuesto}}<br>
                N º : {{$cabecera->id}}</p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <th id="fac">DATOS DEL CLIENTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Sr(a). {{$cabecera->cliente_descripcion}}
                            <br>Contacto : {{$cabecera->contacto}} 
                            Dirección: {{$cabecera->direccion_envio}}<br>
                            Teléfono: {{$cabecera->telefono}}<br>
                            Email: {{$cabecera->email}}</</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>ESTADO</th>
                            <th>FECHA ENTREGA </th>
                            <th>REALIZADO </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$cabecera->estado}}</td>
                            <td>{{$cabecera->opcion_envio}}</td>
                            <td>   </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        
        <section>
            <div>
                @foreach ($articulos as $uno)
                    <table id="facarticulo">
                        <thead>
                            <tr id="fa">
                           
                                <th>DESCRIPCION</th>
                                <th>CANT</th>
                                <th>PRECIO UNIT</th>
                                <th>IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>


                        <tr id="com">
                            <td class="des">{{strtoupper($uno->descripcion)}}</td>

                        
                            

                            <td>{{$uno->cantidad}}</td>
                            
                            <td>{{$uno->preciofinal}}</td>
                            <td>{{$uno->importefinal}}</td>
                        </tr>
                        


                        @if (count($componentes)>0)

                        @php($i = 0)
                        @foreach ($componentes as $key => $dos) 
                            @if ($uno->id===$dos->idpresupuestolinea) 
                        
                            @php($i++)
                            
                            
                                @if($i===1)
                            <table id="facomponente">
                                <thead>
                                     <tr id="com">
                            
                                        <th>Componente Descripcion</th>
                                        <th>Ancho</th>
                                        <th>Alto</th>
                                        <th>M2</th>
                                        <th>T.unidad</th>

                                        <th>Cantidad</th>
                                        
                                        <th>PRECIO </th>
                                        <th>IMPORTE</th>
                                    </tr>
                                </thead>
                               

                              

                                @endif
                                <tbody>
                           
                                <tr id="com2">
                                    <td class="des">{{strtoupper($dos->descripcion)}}</td>

                                    <td>{{$dos->ancho}}</td>
                                    <td>{{$dos->longitud}}</td>
                                    <td>{{$dos->m2}}</td>
                                    <td>{{$dos->tipounidad}}</td>


                                    <td>{{$dos->cantidad}}</td>
                                    <td>{{$dos->preciofinal}}</td>
                                    <td>{{$dos->importefinal}}</td>
                                </tr>
                                </tbody>

                            </table>
                            @endif
                        @endforeach
                        

                      
                    @endif
                        </tbody>

                    </table>

                    @endforeach
              
            
                   
             </div>
    </section>
            
   

       
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su compra!</b></p>
            </div>
        </footer>
    </body>
</html>