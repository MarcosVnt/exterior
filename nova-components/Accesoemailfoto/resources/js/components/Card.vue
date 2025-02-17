<template>
  <!-- <card class="flex">
    <div class="flex flex-wrap">
      <div id="obra" class="w-full h-12">
        <p class="mb-12 dim text-80 font-bold">Proyecto</p>

        <multiselect
          class="w-full h-12"
          v-model="obra"
          :options="obrasUsuario"
          :max-height="600"
          :custom-label="selectObra"
          placeholder="Seleccione una Obra"
          label="obra"
          required
          track-by="id"
        ></multiselect>
      </div>
    </div>

    <div class="flex mb-4">
      <p class="mb-2 dim text-80 font-bold">Introduzca email de colaborador para envío.</p>
      <input type="text" class="w-full form-control form-input form-input-bordered" v-model="email" />
      <div class="flex items-center mt-3" v-if=" ! loading">
        <a @click="sendEmail()" class="btn btn-default btn-primary">Enviar Email</a>
      </div>
    </div>

    
    <div class="mt-3" v-if="loading">
      <span class="font-bold dim text-80">Email enviado.</span>
    </div>
  </card> -->

  <card class="bg-gray-200 p-4 pb-8">
        <multiselect
          class="w-full h-12"
          v-model="obra"
          :options="obrasUsuario"
          :max-height="600"
          :custom-label="selectObra"
          placeholder="Seleccione una Obra"
          label="obra"
          required
          track-by="id"
        ></multiselect>

         <div class="p-4">
            <p class="mb-2 dim text-80 font-bold">Introduzca email de colaborador para envío.</p>
            <input type="text" class="w-full form-control form-input form-input-bordered" v-model="email" />
            <div class="flex items-center mt-3" v-if=" ! loading">
                <a @click="sendEmail()" class="btn btn-default btn-primary">Enviar Email</a>
            </div>
        </div>
        <div class="p-4" v-if="mensaje">
              
        </div>
            <hr>
            <div v-show="mensajes" class="col-md-12 div-error">
                                    <div class="text-center text-error">
                                        <div class="alert alert-danger" role="alert" v-for="error in mensajes" :key="error" v-text="error">

                                        </div>
                                    </div>
            </div>

    
</card>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
  components: {
    Multiselect
  },

  props: ["card"],
  data() {
    return {
      loading: false,
      email: null,
      proyecto: null,
      obrasUsuario: [],
      obra: [],
      obraDescripcion: "",
      obraCodigo: "",
      mensaje : "WWW",
      mensajes: ["DDDD"],
    };
  },

  mounted() {
    console.log(this.card);
    this.obrasUsuarioListar();
  },
  methods: {
    selectObra({ codigo, nombre }) {
      return `${codigo} - ${nombre}`;
    },
    obrasUsuarioListar: function obrasUsuarioListar() {
      var me = this;
      me.mensajes = [];

      var url = "/obrasusuario";

      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;

          me.obrasUsuario = respuesta.obrasUsuario;

          console.log("OBRASUSUARIOLISTAR ", response, me.obrasUsuario);
        })
        .catch(function(error) {
          if (error.response.status === 401) {
            
              axios.post('/log-error', {
                        type: 'Axios Request Failure',
                        message: error.response,
                        stack: error.stack || 'N/A',
                    });

            window.location = "/login";
          }
          me.mensaje = error.response;
          this.mensajes.push("ERROR :", me.mensaje);

          //console.log('UUUUNO -> ERROR',error,error.response,me.mensaje);
        });
    },

    sendEmail() {
      this.loading = true;
      this.mensajes = [];
      console.log('ENVIAR EMAIL ',this.email,this.obra.codigo, this.obra.nombre, this.obra.id);
      axios
        //.post("/nova-vendor/" + this.card.component + "/send-mail", {
            .post("/send-mail", {
          email: this.email,
          obraI: this.obra.id,
          obraD : this.obra.nombre,
          obraC : this.obra.codigo
        })
        .then(response => {
          this.loading = false;

          console.log('RESPONDIENDO DATOS :',response, response.data, response.data.code);
          if (response.status == 200) {
                this.mensajes.push("CORRECTO : Email enviado a : ",this.email , "para tramitar fotos de :", this.obra.codigo , "/", this.obra.nombre);
            //alert("Email ha sido enviado a :  " + this.email + this.obra);
          } else {
                this.mensajes.push("ERROR : en el envio de Email", response);
           // alert("Error enviando email");
          }
        })
        .catch(error => {
          this.loading = false;
          alert("Ha habido un error , email no enviado.",error);
        });
    }
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
