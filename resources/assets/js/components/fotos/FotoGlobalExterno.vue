<template>
  <main class="main">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/">Escritorio</a>
      </li>
    </ol>

    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>
 Fotos Obra
        </div>

        <div class="card-body">
          <div class="form-row">
         <!--    <div class="form-group col-md-4">
              <label for="inputUsuario">Usuario</label>
              <input
                type="text"
                class="form-control"
                id="usuario"
                placeholder="Usuario"
                v-model="user"
                readonly
              />
            </div>
 -->
            <div class="form-group col-md-12">
              <label for="selectObrar">Obra seleccionada</label>

<!--               <input
                type="text"
                class="form-control"
                id="obraId"
                placeholder="obraId"
                v-model="obraId"
                readonly
              />
 -->
          <input
                type="text"
                class="form-control"
                id="obracodigo"
                placeholder="obracodigo"
                v-model="obraCodigo"
                readonly
              />

              <input
                type="text"
                class="form-control"
                id="obraNombre"
                placeholder="obraNombre"
                v-model="obraNombre"
                readonly
              />
            </div>

            <div class="col-md-12" v-if="obraMostrarListaFotos">
              <hr />
              <button type="button" @click="obraAnadirFotos(obraCodigo)" class="btn btn-success">
                <i class="icon-plus"></i>&nbsp;Añadir Fotos
              </button>
               <button type="button" @click="salir()" class="btn btn-danger pull-right">
                <i class="icon-ban-cicle"></i>&nbsp;Finalizar y Salir
              </button>
              
                          

              
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  <foto-cab
             @obraSeleccionada="obraSeleccionadaRecibida($event)"   
             @obraAnadirFoto="obraAnadirFotos($event)" 
             :anadirFoto ="fotoAnadir"
             
    ></foto-cab>-->

    <!-- recibo la obra obraSeleccionada
             @obraSeleccionada="changeActiveConversation($event)"
                recbio que quiero añadir fotos a una obra
            envio usuario 
            envio si anadirfosts false para que podamos hacer select
    -->

    <div v-if="obraMostrarListaFotos">
      <foto-lista :fotosDelDia="obrasFotosLista"></foto-lista>

      <!-- envio la obraSeleccionada y 
            consulto las fotos de hoy y de obra si hay..

      -->
    </div>

    <div v-else>
      <!--   <foto-alta
                    :obra ="obraRecibida"
                >
      </foto-alta>-->
      <foto-obra-dropzone @finalizar="finalizarSubirFotos" :obra="obraRecibida"></foto-obra-dropzone>
    </div>
  </main>
</template>

<script>
export default {
  props: {
    obra: String,
    user: String
  },

  data() {
    return {
      obrasFotosLista: [],
      obraRecibida: {},
      obraEnviada: "",
      obraMostrarListaFotos: true,
      fotoAnadir: false,
      obraNombre: "",
      obraCodigo: "",
      obraId:"",
    };
  },
  mounted() {
    console.log("MOUUUUUUUUUUUUUUNTED", this.obra, this.user);

    this.listarFotosObras();
  },

  methods: {
      salir () {

  axios
            .post("/logout"
            )
            .then(function(response) {
              //me.listarFotosObras();
                    console.log('SALIR EXTERNO ',response);

                    localStorage.removeItem('oi');
                    localStorage.removeItem('us');
                                     window.location = "/login";


            })
            .catch(function(error) {
              //console.log(error);
              if (error.response.status === 401) {
                window.location = "/login";
              }
            });

      },
    finalizarSubirFotos: function finalizarSubirFotos(fin) {
      console.log("FOTO GLOBAL 33333 - FINALIZAR ", fin, this.fotoAnadir);
      this.fotoAnadir = false;
      this.obraMostrarListaFotos = true;
      console.log(
        "FOTO GLOBAL 33333 - FINALIZAR ",
        fin,
        this.obraMostrarListaFotos
      );

      this.listarFotosObras();
      //this.$store.state.anadirFoto = false;
    },
    obraAnadirFotos(obra) {
      let me = this;
      me.fotoAnadir = true;

      me.obraMostrarListaFotos = true;
      console.log(
        "foto global - obraAnadir fotos ",
        obra,
        me.obraMostrarListaFotos
      );

      me.obraMostrarListaFotos = false;
    },
   
    listarFotosObras: function listarFotosObras() {
      var me = this;
        
         if(localStorage.getItem('oi') || localStorage.getItem('us')) {
             me.obra = localStorage.getItem('oi');
             me.user = localStorage.getItem('us');
         }


      var url = "/fotosobrasexterno?&o=" + me.obra + "&u=" + me.user;
      axios
        .get(url)
        .then(function(response) {
          //me.hayFotos = 0;
          var respuesta = response.data;
          //me.obrasUsuario();
          me.obrasFotosLista = respuesta.obraFoto;
          me.obraNombre = respuesta.obraNombre[0].nombre;
          me.obraId = me.obra;
          me.obraCodigo = respuesta.obraNombre[0].codigo;
          me.obraRecibida.codigo = me.obraCodigo;
          me.obraRecibida.nombre = me.obraNombre;
          localStorage.setItem('oi', me.obraId);
          localStorage.setItem('us', me.user);
          console.log(
            "FOTO GLOBAL -listar fotos obras **",
            respuesta,
            me.obraNombre,
            me.obrasFotosLista,
            me.obraRecibida,'fin'
          );

          if (me.obrasFotosLista.length > 0) {
            // me.hayFotos = 1;
          } else {
          }

          // me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          /*P  if (error.response.status === 401) {
                            window.location = "/login";
                        }
 */
        });
    }
  }
};
</script>
<style>
</style>
