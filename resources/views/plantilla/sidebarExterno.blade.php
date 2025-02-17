<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Exterior Play
                    </li>
                    
                    <li @click="menu=3000" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Vallas Exterior</a>
                            </li>
                    
                   
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
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