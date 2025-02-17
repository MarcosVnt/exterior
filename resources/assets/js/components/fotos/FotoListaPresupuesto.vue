<template>
  <div class="container gallery-container">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i>
 Gestor de Ficheros:
      </div>

      <div class="card-body">
        <div class="tz-gallery">
          <div class="row mb-3">
            <div
              class="col-md-4"
              v-for="(documento, index) in listaDocumentos"
              :key="documento.id"
             
             
            >
            <!--  v-on:remove="fotoDia.splice(fotoDia.id, 1)" -->
              <div class="card" id="`${fotoDia.imagen}`">
                <img :src="'/storage/'+`${documento.nombre}`" alt="Park" class="card-img-top" />
                <h5 class="card-title">{{documento.presupuesto_id}}</h5>
                <p class="card-text">{{documento.nombreObra}}.</p>
                <p class="card-text">{{documento.texto}}.</p>

                <button
                  type="submit"
                  v-on:click.prevent="borrarFoto(documento.id,index)"
                  class="btn btn-danger float-right"
                >Borrar {{documento.texto}}</button>
              </div>
            </div>
          </div>
        </div>
      </div>


      
    </div>

    <!--  https://codepen.io/georgia/pen/ZomRQj -->

    <!--     <h1 class="text-center">Fotos del Día : A</h1>
  
    
    <p class="page-description text-center">Fotos del Día....</p>
    <div class="tz-gallery">
  
        <div class="row mb-3">

            <div class="col-md-4" v-for="fotoDia in fotosDelDia" :key="fotoDia.id">
                <div class="card">
                    <img :src="`${fotoDia.imagen}`"  alt="Park" class="card-img-top">
                      <h5 class="card-title">{{fotoDia.codigoObra}}</h5>
                                <p class="card-text">{{fotoDia.nombreObra}}.</p>
                                <p class="card-text">{{fotoDia.texto}}.</p>
                </div>
            </div>
             
         
        </div>
  
    </div>
    -->
  </div>
</template>

<script>
export default {
  props: {
    // propiedad que se recibe de forma externa
    listaDocumentos: Array
  },
  data: function data() {
    return {};
  },
  methods: {
    borrarFoto: function borrarFoto(id, index) {
      var me = this;

      console.log('FOTO LISTA BORRAR FOTO ',id, 'index',index);

      swal({
        title: "Esta seguro de Borrar esta Foto?",
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
      }).then(function(result) {
        if (result.value) {

          axios
            .post("/foto/borrar", {
              id: id
            })
            .then(function(response) {
              //me.listarFotosObras();
                    console.log('FOTO LISTA BORRAR FOTO ',id, 'index',index);

              me.fotosDelDia.splice(index, 1);
              swal(
                "Eliminado!",
                "El registro ha sido desactivado con éxito.",
                "success"
              );
            })
            .catch(function(error) {
              //console.log(error);
              if (error.response.status === 401) {
                window.location = "/login";
              }
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    }
  },

  mounted: function mounted() {
    console.log('mounted foto lista ',this.fotosDelDia)

  }
};
</script>
<style>
.image {
  width: 100%;
  height: 250px;
  background-size: cover;
  background-position: center center;
  margin-bottom: 10px;
}
</style>
