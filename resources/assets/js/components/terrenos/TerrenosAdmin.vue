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
          <i class="fa fa-align-justify"></i> Terrenos : Nº TOTAL : ( {{maxDni}} )
          <button
            v-if="modal === 0"
            type="button"
            @click="abrirModal('terreno', 'registrar')"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
          <button
            v-else
            type="button"
            @click="listaTerrenos"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Lista de Terrenos
          </button>
        </div>

        <div class="card-body" v-if="modal === 1" :modal="modal">
          <terrenos-modal @modalR="modal"> ></terrenos-modal>
        </div>
        <div class="card-body" v-else-if="modal === 2">
          <terrenos-editar
            :modal="modal"
            :terrenoE="terrenoE"
            @modalRecibido="modalRecibido"
          >
            ></terrenos-editar
          >
        </div>
        <div class="card-body" v-else-if="modal === 3">
          <vallas-editar
            :modal="modal"
            :vallaE="vallaE"
            @modalRecibido="modalRecibido"
          >
            ></vallas-editar
          >
        </div>
          <div class="card-body" v-else-if="modal === 33">
          <vallas-editar
            :modal="modal"
            :vallaE="vallaE"
            @modalRecibido="modalRecibido"
          >
            ></vallas-editar
          >
        </div>
        <div class="card-body" v-else-if="modal === 4">
          <contratos-modal
            :modal="modal"
            
            @modalRecibido="modalRecibido"
          >
            ></contratos-modal
          >
        </div>
         <div class="card-body" v-else-if="modal === 5">
          <contratos-editar
            :modal="modal"
            :contratoE="contratoE"
            
            @modalRecibido="modalRecibido"
          >
            ></contratos-editar
          >
        </div>
        

        <div class="card-body" v-else>
          <div class="form-group row">
            <div class="col-md-3">
              <div class="input-group">
                <input
                  type="text"
                  v-model="buscarRef"
                  @keyup.enter="listarTerreno(1, buscarRef, 'referencia')"
                  class="form-control"
                  placeholder="Buscar Por Referencia"
                />
                <button
                  type="submit"
                  @click="listarTerreno(1, buscarRef, 'referencia')"
                  class="btn btn-primary"
                >
                  <i class="fa fa-search"></i> x Referencia
                </button>
              </div>
            </div>
         
         
            <div class="col-md-6">
              <div class="input-group">
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarTerreno(1, buscar, criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarTerreno(1, buscar, criterio)"
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
                  <th>Ref.</th>
                  <th>Nombre</th>
                  <th>direccion</th>
                  <th>Poblacion</th>
                  <th>Postal</th>

                  <th>Propietario</th>
                  <th>Nº Vallas</th>

                  <th>Nº Contratos</th>
                  <th>Ingresos Anuales</th>
                  
                  <th>Periodo</th>
                  <th>Importe Periodo</th>
                  <th>Gastos Anuales</th>
                  <th>Cálculo</th>

                  <th>Rentabilidad</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody v-for="terreno in arrayTerreno" :key="terreno.id">
                <tr class="table-success">
                  <td colspan="16">
                    <h5>
                    Terreno Nº {{ terreno.dni }} - {{ terreno.nombre }}
                    </h5>
                  </td>
                </tr>

                <tr>
                  <td>
                    <button
                      type="button"
                      @click="editarTerreno(terreno)"
                      class="btn btn-success btn-sm"
                    >
                      <i class="icon-eye"></i>
                    </button>

                    <!--  <button
                                          type="button"
                                          @click="borrarTerreno(terreno.id)"
                                          class="btn btn-danger btn-sm"
                                      >
                                   
                                          <i class="icon-trash"></i>
                                      </button> -->
                  </td>
                  <td v-text="terreno.dni"></td>
                  <td v-text="terreno.nombre"></td>
                  <td v-text="terreno.direccion"></td>

                  <td v-text="terreno.poblacion"></td>
                  <td v-text="terreno.postal"></td>
                  <td v-text="terreno.propietario.nombre"></td>

                  <td>
                    {{ terreno.vallas.length }}
                  </td>

                  <td>
                    <!-- {{terreno.contratos_count}} -->
                    {{ terreno.contratos.length }}
                  </td>
                  <td>
                    {{ +terreno.contratos_count }}
                  </td>
                

                  <td>
                   <select
                      class="form-control"
                      id="forma_pago"
                      v-model="terreno.forma_pago"
                      v-on:change="guardar(terreno)"
                      :disabled="true"
                    >
                      <option value="12">Mensual</option>
                      <option value="4">Trimestral</option>
                      <option value="2">Semestral</option>
                      <option value="1">Anual</option>
                      <option value="1">Otras</option>
                    </select> 
                   
                  </td>
                  <td>
                    <div class="">
                     <!--  <input
                        type="number"
                        v-model="terreno.importe_periodo"
                        class="form-control"
                        v-on:change="guardar(terreno)"
                      /> -->
                       {{ +terreno.importe_periodo }}
                    </div>
                  </td>

                  <td>
                    <!-- <input
                      type="number"
                      step="10"
                      v-model="terreno.alquiler_anual"
                      class="form-control"
                      v-on:change="guardar(terreno)"
                    /> -->
                    {{+terreno.alquiler_anual}} 

                  </td>
                    <td>
                    {{ terreno.calculo_costes }}
                  </td>
                  <td
                    v-text="
                      (
                        terreno.contratos_count - terreno.alquiler_anual
                      ).toFixed(2)
                    "
                  >
                    <!--   {{terreno.contratos_count-terreno.alquiler_anual}}  -->
                  </td>

                  <td>
                    {{ terreno.baja }}
                    <div v-if="terreno.baja === 1">
                      <span class="badge badge-success">Alta</span>
                    </div>
                    <div v-else-if="terreno.baja === 2">
                      <span class="badge badge-danger">Baja</span>
                    </div>
                    <!--  <div v-else>
                                              <span class="badge badge-warning">Revisar</span>
                                          </div> -->
                  </td>
                </tr>

                <!--  <tr  class="table-danger" v-if="terreno.vallas.length >0">  -->
                <tr class="table-danger">
                  <td colspan="8">
                    V A L L A S
                    <button
                      type="button"
                      @click="nuevaValla(terreno.id)"
                      class="btn btn-secondary btn-sm"
                    >
                      <i class="icon-plus"></i>
                    </button>
                  </td>
                  <td colspan="8" style="background-color: #d3eef6">
                    CONTRATOS
                    <button
                      type="button"
                      @click="nuevoContrato()"
                      class="btn btn-info btn-sm"
                    >
                      <i class="icon-plus"></i>
                    </button>
                  </td>
                </tr>

                <tr
                  v-for="valla in terreno.vallas"
                  :key="valla.id"
                  style="background-color= #1c6ea50f"
                >
                  <td></td>
                   <td>
                    <button
                      type="button"
                      @click="editarValla(valla)"
                      :class="[valla.baja === 2 ? bntWarning : btnSuccess]"
                    >
                      {{ valla.dni }}
                    </button>
                  </td>
                  <td colspan="2" v-text="valla.nombre"></td>
                 

                  <td>
                     <div v-if="valla.baja === 1">
                      <span class="badge badge-success">Alta</span>
                    </div>
                    <div v-else-if="valla.baja === 2">
                      <span class="badge badge-danger">Baja</span>
                    </div>
                  </td>
                  <td>Coste Terreno Valla</td>
                   <td colspan="1" >
                    {{ +valla.alquiler_anual}}
                   </td>

                  <td></td>
             

                  <td colspan="7">
                    <div
                      v-for="contrato in terreno.contratos"
                      :key="contrato.id"
                    >
                      <td v-if="valla.id === contrato.valla_id">
                        <button v-if="valla.id === contrato.valla_id"
                        type="button"
                      @click="editarContrato(contrato)"
                      :class="[contrato.baja === 2 ? bntCWarning : btnCSuccess]"
                     >
                            {{ contrato.fecha_final | fechaF }}
                        </button>

                      </td>
                      <!--  <td
                        v-if="valla.id === contrato.valla_id"
                        v-text="contrato.forma_pago"
                      ></td> -->
                       <td
                        v-if="valla.id === contrato.valla_id"
                      
                      >Ingresos Anual/Valla</td>

                      <td
                        v-if="valla.id === contrato.valla_id"
                        v-text="+contrato.alquiler_anual"
                      ></td>
                       <td
                        v-if="valla.id === contrato.valla_id">
                          <div v-if="contrato.baja === 1">
                            <span class="badge badge-success">Alta</span>
                          </div>
                          <div v-else-if="contrato.baja === 2">
                            <span class="badge badge-danger">Baja</span>
                          </div>
                      </td>
                      
                    </div>
                  </td>
                </tr>

                <!-- 
                                  <tr  class="table-info" v-if="terreno.contratos.length >0"> 
                                         <td colspan="12">C O N T R A T O S</td>
                                  </tr>                             
                                   <tr v-for="contrato in terreno.contratos" :key="contrato.id"
                                  style="background-color= #1c6ea50f"
                                  >
                                     <td></td>
                                      <td  v-text="contrato.referencia"></td>
                                      <td v-text="contrato.valla_id"></td>                                      <td></td>

                                      <td></td>
                                      <td></td>
                                      <td></td>

                                      <td></td>

                                      <td></td>
                                      <td></td>

                                      <td></td>
                                      <td></td>
                                      
                                      <td></td>
                                      
                                      <td></td>
                                     

                                   
                                      <td></td>


                                       
                                  </tr> -->

                <!--  <div v-if="terreno.contratos.length >0 ">
                                          {{ terreno.contratos}}
                                        </div> -->
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
import TerrenosModal from "./TerrenosModal.vue";
import VallasModal from "../vallas/VallasModal.vue";
import ContratosModal from "../contratos/ContratosModal.vue";
import ContratosEditar from "../contratos/ContratosEditar.vue";

import moment from "moment";

export default {
  components: { TerrenosModal, ContratosModal ,ContratosEditar},
  //props : ['ruta'],
  data() {
    return {
      maxDni: 0,
      btnSuccess: 'btn btn-secondary btn-sm',
      bntWarning: 'btn btn-warning btn-sm',
      btnCSuccess: 'btn btn-info btn-sm',
      bntCWarning: 'btn btn-warning btn-sm',
      vallaE: {},
      contratoE: {},
      terrenoE: [],
      modoEdicion: false,

      arrayTerreno: [],
      modal: 0,
      modalAltaTerreno: 0,

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
      buscarRef: "",
    };
  },
  computed: {
    calcularBeneficio: function (a, b) {
      return (a - b).toFixed(2);
    },
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
    number : function(value){
       if (!value) return "0";
      return value.toFixed(2);
    }
  },

  methods: {

    maxDNI() {
      axios.get('/terrenos/max-dni')
        .then(response => {
          this.maxDni = response.data.maxDni;
        })
        .catch(error => {
          console.error("Hubo un error al obtener el máximo DNI:", error);
        });
    },


    guardar(e) {
      console.log("aaaa", e);
      let me = this;

      axios
        .post("/terreno/update", {
          data: {
            terreno: e,
          },
        })
        .then(function (response) {
          console.log("guardarFormulario", response, response.data);
        })

        .catch((error) => {
          console.log("guardarFormulario", error);
          me.errores = error;
          me.currentstep = 4;
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    borrarTerreno(id) {
      swal({
        title: "Esta seguro de anular esta Terreno ?",
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
            .put("/terreno/eliminar", {
              id: id,
            })
            .then(function (response) {
              swal("Anulado!", "Terreno Eliminada con exito.", "success");
              me.listarTerreno(1, me.buscar, me.criterio);
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
    editarTerreno(v) {
      let me = this;
      me.modal = 2;
      me.terrenoE = v;
      console.log("editarTerreno", me.modal, v, me.terrenoE);
    },
    editarValla(v) {
      let me = this;
      me.modal = 33;
      me.vallaE = v;
      console.log("editarValla", this.modal, v, me.vallaE);
    },
    nuevaValla(v) {
      let me = this;
      me.modal = 3;
      me.vallaE = {};
      me.vallaE.terreno_id = v;

      console.log("nuveaValla", this.modal, v, me.vallaE);
    },
    nuevoContrato() {
      let me = this;
      me.modal = 4;
      console.log("nuevoCOntrato");
    },

    editarContrato(v) {
      let me = this;
      me.modal = 5;
      me.contratoE = v;
      console.log("editarContrato", me.contratoE,'v->',v);
    },

    listaTerrenos() {
      console.log("listaTerrenos");
      this.modal = 0;
      this.listarTerreno(1, this.buscar, this.criterio);
    },
    modalRecibido(a) {
      console.log("modalRecibido");
      this.modal = a.modal;
      this.listaTerrenos();
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
        case "terreno": {
          switch (accion) {
            case "registrar": {
              console.log(
                "terreno REGISTRAR",
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

    listarTerreno(page, buscar, criterio) {
      let me = this;
      //var url= this.ruta + '/terreno?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      var url =
        "/terrenos?page=" +
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

          console.log("-----", respuesta);

          me.arrayTerreno = respuesta.terrenos.data;
          console.log("-----", me.arrayTerreno);

          me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
          console.log(error,typeof(error));
           
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
      me.listarTerreno(page, buscar, criterio);
    },
  },
  mounted() {
    this.listarTerreno(1, this.buscar, this.criterio);
    this.maxDNI();
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
