<template>
<!--Inicio del modal agregar/actualizar-->
   

    <div id="pro-wizard">
        <step-navigation
            :steps="steps"
            :currentstep="currentstep">
        </step-navigation>
       
        <div v-if="currentstep == 1">
           
            <div class="form-group row"> <h2>Propietario</h2>
              <div class="col-md-6">
                <div class="input-group">
                 
                  <input
                    type="text"
                    v-model="textoBuscar"
                    @keyup.enter="listarPropietarios(1, textoBuscar)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarPropietarios(1, textoBuscar)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>

              <div class="card-body" v-if="mostrarBuscar === 1 ">
                        
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
                                <tr v-for="propietario in arrayPropietarios" :key="propietario.id">
                                     
                                     <td><button
                                        type="button"
                                        @click="seleccionarPropietario(propietario)"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="icon-eye"></i>
                                    </button>
                                    </td>
                                    <td v-text="propietario.dni"></td>
                                    <td v-text="propietario.nombre"></td>
                                    <td v-text="propietario.direccion"></td>
                                    <td v-text="propietario.poblacion"></td>
                                    <td v-text="propietario.postal"></td>
                                    <td v-text="propietario.provincia"></td>
                                    <td v-text="propietario.telefono"></td>
                                    <td v-text="propietario.email"></td>
                                   
                                    
                                    <td>
                                        <div v-if="propietario.baja">
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
                            v-model="propietario.dni"
                            class="form-control"
                            placeholder="DNI Propietario"
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="nombrePropietario-input">Nombre </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="propietario.nombre"
                                class="form-control"
                                placeholder="Nombre Propietario"
                            />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="password-input">Dirección</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                v-model="propietario.direccion"
                                class="form-control"
                                placeholder="Direccion Valla"
                            />
                        </div>
               
                    <label class="col-md-2 form-control-label" for="codigo-input">Código Postal</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="propietario.postal"
                            class="form-control"
                            placeholder="Codigo Postal"
                        />
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="poblacion-input">Poblacion</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="propietario.poblacion"
                            class="form-control"
                            placeholder=" Poblacion"
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provincia-input">Provincia</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="propietario.provincia"
                            class="form-control"
                            placeholder="Provincia"
                        />
                    </div>
                </div>
                  <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="telefono-input">Telefono</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="propietario.telefono"
                            class="form-control"
                            placeholder=" Telefono"
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="email-input">email</label>
                    <div class="col-md-6">
                        <input
                            type="email"
                            v-model="propietario.email"
                            class="form-control"
                            placeholder="Email"
                        />
                    </div>
                </div>
                <!-- <div class="form-group row" v-if="propietario === copia">
                    {{propietario}}
                    <br>
                    {{copia}}
                </div>
                <div class="form-group row" v-else>
                     <button
                    type="submit"
                    @click="propietarioUpdate(propietario)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-pencil"></i> Actualizar Datos Propietario
                  </button>
                   {{propietario}} prpie
                    <br>
                    {{copia}}
                </div> -->
                 
                </div>

        </div>

        
        <div v-if="currentstep == 2">
            <div class="form-group row"> <h2>Terreno</h2>
              <div class="col-md-6">
                <div class="input-group">
                 
                
                  <button
                    type="submit"
                    @click="terrenosDeUnPropietario(propietario.id)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Ver Terrenos
                  </button>
                </div>
               
              </div>
            </div>


               <div class="card-body" v-if="tieneTerrenos === true ">
                        
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
                                <tr v-for="terreno in arrayTerrenos" :key="terreno.id">
                                     
                                     <td><button
                                        type="button"
                                        @click="seleccionarTerreno(terreno)"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="icon-eye"></i>
                                    </button>
                                    </td>
                                    <td v-text="terreno.dni"></td>
                                    <td v-text="terreno.nombre"></td>
                                    <td v-text="terreno.direccion"></td>
                                    <td v-text="terreno.poblacion"></td>
                                    <td v-text="terreno.postal"></td>
                                    <td v-text="terreno.provincia"></td>
                                    <td v-text="terreno.telefono"></td>
                                    <td v-text="terreno.email"></td>
                                   
                                  <!--   
                                    <td>
                                        <div v-if="terreno.baja">
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
                        <label class="col-md-2 form-control-label" for="referencia-input">Referencia </label>
                        <div class="col-md-3">
                        <input
                            type="text"
                            v-model="terreno.dni"
                            class="form-control"
                            placeholder="Referencia"
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="nombreTerreno-input">Descripcion Terreno </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="terreno.nombre"
                                class="form-control"
                                placeholder="Descripcion terreno"
                            />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="direccion-input">Dirección</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                v-model="terreno.direccion"
                                class="form-control"
                                placeholder="Direccion "
                            />
                        </div>
               
                    <label class="col-md-2 form-control-label" for="codigo-input">Código Postal</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="terreno.postal"
                            class="form-control"
                            placeholder="Codigo Postal"
                        />
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="poblacionterreno-input">Poblacion</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="terreno.poblacion"
                            class="form-control"
                            placeholder="Terreno Poblacion"
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provinciaTerreno-input">Provincia</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="terreno.provincia"
                            class="form-control"
                            placeholder="Provincia"
                        />
                    </div>
                </div>
                  <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="telefono-input">Telefono</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="terreno.telefono"
                            class="form-control"
                            placeholder="Direccion Telefono"
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="email-input">email</label>
                    <div class="col-md-6">
                        <input
                            type="email"
                            v-model="terreno.email"
                            class="form-control"
                            placeholder="Email"
                        />
                    </div>
                </div>
            </div>
           <!--   <div class="form-group row">
                <label class="col-md-1 form-control-label" for="direccion-input"
                >Forma de Pago</label
                >

                <select
                class="form-control col-md-3"
                id="forma_pago"
                v-model="terreno.forma_pago"
                >
                <option value="Mensual">Mensual</option>
                <option value="Trimestral">Trimestral</option>
                <option value="Semestral">Semestral</option>
                <option value="Anual">Anual</option>
                <option value="Otras">Otras</option>
                </select>

                <label class="col-md-1 form-control-label" for="direccion-input"
                >Importe Periodo</label
                >
                <div class="col-md-3">
                <input
                    type="number"
                    v-model="terreno.importe_periodo"
                    class="form-control"
                    placeholder="Importe Periodo "
                />
                </div>

                <label class="col-md-1 form-control-label" for="codigo-input"
                >Alquiler Anual</label
                >
                <div class="col-md-3">
                <input
                    type="number"
                    v-model="terreno.alquiler_anual"
                    class="form-control"
                    placeholder="Alquiler Anual"
                />
                </div>
            </div> -->
        </div>

        <div v-if="currentstep == 3">
            <div class="form-group row"> <h2>Valla</h2>
              <div class="col-md-6">
                <div class="input-group">
                 
                
                  <button
                    type="submit"
                    @click="traerDatosDelTerreno(terreno)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Traer Datos de Terreno
                  </button>
                </div>
              </div>
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
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="nombreValla-input">Descripción </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="valla.nombre"
                                class="form-control"
                                placeholder="Descripcion"
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
                            />
                        </div>
               
                    <label class="col-md-2 form-control-label" for="codigo-input">Código Postal</label>
                    <div class="col-md-2">
                        <input
                            type="text"
                            v-model="valla.postal"
                            class="form-control"
                            placeholder="Codigo Postal"
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
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provincia-input">Provincia</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.provincia"
                            class="form-control"
                            placeholder="Provincia"
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
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="email-input">email</label>
                    <div class="col-md-6">
                        <input
                            type="email"
                            v-model="valla.email"
                            class="form-control"
                            placeholder="Email"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="ancho-input">Ancho</label>
                    <div class="col-md-2">
                        <input
                            type="number"
                            v-model="valla.ancho"
                             v-on:change="calcularM2"
                            class="form-control"
                            placeholder="Ancho"
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="Alto-input">Alto</label>
                    <div class="col-md-2">
                        <input
                            type="number"
                            v-model="valla.alto"
                             v-on:change="calcularM2"
                            class="form-control"
                            placeholder="alto"
                        />
                    </div>
                     <label class="col-md-2 form-control-label" for="m2-input">M2</label>
                    <div class="col-md-2">
                        <input
                            type="number"
                            v-model="valla.m2"
                            class="form-control"
                            placeholder="m2"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" rows="3" v-model="valla.observaciones"></textarea>
                </div>
                <div class="form-group row">
                     <label class="col-md-2 form-control-label" for="tipo">Tipo</label>
                    <select class="form-control col-md-2" id="tipo" v-model="valla.tipo">
                    
                    <option value="Valla">Valla</option>
                    <option value="Monoposte">Monoposte</option>
                    <option value="Fachada">Fachada</option>
                    <option value="Pantalla Led">Pantalla Led</option>

                   
                  
                    </select>
                    <label class="col-md-2 form-control-label" for="elemento">Elemento</label>
                    <select class="form-control col-md-2" id="elemento" v-model="valla.elemento">
                        <option value="Lona">Lona</option>
                        <option value="Dibon">Dibon</option>
                        <option value="Vinilo">Vinilo</option>
                        <option value="Papel">Papel</option>
                        <option value="Sin-Chapas">Sin-Chapas</option>

                    
                    </select>

                    <label class="col-md-2 form-control-label" for="estado" >Estado</label>
                    <select class="form-control col-md-2" id="estado" v-model="valla.estado">
                        <option value="Libre">Libre</option>
                        <option value="Ocupada">Ocupada</option>
                        <option value="Reservada">Reservada</option>
                        <option value="Baja">Baja</option>
                        
                    
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-md-1 form-control-label" for="direccion-input"
                    >Periodo</label
                    >
                    <select
                    class="form-control col-md-3"         

                    id="forma_pago"
                    v-model="valla.forma_pago"
                     @change="calculoCuotasTerrenoValla($event)"
                    >
                    <option value="12">Mensual</option>
                    <option value="4">Trimestral</option>
                    <option value="2">Semestral</option>
                    <option value="1">Anual</option>
                    <option value="1">Otras</option>
                    </select>

                    <label class="col-md-1 form-control-label" for="direccion-input"
                    >Importe Periodo</label
                    >
                    <div class="col-md-3">
                    <input
                     id="importe_periodo"
                        type="number"
                        v-model="valla.importe_periodo"
                        class="form-control"
                        placeholder="Importe Periodo "
                         @change="calculoCuotasTerrenoValla($event)"

                    />
                    </div>

                    <label class="col-md-1 form-control-label" for="codigo-input"
                    >Alquiler Anual</label
                    >
                    <div class="col-md-3">
                    <input
                        id="alquiler_anual"
                        type="number"
                        v-model="valla.alquiler_anual"
                        class="form-control"
                        placeholder="Alquiler Anual"
                        @change="calculoCuotasTerrenoValla($event)"
                    />
                    </div>
                </div>

            </div>
        </div>


        <div v-if="currentstep == 4">
            <h2>Ubicación Mapa</h2>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="latitud-input">Latitud</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.latitud"
                            class="form-control"
                            placeholder="Direccion latitud"
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="longitud-input">Longitud</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.longitud"
                            class="form-control"
                            placeholder="longitud"
                        />
                    </div>
                </div>







                <GmapMap
                    :center="center"
                    :zoom="15"
                    map-type-id="satellite"
                    style="width: 100%; height: 400px"
                    
                    >
                

                    <gmap-info-window
                        :options="infoWindowOptions"
                        :position="infoWindowPosition"
                        :opened="infoWindowOpened"
                        @closeclick="handleInfoWindowClose"
                    >
                        <div class="info-window">
                            <h2 v-text="activeValla.nombre"></h2>
                            <h5 v-text="activeValla.dni"></h5>
                            <p v-text="activeValla.direccion"></p>

                        </div>
                    </gmap-info-window>
                    <gmap-marker
                        
                            :key="valla.id"
                            :position="getPosition(valla)"
                            :clickable ="true"
                            :draggable ="true"
                            @click="handleMarkerClicked(valla)"
                            @drag="getCoordenadasDrag"


                        >
                        </gmap-marker>
                </GmapMap>
                
                {{latitud}}
                {{longitud}}

            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                 
                
                  <button
                    type="submit"
                    @click="geocoderAddres(valla,true);
"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Recalcular ubicacion en funcion de direccion.
                  </button>
                </div>
              </div>
            </div>
              

            </div>
        </div>

        <div v-if="currentstep == 'enviar'">
            <div class="form-group row"> <h2>Proceso de Actualizacion de Valla Finalizado</h2>
             
            </div>
             <div v-if="errores" class="alert alert-danger" role="alert">
                    {{errores}} 

            </div>

           <div v-else class="card-body alert alert-successs" role="alert">
                   
              
                <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Propietario  </label>
                        <div class="col-md-10">
                        <input
                            type="hidden"
                            v-model="propietario.nombre"
                            class="form-control"
                        />
                        </div>
                </div>

                <div class="form-group row">   
                        <label class="col-md-2 form-control-label" for="nombreValla-input">Terreno </label>
                        <div class="col-md-10">
                           <h3> {{propietario.nombre}}</h3>
                        </div>
                </div>
                 <div class="form-group row">   
                        <label class="col-md-2 form-control-label" for="nombreValla-input">Valla </label>
                        <div class="col-md-10">
                           <h3>{{valla.nombre}}</h3>
                        </div>
                </div>
                 <div class="form-group row">   
                        <label class="col-md-2 form-control-label" for="nombreValla-input">Latitud </label>
                        <div class="col-md-4">
                            <h3>{{valla.latitud}}</h3>
                        </div>
                         <label class="col-md-2 form-control-label" for="nombreValla-input">Longitud </label>
                        <div class="col-md-4">
                            <h3>{{valla.longitud}}</h3>
                        </div>
                        Pulse en Listar Vallas para ver lista de vallas
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
     <!--    {{modal}}
        <br>
        {{vallaE}}
        <br>
        {{propietario}}
        <br>
        {{terreno}}
        <br>
        {{valla}} -->


        
    </div>




</template>

<script>
import StepControls from './StepControls.vue';

export default {
     components: { StepControls },
     props: {
             modal : Number,
             modo : String,
             vallaE: Object,
             
        },
    data(){
        return {
            vallaEnviada : [],

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
                    ancho : 0,
                    alto : 0,
                    m2 : 0,
                    tipo : '',
                    elemento : '',
                    estado : 'Libre',
                    observaciones: '',
                      forma_pago: "",
                    importe_periodo: "",
                    alquiler_anual: "",

            },
           
            m2 : 0 , 
             copia: {
                    id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
            },
            propietario: {
                    id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
            },
            terreno: {
                id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                     email: "",
                    forma_pago: "",
                    importe_periodo: "",
                    alquiler_anual: "",
            },
            mostrarBuscar: 0,
            textoBuscar: '',
            arrayPropietarios:[],
            arrayTerrenos:[],
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
                    title: 'Datos Propietario',
                    icon_class: "fa fa-user-o"
                }, {
                    id: 2,
                    title: 'Datos Terreno',
                    icon_class: "fa fa-folder-open"
                }, {
                    id: 3,
                    title: 'Datos Valla',
                    icon_class: "fa fa-paper-plane"
                }
                , {
                    id: 4,
                    title: 'Ubicacion Maps',
                    icon_class: "fa fa-map-marker"
                }
            ]



        }
    },
     mounted() {
             let me = this;
              
             
             console.log('mounted, Inicio vallaE : ',this.vallaE
             ,'modo', this.modo, 'modal : ', this.modal
             );
             me.cargarDatosValla(me.vallaE);
        
     },
     methods: {
         calculoCuotasTerrenoValla: function(e){
                console.log(e, e.target, e.target.value, e.target.id);


                if (e.target.id === 'forma_pago') {
                    this.valla.importe_periodo = (this.valla.alquiler_anual/e.target.value).toFixed(2);
                    } else if (e.target.id==='importe_periodo') {
                            this.valla.alquiler_anual = (this.valla.forma_pago*e.target.value).toFixed(2);

                    } else if (e.target.id ==='alquiler_anual') {
                            this.valla.importe_periodo = (e.target.value/this.valla.forma_pago).toFixed(2);

                    }else {

                    }

                          
                

                },

         cargarDatosValla(v){
             console.log('cargarDatos',v);
                  let me = this;
       
                var url =
                "/api/valla/datos/"+v.terreno_id;

                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.propietario = response.data.propietario;
                    me.copia = me.propietario;
                    me.terreno = response.data.terreno;
                    if(me.modal==2 || me.modal==33){
                        me.valla = v ;
                    }
                    

                     console.log('datos vallaEditar : respuesta : ',respuesta,'valla',me.valla);

                    
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
            console.log('stepChanged propietario',step,this.propietario.nombre,this.propietario.dni);
            console.log('stepChanged valla',step,this.valla);

            if(step === 2 && (!this.propietario.dni || !this.propietario.nombre)){
                 swal({
                        type: "error",
                        title: "Error...",
                        text:
                            "Dni Propietario y Nombre obligatorios ",
                        });
                        
                return;

            }
         
            if(step === 3 && (!this.terreno.dni || !this.terreno.nombre)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Referencia Terreno y Descripcion obligatorios ",
            });
            return;

            }
            
            if(step === 4 && (!this.valla.dni || !this.valla.nombre)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Referencia Valla y Descripcion obligatorios ",
            });
            return;

            }
            if(step === 4 && (this.valla.dni.substring(1,3) != this.terreno.dni.substring(1,3))){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "TRES primeros digitos de REFERNCIA TERRENO debe ser IGUAL  a REFENCIA VALLA ",
            });
            return;

            }
            

            if(step === 4 && (!this.valla.direccion)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Referencia Valla y Descripcion obligatorios ",
            });
            return;

            }
            
            if(step === 4 ){
                this.valla.terreno_id = this.terreno.id;
                this.geocoderAddres(this.valla,false);


            }
            if(step === 4 && (!this.valla.direccion || !this.valla.poblacion  || !this.valla.provincia ||!this.valla.m2  || !this.valla.tipo  || !this.valla.elemento  || !this.valla.estado)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Referencia Ancho , Alto, Tipo, Elemento , Estado son  obligatorios ",
            });
            return;

            }
         
            if(step === 'enviar' && (!this.valla.latitud || !this.valla.longitud)){
                 swal({
              type: "error",
              title: "Error...",
              text:
                "Referencia Longitud y Latitud  ",
            });
            return;

            }
            if(step === 'enviar' ){
                          //  this.geocoderAddres(this.valla.direccion);
             this.guardarFormulario();
            }

        
            this.currentstep = step;
        },
      
        seleccionarPropietario(propietario){
            console.log('seleccionarPropietario',propietario)
            this.propietario = propietario;
            this.mostrarBuscar=0;
                        console.log('seleccionarPropietario',this.propietario,this.propietario.nombre)
            this.terrenosDeUnPropietario(propietario.id);

        },
        seleccionarTerreno(terreno){
            console.log('seleccionarTerreno',terreno)
            this.terreno = terreno;
            this.tieneTerrenos=false;
                        console.log('seleccionarTerreno',this.terreno,this.terreno.nombre)
         

        },
        traerDatosDelTerreno(terreno){
            console.log('traerDatosDelTerreno VallaEditar',terreno,this.valla)
           // this.valla = terreno;
            this.valla['dni']=this.terreno['dni'] ; 

            this.valla['nombre']=this.terreno['nombre'] ; 
            this.valla['descripcion']=this.terreno['descripcion'];
            this.valla['direccion']=this.terreno['direccion'];
            this.valla['postal']=this.terreno['postal'];
            this.valla['poblacion']=this.terreno['poblacion'];
            this.valla['provincia']=this.terreno['provincia'];
            
            this.valla['telefono']=this.terreno['telefono'];
            this.valla['email']=this.terreno['email'];
           /*  this.valla["forma_pago"] = this.terreno["forma_pago"];
             this.valla["importe_periodo"] = this.terreno["importe_periodo"];
            this.valla["alquiler_anual"] = this.terreno["alquiler_anual"]; */
           
            this.valla.observaciones = "";



//todo .. poner los que no tiene terreno o poner los que tiene valla .. 
           
         
                        console.log('traerDatosDelTerreno',this.valla,this.valla.nombre)
          

        },
        geocoderAddres(direccion,modo){
            console.log('geocoderAdress',direccion, this.$refs, 'valla',direccion.latitud,direccion.longitud, this.valla.direccion, this.valla.latitud);
            //var d ="Antonio Gamoneda, 2 -24006 - leon";
            var d = this.valla.direccion+'-'+this.valla.poblacion;
            var me = this;
            //this.$$refs.mapR
           // var geocoder =  new VueGoogleMaps;
            //.maps.newGeocoder(d);
           /*  VueGoogleMaps.loaded().then(() => {
                            console.log(google.maps);

            }); */
/* 
            this.$refs.gmap.$mapCreated.then(()=>{
                console.log(google.maps);
            });
             */
            const a = this.$gmapApiPromiseLazy().then(() => {
                console.log('direccion ',direccion,d);
                //google.maps);
                const geocoder = new google.maps.Geocoder();
                const address = d;

                geocoder.geocode({ address }, function(results, status){
                    var latitude =0, longitude =0;
                    console.log('gecoooder',results, status,direccion.latitud, direccion.longitud);
                    if (status === 'OK'){
                        
                        
                        if (direccion.latitud && direccion.longitud && !modo) {
                              latitude =direccion.latitud;
                         longitude =direccion.longitud;

                        }else {
                             latitude = results[0].geometry.location.lat();
                             longitude = results[0].geometry.location.lng();
                        }
                          
                        
                        console.log('latitude',latitude,'direccion',direccion);
                        console.log('longitude',longitude);
                        var r = [];
                        r.latitud = latitude;
                        r.longitud = longitude;
                        me.getPosition(r);
                        me.setCenter(parseFloat(latitude),parseFloat(longitude));
                         return {

                lat : parseFloat(latitude),
                lng : parseFloat(longitude)
            }


                    }
                });
            })
            console.log('aaaaaaaaaaaaaaaaaa', a);

                           

        },
        terrenosDeUnPropietario(propietario){
            console.log('terrenosPropieatrio',propietario);
             let me = this;
           // if (me.terrenos= true){return};



            var url =
                "/api/propietarios/"+propietario+"/terrenos";
                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.arrayTerrenos = respuesta.terrenos;
                    me.paginationT = respuesta.pagination;
                     me.tieneTerrenos = true;

                     console.log('terrenosdeunpropiestario',respuesta,me.arrayTerrenos, me.tieneTerrenos);

                    
                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
            });
            
        },
         guardarFormulario(){
            console.log('guardarFormulario',this.propietario, this.terreno, this.valla);
             let me = this;
             //if(this.valla.id){}else{this.valla.id=9999}
           // if (me.terrenos= true){return};
            axios
                .post("/valla/update", {
                data: {
                    propietario: this.propietario,
                    terreno: this.terreno,
                    valla : this.valla,
                },
                })
                .then(function (response) {
                console.log("guardarFormulario", response, response.data, response.data['valla']);
                           // me.$emit('modalR', 0)
                me.valla = response.data['valla'];
                me.vallaEnviada = response.data;
                console.log("guardarFormulario", me.valla, response.data);


                })

                .catch((error) => {
                    console.log('guardarFormulario',error, error.response, error.response.status);
                    me.errores = error;
                    me.currentstep = 4;
                     if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
                });


           
           
            
        },
        listarPropietarios(page, textoBuscar) {
            let me = this;
            me.mostrarBuscar = 1;



            var url =
                "/api/propietarios?page=" +
                page +
                "&buscar=" +
                textoBuscar;
         

                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.arrayPropietarios = respuesta.propietarios.data;
                    me.pagination = respuesta.pagination;
                    
                    if (respuesta.propietarios.data.length <= 0) {
                        console.log("LISTAR PRESUPUESTO entro");
                        me.mostrarBuscar = 0 ;
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
        calcularM2() {
            this.valla.m2 = 0 ; 
            let me = this;
            let m = +(me.valla.ancho * me.valla.alto).toFixed(3);
            if (m>0){
                console.log('m>o', m)
                this.m2 = m ; 
                this.valla.m2 = m ;
                console.log('m>o', this.m2, this.valla.m2);
                return me.valla.m2 = m ; 
            }

         
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
        getCoordenadasDrag(location){
            console.log('getCoordenadasDrag',location.latLng.lat(),location.latLng.lng());

            let me = this;
            me.longitud  = location.latLng.lat();
            me.latitud =  location.latLng.lng();

            this.valla.latitud = location.latLng.lat();
            this.valla.longitud = location.latLng.lng();
            
            console.log('getCoordenadasDrag despues',location.latLng.lat(),'->',this.valla.latitud,':',location.latLng.lng(),'->',this.valla.longitud);

            
        

        }


     },
    computed: {
        modoEdicion(){
            console.log('modoEdicion', this.modoEdicion);

        },
        mapCenter() {

            console.log('mapCenter');
            if(!this.valla.latitud  || !this.valla.longitud){
                console.log('mapCenter',this.valla.longitud);
                return {
                     
                   // lat: 42.60003,
                   // lng: -5.57032
                     lat: 10,
                     lng: 10
                }
            }
                console.log('mapCenter 33333',this.valla.longitud,this.valla.latitud);

            return {

                lat : parseFloat(this.valla.latitud),
                lng : parseFloat(this.valla.longitud)
            }
        },
        infoWindowPosition() {
            console.log('infoWindowPosition', this.longitud,this.latitud);
            return {

               
                lat : parseFloat(this.valla.latitud),
                lng : parseFloat(this.valla.longitud)
            }
        }
      
        
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