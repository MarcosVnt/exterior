<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Venta</title>
    <style>
        #logo{
      
        border: 1px solid #000;

        float: left;
        width:45%;
        height: 150px;
        margin-top: 3%;
        margin-left: 1%;
        margin-right: 1%;
        }
        #direccion{
        
        border: 1px solid #000;
        float: right;
        width:45%;
        height: 200px;
        margin-top: 1%;
        margin-left: 5%;
        margin-right: 1%;
        background-color: #f1f5f9;
          padding-left: 3%;
          padding-top: 1%;

        }
    
#documento{
  background-color: #e6f2ff;
  width: 30%;
}
      #imagen{
        width: 250px;
        }














        html {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        body {
            font-size: 11px;
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
        }
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
</head>
  <body>
      
   
    <div class="l-wrap">
        <div class="row no-gutters" >
        <div class="row header">
            <div class="col-24 title">
                INSTALACIONES TÉRMICAS EN LOS EDIFICIOS CERTIFICADO DE MANTENIMIENTO
            </div>
            <div class="col-20 subtitle">
                Real Decreto 1027/2007, de 20 de julio. Reglamento de Instalaciones Térmicas en los Edificios
            </div>
            <div class="col-12 numero">
                Nº DE INSTALACIÓN: <span class="square"></span><span class="square"></span><span class="square"></span><span class="square"></span><span class="square"></span><span class="square"></span><span class="square"></span><span class="square"></span>
            </div>
        </div>
            <div class="col-24" >
                <div class="rowTable col-24 no-gutters" >
                
                    <div id="logo">
                        <img    src="http://rotuleon.rotuleon.net:8081/img/rotuleon_nuevo_logo.jpg" alt="ROTULEON" id="imagen">
                    </div>
                 
                    <div id="direccion" >
                        <p>Nº Presupuesto<br>
                        Nº Presupuesto<br>
                        Nº Presupuesto<br>
            
                          </p>
                    </div>
        
                   
                </div> 

            </div>
            <div class="rowTable titulo  col-24 " >
                        <div class="col-3-titulo  cell " >
                            Documento 
                        </div>
                        <div class="col-3-titulo cell">
                            Número
                        </div>
                        <div class="col-3-titulo cell">
                            ´Pagina
                        </div>
                        <div class="col-3-titulo cell">
                            Fecha
                        </div>
                </div> 
        </div> 
      -
    </div>      


               <!--  <div class="rowTable titulo  col-24 ">
                        <div class="col-3-titulo " >
                            Documento 
                        </div>
                        <div class="col-3-titulo cell">
                            Número
                        </div>
                        <div class="col-3-titulo cell">
                            ´Pagina
                        </div>
                        <div class="col-3-titulo cell">
                            Fecha
                        </div>
                </div> -->
                  
                <!-- <div class="rowTable col-23 no-gutters">
                        <div class="col-3 ">
                            Documento   
                        </div>
                        <div class="col-3 ">
                            Nmero
                        </div>
                        <div class="col-3 ">
                            ´Pagina
                        </div>
                        <div class="col-3 ">
                            Fecha
                        </div>
                    </div>
                     -->
                  <!-- <div class="rowTable titulo col-24 no-gutters" >
                        <div class="col-5 ">
                            N.I.F
                        </div>
                        <div class="col-8 ">
                            AGENTE
                        </div>
                        <div class="col-8 ">
                            
                        </div>
                        
                  </div>
                 -->
                
               
                  <!--  <div class="rowTable titulo col-24 no-gutters" >
                        <div class="col-5 ">
                            N.I.F
                        </div>
                        <div class="col-8 ">
                            AGENTE
                        </div>
                        <div class="col-8 ">
                            
                        </div>
                        
                    </div>
                 -->
            


    
   


  </body>
</html>