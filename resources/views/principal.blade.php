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
    <link href="css/plantilla.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
</head>
<!-- 
sidebar-hidden -->
@if(Auth::check())
        @if(Auth::user()->rol_id===8)
        <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden sidebar-hidden ">

        @else
        <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden ">

        @endif

@else

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden ">

@endif


    <div id="app">
        <header class="app-header navbar " style="height:auto">
        <!--  <div class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto"> -->
                <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
                <span class="navbar-toggler-icon"></span>
                </button>
                <!-- </div> -->
                <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Escritorio</a>
                </li>
                
                <li class="nav-item px-3">
                    <!--                 <a class="nav-link" href="{{ route('logout') }}">Desconectar</a>-->
    
                        <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Salir') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                        </form>
                </li>
            </ul>
            
        
        
        </header>

        <div class="app-body">
            
            @if(Auth::check())
            @switch(Auth::user()->rol_id)
                @case(8)
                @include('plantilla.sidebarPanel')

                    @yield('contenidoPanel') 


                    @break
                @case(4)
                 
                    @yield('contenidoExterno') 

                    @break
                @case(6)
                    @include('plantilla.sidebarOperarioTaller')
                    @yield('contenidoTaller') 

                    @break
                @case(3)
                    @include('plantilla.sidebarOperario')
                    @yield('contenido') 

                    @break
                @case(2)
                    @include('plantilla.sidebarOperario')
                    @yield('contenido') 

                    @break
                @case(1)
                    @include('plantilla.sidebar')
                    @yield('contenido') 

                    @break

                @default
                @yield('contenido') 

                
                @endswitch
             @endif

            <!-- /Fin del contenido principal -->
        </div>   
    </div>
    <footer class="app-footer">
        <span><a href="http://www.codemountain.es/">Code Mountain</a> &copy; 2018-2024</span>
        <span class="ml-auto">Desarrollado por <a href="http://www.codemountain.es/">Code Mountain</a></span>
    </footer>
    

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>