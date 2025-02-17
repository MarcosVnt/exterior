<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                    ExteriorPlay
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Gestor de Compras</a>
                      <!--   <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Pedidos</a>
                            </li>
                           
                        </ul> -->
                        <ul class="nav-dropdown-items">
                            <li @click="menu=100" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Presupuestos</a>
                            </li>
                           
                        </ul>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=101" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Presupuestos Aceptados</a>
                            </li>
                           
                        </ul>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=102" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Estado de Presupuestos</a>
                            </li>
                           
                        </ul>
                        <!-- <ul class="nav-dropdown-items">
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Xml</a>
                            </li>
                           
                        </ul>  -->
                      <!--   <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Compras VNT</a>
                            </li>
                           
                        </ul> -->
                        
                        <ul class="nav-dropdown-items">
                            <li @click="menu=300" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Productos Tarifa</a>
                            </li>
                           
                        </ul>
                        
                    </li>
                   <!--  <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Fotos</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Fotos Obras</a>
                            </li>
                           
                        </ul>
                    </li> -->
                    
                  
                 <!--    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Operarios</a>



                         <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>Parte horas </a>
                            </li>
                           
                        </ul>
                    </li> -->

                      <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>



                        <ul class="nav-dropdown-items">
                        <li   @click="menu=2200" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Terrenos</a>
                            </li>
                            <li   @click="menu=2201" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Vallas</a>
                            </li>
                            <li   @click="menu=2202" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Contratos Vallas</a>
                            </li>
                            <li   @click="menu=2203" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Vallas Exterior</a>
                            </li>

                            <li   @click="menu=10" class="nav-item">
                                <a class="nav-link" href="/nova" target="_blank"><i class="icon-user-following"></i> Administracion</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                            <li @click="menu=11" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Obra Usuario</a>
                            </li>
                            <li @click="menu=21" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Obra Resumen</a>
                            </li>
                            <li @click="menu=22" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Dia Horas x Usuario</a>
                            </li>
                            <li @click="menu=23" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Teclado </a>
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
                    <!--<li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Ingresos</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Proveedores</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Ventas</a>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Clientes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ingresos</a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                            </li>
                        </ul>
                    </li>
                -->
                   <!--  <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li> -->
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>