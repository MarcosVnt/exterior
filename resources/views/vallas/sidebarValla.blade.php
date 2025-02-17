<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                         Vallas Disponibles
                    </li>
                    <ul class="list-group" >
                         @foreach($vallas as $valla) 
                            <li class="list-group-item list-group-item-action list-group-item-dark" >
                                {{$valla->nombre}}
                                <br>
                                {{$valla->direccion}}
                                <br>
                                {{$valla->postal}} -  {{$valla->poblacion}}
                                <br>
                                
                                <span class="badge badge-primary badge-pill">{{$valla->estado}}</span>

                            </li>  

                        @endforeach

            
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>