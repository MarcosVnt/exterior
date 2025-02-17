<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Exterior Play">
    <meta name="author" content="vnt.com">
    <meta name="keyword" content="Exterior PLay, gestor compras">
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Id for Channel Notification -->
    <!--      <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">  
 -->

    <title>Exterior Play - COMPRAS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="../css/plantilla.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
</head>

<body>



    <div id="app">
        <header class="app-header navbar " style="height:auto">
            <a class="navbar-brand" href="#"></a>

            </ul>



        </header>



        <div class="app-body">
            <vallas-mapa></vallas-mapa>

        </div>
        <footer class="app-footer">
            <span><a href="http://www.codemountain.es/">CodeMountain</a> &copy; 2018-2022</span>
            <span class="ml-auto">Desarrollado por <a href="http://www.codemountain.es/">Code Mountain</a></span>
        </footer>
    </div>

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>