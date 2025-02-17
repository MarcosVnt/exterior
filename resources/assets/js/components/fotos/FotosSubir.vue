<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ titulo }}</div>
          <div class="card-body">
            Pincha en el recuadro de abajo para adjuntar ficheros
            <vue-dropzone
              ref="dropzoneRef"
              id="dropzoneId"
              @vdropzone-complete="afterComplete"
              @vdropzone-success="correcto"
              @vdropzone-removed-file="eliminarFichero"
              @vdropzone-duplicate-file="archivoDuplicado"
              @vdropzone-error="error()"
              @vdropzone-thumbnail="miniaturas"
              @vdropzone-mounted="dropzoneMounted"
              :options="dropzoneOptions"
              :duplicateCheck="true"
            ></vue-dropzone>
            <!--     <button @click="removeAllFiles">Remove All Files</button> -->
            Espere a que se procesen los ficheros y pulse en finalizar para
            terminar
            <!--  <button @click="finalizar" class="btn btn-success float-right">
              Finalizar
            </button> -->
            <!--  <input type=button onClick="parent.location='file:///C:/Users/' " value='Users'> -->
          </div>

          <!-- ---------------- -->
          <!--          {{presupuestoDocumentosLista}}
  -->
<!-- LISTA MANUAL DE FICHEROS
 -->
          <div class="row" v-if="tipo==='FICHERO'">
            <div v-for="documento in presupuestoDocumentosLista2"
              :key="documento.id"
              class="col-lg-12" >
           

              <div class="input-group">
                <span class="input-group-addon">


                   <img v-if="documento.texto=='IMAGEN'"
                    class="img-responsive"
                    style="max-width: 100px"
                    :src="'./storage/' + documento.nombre"
                    alt="Rotuleon"
                    id="imagen"
                  /> 
                  <a v-else v-bind:href="'./storage/'+documento.nombre" target="_blank">{{ documento.slug }} </a>

                  <!-- <input type="checkbox" aria-label="..." /> -->
                </span>
                <input type="text" class="form-control" aria-label="..." />
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
          </div>
          <div class="row" v-else>
            <div v-for="documento in presupuestoImagenesLista2"
              :key="documento.id"
              class="col-lg-6" >

              <div class="input-group">
                <span class="input-group-addon">


                   <img v-if="documento.texto=='IMAGEN'"
                    class="img-responsive"
                    style="max-width: 100px"
                    :src="'./storage/' + documento.nombre"
                    alt="Rotuleon"
                    id="imagen"
                  /> 
                  <a v-else v-bind:href="'./storage/'+documento.nombre" target="_blank">{{ documento.slug }} </a>

<!--                   <input type="checkbox" aria-label="..." />
 -->                </span>
                <input type="text" class="form-control" aria-label="..." />
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
          </div>

        </div>
      </div>
      <!--   <carousel v-if="mostrarCarousel"
              :images="presupuestoImagenesLista">
              </carousel> -->
    </div>
  </div>
</template>
 
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone,
  },
  /*   props: ["codigoDeObra", "writtenByMe"],
   */
  props: {
    dropzoneOptions: Object,
    presupuestoImagenesLista: Array,
    presupuestoDocumentosLista: Array,
    tipo: String
  },

  data: function data() {
    return {
      presupuestoImagenesLista2: [],
      presupuestoDocumentosLista2: [],
      
      mostrarCarousel: false,
      titulo: "",
      is_destroying: false,
      /*obraCodigo: "",
      obraNombre: "",*/
      /*   dropzoneOptions: {},
        
      dropzoneOptions: {
        url: "/altafoto",
      
      } */
    };
  },
  computed: {
    //return this.pagination.current_page;ç
  },
  beforeDestroy() {
    // borra todos los ficheros al destruir dropzone
    this.is_destroying = true;
  },
  mounted() {
    this.inicio();

    const pre = this.dropzoneOptions;
    const pre2 = pre.params;
    const pre3 = pre2["id"];
    const pre4 = pre.params["id"];
  },
  methods: {
    inicio: function inicio() {
      let me = this;
      me.titulo = me.dropzoneOptions["params"]["texto"];

      me.presupuestoImagenesLista2 = me.presupuestoImagenesLista;
      me.presupuestoDocumentosLista2 = me.presupuestoDocumentosLista;
     


      me.anadirADrop(me.presupuestoImagenesLista2);
      me.anadirADrop(me.presupuestoDocumentosLista2);

      console.log("FOTOOBRADROPZONE -> INICIO ", me.obra, me.dropzoneOptions);
    },
    anadirADrop(que) {
      console.log("anadirAdrop 2301", que, que.length);

      for (var i = 0; i < que.length; i++) {
        var nombre = que[i]["slug"];
        var texto = que[i]["texto"];

        var ruta = this.dropzoneOptions["params"]["ruta"];

        // var file = { size: 123, name: 'nombre', type: "image/png" };
        //var url = "https://myvizo.com/img/logo_sm.png";
        //file['name'] = nombre;
        var file = {};

        file.size = 123;
        file.name = nombre;
        file.tye = "image/png";

        console.log(
          "anadirAdrop 2301 url",
          this.dropzoneOptions["params"]["tipo"],
          texto
        );
        //,nombre,'texto',texto,'ruta',ruta);
        //file,'filename,',file['name'],'./storage/'+que[i]['nombre']);

        var url = "./storage/" + que[i]["nombre"];

        // var url = que[i]['nombre'];

        if (this.dropzoneOptions["params"]["tipo"] === texto) {
          this.$refs.dropzoneRef.manuallyAddFile(file, url);
          console.log("anadirAdrop 2301 url fin", this.$refs.dropzoneRef);
        }

        //this.$refs.dropzoneRef.manuallyAddFile(file, url);

        console.log("anadirAdrop 2301 url fin", this.$refs.dropzoneRef);
        //url,i,que[i]['nombre']);
      }
    },

    listarFicherosImagenesPresupuestos() {
      var me = this;
      var i = this.$parent.cabecera.id;

      var url = "/presupuesto/documentacion?id=" + i;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;

          me.presupuestoImagenesLista2 = response.data.imagenes;
          me.presupuestoDocumentosLista2 = response.data.documentos;

          console.log(
            "2801 FOTOOBRADROPZONE -> INICIO ",
            me.presupuestoImagenesLista2,
            "MAS FINALIZAR"
          );

          me.finalizar();

          // me.cargado = true;
        })
        .catch(function (error) {});
    },

    archivoDuplicado(file) {
      console.log("archivoDuplicado 2301", file);
    },

    finalizar: function finalizar() {
      let fin = true;
      let i = this.presupuestoImagenesLista2;

      console.log(
        "2801  FOTOOBRADROPZONE - FINALIZAR",
        i
        //this.$refs,this.$refs.dropzoneRef
      );

      this.$emit("finalizar", i);
    },

    miniaturas(file, dataUrl) {
      console.log("FOTOOBRADROPZONE miniaturas", file, dataUrl);
    },

    eliminarFichero(file, error, xhr) {
      let me = this;
            var i = this.$parent.cabecera.id;


      if (this.is_destroying) {
        console.log("2801 eliminarFichero true", this.is_destroying);
        return;
      }
      console.log("2801  eliminarFichero false", this.is_destroying);

      console.log("FOTOOBRADROPZONE removedFile", file, file.name, error, xhr);

      //const xhrJSON = JSON.parse(file.xhr.response);
      axios
        .put("/presupuesto/documentacion/eliminar", {
          data: {
            documento: file.name,
            id: i,
          },
        })
        .then(function (response) {
          console.log("2801  eliminar mas listar", response);
          me.listarFicherosImagenesPresupuestos();
        })

        .catch((err) => {
          console.log(err);
        });

      console.log("FOTOOBRADROPZONE removedFile", file, "----XHR--");
      //this.$refs.dropzoneRef,this.$refs.dropzoneRef.dropzone.files);
      //this.$refs.dropzoneRef.del
    },

    error() {
      console.log(
        "FOTOOBRADROPZONE error",
        "DROPOPTIONS",
        this.dropzoneOptions
      );
    },

    removeAllFiles() {
      console.log(
        "FOTOOBRADROPZONE this.$refs.dropzone",
        "this.$refs.dropzoneRef"
      );
      // this.$refs.dropzone.removeAllFiles();
    },

    correcto() {
      console.log("2801 FOTOOBRADROPZONE correcto + listarficheros");

      this.listarFicherosImagenesPresupuestos();
    },

    afterComplete(file) {
      this.dropzoneOptions.params.slot = this.obra;

      console.log(
        "FOTOOBRADROPZONE",
        this.dropzoneOptions.params.slot,
        "CONSOLE.LGO",
        this.obra,
        file
      );
    },

    dropzoneMounted() {
      /*  this.files.forEach((file) => {
        const src = file.src
        const addFile = {
          data: file,
          name: file.name,
          size: file.size,
          accepted: true,
          type: file.type,
					dataUrl: file.src
        }
         }) */
      // this.$refs.myVueDropzone.dropzone.emit('addedfile', addFile)
      // this.$refs.myVueDropzone.dropzone.emit('thumbnail', addFile, src)
      //console.log('DEBUG')
      /*    console.log("FOTOOBRADROPZONE  dropzoneMounted",addFile,src);*/
    },
  },
  watch: {
    /*  codigoDeObra(value){
      console.log('FOTOOBRADROPZONE->WATCH ',value)
    } */
  },
};
</script>
