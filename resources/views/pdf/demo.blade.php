<!-- https://www.positronx.io/laravel-pdf-tutorial-generate-pdf-with-dompdf-in-laravel/
 -->


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rotuleon Presupuesto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        @page {
           margin: 0px 0px 0px 0px !important;
           padding: 0px 0px 0px 0px !important;
       }

       @font-face {
        font-family: "Raleway";
        font-style: normal;
        font-weight: light;
       }
       .nobreak {
         page-break-inside: auto;
        }

        .lin {
            white-space: pre-wrap
            word-wrap: break-word;
            font-family: inherit;
        }

       body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 16px;
        /* font-family: SourceSansPro; */
        }

        #logo{
        float: center;
        margin-top: 10%;
        margin-left: 22%;
        margin-right: 22%;
        }

        .table-responsive > .fixed-column {
            right: 0;
            top: 0px;
           /*  background: #f4f4f4; */
           background: red;
            position: absolute;

            display: inline-block;
            width: auto;
            border-top: 0px solid;
            border-left: 1px solid #808080;

            page-break-inside: auto;


            }
    </style>

</head>

<body>
    <!-- <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <td>Name</td>
        <td>Email</td>
        <td>Phone Number</td>
        <td>DOB</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($articulos as $data)
        <tr>
            <td>{{ $data->descripcion }}</td>
            <td>{{ $data->cantidad }}</td>
            <td>{{ $data->preciofinal }}</td>
            <td>{{ $data->importefinal }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
     -->
    <div class="container-fluid">
        <div class="card">

           
            <div class="card-header">
                <br>
                <br>
                <br>
               

                NºDocumento:
                <strong>{{$cabecera->fecha_presupuesto}}</strong>
                <span class="float-right"> <strong>Estado:</strong> {{$cabecera->estado}}</span>

            </div>
           
 
            <div class="card-body">
                <!-- <div class="row mb-4">
                    <div class="col-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>Webz Poland</strong>
                        </div>
                        <div>Madalinskiego 8</div>
                        <div>71-101 Szczecin, Poland</div>
                        <div>Email: info@webz.com.pl</div>
                        <div>Phone: +48 444 666 3333</div>
                    </div>

                    <div class="col-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong>Bob Mart</strong>
                        </div>
                        <div>Attn: Daniel Marek</div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Email: marek@daniel.com</div>
                        <div>Phone: +48 123 456 789</div>
                    </div>

                </div> -->

                    <div id="logos"  class="row mb-12" style="min-height: 200px;">
                        <img src="img/rotuleon.png" alt="Grupo Rotuleon" id="imagen">
                    </div>
                       
                

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                          

                            <tr>
                                <th> 
                                <div class="col-6">
                                   <!--  <div id="logos">
                                        <img src="img/rotuleon.png" alt="Grupo Rotuleon" id="imagen">
                                    </div>
 -->
                                    <h6 class="mb-3"></h6>
                                    <div>
                                        <strong>R O T U L E O N  S.L.</strong>
                                    </div>
                                    <div>P.I. de León Fase I, Parcela G30</div>
                                    <div>24231 - Onzonilla - (LEON)</div>
                                    <div>Email: info@gruporotuleon.com</div>
                                    <div>Telf: 987 22 39 37</div>
                                </div>
                            </th>
                                <th> 
                                    <div class="col-6">
                                    <h6 class="mb-3">Datos del Cliente:</h6>
                                    <div>
                                        <strong> {{$cabecera->cliente_descripcion}}</strong>
                                    </div>
                                    <div>Att: {{$cabecera->contacto}}</div>
                                    <div> {{$cabecera->direccion_envio}}</div>
                                    <div>Email: {{$cabecera->email}}</div>
                                    <div>Telf:  {{$cabecera->telefono}}</div>
                                </div>
                            </th>

                            </tr>
                        </thead>
                       
                    </table>
                </div>
                <div class="card" style="height: 2rem;">
                    
                    <span class="float-left"> <strong>NºDocumento::</strong> {{$cabecera->id}}</span>

    
                   
                    <span class="float-right"> <strong>Fecha del Presupuesto:</strong> {{$cabecera->fecha_presupuesto}}</span>
    
                </div>
    
                <div class="table-responsive-sm h-50 " >
                    
                        <table class="table table-striped">
                        <thead>
                            <tr>
                              <!--   <th class="center">#</th> -->
<!--                                 <th>Item</th>
 -->                                <th>Descripción</th>

                                <th class="right">Unidades</th>
                               <!--  <th class="center">Qty</th> -->
                                <th class="right">PVP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articulos as $uno)
                            <tr>
                               <!--  <td class="center">1</td> -->
                                <td  class="right strong lin monospace-pre-wrap">{{strtoupper($uno->descripcion)}}</td>
<!--                                 <td class="left">Extended License</td>
 -->
                                <td class="right">{{$uno->bultos}}</td>
                                <td class="right">{{$uno->bultos}}</td>
                                <td class="right">{{$uno->bultos}}</td>
                                
<!--                                 <td class="center">1</td>
 -->                                <td class="left">{{$uno->importefinal}} €</td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    
                </div>



                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                               <!--  <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">$8.497,00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount (20%)</strong>
                                    </td>
                                    <td class="right">$1,699,40</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>VAT (10%)</strong>
                                    </td>
                                    <td class="right">$679,76</td>
                                </tr> -->
                                <tr>
                                    <td class="left">
                                        <strong>IMPORTE TOTAL</strong>
                                    </td>
                                    <td class="right">
                                        <strong>{{$cabecera->importefinal}} €</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                   

                </div>


                <div class="row">
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                        
                            <tr>
                                <td class="left">
                                    <strong>IVA 21 % NO INCLUIDO</strong>
                                </td>
                                <td class="right">
                                    FORMA DE PAGO  TRANSFERENCIA
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div>

            </div> 

        </div>
    </div>
</body>

</html>