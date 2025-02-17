    @extends('principal')




    @section('contenidoPanel')
        <main class="main">
        <div class="row justify-content-center">
    
        <div class="container-fluid row justify-content-center">

            <presupuestos-estado></presupuestos-estado>
        </div>

        </div>
        </main>





    @endsection

    @section('contenidoExterno')
    
           <vallas-mapa></vallas-mapa>
    




    @endsection



    @section('contenidoTaller')
        <main class="main">
        <div class="row justify-content-center">
    
        <div class="container-fluid row justify-content-center">

        <obraManoTaller></obraManoTaller>
        </div>

        </div>
        </main>





    @endsection



    @section('contenido')
        <template v-if="menu==0">
            <main class="main">
                    <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card-group mb-0">
                                    <div class="card p-4">
                                    <img src="img/LOGO_EXTERIOR_PLAY.PNG" class="img-fluid" alt="Responsive image">
                                    </div>
                                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                                        <div class="card-body text-center">
                                        <div>
                                            <h2>Exterior Play</h2>
                                            <p>Gestor de Compras </p>
                                            <a href="https://www.gruporotuleon.com/" target="_blank" class="btn btn-primary active mt-3">Rotuleon</a>
                                        </div>
                                        
                                        
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="container-fluid row justify-content-center">

                                        <ObraDia></ObraDia>

                                                            <!-- 
                                                            @if(Auth::check())


                                                                @if(Auth::user()->rol_id === 6)
                                                                    <obraManoTaller></obraManoTaller>
                                                                @else
                                                                    @if(Auth::user()->id === 6)
                                                                    @else

                                                                        <ObraDia></ObraDia>
                                                                        @endif
                                                                @endif
                                                            @endif -->
                                </div>
                    </div>
            </main>
        </template>

         @if(Auth::user()->id === 1) 
       
        @endif

        <template v-if="menu==100">
            <presupuestos></presupuestos>
        </template>
        
        <template v-if="menu==101">
            <presupuestos-aceptados></presupuestos-aceptados>
        </template>


        <template v-if="menu==102">
            <presupuestos-estado></presupuestos-estado>
        </template>

        <template v-if="menu==1">
            <compras></compras>
        </template>



<!--        <template v-if="menu==2">
            <xml></xml>
        </template>
 -->
        <template v-if="menu==3">
            <xmlcomprasvnt></comprasvntxml>
        </template>
        
        <template v-if="menu==300">
            <productotarifa></productotarifa>
        </template>



        <template v-if="menu==4">
<!--             <fotosObras></fotosObras>
 -->
         <foto-global></foto-global>

        </template>
        <template v-if="menu==40">
<!--             <fotosObras></fotosObras>
 -->
         <foto-global-externo></foto-global-externo>

        </template>

         <template v-if="menu==7">
<!--                 <user :ruta="ruta"></user> -->
            <user></user>
        </template>

            <template v-if="menu==8">
               <!--  <rol :ruta="ruta"></rol> -->
               <rol></rol>
            </template>
        
        <template v-if="menu==9">
            <obraMano></obraMano>
        </template>

        <template v-if="menu==11">
            <obraUsuario></obraUsuario>
        </template>


         <template v-if="menu==20">
            <obraManoTaller></obraManoTaller>
        </template>
        <template v-if="menu==21">
            <!-- <obraResumen></obraResumen> -->
            <ObraDia></ObraDia>
        </template>
        <template v-if="menu==22">
            <!-- <obraResumen></obraResumen> -->
            <diahorasusuario></diahorasusuario>
        </template>
        <template v-if="menu==23">
            <!-- <obraResumen></obraResumen> -->
            <teclado-numerico></teclado-numerico>
        </template>


        <template v-if="menu==2200">
            <!-- <obraResumen></obraResumen> -->
            <terrenos-admin></terrenos-admin>
        </template>

        <template v-if="menu==2201">
            <!-- <obraResumen></obraResumen> -->
            <vallas-admin></vallas-admin>
        </template>

        <template v-if="menu==2202">
            <!-- <obraResumen></obraResumen> -->
            <contratos-admin></contratos-admin>
        </template>

        <template v-if="menu==2203">
            <!-- <obraResumen></obraResumen> -->
           <vallas-mapa></vallas-mapa>
        </template>

    @endsection