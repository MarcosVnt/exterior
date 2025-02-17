<template>
  <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/">Escritorio</a>
      </li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Usuarios
          <button
            type="button"
            @click="abrirModal('persona','registrar')"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criterio">
                  <option value="name">Nombre</option>
                  <option value="email">Email</option>
                </select>
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarPersona(1,buscar,criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarPersona(1,buscar,criterio)"
                  class="btn btn-primary"
                >
                  <i class="fa fa-search"></i> Buscar
                </button>
              </div>
            </div>
          </div>

          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th>Opciones</th>

                <th>Email</th>
                <th>Usuario</th>
                <th>Role</th>
                <th>Situación</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="persona in arrayPersona" :key="persona.id">
                <td>
                  <button
                    type="button"
                    @click="abrirModal('persona','actualizar',persona)"
                    class="btn btn-warning btn-sm"
                  >
                    <i class="icon-pencil"></i>
                  </button> &nbsp;
                  <template v-if="persona.condicion">
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="desactivarUsuario(persona.id)"
                    >
                      <i class="icon-trash"></i>
                    </button>
                  </template>
                  <template v-else>
                    <button
                      type="button"
                      class="btn btn-info btn-sm"
                      @click="activarUsuario(persona.id)"
                    >
                      <i class="icon-check"></i>
                    </button>
                  </template>

                  <button
                    type="button"
                    class="btn btn-info btn-sm"
                    @click="abrirModal('horario','registrar',persona)"
                  >
                    <i class="icon-clock"></i>
                  </button>
                </td>

                <td v-text="persona.email"></td>
                <td v-text="persona.name"></td>
                <td v-text="persona.rol_id"></td>
                <td>
                  <div v-if="persona.condicion">
                    <span class="badge badge-success">Activo</span>
                  </div>
                  <div v-else>
                    <span class="badge badge-danger">Desactivado</span>
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
                  @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                >Ant</a>
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
                  @click.prevent="cambiarPagina(page,buscar,criterio)"
                  v-text="page"
                ></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                >Sig</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="email-input">Email</label>
                <div class="col-md-9">
                  <input type="email" v-model="email" class="form-control" placeholder="Email" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="idrol-input">Role</label>
                <div class="col-md-9">
                  <select v-model="idrol" class="form-control">
                    <option value="0" disabled>Seleccione</option>
                    <option
                      v-for="role in arrayRol"
                      :key="role.id"
                      :value="role.id"
                      v-text="role.nombre"
                    ></option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="usuario-input">Usuario</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="usuario"
                    class="form-control"
                    placeholder="Nombre del usuario"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="password-input">password</label>
                <div class="col-md-9">
                  <input
                    type="password"
                    v-model="password"
                    class="form-control"
                    placeholder="password del usuario"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 form-control-label">OPCIONES DE USUARIO</label>
              </div>
              <!--  CAMPOS 2 -->
              <div class="form-group row">
                <label
                  class="col-md-3 form-control-label"
                  for="visualId-input"
                >Código Operario en Visual-NT</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="visualId"
                    class="form-control"
                    placeholder="Codigo de Operario en Visual-NT"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label
                  class="col-md-3 form-control-label"
                  for="tecladoId-input"
                >password para acceso por Teclado</label>
                <div class="col-md-9">
                  <input
                    type="password"
                    v-model="tecladoId"
                    class="form-control"
                    placeholder="password del usuario para acceso por teclado"
                  />
                </div>
              </div>

              <div v-show="errorPersona" class="form-group row div-error">
                <div class="text-center text-error">
                  <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
            <button
              type="button"
              v-if="tipoAccion==1"
              class="btn btn-primary"
              @click="registrarPersona()"
            >Guardar</button>
            <button
              type="button"
              v-if="tipoAccion==2"
              class="btn btn-primary"
              @click="actualizarPersona()"
            >Actualizar</button>

            
             <!--  @click="tecladoCodigoExiste(id,tecladoId)" -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

    <!--Inicio del modal  HORARIO agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modalHorario}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModalHorario"></h4>
            <button type="button" class="close" @click="cerrarModalHorario()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> -->
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="usuario-input">Usuario</label>
              <div class="col-md-9">
                <input
                  type="text"
                  v-model="turno.usuario"
                  class="form-control"
                  placeholder="Usuario"
                  readonly
                />
              </div>
            </div>
            <!--   <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="horaInicio-input">Hora Inicio</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="horaInicio" class="form-control" placeholder="Hora Inicio" >

                                        
                                    </div>
            </div>-->

            <div class="form-group row">
              <div class="form-group col-sm-3">
                <label for="horad">Hora Inicio</label>
                <vue-timepicker v-model="horaInicio" format="HH:mm" :minute-interval="10"></vue-timepicker>
                <!--  <span class="text-danger" v-text="horaInicio"></span> -->
                <!--                   v-bind:style="{'display:none' : okHoraInicio}"
                -->
                <span
                  class="text-danger"
                  v-if="validationErrors.horaInicio"
                  v-text="validationErrors.horaInicio"
                ></span>
              </div>

              <div class="form-group col-sm-3">
                <label for="horaf">Hora Fin</label>
                <vue-timepicker v-model="horaFin" format="HH:mm" :minute-interval="10">></vue-timepicker>
                <span
                  class="text-danger"
                  v-if="validationErrors.horaFin"
                  v-text="validationErrors.horaFin"
                ></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
              <div class="col-md-9">
                <input
                  type="text"
                  v-model="turno.descripcion"
                  class="form-control"
                  placeholder="Descripcion"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="email-input">Observaciones</label>
              <div class="col-md-9">
                <input
                  type="text"
                  v-model="turno.observaciones"
                  class="form-control"
                  placeholder="Observaciones"
                />
              </div>
            </div>
            <div v-show="errorPersona" class="form-group row div-error">
              <div class="text-center text-error">
                <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
              </div>
            </div>
            <div class="form-group row">
              <button
                type="button"
                class="btn btn-primary ccol-md-12"
                @click="guardarTurno()"
              >Guardar Turno</button>
            </div>

            <!--    </form> -->

            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>Opciones</th>

                  <th>Hora Inicio</th>
                  <th>Hora Final</th>
                  <th>Descripcion</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="h in arrayHorarioUsuario" :key="h.id">
                  <td>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="borrarHorario(h.id)"
                    >
                      <i class="icon-trash"></i>
                    </button>
                  </td>

                  <!--  <td v-text="turno.usuario"></td> -->
                  <td v-text="h.hora_inicio"></td>
                  <td v-text="h.hora_fin"></td>
                  <td v-text="h.descripcion"></td>
                  <td v-text="h.observaciones"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModalHorario()">Cerrar</button>
            <!--   <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarHorario()">Guardar</button>
            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarHorario()">Actualizar</button>-->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
import VueTimepicker from "vue2-timepicker";
// import VueTimepicker from 'vue2-timepicker'
//var VueTimepicker = require('vue2-timepicker');

export default {
  components: {
    VueTimepicker
  },

  //props : ['ruta'],
  data() {
    return {
      tecladoExiste: false,
      visualId: 0,
      tecladoId: 0,
      okHoraInicio: false,

      horaInicio: {
        HH: "HH",
        mm: "mm"
      },
      horaFin: {
        HH: "HH",
        mm: "mm"
      },
      validationErrors: [],
      descripcion: "",
      observaciones: "",
      arrayHorarioUsuario: [],
      turno: [],

      persona_id: 0,
      nombre: "",
      tipo_documento: "",
      num_documento: "",
      direccion: "",
      telefono: "",
      email: "",
      usuario: "",
      password: "",
      idrol: "",
      arrayPersona: [],
      arrayRol: [],
      modal: 0,
      tituloModal: "",
      modalHorario: 0,
      tituloModalHorario: "",
      tipoAccion: 0,
      errorPersona: 0,
      errorMostrarMsjPersona: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      criterio: "nombre",
      buscar: ""
    };
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function() {
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
    }
  },
  methods: {
    borrarHorario(id) {
      swal({
        title: "Esta seguro de desactivar este Horario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;

          /* axios.put(this.ruta + '/user/desactivar',{ */
          axios
            .put("/horario/desactivar", {
              id: id
            })
            .then(function(response) {
              me.turnoListar(me.turno.usuario_id);
              swal(
                "Desactivado!",
                "El registro ha sido BORRADO con éxito.",
                "success"
              );
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    turnoListar(usuario) {
      console.log("TURNOLISTAR", usuario);
      let me = this;
      var url = "/turnos?&usuario=" + usuario;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;

          me.arrayHorarioUsuario = respuesta.turnosUsuario;
          console.log("TURNO LISTAR", respuesta);
          console.log("arrayHorarioUsuario" + me.arrayHorarioUsuario);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    guardarTurno() {
      console.log("GUARDAR TURNO : ");
      /* if (this.validarPersona()){
                    return;
                } */

      let me = this;

      axios
        .post("/horario/registrar", {
          usuario_id: this.turno.usuario_id,
          horaInicio: this.horaInicio,
          horaFin: this.horaFin,
          descripcion: this.turno.descripcion,
          observaciones: this.turno.observaciones
        })
        .then(function(response) {
          console.log("HORARIO REGISTRAR ", response);

          /*     me.horaInicio = me.horaFin;
                            me.horaFin = {}; */

          /*  me.horaInicio= {
                            HH: "HH",
                            mm: "mm"
                        },
                        me.horaFin= {
                            HH: "HH",
                            mm: "mm"
                        }, */
          // me.turno.descripcion = "";
          me.turno.observaciones = "";

          me.turnoListar(me.turno.usuario_id);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    onSelectHora(eventData) {
      console.log("changeHandler1", eventData);
      console.log("changeHandler2", eventData.h);
      console.log("changeHandler3", eventData.data.h);

      if (eventData.h && eventData.k && eventData.m) {
        console.log("changeHandler44444444444", eventData.h);

        this.okHoraInicio = true;
      }
    },
    // No argument
    changeHandler(eventData) {
      // eventData -> {data: {HH:..., mm:...}}
      console.log("changeHandler", eventData);
      console.log("changeHandler1", eventData);
      console.log("changeHandler2", eventData.h);
      console.log("changeHandler3", eventData.data.h);

      if (eventData.data.h && eventData.data.k && eventData.data.m) {
        this.okHoraInicio = true;
        console.log("changeHandler44444444444", this.okHoraInicio);
      }
    },

    // Customized arguments
    otherChangeHandler(eventData, arg1, arg2) {
      console.log("otherChangeHandler", eventData);

      // eventData -> {data: {HH:..., mm:...}}
      // arg1 -> 'foo'
      // arg2 -> 42
    },
    listarPersona(page, buscar, criterio) {
      let me = this;
      /* var url= this.ruta + '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio; */
      var url =
        "/user?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayPersona = respuesta.personas.data;
          me.pagination = respuesta.pagination;
          console.log(respuesta);
          console.log("pagination" + response);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    selectRol() {
      let me = this;
      /* var url= this.ruta + '/rol/selectRol'; */
      var url = "/rol/selectRol";
      axios
        .get(url)
        .then(function(response) {
          console.log("SLECT ROL", response);
          var respuesta = response.data;
          me.arrayRol = respuesta.roles;
          //console.log(me.arrayRol);
        })
        .catch(function(error) {
          console.log(error);
          if (error.response.status === 401) {
            window.location = "/login";
          }
        });
    },

    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarPersona(page, buscar, criterio);
    },
    registrarPersona() {
      if (this.validarPersona()) {
        return;
      }

      let me = this;

      /*     this.tecladoCodigoExiste(this.id,this.tecladoId);
        console.log('TECLADO EXSITE----',this.tecladoCodigoExiste(this.id,this.tecladoId)); */

      /* axios.post(this.ruta + '/user/registrar',{ */
      axios
        .post("/user/registrar", {
          nombre: this.nombre,
          tipo_documento: this.tipo_documento,
          num_documento: this.num_documento,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email,
          idrol: this.idrol,
          usuario: this.usuario,
          password: this.password,
          visual_id: this.visualId,
          teclado_id: this.tecladoId
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarPersona(1, "", "nombre");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarPersona() {
      // this.tecladoCodigoExiste(this.id,this.tecladoId);

        if (this.validarPersona()) {
        return;
      } 
      let me = this;

      //this.tecladoCodigoExiste(this.id,this.tecladoId));

      console.log(
        "ACTUALIZAR PERSONA  this.visualId : ",
        this.visualId,
        " tecladoId :",
        this.tecladoId
      );
      /* axios.put(this.ruta + '/user/actualizar',{ */
      axios
        .put("/user/actualizar", {
          /*  'nombre': this.nombre, */
          /*   'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono, */
          id: this.id,
          email: this.email,
          idrol: this.idrol,
          usuario: this.usuario,
          password: this.password,
          visual_id: this.visualId,
          teclado_id: this.tecladoId
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarPersona(1, "", "nombre");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    tecladoCodigoExiste(user, codigo) {
      console.log(
        "TELCADO EXISTE ",
        this.tecladoExiste,
        " me.errorMostrarMsjPersona",
        this.errorMostrarMsjPersona
      );

      // let this=this;
      //  this.errorMostrarMsjPersona=[];
      console.log("teclado codigo exsite User :", user, " tecladoId :", codigo);
      /* axios.put(this.ruta + '/user/actualizar',{ */
      var url = "/user/teclado?&usuario=" + user + "&codigo=" + codigo;
      axios
        .get(url)
        .then(function(response) {
            let mes = this;

            mes.observaciones='aaaa';
            console.log(this.observaciones);
        /*  // let me = this;

          console.log("TELCADO EXISTE ", response);
          console.log("TELCADO EXISTE ", response.data);
          console.log("TELCADO EXISTE ", response.data.flag);
          // me.tecladoExiste = response.data.flag;
          let flag = response.data.flag;

          console.log(
            "flag :::::::",
            flag,
            "TELCADO EXISTE ",
           
            " me.errorMostrarMsjPersona",
            this.errorMostrarMsjPersona
          );
          if (flag) this.tecladoExiste = true;

          if (this.tecladoExiste) {
            this.errorMostrarMsjPersona.push(
              "COdigo ya existe debe ser unico aaaa"
            );
            console.log(
              "si existe",
              this.tecladoExiste,
              " this.errorMostrarMsjPersona",
              this.errorMostrarMsjPersona
            );
          } else {
            console.log("nooooooooooo existe", this.tecladoExiste);
            this.errorMostrarMsjPersona.push(
              "COdigo ya existe debe ser unico aaaa"
            );
          /*   if (me.validarPersona()) {
              return;
            } */
           
         // } */
        })
        .catch(function(error) {
          console.log(error);
          // this.tecladoExiste = false;
        });
    },
    validarPersona() {
      this.errorPersona = 0;
      this.errorMostrarMsjPersona = [];
      let me = this;

      // let t = me.tecladoCodigoExiste(me.id,me.tecladoId);

      console.log(
        "USER",
        me.id,
        "teclado",
        me.tecladoId,
        "t:::::",
        "teclado",
        this.tecladoExiste
      );

      // if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la pesona no puede estar vacío.");

      if (this.tecladoExiste)
        this.errorMostrarMsjPersona.push(
          "COdigo ya existe debe ser unico ...."
        );

      if (this.visualId.length > 6)
        this.errorMostrarMsjPersona.push(
          "Longitud de codigo visual Incorrecta"
        );
      if (this.tecladoId.length > 6)
        this.errorMostrarMsjPersona.push(
          "Longitud de codigo teclado Incorrecta"
        );

      if (!this.usuario)
        this.errorMostrarMsjPersona.push(
          "El nombre de usuario no puede estar vacío."
        );
      if (!this.email)
        this.errorMostrarMsjPersona.push(
          "Email de usuario no puede estar vacío."
        );

      if (!this.password && this.tipoAccion == 1)
        this.errorMostrarMsjPersona.push(
          "Password del usuario no puede estar vacía."
        );
      if (this.idrol == 0)
        this.errorMostrarMsjPersona.push("Seleccione una Role.");
      if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

      return this.errorPersona;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.nombre = "";
      this.tipo_documento = "DNI";
      this.num_documento = "";
      this.direccion = "";
      this.telefono = "";
      this.email = "";
      this.usuario = "";
      this.password = "";
      this.idrol = 0;
      this.errorPersona = 0;
    },
    cerrarModalHorario() {
      console.log("CERRARMODALHORARIO", this.turno);
      this.modalHorario = 0;
      this.tituloModalHorario = "";
      this.turno.usuario_id = 0;
      /*  this.horaFin = "";
      this.horaInicio = ""; */
      this.turno.descripcion = "";
      this.turno.observaciones = "";
      console.log("CERRARMODALHORARIO FIN");
    },
    abrirModal(modelo, accion, data = []) {
      this.selectRol();
      console.log(
        "ABRIRMODAL ",
        "modelo:",
        modelo,
        "accion:",
        accion,
        "data :",
        data
      );
      console.log("modal", this.modal, "modalHorario", this.modalHorario);

      switch (modelo) {
        case "persona": {
          switch (accion) {
            case "registrar": {
              console.log(
                "persona REGISTRAR",
                "modelo:",
                modelo,
                "accion:",
                accion
              );
              this.modal = 1;
              this.modalHorario = 0;
              this.tituloModal = "Registrar Usuario";

              this.id = 0;
              this.email = "";
              this.usuario = "";
              this.password = "";
              this.idrol = 0;
              this.tipoAccion = 1;
              this.tecladoId = 0;
              this.visualId = 0;
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
              this.modalHorario = 0;
              this.tituloModal = "Actualizar Usuario";
              this.tipoAccion = 2;
              this.id = data["id"];

              this.email = data["email"];
              this.usuario = data["name"];

              this.idrol = data["rol_id"];
              this.visualId = data["visual_id"];
              this.tecladoId = data["teclado_id"];

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
    desactivarUsuario(id) {
      swal({
        title: "Esta seguro de desactivar este usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;

          /* axios.put(this.ruta + '/user/desactivar',{ */
          axios
            .put("/user/desactivar", {
              id: id
            })
            .then(function(response) {
              me.listarPersona(1, "", "nombre");
              swal(
                "Desactivado!",
                "El registro ha sido desactivado con éxito.",
                "success"
              );
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    activarUsuario(id) {
      swal({
        title: "Esta seguro de activar este usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;

          /* axios.put(this.ruta + '/user/activar',{ */
          axios
            .put("/user/activar", {
              id: id
            })
            .then(function(response) {
              me.listarPersona(1, "", "nombre");
              swal(
                "Activado!",
                "El registro ha sido activado con éxito.",
                "success"
              );
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    }
  },
  mounted() {
    this.listarPersona(1, this.buscar, this.criterio);
  }
};
</script>

<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
  overflow: visible !important;
}
.modal .animation-content .modal-card {
  overflow: visible !important;
}

.modal-body {
  overflow: visible !important;
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
