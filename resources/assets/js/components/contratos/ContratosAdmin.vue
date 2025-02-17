<template>
  <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Contratos
          <button
            v-if="modal === 0"
            type="button"
            @click="abrirModal('contrato', 'registrar')"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
          <button
            v-else
            type="button"
            @click="listaContratos"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Lista de Contratos
          </button>
        </div>

        <div class="card-body" v-if="modal === 1" :modal="modal">
          <contratos-modal @modalR="modal"> ></contratos-modal>
        </div>
        <div class="card-body" v-else-if="modal === 2">
          <contratos-editar-todo
            :modal="modal"
            :contratoE="contratoE"
            @modalRecibido="modalRecibido"
          >
            ></contratos-editar-todo
          >
        </div>

        <div class="card-body" v-else>
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarContrato(1, buscar, criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarContrato(1, buscar, criterio)"
                  class="btn btn-primary"
                >
                  <i class="fa fa-search"></i> Buscar
                </button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>Opciones</th>
                  <th>Cliente</th>
                  <th>Anunciante</th>
                  <th>Terreno</th>

                  <th>Valla</th>
                  <th>Valla Ref.</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Final</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="contrato in arrayContrato" :key="contrato.id">
                  <td>
                    <button
                      type="button"
                      @click="editarContrato(contrato)"
                      class="btn btn-success btn-sm"
                    >
                      <i class="icon-eye"></i>
                    </button>
                    <button
                      type="button"
                      @click="borrarContrato(contrato.id)"
                      class="btn btn-danger btn-sm"
                    >
                      <i class="icon-trash"></i>
                    </button>
                      

                    <button
                      v-if="contrato.baja === 1"
                      type="button"
                      @click="finContrato(contrato.id,2)"
                      class="btn btn-warning btn-sm"
                    >
                      FIN DE CONTRATO
                    </button>
                    <button
                      v-else
                      type="button"
                      @click="altaContrato(contrato.id,1)"
                      class="btn btn-success btn-sm"
                    >
                      ALTA DE CONTRATO
                    </button>

                  </td>
                  <!--  <td v-text="contrato.cliente['nombre']"></td>
                                      <td v-text="contrato.agencia['nombre']"></td>
                                      <td v-text="contrato.valla['terreno_id'].terreno"></td>

                                      <td v-text="contrato.valla['nombre']"></td> -->

                  <td v-text="contrato.clienteNombre"></td>
                  <td v-text="contrato.agenciaNombre"></td>
                  <td v-text="contrato.terrenoNombre"></td>

                  <td v-text="contrato.vallaNombre"></td>
                  <td v-text="contrato.dni"></td>
                  <td type="date">
                    {{ contrato.fecha_inicio | fechaF }}
                  </td>

                  <td type="date">
                    {{ contrato.fecha_final | fechaF }}
                  </td>
                  <td>
                    {{ contrato.baja }}
                    <div v-if="contrato.baja === 1">
                      <span class="badge badge-success">Activo</span>
                    </div>
                    <div v-else-if="contrato.baja === 2">
                      <span class="badge badge-danger">Finalizado</span>
                    </div>
                    <div v-else>
                      <span class="badge badge-warning">Revisar</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                    cambiarPagina(pagination.current_page - 1, buscar, criterio)
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
                  @click.prevent="cambiarPagina(page, buscar, criterio)"
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
                    cambiarPagina(pagination.current_page + 1, buscar, criterio)
                  "
                  >Sig</a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
  </main>
</template>

<script>
import ContratosModal from "./ContratosModal.vue";
import moment from "moment";

export default {
  components: { ContratosModal },
  //props : ['ruta'],
  data() {
    return {
      contratoE: [],
      modoEdicion: false,

      arrayContrato: [],
      modal: 0,
      modalAltaContrato: 0,

      tituloModal: "",
      tipoAccion: 0,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "nombre",
      buscar: "",
    };
  },
  computed: {
    isActived: function () {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  filters: {
    fechaF: function (value) {
      //console.log('fecha-->',value);
      if (!value) return "";
      return moment(String(value)).format("DD/MM/YYYY");
    },
  },

  methods: {

    altaContrato(id,estado) {
       
      swal({
        title: "Activamos Contrato?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .put("/contrato/activar", {
              id: id,
              estado: estado,
            })
            .then(function (response) {
              swal("Activado!", "Contrato Activado con exito.", "success");
              me.listarContrato(1, me.buscar, me.criterio);
            })
            .catch(function (error) {
              console.log(error);
              if (
                error.response.status === 401 ||
                error.response.status === 419
              ) {
                window.location = "/login";
              }
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    }, 
    finContrato(id,estado) {
       
      swal({
        title: "Finalizamos Contrato?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .put("/contrato/finalizar", {
              id: id,
              estado: estado,
            })
            .then(function (response) {
              swal("Anulado!", "Contrato Eliminada con exito.", "success");
              me.listarContrato(1, me.buscar, me.criterio);
            })
            .catch(function (error) {
              console.log(error);
              if (
                error.response.status === 401 ||
                error.response.status === 419
              ) {
                window.location = "/login";
              }
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    borrarContrato(id) {
      swal({
        title: "Esta seguro de anular esta Contrato ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .put("/contrato/eliminar", {
              id: id,
            })
            .then(function (response) {
              swal("Anulado!", "Contrato Eliminada con exito.", "success");
              me.listarContrato(1, me.buscar, me.criterio);
            })
            .catch(function (error) {
              console.log(error);
              if (
                error.response.status === 401 ||
                error.response.status === 419
              ) {
                window.location = "/login";
              }
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    editarContrato(v) {
      let me = this;
      me.modal = 2;
      me.contratoE = v;
      console.log("editarContrato", this.modal, v, me.contratoE);
    },

    listaContratos() {
      console.log("listaContratos");
      this.modal = 0;
      this.listarContrato(1, this.buscar, this.criterio);
    },
    modalRecibido(a) {
      console.log("modalRecibido");
      this.modal = a.modal;
      this.listaContratos();
    },

    abrirModal(modelo, accion, data = []) {
      //this.selectRol();
      console.log(
        "ABRIRMODAL ",
        "modelo:",
        modelo,
        "accion:",
        accion,
        "data :",
        data
      );

      switch (modelo) {
        case "contrato": {
          switch (accion) {
            case "registrar": {
              console.log(
                "contrato REGISTRAR",
                "modelo:",
                modelo,
                "accion:",
                accion
              );
              this.modal = 1;
              break;
            }
            case "actualizar": {
              console.log(
                "persona ACTUACLIZAR",
                "modelo:",
                modelo,
                "accion:",
                accion
              );
              this.modal = 1;
              break;
            }
          }
          break;
        }
        case "horario": {
          switch (accion) {
            case "registrar": {
              console.log(
                "HORARIO REGISTRAR",
                "modelo:",
                modelo,
                "accion:",
                accion
              );
              console.log(
                "data ",
                data,
                "data.id",
                data.id,
                "data",
                data["name"]
              );
              this.modalHorario = 1;
              this.modal = 0;
              this.tituloModalHorario = "Registrar Horario de Usuario";

              this.turno.usuario_id = data["id"];
              this.turno.usuario = data["name"];
              this.turno.email = data["email"];

              this.turno.hora_inicio = "";
              this.turno.hora_fin = "";
              this.turno.descripcion = "";
              this.turno.observaciones = "";
              this.tipoAccion = 3;

              this.turnoListar(data["id"]);

              break;
            }
            case "actualizar": {
              console.log("HORARIO ACTU", "modelo:", modelo, "accion:", accion);
              this.modalHorario = 1;
              this.modal = 0;
              this.tituloModalHorario = "Actualizar Horario de Usuario";

              this.tipoAccion = 4;
              this.id = data["id"];

              this.user_id = data["user_id"];
              this.hora_inicio = data["hora_inicio"];
              this.hora_fin = data["hora_fin"];
              this.descripcion = data["descripcion"];
              this.observaciones = data["observaciones"];

              break;
            }
          }
          break;
        }
        default:
          {
            console.log(
              "default default ",
              "modelo:",
              modelo,
              "accion:",
              accion
            );
          }
          console.log(
            "ABRIRMODAL FINNNNNNN ",
            "modelo:",
            modelo,
            "accion:",
            accion
          );
          console.log(
            "modal     FINNNNNNNNN",
            this.modal,
            "modalHorario",
            this.modalHorario
          );
      }
    },

    listarContrato(page, buscar, criterio) {
      let me = this;
      //var url= this.ruta + '/contrato?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      var url =
        "/contratos?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      // var url= '/demoBusqueda?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayContrato = respuesta.contratos.data;
          me.pagination = respuesta.pagination;
          console.log("listarcontrota", respuesta);
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarContrato(page, buscar, criterio);
    },
  },
  mounted() {
    this.listarContrato(1, this.buscar, this.criterio);
  },
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
</style>
