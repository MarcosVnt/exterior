@extends('principal')
    @section('contenido')
        <template v-if="menu==0">
        <main class="main">




        <div class="container-fluid">
        <div class="card">
        <div class="card-header">
            <div>Doughnut Chart</div>
        </div>
        <div class="card-body"
        ><div class="chart-wrapper"
        ><div class="">
        <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div>
        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <img src="storage/obras/images/{{ Session::get('imageName') }}" />
        
        <!-- <canvas id="chart-doughnut-01" width="1044" height="1044" class="chartjs-render-monitor" style="display: block; height: 348px; width: 348px;"></canvas>
 -->        </div></div></div></div>

<!--             <h1>ROTULEON - SUBIR IMAGENES OBRA</h1>
 -->            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

           <!--  @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                 </div>
            @else
            @endif -->
                                @if (count($errors) > 0)

                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Hay problemas en el Formulario<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
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
                    <img src="storage/obras/images/{{ Session::get('imageName') }}" />
                </div>
                <!-- <div class="col-md-4">
                    <strong>Thumbnail Image:</strong>
                    <br/>
                    <img src="storage/obras/thumbnail/{{ Session::get('imageName') }}" />
                </div> -->
            </div>
            @endif  
             
    <!--     @if(Auth::check())
          {{ 'hola : ' .Auth::user()->name}}
          

          @else
        {{'hola dos '}}
        @endif -->
            <div class="form-group">
                <strong>Bienvenido: <h3> {{$user_nombre}}</h3></strong>
            </div>
                    
            <form action="{{ url('altafoto') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                <div class="form-group">
            <strong>Obra a la que pertenece la foto:</strong>

            <select class="form-control" name="selectobrassss" id="selectobra">
                @foreach($data as $item)
                <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                @endforeach
            </select>
            </div>
            
                <div class="col-md-4">
                        <br/>
                        <input type="text" name="title" id="image" placeholder="Nombre Foto">: Nombre foto</label>
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <input type="file" name="image" id="image"  />

<!--                         <input type="file" name="image" id="image" multiple />
 -->                    </div>
                    {{ csrf_field() }}

                    <div class="col-md-12">
                        <br/>
                        <button type="submit" class="btn btn-success">Subir Image</button>
                    </div>
                </div>
                </form>
            </div>           
    
        </main>
        </template>

        <template v-if="menu==1">
            <compras></compras>
        </template>

       {{--  <template v-if="menu==2">
            <xml></xml>
        </template>
 --}}
        <template v-if="menu==3">
            <xmlcomprasvnt></comprasvntxml>
        </template>
        <template v-if="menu==4">
            <fotosObras></fotosObras>
        </template>

         <template v-if="menu==7">
<!--                 <user :ruta="ruta"></user> -->
<user></user>
  </template>

            <template v-if="menu==8">
               <!--  <rol :ruta="ruta"></rol> -->
               <rol></rol>
            </template>

    @endsection