<template>
  <!--Inicio del modal agregar/actualizar-->

  <div id="pro-wizard">
    <step-navigation :steps="steps" :currentstep="currentstep">
    </step-navigation>

    <div v-if="currentstep == 1">
      <div class="form-group row">
        <h2>Propietario</h2>
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

      <div class="card-body" v-if="mostrarBuscar === 1">
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
              <td>
                <button
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
              <a
                class="page-link"
                href="#"
                @click.prevent="
                  cambiarPagina(
                    pagination.current_page - 1,
                    textoBuscar,
                    criterio
                  )
                "
                >Ant</a
              >
            </li>
            <li
              class="page-item"
              v-for="page in pagesNumber"
              :key="page"
              :class="[page == isActived ? 'active' : '']"
            >
              <a
                class="page-link"
                href="#"
                @click.prevent="cambiarPagina(page, textoBuscar, criterio)"
                v-text="page"
              ></a>
            </li>
            <li
              class="page-item"
              v-if="pagination.current_page < pagination.last_page"
            >
              <a
                class="page-link"
                href="#"
                @click.prevent="
                  cambiarPagina(
                    pagination.current_page + 1,
                    textoBuscar,
                    criterio
                  )
                "
                >Sig</a
              >
            </li>
          </ul>
        </nav>
      </div>

      <div class="card-body">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="dni-input"
            >DNI
          </label>
          <div class="col-md-3">
            <input
              type="text"
              v-model="propietario.dni"
              class="form-control"
              placeholder="DNI Propietario"
              :readonly="propietario.id >= 1"
            />
          </div>

          <label
            class="col-md-2 form-control-label"
            for="nombrePropietario-input"
            >Nombre
          </label>
          <div class="col-md-5">
            <input
              type="text"
              v-model="propietario.nombre"
              class="form-control"
              placeholder="Nombre Propietario"
              :readonly="propietario.id >= 1"
            />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="password-input"
            >Dirección</label
          >
          <div class="col-md-6">
            <input
              type="text"
              v-model="propietario.direccion"
              class="form-control"
              placeholder="Direccion "
              :readonly="propietario.id >= 1"
            />
          </div>

          <label class="col-md-2 form-control-label" for="codigo-input"
            >Código Postal</label
          >
          <div class="col-md-2">
            <input
              type="text"
              v-model="propietario.postal"
              class="form-control"
              placeholder="Codigo Postal"
              :readonly="propietario.id >= 1"
            />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="poblacion-input"
            >Poblacion</label
          >
          <div class="col-md-4">
            <input
              type="text"
              v-model="propietario.poblacion"
              class="form-control"
              placeholder=" Poblacion"
              :readonly="propietario.id >= 1"
            />
          </div>

          <label class="col-md-2 form-control-label" for="provincia-input"
            >Provincia</label
          >
          <div class="col-md-4">
            <input
              type="text"
              v-model="propietario.provincia"
              class="form-control"
              placeholder="Provincia"
              :readonly="propietario.id >= 1"
            />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="telefono-input"
            >Telefono</label
          >
          <div class="col-md-2">
            <input
              type="text"
              v-model="propietario.telefono"
              class="form-control"
              placeholder=" Telefono"
              :readonly="propietario.id >= 1"
            />
          </div>

          <label class="col-md-2 form-control-label" for="email-input"
            >email</label
          >
          <div class="col-md-6">
            <input
              type="email"
              v-model="propietario.email"
              class="form-control"
              placeholder="Email"
              :readonly="propietario.id >= 1"
            />
          </div>
        </div>
      </div>
    </div>

    <div v-if="currentstep == 2">
      <div class="form-group row">
        <h2>Terreno</h2>
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

      <div class="card-body" v-if="tieneTerrenos === true">
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
              <td>
                <button
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
          <label class="col-md-2 form-control-label" for="referencia-input"
            >Referencia
          </label>
          <div class="col-md-3">
            <input
              type="text"
              v-model="terreno.dni"
              class="form-control"
              placeholder="Referencia"
              :readonly="terreno.id >= 1"
            />
          </div>

          <label class="col-md-2 form-control-label" for="nombreTerreno-input"
            >Descripcion Terreno
          </label>
          <div class="col-md-5">
            <input
              type="text"
              v-model="terreno.nombre"
              class="form-control"
              placeholder="Descripcion terreno"
              :readonly="terreno.id >= 1"
            />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="direccion-input"
            >Dirección</label
          >
          <div class="col-md-6">
            <input
              type="text"
              v-model="terreno.direccion"
              class="form-control"
              placeholder="Direccion "
              :readonly="terreno.id >= 1"
            />
          </div>

          <label class="col-md-2 form-control-label" for="codigo-input"
            >Código Postal</label
          >
          <div class="col-md-2">
            <input
              type="text"
              v-model="terreno.postal"
              class="form-control"
              placeholder="Codigo Postal"
              :readonly="terreno.id >= 1"
            />
          </div>
        </div>

        <div class="form-group row">
          <label
            class="col-md-2 form-control-label"
            for="poblacionterreno-input"
            >Poblacion</label
          >
          <div class="col-md-4">
            <input
              type="text"
              v-model="terreno.poblacion"
              class="form-control"
              placeholder="Poblacion"
              :readonly="terreno.id >= 1"
            />
          </div>

          <label
            class="col-md-2 form-control-label"
            for="provinciaTerreno-input"
            >Provincia</label
          >
          <div class="col-md-4">
            <input
              type="text"
              v-model="terreno.provincia"
              class="form-control"
              placeholder="Provincia"
              :readonly="terreno.id >= 1"
            />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="telefono-input"
            >Telefono</label
          >
          <div class="col-md-2">
            <input
              type="text"
              v-model="terreno.telefono"
              class="form-control"
              placeholder="Telefono"
              :readonly="terreno.id >= 1"
            />
          </div>

          <label class="col-md-2 form-control-label" for="email-input"
            >email</label
          >
          <div class="col-md-6">
            <input
              type="email"
              v-model="terreno.email"
              class="form-control"
              placeholder="Email"
              :readonly="terreno.id >= 1"
            />
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-1 form-control-label" for="direccion-input"
          >Forma de Pago</label
        >

        <select
          class="form-control col-md-3"
          id="forma_pago"
          v-model="terreno.forma_pago"
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
      </div>
    </div>

    <div v-if="currentstep == 3">
      <div class="form-group row">
        <h2>Valla</h2>
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
          <label class="col-md-2 form-control-label" for="referencia-input"
            >Referencia
          </label>
          <div class="col-md-3">
            <input
              type="text"
              v-model="valla.dni"
              class="form-control"
              placeholder="referencia"
            />
          </div>

          <label class="col-md-2 form-control-label" for="nombreValla-input"
            >Descripción
          </label>
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
          <label class="col-md-2 form-control-label" for="password-input"
            >Dirección</label
          >
          <div class="col-md-6">
            <input
              type="text"
              v-model="valla.direccion"
              class="form-control"
              placeholder="Direccion Valla"
            />
          </div>

          <label class="col-md-2 form-control-label" for="codigo-input"
            >Código Postal</label
          >
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
          <label class="col-md-2 form-control-label" for="poblacion-input"
            >Poblacion</label
          >
          <div class="col-md-4">
            <input
              type="text"
              v-model="valla.poblacion"
              class="form-control"
              placeholder="Direccion Poblacion"
            />
          </div>

          <label class="col-md-2 form-control-label" for="provincia-input"
            >Provincia</label
          >
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
          <label class="col-md-2 form-control-label" for="telefono-input"
            >Telefono</label
          >
          <div class="col-md-2">
            <input
              type="text"
              v-model="valla.telefono"
              class="form-control"
              placeholder="Direccion Telefono"
            />
          </div>

          <label class="col-md-2 form-control-label" for="email-input"
            >email</label
          >
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
          <label class="col-md-2 form-control-label" for="ancho-input"
            >Ancho</label
          >
          <div class="col-md-2">
            <input
              type="number"
              v-model="valla.ancho"
              v-on:change="calcularM2"
              class="form-control"
              placeholder="Ancho"
            />
          </div>

          <label class="col-md-2 form-control-label" for="Alto-input"
            >Alto</label
          >
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
          <textarea
            class="form-control"
            id="observaciones"
            rows="3"
            v-model="valla.observaciones"
          ></textarea>
        </div>
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="tipo">Tipo</label>
          <select class="form-control col-md-2" id="tipo" v-model="valla.tipo">
            <option value="Valla">Valla</option>
            <option value="Monoposte">Monoposte</option>
            <option value="Fachada">Fachada</option>
            <option value="Pantalla Led">Pantalla Led</option>
          </select>
          <label class="col-md-2 form-control-label" for="elemento"
            >Elemento</label
          >
          <select
            class="form-control col-md-2"
            id="elemento"
            v-model="valla.elemento"
          >
            <option value="Lona">Lona</option>
            <option value="Dibon">Dibon</option>
            <option value="Vinilo">Vinilo</option>
            <option value="Papel">Papel</option>
            <option value="Sin-Chapas">Sin-Chapas</option>
          </select>

          <label class="col-md-2 form-control-label" for="estado">Estado</label>
          <select
            class="form-control col-md-2"
            id="estado"
            v-model="valla.estado"
          >
            <option value="Libre">Libre</option>
            <option value="Ocupada">Ocupada</option>
            <option value="Reservada">Reservada</option>
          </select>
        </div>
      </div>
    </div>

    <div v-if="currentstep == 4">
      <h2>Ubicación Mapa</h2>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="latitud-input"
            >Latitud</label
          >
          <div class="col-md-4">
            <input
              type="text"
              v-model="valla.latitud"
              class="form-control"
              placeholder="Direccion latitud"
            />
          </div>

          <label class="col-md-2 form-control-label" for="longitud-input"
            >Longitud</label
          >
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
            :clickable="true"
            :draggable="true"
            @click="handleMarkerClicked(valla)"
            @drag="getCoordenadasDrag"
          >
          </gmap-marker>
        </GmapMap>

        {{ latitud }}
        {{ longitud }}
        A
      </div>
    </div>

    <div v-if="currentstep == 'enviar'">
      <div class="form-group row">
        <h2>Proceso de creación de Valla Finalizado</h2>
      </div>
      <div v-if="errores" class="alert alert-danger" role="alert">
        {{ errores }}
      </div>

      <div v-else class="card-body alert alert-successs" role="alert">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="referencia-input"
            >Propietario
          </label>
          <div class="col-md-10">
            <h3>{{ propietario.nombre }}</h3>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="nombreValla-input"
            >Terreno
          </label>
          <div class="col-md-10">
            <h3>{{ terreno.nombre }}</h3>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="nombreValla-input"
            >Valla Referencia</label
          >
          <div class="col-md-10">
            <h3>{{ valla.referencia }}</h3>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="nombreValla-input"
            >Valla Descripcion</label
          >
          <div class="col-md-10">
            <h3>{{ valla.nombre }}</h3>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="nombreValla-input"
            >Latitud
          </label>
          <div class="col-md-4">
            <h3>{{ valla.latitud }}</h3>
          </div>
          <label class="col-md-2 form-control-label" for="nombreValla-input"
            >Longitud
          </label>
          <div class="col-md-4">
            <h3>{{ valla.longitud }}</h3>
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
      @step-change="stepChanged"
    >
    </step-controls>
  </div>
</template>

<script>
import StepControls from "./StepControls.vue";

export default {
  components: { StepControls },
  props: {
    modal: Number,
  },
  data() {
    return {
      vallaEnviada: [],

      center: { lat: 5, lng: -5 },
      longitud: 0,

      latitud: 0,

      infoWindowOptions: {
        pixelOffset: {
          width: 0,
          height: -55,
        },
      },
      infoWindowOpened: false,

      tieneTerrenos: false,
      activeValla: {},
      valla: {
        id: 0,
        dni: "",
        nombre: "",
        direccion: "",
        poblacion: "",
        postal: "",
        provincia: "",
        telefono: "",
        email: "",
        longitud: "",
        latitud: "",
        ancho: 1,
        alto: 1,
        m2: 1,
        tipo: "Valla",
        elemento: "Vinilo",
        estado: "Libre",
        observaciones: "",
      },

      m2: 0,
      propietario: {
        id: 0,
        dni: "",
        nombre: "",
        direccion: "",
        poblacion: "",
        postal: "",
        provincia: "",
        telefono: "",
        email: "",
      },
      terreno: {
        id: 0,
        dni: "",
        nombre: "",
        direccion: "",
        poblacion: "",
        postal: "",
        provincia: "",
        telefono: "",
        email: "",
         forma_pago: "",
        importe_periodo: "",
        alquiler_anual: "",
      },
      mostrarBuscar: 0,
      textoBuscar: "",
      arrayPropietarios: [],
      arrayTerrenos: [],
      pagination: "",
      pagesNumber: "",

      currentstep: 1,
      indicatorclass: true,
      step: 1,
      active: 1,
      firststep: true,
      nextStep: "",
      lastStep: "",
      laststep: false,
      errores: "",
      steps: [
        {
          id: 1,
          title: "Datos Propietario",
          icon_class: "fa fa-user-o",
        },
        {
          id: 2,
          title: "Datos Terreno",
          icon_class: "fa fa-folder-open",
        },
        {
          id: 3,
          title: "Datos Valla",
          icon_class: "fa fa-paper-plane",
        },
        {
          id: 4,
          title: "Ubicacion Maps",
          icon_class: "fa fa-map-marker",
        },
      ],
    };
  },
  methods: {
    setCenter(la, lo) {
      console.log("setCenter", la, lo);
      this.center = { lat: la, lng: lo };
    },

    stepChanged: function (step) {
      console.log(
        "stepChanged",
        step,
        this.propietario.nombre,
        this.propietario.dni
      );
      if (
        step === 2 &&
        (!this.propietario.dni ||
          !this.propietario.nombre ||
          !this.propietario.direccion ||
          !this.propietario.postal ||
          !this.propietario.poblacion ||
          !this.propietario.provincia ||
          !this.propietario.email ||
          !this.propietario.telefono)
      ) {
        swal({
          type: "error",
          title: "Error...",
          text: "Todos los campos son obligatorios , por favor completelos ",
        });

        return;
      }

      if (
        step === 3 &&
        (!this.terreno.dni ||
          !this.terreno.nombre ||
          !this.terreno.direccion ||
          !this.terreno.postal ||
          !this.terreno.poblacion ||
          !this.terreno.provincia ||
          !this.terreno.telefono ||
          
          !this.terreno.forma_pago ||
          !this.terreno.importe_periodo ||
          !this.terreno.alquiler_anual ||

          !this.terreno.email)
      ) {
        swal({
          type: "error",
          title: "Error...",
          text: "Todos los campos son obligatorios , por favor completelos ",
        });
        return;
      }

      if (step === 4 && (!this.valla.dni || !this.valla.nombre)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Referencia Valla y Descripcion obligatorios ",
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

      if (step === 4 && !this.valla.direccion) {
        swal({
          type: "error",
          title: "Error...",
          text: "Referencia Valla y Descripcion obligatorios ",
        });
        return;
      }

      if (step === 4) {
        this.geocoderAddres(this.valla.direccion);
      }
      if (
        step === 4 &&
        (!this.valla.direccion ||
          !this.valla.poblacion ||
          !this.valla.provincia ||
          !this.valla.m2 ||
          !this.valla.tipo ||
          !this.valla.elemento ||
          !this.valla.estado)
      ) {
        swal({
          type: "error",
          title: "Error...",
          text: "Direccion, poblacion, provincia, Referencia ,Ancho , Alto, Tipo, Elemento , Estado son  obligatorios ",
        });
        return;
      }
      if (step === "enviar" && (!this.valla.latitud || !this.valla.longitud)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Referencia Longitud y Latitud  ",
        });
        return;
      }
      if (step === "enviar") {
        //  this.geocoderAddres(this.valla.direccion);
        this.guardarFormularioValla();
      }

      this.currentstep = step;
    },

    seleccionarPropietario(propietario) {
      console.log("seleccionarPropietario", propietario);
      this.propietario = propietario;
      this.mostrarBuscar = 0;
      console.log(
        "seleccionarPropietario",
        this.propietario,
        this.propietario.nombre
      );
      this.terrenosDeUnPropietario(propietario.id);
    },
    seleccionarTerreno(terreno) {
      console.log("seleccionarTerreno", terreno);
      this.terreno = terreno;
      this.tieneTerrenos = false;
      console.log("seleccionarTerreno", this.terreno, this.terreno.nombre);
    },
    traerDatosDelTerreno(terreno) {
      console.log("traerDatosDelTerreno", terreno, this.valla);
      // this.valla = terreno;
      this.valla["dni"] = this.terreno["dni"];

      this.valla["nombre"] = this.terreno["nombre"];
      this.valla["descripcion"] = this.terreno["descripcion"];
      this.valla["direccion"] = this.terreno["direccion"];
      this.valla["postal"] = this.terreno["postal"];
      this.valla["poblacion"] = this.terreno["poblacion"];
      this.valla["provincia"] = this.terreno["provincia"];

      this.valla["telefono"] = this.terreno["telefono"];
      this.valla["email"] = this.terreno["email"];
      this.valla["forma_pago"] = this.terreno["forma_pago"];
      this.valla["importe_periodo"] = this.terreno["importe_periodo"];
      this.valla["alquiler_anual"] = this.terreno["alquiler_anual"];
      this.valla.observaciones = 'obs';

      //todo .. poner los que no tiene terreno o poner los que tiene valla ..

      console.log("traerDatosDelTerreno MODAL", this.valla, this.valla.nombre);
    },
    geocoderAddres(direccion) {
      console.log("geocoderAdress", direccion, this.$refs);
      //var d ="Antonio Gamoneda, 2 -24006 - leon";
      var d = this.valla.direccion + "-" + this.valla.poblacion;
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
        console.log("direccion ", direccion, d);
        //google.maps);
        const geocoder = new google.maps.Geocoder();
        const address = d;

        geocoder.geocode({ address }, function (results, status) {
          console.log(results, status);
          if (status === "OK") {
            const latitude = results[0].geometry.location.lat();
            const longitude = results[0].geometry.location.lng();

            console.log(latitude);
            console.log(longitude);
            var r = [];
            r.latitud = latitude;
            r.longitud = longitude;
            me.getPosition(r);
            me.setCenter(latitude, longitude);
            return {
              lat: parseFloat(latitude),
              lng: parseFloat(longitude),
            };
          }
        });
      });
      console.log("aaaaaaaaaaaaaaaaaa", a);
    },
    terrenosDeUnPropietario(propietario) {
      console.log("terrenosPropieatrio", propietario);
      let me = this;
      // if (me.terrenos= true){return};

      var url = "/api/propietarios/" + propietario + "/terrenos";
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayTerrenos = respuesta.terrenos;
          me.paginationT = respuesta.pagination;
          me.tieneTerrenos = true;

          console.log(
            "terrenosdeunpropiestario",
            respuesta,
            me.arrayTerrenos,
            me.tieneTerrenos
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },
    guardarFormularioValla() {
      console.log(
        "guardarFormulario",
        this.propietario,
        this.terreno,
        this.valla
      );
      let me = this;
      // if (me.terrenos= true){return};
      axios
        .post("/valla/create", {
          data: {
            propietario: this.propietario,
            terreno: this.terreno,
            valla: this.valla,
          },
        })
        .then(function (response) {
          console.log(
            "guardarFormulario",
            response,
            response.data,
            response.data["valla"]
          );
          // me.$emit('modalR', 0)
          me.valla = response.data["valla"];
          me.vallaEnviada = response.data;
          console.log("guardarFormulario", me.valla, response.data);
        })

        .catch((error) => {
          console.log("guardarFormulario", error, error.response);
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

      var url = "/api/propietarios?page=" + page + "&buscar=" + textoBuscar;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayPropietarios = respuesta.propietarios.data;
          me.pagination = respuesta.pagination;

          if (respuesta.propietarios.data.length <= 0) {
            console.log("LISTAR PRESUPUESTO entro");
            me.mostrarBuscar = 0;
            swal({
              type: "error",
              title: "Error...",
              text: "No hay registros que cumplan, las condiciones establecidas ",
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
      this.valla.m2 = 0;
      let me = this;
      let m = +(me.valla.ancho * me.valla.alto).toFixed(3);
      if (m > 0) {
        console.log("m>o", m);
        this.m2 = m;
        this.valla.m2 = m;
        console.log("m>o", this.m2, this.valla.m2);
        return (me.valla.m2 = m);
      }
    },
    handleMapClick(e) {
      console.log("handleMapClick", e, this.valla);
      this.valla.push({
        nombre: "valla nueva",
        dni: "rererencia",
        latitud: e.latLng.lat(),
        longitud: e.latLng.lng(),
      });
    },

    getPosition(r) {
      this.valla.latitud = r.latitud;
      this.valla.longitud = r.longitud;
      this.longitud = r.longitud;
      this.latitud = r.latitud;

      console.log(
        "getPosition",
        parseFloat(r.latitud),
        this.valla.latitud,
        parseFloat(r.longitud),
        this.valla.longitud
      );

      return {
        lat: parseFloat(r.latitud),
        lng: parseFloat(r.longitud),
      };
    },
    handleMarkerClicked(r) {
      console.log("handleMarkerClicked", r);

      this.activeValla = r;
      this.infoWindowOpened = true;
    },
    handleInfoWindowClose() {
      console.log("handleInfoWindowClose");

      this.activeValla = {};
      this.infoWindowOpened = false;
    },
    getCoordenadasDrag(location) {
      console.log(
        "getCoordenadasDrag",
        location.latLng.lat(),
        location.latLng.lng()
      );

      let me = this;
      me.longitud = location.latLng.lat();
      me.latitud = location.latLng.lng();

      this.valla.latitud = location.latLng.lat();
      this.valla.longitud = location.latLng.lng();

      console.log(
        "getCoordenadasDrag despues",
        location.latLng.lat(),
        "->",
        this.valla.latitud,
        ":",
        location.latLng.lng(),
        "->",
        this.valla.longitud
      );
    },
  },
  computed: {
    mapCenter() {
      console.log("mapCenter");
      if (!this.valla.latitud || !this.valla.longitud) {
        console.log("mapCenter", this.valla.longitud);
        return {
          // lat: 42.60003,
          // lng: -5.57032
          lat: 10,
          lng: 10,
        };
      }
      console.log("mapCenter 33333", this.valla.longitud, this.valla.latitud);

      return {
        lat: parseFloat(this.valla.latitud),
        lng: parseFloat(this.valla.longitud),
      };
    },
    infoWindowPosition() {
      console.log("infoWindowPosition", this.longitud, this.latitud);
      return {
        lat: parseFloat(this.valla.latitud),
        lng: parseFloat(this.valla.longitud),
      };
    },
  },
};
</script>
<style>
body {
  padding: 0;
  margin: 0;
  background-color: #f6f6f6;
  font-family: "Roboto", sans-serif;
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