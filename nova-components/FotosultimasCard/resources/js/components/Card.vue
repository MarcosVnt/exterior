<template>
  <div class="container">
    <card class="flex flex-wrap items-center justify-center">
      <div class="flex flex-wrap w-full">
        <div class="px-3 py-3 mt-4">
          <h1 class="text-center text-3xl text-80 font-light">
            Fotos ultimos trabajos ::: <!-- desde :{{ dia }} . -->
          </h1>
        </div>
      </div>
      <div class="flex flex-wrap w-full">
        <div class="bg-20 rounded-b">
          <nav
            class="flex justify-between items-center text-90 font-normal text-2xl"
          >
            <button
              rel="prev"
              dusk="previous"
              @click.prevent="
                cambiarPagina(pagination.current_page - 1, buscar, criterio)
              "
              class="btn btn-link py-3 px-4 text-80 dim"
            >
              Anterior
            </button>
            <span class="text-90 font-normal text-2xl">
              {{ pagination.from }}/{{ pagination.total }} resources
            </span>
            <button
              rel="next"
              dusk="next"
              @click.prevent="
                cambiarPagina(pagination.current_page + 1, buscar, criterio)
              "
              class="btn btn-link py-3 px-4 text-primary dim"
            >
              Siguiente
            </button>
          </nav>
        </div>
      </div>
      <div class="flex flex-wrap w-full">
        
        <gallery
          :images="imagesImagen"
          :index="index"
          @close="index = null"
        ></gallery>
  <!--      <div
          class="image"
          v-for="(image, imageIndex) in images2"
          :key="imageIndex"
           @click="index = imageIndex"
          :style="{
            backgroundImage: 'url(' + image.imagen + ')',
            width: '300px',
            height: '200px',
          }"
         
        >
          <a ref="nova/resources/obra/'.{{image.id}}.'"> <h1 style="color:white;">{{image.codigo}}</h1> </a>
          <h9 style="color:white;">{{image.nombre}}</h9> 

        </div> -->
      
       <div
          class="images"
          v-for="(image, imageIndex) in images2"
          :key="imageIndex"  
          style="width:'400px;' margin-botton:10px;"
        >
 
            <div @click="index = imageIndex">
                <img :src="`${image.imagen}`" alt="Park"  :style="{
                  width: '300px',
                 // height: '200px',
                  padding : '2px'
                  
                }" />

            </div>

            <div class="row">
              <div class="text-nowrap" style="width: 12rem;">
                   {{image.nombre}}                             
              </div>
              
              <button
                  rel="prev"
                  dusk="previous"
                  @click.prevent="irObra(image.id)"
                  class="span6 btn btn-link py-3 px-4 text-80 dim"
                                
                >
                Ir a Obra :  {{image.codigo}} </br>
                            

              </button>
               


            </div>
              
        </div>


      </div>              



      
      <div class="flex flex-wrap w-full">
        <div class="bg-20 rounded-b">
          <nav
            class="flex justify-between items-center text-90 font-normal text-2xl"
          >
            <button
              rel="prev"
              dusk="previous"
              @click.prevent="
                cambiarPagina(pagination.current_page - 1, buscar, criterio)
              "
              class="btn btn-link py-3 px-4 text-80 dim"
            >
              Anterior
            </button>
            <span class="text-90 font-normal text-2xl">
              {{ pagination.from }}/{{ pagination.total }} resources
            </span>
            <button
              rel="next"
              dusk="next"
              @click.prevent="
                cambiarPagina(pagination.current_page + 1, buscar, criterio)
              "
              class="btn btn-link py-3 px-4 text-primary dim"
            >
              Siguiente
            </button>
          </nav>
        </div>
      </div>
    </card>
  </div>
</template>

<script>
import VueGallery from "vue-gallery";

export default {
  props: [
    "card",

    // The following props are only available on resource detail cards...
    "resource",
    "resourceId",
    "resourceName",
  ],
  data: function () {
    return {
      images: [],
      images2: [],
      imagesImagen: [],
      imagesNombre: [],
      imagesCodigo: [],

      imagenRotada: "",

      index: null,
      dia: "",
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
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

  components: {
    gallery: VueGallery,
  },
  mounted() {
    console.log(
      "listarfotosObras mounted",
      "card",
      this.card,
      "resource",
      this.resouce,
      "resourceId",
      this.resourceId,
      "resourceName",
      this.resourceName
    );
    this.listarFotosDeUnaObra();
  },

  methods: {
    rotarFotoObra(id, codigo, url) {
      console.log("rotar Obra", id, codigo, url);

      var me = this;
      var url = "/foto/rotar?id=" + id + "&url=" + url;
      axios
        .post(url)
        .then(function (response) {
          var respuesta = response.data;

          console.log("rotar", response);
          this.listarFotosDeUnaObra();

          //me.imagenRotada =response.data.img;
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401) {
            window.location = "/login";
          }
        });
    },

    irObra(obra) {
      console.log("ira a obra pdf", obra, window.location.hostname);
      window.open(
        "http://" +
          window.location.hostname +
          ":8081/nova/resources/obras/" +
          obra 
         
      );
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarFotosDeUnaObra(page, buscar, criterio);
    },
    informePdf(obra) {
      console.log("informe pdf", obra, window.location.hostname);
      window.open(
        "http://" +
          window.location.hostname +
          ":8081/informepdf?obra=" +
          obra +
          "," +
          "_blank"
      );
    },

    listarFotosDeUnaObra: function listarFotosDeUnaObra(pag, buscar, criterio) {
      var me = this;
      console.log("listarfotosObras", pag, buscar, criterio);

      //console.log('listarFotosObras: pAGE:' + pag + '-BUSCAR:' + me.buscar + '-CRITERIO' + me.criterio + '-');
      // var url = '/fotosunaobra?page=' +pag + '&buscar=' + this.resourceId + '&criterio=' + me.criterio;
      var url =
        "/ultimasfotos?page=" +
        pag +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;

      axios
        .get(url)
        .then(function (response) {
          //000  me.hayFotos = 0;

          var respuesta = response.data;
          console.log(
            "INICIO----DOS --------listarfotos",
            response,
            "response.data",
            response.data,
            "response.data2",
            response.data.ultimasFotos2.data
          );

          //console.log(respuesta);
          //0000  me.obrasUsuario();
          //console.log('FIN----------listarfotos');
          me.images = respuesta.ultimasFotos2.data;
          me.images2 = respuesta.ultimasFotos.data;

          console.log(
            "unoooooooooo",
            me.images2,
            Array.isArray(me.images2),
            typeof (me.images2 === "function")
          ),
            typeof (me.images2 === "object");

          const arrayColumn = (arr, n) => arr.map((x) => x[n]);

          me.imagesImagen = arrayColumn(me.images2, "imagen");

          console.log(
            "unoooooooooo",
            arrayColumn(me.images2, "imagen"),
            me.imagesImagen
          );

          me.pagination = respuesta.pagination;
          me.dia = respuesta.dia;
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401) {
            window.location = "/login";
          }

          //console.log(error);
        });
    },
  },
};
</script> 

<style scoped>
.image {
  float: left;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  border: 1px solid #ebebeb;
  margin: 5px;
  width: 300px;
  height: 200px;
}
</style>