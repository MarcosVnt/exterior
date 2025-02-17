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
        <div class="form-group row">
          <label for="observaciones">Observaciones</label>
          <textarea
            class="form-control"
            id="observaciones"
            rows="3"
            v-model="propietario.observaciones"
            :readonly="propietario.id >= 1"
          ></textarea>
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

               
                                    <td>
                                        <div v-if="terreno.baja===1">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Baja</span>
                                        </div>
                                        
                                    </td>
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
          :disabled="terreno.calculo_costes==='xValla'"
            @change="calculoCuotasTerreno($event)"
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
          :disabled="terreno.calculo_costes==='xValla'"
            type="number"
            v-model="terreno.importe_periodo"
            class="form-control"
            placeholder="Importe Periodo "
              @change="calculoCuotasTerreno($event)"
          />
        </div>

        <label class="col-md-1 form-control-label" for="codigo-input"
          >Alquiler Anual</label
        >
        <div class="col-md-3">
          <input
          id="alquiler_anual"
          :disabled="terreno.calculo_costes==='xValla'"
            type="number"
            v-model="terreno.alquiler_anual"
            class="form-control"
            placeholder="Alquiler Anual"
              @change="calculoCuotasTerreno($event)"
          />
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-1 form-control-label" for="direccion-input"
            >Estado</label
          >

          <select
            class="form-control col-md-2"
            id="baja"
            v-model="terreno.baja"
          >
            <option selected value="1">Activo </option>
            <option value="2">Baja</option>
          
          </select>
                   <label class="col-md-2 form-control-label" for="direccion-input"
            >Cálculo Coste Terreno</label
          >

          <select
            class="form-control col-md-3"
            id="baja"
            v-model="terreno.calculo_costes"
            @change="calculoCuotasValla($event,terreno)"
            
          >
            <option value="xTerreno" selected>Coste por Terreno </option>
            <option value="xValla">Coste Por Valla</option>
          
          </select>
         
          <div class="col-md-2"
           v-if="terreno.vallas_count"
           >
            Anual X Vallas
          <input
         
          :disabled="true"
            type="number"
            v-model="terreno.vallas_count"
            class="form-control"
            placeholder="Anual por vallas"
          />
        </div>
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
import moment from "moment";
import StepControls from "../vallas/StepControls.vue";

export default {
      components: { StepControls },

  props: {
    modal: Number,

    terrenoE: Object,
  },
  data() {
    return {

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
      ],
      
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
        observaciones: '',
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
        forma_pago: "1",
        importe_periodo: "",
        alquiler_anual: "",
        baja:"",
        calculo_costes:"",
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
      old: {importe_periodo: 0, alquiler_anual:0},
    };
  },
  mounted() {
    let me = this;
    console.log("mounted, Inicio", this.terrenoE);
    me.cargarDatosTerreno(me.terrenoE);
  },

  methods: {
    calculoCuotasTerreno: function(e){
      console.log(e, e.target, e.target.value, e.target.id);


      if (e.target.id === 'forma_pago') {
          this.terreno.importe_periodo = (this.terreno.alquiler_anual/e.target.value).toFixed(2);
        } else if (e.target.id==='importe_periodo') {
                  this.terreno.alquiler_anual = (this.terreno.forma_pago*e.target.value).toFixed(2);

        } else if (e.target.id ==='alquiler_anual') {
                   this.terreno.importe_periodo = (e.target.value/this.terreno.forma_pago).toFixed(2);

        }else {

        }

         this.old['importe_periodo'] = this.terreno.importe_periodo;
          this.old['alquiler_anual'] = this.terreno.alquiler_anual;
      
      

    },

    calculoCuotasValla: function(e,terreno){
      console.log(e.target, e.target.value, terreno.vallas_count, this.terreno.forma_pago,'old',this.old,'lll',typeof(this.old),this.old);
      if(this.terreno.forma_pago==='null'){
        this.terreno.forma_pago = '1';
      }
     
      if (e.target.value==="xValla"){
        if(this.old.importe_periodo===0){
          this.old['importe_periodo'] = terreno.importe_periodo;
          this.old['alquiler_anual'] = terreno.alquiler_anual;
        }
      
        if (terreno.vallas_count){
          this.terreno.alquiler_anual = terreno.vallas_count;
          this.terreno.importe_periodo = terreno.vallas_count/this.terreno.forma_pago
          
        }

        //this.alquiler_anual = this.terr
      }else {
        console.log('elseeeee',this.old);
         if(this.old.importe_periodo>0){
          this.terreno.alquiler_anual = this.old['alquiler_anual'];
          this.terreno.importe_periodo =this.old['importe_periodo']
         }
      }

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
        step === "enviar" &&
        (!this.terreno.dni ||
          !this.terreno.nombre ||
          !this.terreno.direccion ||
          !this.terreno.postal ||
          !this.terreno.poblacion ||
          !this.terreno.provincia ||
          !this.terreno.telefono ||
          !this.terreno.email)
      ) {
        swal({
          type: "error",
          title: "Error...",
          text: "Todos los campos son obligatorios , por favor completelos ",
        });
        return;
      }
      /*  if(step === 'enviar' ){
                          //  this.geocoderAddres(this.valla.direccion);
            // this.guardarFormulario();
                console.log('enviar ', this.propietario.nombre,this.terreno.dni, this.terreno, this.propietario);
            } */

      if (
        step === "enviar" &&
        (!this.propietario.nombre || !this.terreno.dni)
      ) {
        swal({
          type: "error",
          title: "Error...",
          text: "Propietario y terreno obligatorio  ",
        });
        return;
      }
      if (step === "enviar") {
        //  this.geocoderAddres(this.valla.direccion);
        this.guardarFormulario();
      }

      this.currentstep = step;
    },

    cargarDatosTerreno(v) {
      console.log("cargarDatos", v);
      let me = this;

      var url = "/api/terreno/datos/" + v.id;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.terreno = response.data.terreno;
          me.propietario = me.terreno.propietario;

          console.log("datos terreno", me.terreno, me.propietario);
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    guardarFormulario() {
      console.log(
        "guardarFormulario",
     
      );
      let me = this;
    
      axios
        .post("/terreno/update", {
          data: {
            terreno: this.terreno,
          },
        })
        .then(function (response) {
          console.log("guardarFormulario", response, response.data);
          // me.$emit('modalR', 0)

          me.terrenoEnviado = response.data;
          console.log("guardarFormulario", me.terrenoEnviado, response.data);
          me.$emit("modalRecibido", { modal: "0" });
        })

        .catch((err) => {
          console.log("guardarFormulario", err);
          me.errores = err;
          me.currentstep = 4;
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },
  },
  computed: {},
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