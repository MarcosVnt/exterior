<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Gestor de Fotos Rotuleon.</div>
          <div class="card-body">
            Pincha en el recuadro de abajo para adjuntar las fotos 
            <vue-dropzone
              ref="dropzoneRef"
              id="dropzoneId"
              @vdropzone-complete="afterComplete"
              :options="dropzoneOptions"
            ></vue-dropzone>
       <!--     <button @click="removeAllFiles">Remove All Files</button> -->
              Espere a que se procesen las fotos y pulse en finalizar para terminar
              <button  @click="finalizar" class="btn btn-success float-right">Finalizar </button>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
 
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone
  },
/*   props: ["codigoDeObra", "writtenByMe"],
 */
  props: {
   
    obra: Object,
  
  },

  data: function data() {
    return {

      obraCodigo:"",
      obraNombre: "",
     
      
      dropzoneOptions: {
        url: "/altafoto",
        /*  maxFilesize: 2, // MB
                maxFiles: 4,
                chunking: true,
                chunkSize: 500, // Bytes
                thumbnailWidth: 150, // px
                thumbnailHeight: 150, */
        addRemoveLinks: true,
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]")
            .content
        },
        params: {
          obraCodigo: this.obra.codigo,
          obraNombre: this.obra.nombre,

        }
      }
    };
  },
  computed: {
    //return this.pagination.current_page;ç
    
    
  },
  mounted() {
  
   this.inicio();

      /*       if(localStorage.getItem('codigoObraFoto') === null){


            }else{

                this.a = localStorage.getItem('codigoObraFoto' );
                this.dropzoneOptions.params.slot=  localStorage.getItem('codigoObraFoto' );
                this.dropzoneOptions.params.obra=  JSON.parse(localStorage.getItem('codigoObraFoto') );

            } */

   
    console.log('FOTOOBRADROPZ<ONE -> inicio ',
      this.obra,
      'DROPOPTIONS',this.dropzoneOptions
      
    );

    this.dropzoneOptions.params.codigoObra=this.obra.codigo;
     this.dropzoneOptions.acceptedFiles= 'image/*';
     console.log('FOTOOBRADROPZONE -> inicio 222222222',
      this.obra,
      'DROPOPTIONS',this.dropzoneOptions
      
    );



  },
  methods: {
    finalizar: function finalizar(){
      console.log('FOTOOBRADROPZONE - FINALIZAR');
      let fin = true;
                this.$emit('finalizar',fin);

    },
    inicio: function inicio() {
      let me = this;

      console.log('FOTOOBRADROPZONE -> INICIO ',me.obra,me.dropzoneOptions);

    },

    removeAllFiles() {
      console.log("FOTOOBRADROPZONE this.$refs.dropzone", "this.$refs.dropzoneRef");
      // this.$refs.dropzone.removeAllFiles();
    },
    afterComplete(file) {
      this.dropzoneOptions.params.slot=this.obra;

      console.log( "FOTOOBRADROPZONE",this.dropzoneOptions.params.slot,"CONSOLE.LGO",this.obra, file);
    }
  },
  watch: {
    codigoDeObra(value){
      console.log('FOTOOBRADROPZONE->WATCH ',value)
    }
  }
};
</script>
