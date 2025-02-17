
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
                        <i class="fa fa-align-justify"></i> Vallas
                        <button
                            v-if="modal ===0"
                            type="button"
                          @click="abrirModal('valla','registrar')"
                            class="btn btn-secondary"
                        >
                            <i class="icon-plus"></i>&nbsp;Nueva
                        
                        </button>
                         <button
                            v-else
                            type="button"
                          @click="listaVallas"
                            class="btn btn-secondary"
                        >
                            <i class="icon-plus"></i>&nbsp;Lista de Vallas
                        
                        </button>

                    </div>
              
                  
                    <div class="card-body" v-if="modal === 1"
                            :modal ="modal">
                          
                        <vallas-modal 
                         @modalR="modal">
                            ></vallas-modal>
                    </div>
                     <div class="card-body" v-else-if="modal === 2"
                       
                            >
                          
                        <vallas-editar
                           :modal="modal"
                           :vallaE="vallaE"
                         >
                            ></vallas-editar>
                    </div>

                     <div class="card-body" v-else>
                        <div  class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    
                                    <input type="text" v-model="buscar" @keyup.enter="listarValla(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarValla(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped table-sm">
                              <thead>
                                  <tr>
                                      <th>Opciones</th>
                                      <th>Propietario</th>
                                      <th>Terrerno</th>
                                      <th>Referencia</th>
                                      <th>Descripcion</th>
                                      <th>Direccion</th>
                                      <th>Poblacion</th>
                                      <th>Postal</th>
                                      <th>Provincia</th>
                                      <th>Telefono</th>
                                      <th>Tipo</th>
                                      <th>Elemento</th>
                                      <th>Estado</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <tr v-for="valla in arrayValla" :key="valla.id">

                                      <td><button
                                          type="button"
                                          @click="editarValla(valla)"
                                          class="btn btn-success btn-sm"
                                      >
                                          <i class="icon-eye"></i>
                                      </button>
                                      <button v-if="valla.baja===1"
                                          type="button"
                                          @click="borrarValla(valla.id)"
                                          class="btn btn-danger btn-sm"
                                      >
                                          <i class="icon-trash"></i>
                                      </button>
                                      <button v-else
                                          type="button"
                                          @click="altaValla(valla.id)"
                                          class="btn btn-success btn-sm"
                                      >
                                          <i class="icon-trash"></i>
                                      </button>


                                      </td>  
                                      <td v-text="valla.propietario"></td>
                                      <td v-text="valla.terreno"></td>
                                      <td v-text="valla.dni"></td>
                                      <td v-text="valla.nombre"></td>
                                      
                                      <td v-text="valla.direccion"></td>
                                      <td v-text="valla.poblacion"></td>
                                      <td v-text="valla.postal"></td>
                                      <td v-text="valla.provincia"></td>
                                      <td v-text="valla.telefono"></td>
                                      <td v-text="valla.tipo"></td>
                                      <td v-text="valla.elemento"></td>
                                    <!--  <td v-text="valla.estado"></td> -->
                                      
                                      <td>
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
                                          
                                      </td>
                                  </tr>                                
                              </tbody>
                          </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
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
import VallasModal from './VallasModal.vue';
    export default {
  components: { VallasModal },
        //props : ['ruta'],
        data (){
            return {
              vallaE : [],
              modoEdicion: false,
                valla_id: 0,
                nombre : '',
                descripcion : '',
                arrayValla : [],
                modal : 0,
                modalAltaValla: 0,

                tituloModal : '',
                tipoAccion : 0,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',


      

            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {

    borrarValla(id) {
      swal({
        title: "Esta seguro de anular esta Valla ?",
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
            .put("/valla/eliminar", {
              id: id,
            })
            .then(function (response) {
              swal(
                "Anulado!",
                "Valla Eliminada con exito.",
                "success"
              );
               me.listarValla(1,me.buscar,me.criterio);
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

    altaValla(id) {
      swal({
        title: "Esta seguro de ACTIVAR esta Valla ?",
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
            .put("/valla/activar", {
              id: id,
            })
            .then(function (response) {
              swal(
                "ACTIVADA!",
                "Valla ACTIVADA con exito.",
                "success"
              );
               me.listarValla(1,me.buscar,me.criterio);
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
          editarValla(v){
            let me =this;
            me.modal = 2 ; 
            me.vallaE = v ;
            console.log('editarValla',this.modal,v, me.vallaE);

          },
          

          listaVallas(){
            console.log('listaVallas');
            this.modal = 0;
              this.listarValla(1,this.buscar,this.criterio);
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
                  case "valla": {
                    switch (accion) {
                      case "registrar": {
                        console.log(
                          "valla REGISTRAR",
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

          listarValla (page,buscar,criterio){
                let me=this;
                //var url= this.ruta + '/valla?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                var url= '/vallas?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayValla = respuesta.vallas.data;
                    me.pagination= respuesta.pagination;
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
            },

          cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarValla(page,buscar,criterio);
            }
        },
        mounted() {
            
            this.listarValla(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
  
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
