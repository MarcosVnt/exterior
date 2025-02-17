@extends('principal')
    @section('contenido')
        <template v-if="menu==0">
        <main class="main">




        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>Fotos de Obras </div>
                    <h1>ROTULEON - SUBIR IMAGENES OBRA</h1>
                </div>


                 @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <strong>Whoops!</strong> Hay algun error al procesar la foto.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <!-- <canvas id="chart-doughnut-01" width="1044" height="1044" class="chartjs-render-monitor" style="display: block; height: 348px; width: 348px;"></canvas>
-->
              <!--   <div class="card-body">
                    <div class="chart-wrapper">
                    <img src="storage/obras/images/{{ Session::get('imageName') }}" class="img-fluid"/>
                 </div>
                </div> -->

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                        <strong>{{ Session::get('imageName') }}</strong>

                    <!-- </div>
                    <div class="row"> -->
                        <div class="col-md-4">
                            <strong>Original Image:</strong>
                            <br/>
                            <img src="storage/obras/images/{{ Session::get('imageName') }}" class="img-fluid"/>
                        </div>
                        <!-- <div class="col-md-4">
                            <strong>Thumbnail Image:</strong>
                            <br/>
                            <img src="storage/obras/thumbnail/{{ Session::get('imageName') }}" />
                        </div> -->
                    </div>
                @endif 


          
            <div class="form-group">
<!--                 <strong>Bienvenido: {{$user_nombre}}</strong>
 -->            </div>         
                <form action="{{ url('altafoto') }}" method="post" enctype="multipart/form-data">
                
                        <div class="form-group">
                            <label for ="selectObra">Obra a la que pertenece la foto:</label>

                            <select class="form-control" name="selectObra" class="form-control" id="selectObra">
                            <option value="">Seleccione una Obra</option>
    
                            @foreach($data as $item)
                                <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" class="form-control" name="nombreObra" id="nombreObra" placeholder="Nombre Obra" value="{{$item->codigo}}"></input>

                        </div>
                
                        <div class="form-group">
                                <label for ="nombreFoto">Nombre Foto (opcional):</label>

                                <input type="text" class="form-control" name="nombreFoto" id="nombreFoto" placeholder="Nombre Foto"></input>
                        </div>
                        <div class="form-group">
                                <label for ="foto">Foto obra , Max : 4mb tamaño:</label>
                                <input type="file" class="form-control-file" id="file" name="file" />

        <!--                         <input type="file" name="image" id="image" multiple />
        -->            </div>
                        

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-success float-right">Subir Imagen Obra</button>
                        </div>
                        {{ csrf_field() }}
                </form>

            </div>

            </div> <!-- fin card -->
        </div>    
        </main>
        </template>

        <template v-if="menu==1">
            <compras></compras>
        </template>

     
        <template v-if="menu==3">
            <xmlcomprasvnt></comprasvntxml>
        </template>
        <template v-if="menu==4">
            <fotosObras></fotosObras>
        </template>

         <template v-if="menu==7">
            <user></user>
         </template>

            <template v-if="menu==8">
               <rol></rol>
            </template> 


    @endsection