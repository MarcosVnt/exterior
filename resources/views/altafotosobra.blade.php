@extends('principal')
    @section('contenido')
        <template v-if="menu==0">
        <main class="main">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @if(session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div>
                                @else
                                <!-- echo 'no hay status';  -->
                                @endif
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
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Original Image:</strong>
                                    <br/>
                                    <img src="/images/{{ Session::get('imageName') }}" />
                                </div>
                                <div class="col-md-4">
                                    <strong>Thumbnail Image:</strong>
                                    <br/>
                                    <img src="/thumbnail/{{ Session::get('imageName') }}" />
                                </div>
                            </div>
                            @endif

                        <div class="container">
                        
                            <h3 class="jumbotron">ROTULEON   Imagenes Obras </h3>
                            <form action="{{ url('altafotosobra') }}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen a subir </label>
                                </div
                                <div class="form-group">
                                
                                    <input type="file" name="profile_image[]" id="exampleInputFile" multiple />
                                </div>
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default">Subir Fotos</button>
                            </form>
                        </div>
                    </div>
            </div>
    </div>
        </main>
        </template>


    @endsection