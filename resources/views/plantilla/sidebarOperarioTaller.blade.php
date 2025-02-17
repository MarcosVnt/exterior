<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                    Exterior Play
                    </li>
                  <!-- 
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Fotos</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Fotos Obras</a>
                            </li>
                           
                        </ul>
                    </li>
                     -->
                  
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Partes</a>



                         <ul class="nav-dropdown-items">
                            <li @click="menu=20" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Parte horas Taller </a>
                            </li>
                           
                        </ul>
                    </li>

                   
                    <!-- <li class="nav-item px-3">
                        <a class="nav-link" href="#"> {{auth()->user()->rol_id}} - {{auth()->user()->name}}</a>
                    </li> -->
                    <li class="nav-item nav-dropdown">
<!--                 <a class="nav-link" href="{{ route('logout') }}">Desconectar</a>
 -->            
                        <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Salir') }} {{auth()->user()->rol_id}} - {{auth()->user()->name}}
                        </a>
                   <!--  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                    </form> -->
                    </li>
              
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>