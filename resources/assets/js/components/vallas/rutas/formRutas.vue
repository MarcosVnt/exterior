<template>
  <div
    class="modal fade"
    id="modalFormRutaVallas"
    tabindex="-1"
    :class="{ mostrar: ModalRuta }"
    role="dialog"
    aria-labelledby="myModalLabel"
    style="display: none"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="loading" style="display: none">
          <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
          </div>
        </div>

        <div class="modal-header">
          <h4 class="modal-title" v-text="Titulo"></h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            @click="cerrarModal()"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row"></div>
          <div class="row">
            <div class="col-md-3 col-sm-4"></div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label class="control-label" for="descripcion"
                  >Descripcion</label
                >
                <input
                  type="text"
                  v-model="rutaValla.descripcion"
                  id="descripcion"
                  name="descripcion"
                  class="rm-width form-control"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label class="control-label" for="email"
                  >Email (para varios email separar por punto y coma ; )</label
                >
                <input
                  type="text"
                  v-model="rutaValla.email"
                  id="email"
                  name="email"
                  class="rm-width form-control"
                />
              </div>
            </div>
          </div>
          <div class="form-group row border">
            <div class="col-md-4">
              <div class="form-group">
                <label>Fecha Inicio</label>
                <input
                  type="date"
                  class="form-control"
                  v-model="rutaValla.fecha_inicio"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Fecha Final</label>
                <input type="date" class="form-control" v-model="fechaFinal" />
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal"
            @click="cerrarModal()"
          >
            Cerrar
          </button>
          <button
            type="button"
            v-if="TipoAccion == 1"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="guardarModal()"
          >
            Guardar
          </button>
          <button
            type="button"
            v-if="TipoAccion == 2"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="actualizarModal()"
          >
            Actualizar
          </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</template>

<script>
import moment from "moment";

export default {
  name: "FormRutasComponente",

  props: {
    ModalRuta: Number,
    rutaSelect: Object,
    modo: String,
  },

  data() {
    return {
      modalcomponente: 1, // true se muestra
      tituloModal: "Alta Ruta de Vallas Publicitarias",
      //rutaVallaRecibida: {},
      //    rutaVallaRecibida: this.rutaSelect ? this.rutaSelect : {},

      rutaValla: {
        descripcion: "",
        email: "",
        fecha_inicio: "",
        fecha_final: "",
      },
      fechaFinal: "",
      TipoAccion: 1,
      Titulo: "Alta de Rutas de Vallas",
    };
  },
  created() {
    console.log("1103  formRutas", this.modo, this.rutaSelect);

    if (this.modo === "editar") {
      console.log("1103  formRutas editar", this.modo, this.rutaSelect);

      this.rutaValla = this.rutaSelect;
    } else {
      console.log("1103  formRutas else ", this.modo, this.rutaSelect);
    }
  },

  mounted() {
    console.log("1303");
    this.fechaFinal = this.formatFecha(this.rutaSelect.fecha_final);
  },

  methods: {
    formatFecha(fecha) {
      // Formatea la fecha al formato "YYYY-MM-DD"
      console.log("1303", fecha);
      let fechaObj;
      if (!fecha) {
        fechaObj = new Date();
      } else {
        fechaObj = new Date(fecha);
      }

      return fechaObj.toISOString().slice(0, 10);
    },

    formattedFechaFinal() {
      console.log("1303");
      // Formatear la fecha para que coincida con el formato aceptado por el campo "date"
      const fechaFinal = new Date(this.rutaValla.fecha_final);
      console.log("1303", fechaFinal, fechaFinal.toISOString().slice(0, 10));
      return fechaFinal.toISOString().slice(0, 10);
    },

    inicializar() {
      this.rutaVallaRecibida = this.rutaValla;

      this.rutaValla = {
        descripcion: "",
        email: "",
        fecha_inicio: "",
        fecha_final: "",
      };
    },
    cerrarModal() {
      this.modalcomponente = 0;
      console.log("cerrarMOdal", this.modalcomponente, this.rutaVallaRecibida);
      this.$emit("cerrarModal", this.rutaVallaRecibida);
    },
    guardarModal() {
      let me = this;

      if (!me.rutaValla.descripcion) {
        swal({
          type: "error",
          title: "Error...",
          text: "Descripcion obligatoria",
        });
        me.modalcomponente = 1;

        return;
      }
      if (!me.rutaValla.fecha_inicio) {
        swal({
          type: "error",
          title: "Error...",
          text: "Fecha obligatoria",
        });
        me.modalcomponente = 1;

        return;
      }
      console.log("1103 guardarMOdal", this.modo);
      if (this.modo === "editar") {
        console.log("1103 guardarMOdal if", this.modo);

        axios
          .post("/ruta-vallas/update", {
            id: me.rutaValla.id,
            descripcion: me.rutaValla.descripcion,
            email: me.rutaValla.email,
            fechaInicio: me.rutaValla.fecha_inicio,
            fechaFinal: me.fechaFinal,

            // fechaFinal : me.rutaValla.fecha_final ,
          })
          .then(function (response) {
            var rutaVallaR = response.data.rutaValla;

            console.log("1103", rutaVallaR, response.data);
            swal("Actualizada!", "Ruta ha sido creada con éxito.", "success");
            me.inicializar();
            me.cerrarModal();

            // me.$parent.guardarPresupuesto();
          })
          .catch(function (error) {
            console.log(error);
            axios.post("/log-error", {
              type: "error",
              message: error,
              stack: "form-rutas actualizar ruta-vallas",
            });
            /*  if (error.response.status === 401 || error.response.status === 419) {
                      window.location = "/login";
                      }*/
          });
      } else {
        console.log("1103 guardarMOdal else", this.modo);
        axios
          .post("/ruta-vallas/create", {
            descripcion: me.rutaValla.descripcion,
            email: me.rutaValla.email,
            fechaInicio: me.rutaValla.fecha_inicio,
            fechaFinal: me.rutaValla.fecha_final,
          })
          .then(function (response) {
            var rutaVallaR = response.data.rutaValla;

            console.log("1103", rutaVallaR, response.data);
            swal("Insertado!", "Ruta ha sido creada con éxito.", "success");
            me.rutaValla = response.data.rutaValla;
            me.inicializar();
            me.cerrarModal();

            // me.$parent.guardarPresupuesto();
          })
          .catch(function (error) {
            console.log(error);
            axios.post("/log-error", {
              type: "error",
              message: error,
              stack: "form-rutas crear ruta-vallas",
            });
            /*  if (error.response.status === 401 || error.response.status === 419) {
                    window.location = "/login";
                    }*/
          });
      }
    },
  },

  watch: {
    modo(newVal, oldVal) {
      console.log(`1103  valor: ${newVal}, Viejo valor: ${oldVal}`);
      // Puedes realizar acciones basadas en los cambios en myValue aquí

      if (newVal === "editar") {
        console.log("1103  formRutas editar", this.rutaSelect);
        this.rutaValla = this.rutaSelect;
      } else {
        this.rutaValla = {};
        this.rutaSelect.fecha_final = new Date();

        console.log("1103  formRutas else ", this.modo, this.rutaSelect);
      }
    },
  },
};
</script>


<style>
.form-control {
  font-weight: bold;
}

.form-actions.stuck {
  position: fixed;
  bottom: 0;
  width: 100%;
  margin-left: -15px;
  margin-bottom: 0;
  z-index: 5;
  border-radius: 0;
}
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}

.table-responsive::-webkit-scrollbar {
  background: lightyellow;
  width: 12px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: gray;
}

.table-responsive {
  overflow-x: auto !important;
}

.modal-dialog {
  max-width: 90% !important;
}
.table-responsive > .fixed-column {
  right: 0;
  top: 0px;
  background: #f4f4f4;
  position: absolute;

  display: inline-block;
  width: auto;
  border-top: 0px solid;
  border-left: 1px solid #808080;
}

.nav-tabs .nav-link.active {
  border-top-color: #3c8dbc !important;
  border-top: 3px solid transparent;
}
.modal-content {
  /* width: 600px !important;*/
  width: 100% !important;
  position: absolute !important;

  /*  display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 10px;
    background-color: transparent;
    z-index: 1060; */
  /*     overflow-x: hidden;
 */
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  background-color: #3c29297a !important;
  position: absolute !important;
  background-color: #3c29297a !important;
  /* display: none;
    position: relative;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 32em;
    max-width: 100%;
    padding: 1.25em;
    border-radius: .3125em;
    background-color: #fff;
    font-family: inherit;
    font-size: 1rem;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    overflow-x: hidden;
    overflow-y: auto */
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
@media (min-width: 600px) {
  .btnagregar {
    margin-top: 2rem;
  }
}
</style>