<template>
  <div class="container">

      <div class="col-md-6">
      <button
        type="submit"
        v-on:click.prevent="informePdf(resourceId)"
        class="
          dim
          btn btn-lg btn-default btn-white
          text-90
          no-text-shadow
          tracking-wide
          uppercase
        "
      >
        Generar Informe PDF 
      </button>
    
      <button
      v-if="fotosMarcadas.length>0"
        type="submit"
        v-on:click.prevent="informePdfCliente(resourceId)"
        class="
        flex-right
          dim
          btn btn-lg btn-default btn-primary
          text-90
          no-text-shadow
          tracking-wide
          uppercase
        "
      >
        Generar Informe CLIENTE con fotos Nº : {{fotosMarcadas.length}}
      </button>
    </div>
    <div class="flex flex-wrap w-full">

  

    <gallery :images="images" :index="index" @close="index = null"></gallery>

    <div class="images" v-for="(image, imageIndex) in images" :key="imageIndex"
              style="width:'400px;' margin-botton:10px;"

    >
      <div @click="index = imageIndex">
        <img
          :src="`${image}`"
          alt="Park"
          :style="{
            width: '300px',
            height: '200px',
            padding: '2px',
          }"
        />
      </div>
      <div class="row">
       
<div class="input-group-text" >
      <input type="checkbox" 
      @click="marcarFoto(image)"
      aria-label="Checkbox for following text input"> Marcar para enviar PDF CLIENTE
    </div>
        <button
          rel="prev"
          dusk="previous"
          @click.prevent="rotarFotoObra( image)"
          class="span4 btn btn-link py-3 px-4 text-80 dim"
        >
          Rotar Imagen 90º AC
        </button>
    
         
      </div>
    </div>
    </div>
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
      /*          images3: [
          {
            title: '400x400',
            description: '400 x 400 White',
            href: 'https://dummyimage.com/400/ffffff/000000',
          },
          {
            title: '400x400',
            description: '400 x 400 White',
            href: 'https://dummyimage.com/400/ffffff/000000',
          },
          {
            title: '400x400',
            description: '400 x 400 Black',
            href: 'https://dummyimage.com/400/000000/ffffff',
          },
          {
            title: '400x400',
            description: '400 x 400 Black',
            href: 'https://dummyimage.com/400/000000/ffffff',
          },
        ],
 */

      /*         
        images2: [
          'http://rotuleon.rutasgp.com:8081/storage/obras/images/06252020/20200723080306_image002.jpg',
          'http://rotuleon.rutasgp.com:8081/storage/obras/images/06252020/20200723080255_image001.jpg',
          'http://rotuleon.rutasgp.com:8081/storage/obras/images/06252020/20200723080306_image002.jpg',
          'http://rotuleon.rutasgp.com:8081/storage/obras/images/06252020/20200723080255_image001.jpg',
        ],
 */
      images: [],
      index: null,
      fotosMarcadas : [],
    };
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
    marcarFoto(foto){

        
        var f =  foto.substr(foto.indexOf('obras/'));

        
      

  var idx = this.fotosMarcadas.indexOf(f);
	
  if(idx >= 0) {
		this.fotosMarcadas.splice(idx, 1);
          console.log('splice',idx,this.fotosMarcadas);

	}else {

     console.log('fotosMarcadas insert',f);
      this.fotosMarcadas.push(f);
    
  }


    
      console.log('marcarFoto',this.fotosMarcadas);
      

    },
    
      rotarFotoObra(image){
 console.log("rotar Obra", image);
    
      var me = this;

      var ruta =  image.substring( image.indexOf("obras"));

      console.log('ruta',ruta);

      var url =
        "/foto/rotar?url=" +ruta;
      axios
        .post(url)
        .then(function (response) {

      
          var respuesta = response.data;

          console.log('rotar',response);
           //   me.listarFotosDeUnaObra();
          //  setTimeout('', 5000);

           //location.reload();


          //me.imagenRotada =response.data.img;
      
      

        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401) {
            window.location = "/login";
          }

          
        });


    setTimeout('', 5000);
location.reload();
      


    },

    seleccionarFoto() {
      console.log("seleccionar");
    },

    informePdf(obra) {
      console.log("informe pdf", obra, 'url',window.location.hostname);
      window.open(
        "http://" +
          window.location.hostname +
          ":8081/informepdf?obra=" +
          obra +
          "," +
          "_blank"
      );
    },

  informePdfCliente(obra) {

/* 
console.log('!this.fotosMarcadas || this.fotosMarcadas.length===0',!this.fotosMarcadas ,this.fotosMarcadas.length===0);
      if(!this.fotosMarcadas || this.fotosMarcadas.length===0){
Nova.error('No hay fotos Marcadas');


        
                    return;
      } */


      console.log("informe pdf",
       obra,
        "resource",
      this.resource,
      "resourceId",
      this.resourceId,
      "resourceName",
      this.resourceName,
      "fotosMarcadas",
      this.fotosMarcadas,
    
      window.location.hostname);
      window.open(
        "http://" +
          window.location.hostname +
          ":8081/informepdf/cliente?obra=" +
          obra + "&fotosMarcadas=" +this.fotosMarcadas
      ); 
    },


    listarFotosDeUnaObra: function listarFotosDeUnaObra(pag, buscar, criterio) {
      var me = this;
      console.log("listarfotosObras");

      //console.log('listarFotosObras: pAGE:' + pag + '-BUSCAR:' + me.buscar + '-CRITERIO' + me.criterio + '-');
      var url =
        "/fotosunaobra?page=" +
        pag +
        "&buscar=" +
        this.resourceId +
        "&criterio=" +
        me.criterio;
      axios
        .get(url)
        .then(function (response) {
          //000  me.hayFotos = 0;

          var respuesta = response.data;
          console.log(
            "INICIO--------listarfotos",
            response,
            "response.data",
            response.data
          );

          //console.log(respuesta);
          //0000  me.obrasUsuario();
          //console.log('FIN----------listarfotos');
          me.images = respuesta.fotosObraUrl;
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