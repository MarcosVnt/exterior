@extends('vallas/principal')

@section('contenido'    )
    <template >
        <main class="main">
      
        <div class="row justify-content-center">
    
                          <div class="container-fluid row justify-content-center">

                                         <vallas-mapa
                                        >
                                       

                                     </vallas-mapa>
                                   <!--    :vallas ="'{!! json_encode($vallas) !!}'">-->

                            </div>
                </div>
        </main>
    </template>

     

@endsection