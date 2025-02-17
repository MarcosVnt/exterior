<template>
<!--Inicio del modal agregar/actualizar-->
   


    <div id="pro-wizard">
        <step-navigation
            :steps="steps"
            :currentstep="currentstep">
        </step-navigation>

        <div v-if="currentstep == 1">
            <div class="form-group row"> <h2>Cliente</h2>
              <div class="col-md-6">
                <div class="input-group">
                 
                  <input
                    type="text"
                    v-model="clienteBuscar"
                    @keyup.enter="listarClientes(1, clienteBuscar)"
                    class="form-control"
                    placeholder="Texto a buscar"

                  />
                  <button
                    type="submit"
                    @click="listarClientes(1, clienteBuscar)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>



               <div class="card-body" v-if="mostrarCliente === 1 ">
                        
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Referencia</th>
                                    <th>Descripcion</th>
                                    <th>Direccion</th>
                                    <th>Poblacion</th>
                                    <th>Postal</th>
                                    <th>Provincia</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayClientes" :key="cliente.id">
                                     
                                     <td><button
                                        type="button"
                                        @click="seleccionarCliente(cliente)"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="icon-eye"></i>
                                    </button>
                                    </td>
                                    <td v-text="cliente.dni"></td>
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.direccion"></td>
                                    <td v-text="cliente.poblacion"></td>
                                    <td v-text="cliente.postal"></td>
                                    <td v-text="cliente.provincia"></td>
                                    <td v-text="cliente.telefono"></td>
                                    <td v-text="cliente.email"></td>
                                   
                                  <!--   
                                    <td>
                                        <div v-if="cliente.baja">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Baja</span>
                                        </div>
                                        
                                    </td> -->
                                </tr>                                
                            </tbody>
                        </table>
                      
              </div>
            
            <div class="card-body">
                   
              
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Dni </label>
                        <div class="col-md-3">
                        <input
                            type="text"
                            v-model="cliente.dni"
                            class="form-control"
                            placeholder="Dni"
                            readonly="editoCliente"
                        

                        />
                            <!-- :readonly="cliente.id >= 1"-->
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="nombreTerreno-input">Nombre Cliente </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="cliente.nombre"
                                class="form-control"
                                placeholder="Nombre cliente"
                                 readonly="editoCliente"

                            />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="direccion-input">Dirección</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                v-model="cliente.direccion"
                                class="form-control"
                                 readonly="editoCliente"
                                placeholder="Direccion "

                            />
                        </div>
               
                    <label class="col-md-2 form-control-label" for="codigo-input">Código Postal</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="cliente.postal"
                            class="form-control"
                            placeholder="Codigo Postal"
                                 readonly="editoCliente"

                        />
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="poblacioncliente-input">Poblacion</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="cliente.poblacion"
                            class="form-control"
                            placeholder="Poblacion"
                                 readonly="editoCliente"

                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provinciaTerreno-input">Provincia</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="cliente.provincia"
                            class="form-control"
                            placeholder="Provincia"
                                 readonly="editoCliente"

                        />
                    </div>
                </div>
                  <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="telefono-input">Telefono</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="cliente.telefono"
                            class="form-control"
                            placeholder="Telefono"
                                 readonly="editoCliente"

                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="email-input">email</label>
                    <div class="col-md-6">
                        <input
                            type="email"
                            v-model="cliente.email"
                            class="form-control"
                            placeholder="Email"
                                 readonly="editoCliente"

                        />
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" rows="3" v-model="cliente.observaciones"
                                 readonly="editoCliente"

                    ></textarea>
                </div>
            </div>
        </div>

       
        <div v-if="currentstep == 2">
           
            <div class="form-group row"> <h2>Anunciante</h2>
              <div class="col-md-12">
                <div class="input-group">
                 
                  <input
                    type="text"
                    v-model="textoBuscar"
                    @keyup.enter="listarAgencias(1, textoBuscar)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarAgencias(1, textoBuscar)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                   <button
                    type="submit"
                    @click="traerDatosDelCliente(cliente)"
                    class="btn btn-primary btn-sm ml-3 pull-right"
                  >
                    <i class="fa fa-search"></i> Traer Datos de Cliente
                  </button>
                   <button
                    type="submit"
                    @click="nuevoAnunciante()"
                    class="btn btn-primary btn-sm ml-3 pull-right"
                  >
                    <i class="fa fa-search"></i> Nuevo Anunciante
                  </button>
                </div>
              </div>
            </div>

              <div class="card-body" v-if="mostrarAgencia === 1 ">
                        
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Dni</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Poblacion</th>
                                    <th>Postal</th>
                                    <th>Provincia</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="agencia in arrayAgencias" :key="agencia.id">
                                     
                                     <td><button
                                        type="button"
                                        @click="seleccionarAgencia(agencia)"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="icon-eye"></i>
                                    </button>
                                    </td>
                                    <td v-text="agencia.dni"></td>
                                    <td v-text="agencia.nombre"></td>
                                    <td v-text="agencia.direccion"></td>
                                    <td v-text="agencia.poblacion"></td>
                                    <td v-text="agencia.postal"></td>
                                    <td v-text="agencia.provincia"></td>
                                    <td v-text="agencia.telefono"></td>
                                    <td v-text="agencia.email"></td>
                                   
                                    
                                    <td>
                                        <div v-if="agencia.baja">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Baja</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,textoBuscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,textoBuscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,textoBuscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
              </div>
            
            
            
            <div class="card-body">
                   
              
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="dni-input">DNI </label>
                        <div class="col-md-3">
                        <input
                            type="text"
                            v-model="agencia.dni"
                            class="form-control"
                            placeholder="DNI Anunciante"
                                 :readonly="!editoAgencia"
                           
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="nombreAgencia-input">Nombre </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="agencia.nombre"
                                class="form-control"
                                placeholder="Nombre Anunciante"
                                 :readonly="!editoAgencia"
                               

                            />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="password-input">Dirección</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                v-model="agencia.direccion"
                                class="form-control"
                                placeholder="Direccion "
                                 :readonly="!editoAgencia"
                               

                            />
                        </div>
               
                    <label class="col-md-2 form-control-label" for="codigo-input">Código Postal</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="agencia.postal"
                            class="form-control"
                            placeholder="Codigo Postal"
                                 :readonly="!editoAgencia"
                           

                        />
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="poblacion-input">Poblacion</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="agencia.poblacion"
                            class="form-control"
                            placeholder=" Poblacion"
                                 :readonly="!editoAgencia"
                           

                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provincia-input">Provincia</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="agencia.provincia"
                            class="form-control"
                            placeholder="Provincia"
                                 :readonly="!editoAgencia"
                           

                        />
                    </div>
                </div>
                  <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="telefono-input">Telefono</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="agencia.telefono"
                            class="form-control"
                            placeholder=" Telefono"
                                 :readonly="!editoAgencia"
                           

                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="email-input">email</label>
                    <div class="col-md-6">
                        <input
                            type="email"
                            v-model="agencia.email"
                            class="form-control"
                            placeholder="Email"
                                 :readonly="!editoAgencia"
                            

                        />
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="observaciones">Observaciones</label>
                    <textarea 
                        :readonly="!editoAgencia"
                        class="form-control" id="observaciones" rows="3" v-model="agencia.observaciones"
                   ></textarea>
                </div>
                 
                </div>

        </div>

        
     
        <div v-if="currentstep == 3">
           <div class="form-group row"> <h2>Valla</h2>
              <div class="col-md-6">
                <div class="input-group">
                 
                  <input
                    type="text"
                    v-model="vallaBuscar"
                    @keyup.enter="listarVallas(1, vallaBuscar)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarVallas(1, vallaBuscar)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>

             <div class="card-body" v-if="mostrarValla === 1 ">
                        
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Referencia</th>
                                    <th>Descripcion</th>
                                    <th>Direccion</th>
                                    <th>Poblacion</th>
                                    <th>Postal</th>
                                    <th>Provincia</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="valla in arrayVallas" :key="valla.id">
                                     
                                     <td><button
                                        type="button"
                                        @click="seleccionarValla(valla)"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="icon-eye"></i>
                                    </button>
                                    </td>
                                    <td v-text="valla.dni"></td>
                                    <td v-text="valla.nombre"></td>
                                    <td v-text="valla.direccion"></td>
                                    <td v-text="valla.poblacion"></td>
                                    <td v-text="valla.postal"></td>
                                    <td v-text="valla.provincia"></td>
                                    <td v-text="valla.telefono"></td>
                                    <td v-text="valla.email"></td>
                                   

                                       <div v-if="valla.estado === 'Libre'">
                                              <span class="badge badge-success">Libre</span>
                                          </div>
                                          <div v-else-if="valla.estado ==='Reservada'">
                                              <span class="badge badge-warning">Reservada</span>
                                          </div>
                                            <div v-else-if="valla.estado ==='Baja'">
                                              <span class="badge badge-dark">Baja</span>
                                          </div>
                                            <div v-else>
                                              <span class="badge badge-danger">Ocupada</span>
                                          </div>

                                   
                                  <!--   
                                    <td>
                                        <div v-if="valla.baja">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Baja</span>
                                        </div>
                                        
                                    </td> -->
                                </tr>                                
                            </tbody>
                        </table>
                      
              </div>



           <div class="card-body">
                   
              
                <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Referencia  </label>
                        <div class="col-md-3">
                        <input
                            type="text"
                            v-model="valla.dni"
                            class="form-control"
                            placeholder="referencia"
                            readonly
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="nombreValla-input">Descripción </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="valla.nombre"
                                class="form-control"
                                placeholder="Descripcion"
                                readonly
                            />
                        </div>
                </div>

                <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="password-input">Dirección</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                v-model="valla.direccion"
                                class="form-control"
                                placeholder="Direccion Valla"
                                readonly
                            />
                        </div>
               
                    <label class="col-md-2 form-control-label" for="codigo-input">Código Postal</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="valla.postal"
                            class="form-control"
                            placeholder="Codigo Postal"
                            readonly
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="poblacion-input">Poblacion</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.poblacion"
                            class="form-control"
                            placeholder="Direccion Poblacion"
                            readonly
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provincia-input">Provincia</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.provincia"
                            class="form-control"
                            placeholder="Provincia"
                            readonly
                        />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="telefono-input">Telefono</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="valla.telefono"
                            class="form-control"
                            placeholder="Direccion Telefono"
                            readonly
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="email-input">email</label>
                    <div class="col-md-6">
                        <input
                            type="email"
                            v-model="valla.email"
                            class="form-control"
                            placeholder="Email"
                            readonly
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="ancho-input">Ancho</label>
                    <div class="col-md-2">
                        <input
                            type="number"
                            v-model="valla.ancho"
                           
                            class="form-control"
                            placeholder="Ancho"
                            readonly
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="Alto-input">Alto</label>
                    <div class="col-md-2">
                        <input
                            type="number"
                            v-model="valla.alto"
                            class="form-control"
                            placeholder="alto"
                            readonly
                        />
                    </div>
                     <label class="col-md-2 form-control-label" for="m2-input">M2</label>
                    <div class="col-md-2">
                        <input
                            type="number"
                            v-model="valla.m2"
                            class="form-control"
                            placeholder="m2"
                            readonly
                        />
                    </div>
                </div>


            </div>
        </div>


        <div v-if="currentstep == 4">
            <h2>Contrato</h2>
            <div class="card-body">

                <div class="form-group row">
                  
               
                    <label class="col-md-2 form-control-label" for="cliente-input">Cliente</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="cliente.nombre"
                            class="form-control"
                            placeholder="Cliente Nombre"
                            readonly
                        />
                    </div>

                      <label class="col-md-2 form-control-label" for="Agencia-input">Anunciante</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="agencia.nombre"
                            class="form-control"
                            placeholder="Anunciante Nombre"
                            readonly
                        />
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="Terreno-input">Terreno</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.nombreTerreno"
                            class="form-control"
                            placeholder="Terreno Nombre"
                            readonly
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provincia-input">Valla</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.nombreValla"
                            class="form-control"
                            placeholder="Valla Nombre"
                            readonly
                        />
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Ejercicio </label>
                        <div class="col-md-3">
                        <input
                            type="number"
                            v-model="contrato.ejercicio"
                            class="form-control"
                            placeholder="Ejercicio"
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="descripcion-input">Numero </label>
                        <div class="col-md-5">
                            <input
                                type="number"
                                v-model="contrato.numero"
                                class="form-control"
                                placeholder="Numero"
                            />
                        </div>
                    </div>
              

                 <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Referencia </label>
                        <div class="col-md-3">
                        <input
                            type="text"
                            v-model="contrato.referencia"
                            class="form-control"
                            placeholder="referencia"
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="descripcion-input">Descripcion </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="contrato.descripcion"
                                class="form-control"
                                placeholder="Descripcion"
                            />
                        </div>
                    </div>
              
              
                    <div class="form-group row">
                        <label class="col-md-1 form-control-label" for="direccion-input">Fecha Incio</label>
                        <div class="col-md-3">
                            <input
                                type="date"
                                v-model="fechaII"
                                class="form-control"
                                placeholder="fecha inicio "
                            />
                        </div>
               
                    <label class="col-md-1 form-control-label" for="codigo-input">Fecha Final</label>
                    <div class="col-md-3">
                        <input
                            type="date"
                            v-model="contrato.fechaFF"
                            class="form-control"
                            placeholder="Fecha Final"
                        />
                    </div>
                    <label class="col-md-1 form-control-label" for="codigo-input">Duracion</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            v-model="contrato.duracion"
                            class="form-control"
                            placeholder="Duracion"
                        />
                    </div>
                </div>

                  <div class="form-group row">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" rows="3" v-model="contrato.observaciones"></textarea>
                </div>
  

            <div class="form-group row">
              <label class="col-md-1 form-control-label" for="direccion-input">Forma de Pago</label>
                    
                           <select 
                             @change="calcularAlquiler($event)"

                           class="form-control col-md-3" 
                           id="forma_pago" v-model="contrato.forma_pago">
                   
                            <option value="12">Mensual</option>
                            <option value="4">Trimestral</option>
                            <option value="2">Semestral</option>
                            <option value="1">Anual</option>
                            <option value="1">Otras</option>
                        
                        
                            </select>
                        
                        <label class="col-md-1 form-control-label" for="direccion-input">Importe Periodo</label>
                        <div class="col-md-3">
                            <input
                                type="number"
                                v-model="contrato.importe_periodo"
                                class="form-control"
                                placeholder="Importe Periodo "
                                @change="calcularAlquiler($event)"

                            />
                        </div>
               
                    <label class="col-md-1 form-control-label" for="codigo-input">Alquiler Anual</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            v-model="contrato.alquiler_anual"
                            class="form-control"
                            placeholder="Alquiler Anual"
                        />
                    </div>
            </div>







            </div>
        </div>

        <div v-if="currentstep == 'enviar'">
            <div class="form-group row"> <h2>Contrato realizado correctamente</h2>
             
            </div>
             <div v-if="errores" class="alert alert-danger" role="alert">
                    {{errores}} 

            </div>

           <div v-else class="card-body alert alert-successs" role="alert">
                   
              
           
                 <div class="form-group row">   
                     <label class="col-md-2 form-control-label" for="nombreValla-input">Cliente </label>
                        <div class="col-md-4">
                            <h4> {{cliente.nombre}}</h4>
                           
                        </div>
                        <label class="col-md-2 form-control-label" for="nombreValla-input">Contrato </label>
                        <div class="col-md-4">
                            <h4>Numero : {{contrato.numero}}</h4>
                            <h4>Fecha Inicio : {{contrato.fecha_inicio}}</h4>
                            <h4>Fecha Final : {{contrato.fecha_final}}</h4>
                            
                        </div>
                         <label class="col-md-2 form-control-label" for="nombsreValla-input">Valla </label>
                        <div class="col-md-4">
                            <h4>Referencia  : {{valla.dni}}</h4>
                            <h4>Direccion  : {{valla.direccion}}</h4>
                            
                        </div>

                  <!--       {{agencia}} <br>
                        {{cliente}} <br>
                        {{valla}} <br>
                        {{contrato}} <br> -->

                        Pulse en Listar Contratos  para ver lista de Contratos
                </div>

               <!--  {{propietario}} <br> {{terreno}} <br> {{valla}} <br> {{vallaEnviada}} -->

            </div>
        </div>
        <step-controls
            v-for="step in steps"
            :key="step.id"
            :step="step"
            :stepcount="steps.length"
            :currentstep="currentstep"
            @step-change="stepChanged">
        </step-controls> 
        
    </div>




</template>

<script>
import StepControls from '../vallas/StepControls.vue';
import moment from "moment";

export default {
     components: { StepControls },
     props: {
             modal : Number,
             contratoE: Object,
          
        },
    data(){
        return {
            
                    editoCliente: false,
            editoAgencia: false,

            contratoEnviada : [],

            center: {lat: 5, lng: -5 },
            longitud: 0,

            latitud: 0,

            infoWindowOptions:{
                pixelOffset:{
                    width:0,
                    height: -55
                }
            },
            infoWindowOpened: false,

            tieneTerrenos : false, 
            activeValla : {},
            valla:{
                id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    longitud : '',
                    latitud : '',
                    ancho : 1,
                    alto : 1,
                    m2 : 1,
                    tipo : 'Valla',
                    elemento : 'Vinilo',
                    estado : 'Libre'

            },
           
            m2 : 0 , 
            agencia: {
                    id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
            },
            cliente: {
                id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
            },
            contrato: {
                id: 0,
                ejercicio : (new Date()).getFullYear(),
                numero: 0,
                agencia_id: 0,
                cliente_id: 0,
                valla_id : 0,
                referencia : '',
                descripcion: '',
                observaciones : '',
                fecha_inicio: '',
                fecha_final: '',
                duracion: '',
                forma_pago: '1',
                importe_periodo: 0,
                alquiler_anual:0,
                baja: 1,

            },
            mostrarBuscar: 0,
            mostrarAgencia: 0,
            mostrarCliente: 0,
            mostrarValla: 0,

            textoBuscar: '',
            agenciaBuscar: '',
            clienteBuscar: '',
            vallaBuscar: '',

            arrayAgencias:[],
            arrayClientes:[],
            arrayVallas: [],
            pagination:'',
            pagesNumber: '',

            currentstep : 1,
            indicatorclass: true,
            step: 1,
            active: 1,
            firststep: true,
            nextStep:"",
            lastStep: "",
            laststep: false,
            errores: "",
            steps: [
                {
                    id: 1,
                    title: 'Datos Cliente',
                    icon_class: "fa fa-user-o"
                }, {
                    id: 2,
                    title: 'Datos Anunciante',
                    icon_class: "fa fa-folder-open"
                }, {
                    id: 3,
                    title: 'Datos Valla',
                    icon_class: "fa fa-paper-plane"
                }
                , {
                    id: 4,
                    title: 'Contrato',
                    icon_class: "fa fa-map-marker"
                }
            ]



        }
    },
   mounted() {
             let me = this;
             console.log('mounted, Inicio',this.contratoE);
             me.cargarDatosContrato(me.contratoE);
             
        
     },

     methods: {


        nuevoAnunciante(){
            console.log('nuevoAnunciante',this.editoAgencia);
               
                    this.agencia.id = 0;
                    this.agencia.dni ="";
                    this.agencia.nombre ="";
                    this.agencia.direccion ="";
                    this.agencia.poblacion ="";
                    this.agencia.postal ="";
                    this.agencia.provincia =  "",
                    this.agencia.telefono ="";
                    this.agencia.email ="";
                    this.agencia.observaciones="";
                    this.editoAgencia= true;
            console.log('nuevoAnunciante2 ',this.editoAgencia);

            },

    

        traerDatosDelCliente(cliente){

            this.agencia['id']=0 ; 


            this.agencia['dni']=this.cliente['dni'] ; 

            this.agencia['nombre']=this.cliente['nombre'] ; 
            this.agencia['descripcion']=this.cliente['descripcion'];
            this.agencia['direccion']=this.cliente['direccion'];
            this.agencia['postal']=this.cliente['postal'];
            this.agencia['poblacion']=this.cliente['poblacion'];
            this.agencia['provincia']=this.cliente['provincia'];
            
            this.agencia['telefono']=this.cliente['telefono'];
            this.agencia['email']=this.cliente['email'];
           
            this.agencia.observaciones = "";


            },

          calcularAlquiler(e){
                console.log('2102',e,
                this.contrato,this.contrato.alquiler_anual
                );
                this.contrato.alquiler_anual =this.contrato.importe_periodo * this.contrato.forma_pago


            },

         cargarDatosContrato(v){
             console.log('cargarDatos',v);
                  let me = this;
       
                var url =
                "/api/contrato/datos/"+v.id;

                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.contrato = response.data.contrato;
                    me.valla = me.contrato.valla;
                    me.agencia = me.contrato.agencia;
                    me.cliente = me.contrato.cliente;
                    me.terreno = me.valla.terreno;
                  
                     let fechaI =  me.contrato['fecha_inicio'];
                    me.fechaII = moment(fechaI).format('YYYY-MM-DD');

                    let fechaF =  me.contrato['fecha_final'];
                    me.fechaFF = moment(fechaF).format('YYYY-MM-DD');

               

                     console.log('datos contrato',
                     response.data,
                     '------',
                    me.fechaII,me.fechaFF,
                     me.contrato,me.valla,me.agencia,me.cliente,me.terreno);
                    
                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
            });

         },
      
         setCenter(la,lo){
             console.log('setCenter',la,lo);
            this.center = {lat: la, lng: lo }
         },
         
        stepChanged: function(step) {
            console.log('stepChanged',step,this.agencia.nombre);
             
       
              if(step === 2 && (!this.cliente.nombre)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Cliente Nombre  obligatorio ",
            });
            return;

            }
         
            if(step === 4 && (!this.valla.nombre)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Referencia Valla y Descripcion obligatorios ",
            });
            return;

            }

            if(step === 'enviar' && (!this.contrato.fecha_inicio || !this.contrato.fecha_final)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Fecha Inicio y Fecha final Obligatorias  ",
            });
            return;

            }
            
            if(step === 'enviar' ){
                          //  this.geocoderAddres(this.valla.direccion);

                
             this.guardarFormulario();
            }

        
            this.currentstep = step;
        },
      
        seleccionarAgencia(agencia){
            console.log('seleccionarAgencia',agencia)
            this.agencia = agencia;
            this.mostrarAgencia=0;
            console.log('seleccionarAgencia',this.agencia,this.agencia.nombre)
          

        },
        seleccionarCliente(cliente){
            console.log('seleccionarTerreno',cliente)
            this.cliente = cliente;
            this.mostrarCliente=0;
                        console.log('seleccionarTerreno',this.cliente,this.cliente.nombre)
         

        },
        seleccionarValla(valla){
            console.log('seleccionarValla',valla)

             if (valla.estado === 'Ocupada') {
                       
                        swal({
                        type: "error",
                        title: "Error...",
                        text:
                            "Valla ocupada , desocupela primero.. ",
                        });
                        return;
            }

            this.valla = valla;
            this.mostrarValla = 0 ; 
                        console.log('seleccionarValla',this.valla,this.valla.nombre)
         

        },
       

         guardarFormulario(){
            console.log('guardarFormulario',);
             let me = this;
             
             
             me.contrato.fecha_inicio = me.fechaII;
             me.contrato.fecha_final = me.fechaFF;


             me.contrato.agencia_id = me.agencia.id;
             me.contrato.cliente_id = me.cliente.id;
             me.contrato.valla_id = me.valla.id;

            // me.contrato.ejercicio = (new Date()).getFullYear();
             //me.contrato.numero =0;

                    console.log(this.contrato,this.agencia,this.cliente);


           // if (me.terrenos= true){return};
            axios
                .post("/contrato/update", {
                data: {
                    contrato: this.contrato,
                    agencia: this.agencia,
                    cliente: this.cliente,
                    

                  
                },
                })
                .then(function (response) {
                    console.log(response.data);
              //  console.log("guardarFormulario", response, response.data, response.data['contrato']);
                           // me.$emit('modalR', 0)
                //me.contrato = response.data['contrato'];
                //me.vallaEnviada = response.data;
                console.log("guardarFormulario", me.contrato, response.data);


                })

                .catch((err) => {
                    console.log('guardarFormulario',err);
                    me.errores = err;
                    me.currentstep = 4;
                     if (err.response.status === 401 || err.response.status === 419) {
                            window.location = "/login";
                        }
                });


           
           
            
        },
        
        listarAgencias(page, textoBuscar) {
            let me = this;
            me.mostrarAgencia = 1;
            var url =
                "/api/agencias?page=" +
                page +
                "&buscar=" +
                textoBuscar;        
                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.arrayAgencias = respuesta.agencias.data;
                    me.pagination = respuesta.pagination;
                    
                    if (respuesta.agencias.data.length <= 0) {
                        me.mostrarAgencias = 0 ;
                        swal({
                        type: "error",
                        title: "Error...",
                        text:
                            "No hay registros que cumplan, las condiciones establecidas ",
                        });
                    }
                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
            });
        },
          listarClientes(page, textoBuscar) {
            let me = this;
            me.mostrarCliente = 1;
            var url =
                "/api/clientes?page=" +
                page +
                "&buscar=" +
                textoBuscar;        
                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.arrayClientes = respuesta.clientes.data;
                    me.pagination = respuesta.pagination;
                    
                    if (respuesta.clientes.data.length <= 0) {
                        me.mostrarClientes = 0 ;
                        swal({
                        type: "error",
                        title: "Error...",
                        text:
                            "No hay registros que cumplan, las condiciones establecidas ",
                        });
                    }
                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
            });
        },

        listarVallas(page, textoBuscar) {
            let me = this;
            me.mostrarValla = 1;
            var url =
                "/api/vallas?page=" +
                page +
                "&buscar=" +
                textoBuscar
                "&Estado=" +
                'Libres';        
                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.arrayVallas = respuesta.vallas.data;
                    me.pagination = respuesta.pagination;
                    
                    if (respuesta.vallas.data.length <= 0) {
                        me.mostrarVallas = 0 ;
                        swal({
                        type: "error",
                        title: "Error...",
                        text:
                            "No hay registros que cumplan, las condiciones establecidas ",
                        });
                    }
                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
            });
        },
        
        handleMapClick(e){
            console.log('handleMapClick',e, this.valla);
            this.valla.push({
                nombre:"valla nueva",
                dni: "rererencia",
                latitud: e.latLng.lat(),
                longitud: e. latLng.lng()
            });
        },

        getPosition(r){
                   this.valla.latitud = r.latitud;
                   this.valla.longitud = r.longitud;
                   this.longitud = r.longitud;
                   this.latitud = r.latitud;

                               console.log('getPosition', parseFloat(r.latitud),this.valla.latitud, parseFloat(r.longitud), this.valla.longitud);

            return {

                lat : parseFloat(r.latitud),
                lng : parseFloat(r.longitud)
            }
        },
        handleMarkerClicked(r){
            console.log('handleMarkerClicked',r);

            this.activeValla = r ; 
            this.infoWindowOpened = true;

        },
        handleInfoWindowClose(){
                        console.log('handleInfoWindowClose');

            this.activeValla = {};
            this.infoWindowOpened = false;
        },


     },
    computed: {
       
      

        
    }

    
  };

</script>
<style>

body {
	 padding: 0;
	 margin: 0;
	 background-color: #f6f6f6;
	 font-family: 'Roboto', sans-serif;
}
 .container {
	 width: 1000px;
	 background-color: #fff;
}
 .step-wrapper {
	 padding: 20px 0;
	 display: none;
}
 .step-wrapper.active {
	 display: block;
}
 .step-indicator {
	 border-collapse: separate;
	 display: table;
	 margin-left: 0px;
	 position: relative;
	 table-layout: fixed;
	 text-align: center;
	 vertical-align: middle;
	 padding-left: 0;
	 padding-top: 20px;
}
 .step-indicator li {
	 display: table-cell;
	 position: relative;
	 float: none;
	 padding: 0;
	 width: 1%;
}
 .step-indicator li:after {
	 background-color: #ccc;
	 content: "";
	 display: block;
	 height: 1px;
	 position: absolute;
	 width: 100%;
	 top: 32px;
}
 .step-indicator li:after {
	 left: 50%;
}
 .step-indicator li:last-child:after {
	 display: none;
}
 .step-indicator li.active .step {
	 border-color: #4183d7;
	 color: #4183d7;
}
 .step-indicator li.active .caption {
	 color: #4183d7;
}
 .step-indicator li.complete:after {
	 background-color: #87d37c;
}
 .step-indicator li.complete .step {
	 border-color: #87d37c;
	 color: #87d37c;
}
 .step-indicator li.complete .caption {
	 color: #87d37c;
}
 .step-indicator .step {
	 background-color: #fff;
	 border-radius: 50%;
	 border: 1px solid #ccc;
	 color: #ccc;
	 font-size: 24px;
	 height: 64px;
	 line-height: 64px;
	 margin: 0 auto;
	 position: relative;
	 width: 64px;
	 z-index: 1;
}
 .step-indicator .step:hover {
	 cursor: pointer;
}
 .step-indicator .caption {
	 color: #ccc;
	 padding: 11px 16px;
}
</style>