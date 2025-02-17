<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe Obra - ROTULEON </title>
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
        width: 300px;
        }
        #imagenObra{
            margin-left: 15%;
        margin-right: 15%;
            width: 65%;
        margin-top: 5%;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: left;
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

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
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
        @foreach ($datosObra as $v)
        <header>
            <div id="logo">
               <!--  <img src="img/GRUPO_ROTULEON.jpg" alt="Rotuleon" id="imagen"> -->
               <img src="img/LOGORTL.PNG" alt="Grupo Rotuleon" id="imagen">

            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>ROTULEON  </b><br>PG. IND. DE LEON, FASE 1 - PARCELA G-30 <br>Telefono:(+34)987223937<br>Email:rotuleon@rotuleon.net
                </p>
            </div>
            <div id="fact">
               <!--  <p>{{$v->codigo}}<br>
                {{$v->serie_comprobante}}-{{$v->num_comprobante}}</p> -->
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
                            <th><p id="cliente"> {{$v->codigo}}<br>
                            {{$v->nombre}}<br>
                       
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
       <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>IMAGENES </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
<!--                     <img src="storage/obras/images/04672019/20200727101455_20200724_152947.jpg" alt="uno" id="imagen">
 -->
                   <br><br><br>
                    @foreach ($fotosObra as $f)

                    <img src="storage/{{$f->imagen}}" alt="uno" id="imagenObra">
             
                    @endforeach

<!--                     <tbody>
                        <tr>
                            <td> <img src="img/GRUPO_ROTULEON.jpg" alt="Rotuleon" id="imagen"></td>
                            <td> <img src="img/GRUPO_ROTULEON.jpg" alt="Rotuleon" id="imagen"></td>
                           
                        
                        </tr>
                        <tr>
                            <td> <img src="img/GRUPO_ROTULEON.jpg" alt="Rotuleon" id="imagen"></td>
                            <td> <img src="img/GRUPO_ROTULEON.jpg" alt="Rotuleon" id="imagen"></td>
                           
                        
                        </tr>
                    </tbody>
 -->               
            </div>
        </section> 
        <br>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Grupo Rotuleon - Todos los derechos Reservados </b></p>
            </div>
        </footer>
    </body>
</html>