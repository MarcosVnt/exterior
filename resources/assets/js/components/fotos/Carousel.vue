<template>
 <div
      class="modal fade"
      id="modalCarousel"
      tabindex="-1"
      :class="{ mostrarr: modalCarousel }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true">

      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">

      <div class="loading" 
      style="display: none">
          <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
          </div>
        </div>
        <div v-if="load" class="spinner-border" role="status">
  <span class="sr-only">Loading...</span>
</div>
      
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModal()"
              aria-label="Close"
            >
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">

            

 <div id="app">
		<div class="gallery">
			<figure class="gallery__item">
              <!--   {{images}}  -->
            <!--     {{presupuestoDocumentosLista}} -->
  
				<span class="prev" @click="updateImage(selectedImage - 1)" ></span>
				<span class="next" @click="updateImage(selectedImage + 1)" ></span>
				<img :src="'./storage/'+images[selectedImage].src" :alt="images[selectedImage].caption" class="gallery__img" />
 			<div class="caption">
					<h2>{{images[selectedImage].caption}}</h2>
					<p> Image {{selectedImage + 1}} of {{images.length}}</p>
				</div>
			</figure>
		</div>
		<h1 class="visually-hidden">{{message}}</h1>
		
		<div class="image__list">
			<ul>
					<li v-for="(image, index) in images" :key="index">
						<img @click="updateImage(index)" :src="'./storage/'+image.src" :alt="image.caption" :class="`list__img ${index === selectedImage ? 'active' : ''}`" />
					</li>
				</ul>
		</div>
  </div>


               
            
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="cerrarModal()"
            >
              Cerrar
            </button>
           
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


</template>


 


<script>
export default {
     props: {
       images: Array,
          presupuestoImagenesLista:Array,
         presupuestoDocumentosLista:Array,
    // images: Array,
    
  },
  data() {
    return {
        img : [],
        load: true,
      message: 'Vue Image Gallery',
            selectedImage: 0,
            modalCarousel: true,
            tituloModal : 'IMAGENES DEL PRESUPUESTO',
            images2: [],
		 	images3: [

				/* {
					src: '',
					caption: ''
				}, 
				{
					src: './img/LOGORTL.JPG',
					caption: 'An old camera'
				},*/
				{
					src: './img/LOGORTL.JPG',
					caption: 'New York City from the sky'
				},
				{
					src: './img/LOGORTL.JPG',
					caption: 'A random street'
				},
				{
					src: './img/LOGORTL.JPG',
					caption: 'A Train Station'
				}  
		] 
    };
  },
  mounted(){
      this.inicio();
     // this.recargarImage();

},

  methods: {
      cerrarModal(){
          this.modalCarousel = false;

      },
      inicio(){
        console.log('aaa 2301',this.presupuestoImagenesLista,this.presupuestoDocumentosLista,'mounted',this.images,this.images2);
        //2601 this.listarFicherosImagenesPresupuestos();
        

      },

      recargarImage(){


let me = this;
           console.log(
            "aaa listarFicherosImagenesPresupuestos image3 for 3333-000",
            me.presupuestoImagenesLista.length
        
          );
    

for (var i = 0; i <  me.presupuestoImagenesLista.length; i++) {
    /* me.image3=[];
    me.image3[i].src=me.presupuestoImagenesLista[i].nombre;
    me.image3[i].caption=me.presupuestoImagenesLista[i].src; */

    var obj = new Object();
//    obj.src = './storage/'+me.presupuestoImagenesLista[i].nombre;
      obj.src = me.presupuestoImagenesLista[i].nombre;
  
  obj.caption = me.presupuestoImagenesLista[i].slug;
    me.images[i] = obj;

    /* me.images[i]={'src' : './'+me.presupuestoImagenesLista[i].nombre,
    'caption' : me.presupuestoImagenesLista[i].slug};
 */
    console.log(
            "aaa listarFicherosImagenesPresupuestos image3 for 3333--111",
            me.images,'--->',me.presupuestoImagenesLista[i],'me.images', me.images
          );

          console.log(
            "aaa listarFicherosImagenesPresupuestos image3 for 3333-2222",
            me.presupuestoImagenesLista.length
        
          );
    

}
this.load = false;


      },


       listarFicherosImagenesPresupuestos() {
      console.log("aaa listarFicherosImagenesPresupuestos 2301 image3->1111");
      var me = this;
      /* var i =  this.dropzoneOptions['params']['id'];
      var a = i['ruta'];
      var b = i['id'];
      var c = i['presupuesto'];
       */
      var i = this.idp;
      this.images=[];
      //console.log("listarFicherosImagenesPresupuestos 2301 iiiiiii->",i,a,b,c);
      //,i,this.dropzoneOptions['params']);

      var url = "/presupuesto/documentacion?id=" + i;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;

          console.log("aaa listarFicherosImagenesPresupuestos 2301 response -> image3 2222", response);

          me.presupuestoImagenesLista = response.data.imagenes;

me.recargarImage();

          

          
        })
        .catch(function (error) {});




         console.log("aaa listarFicherosImagenesPresupuestos 2301 ->image3 4444",me.image3);

    },

		updateImage(index = 0) {
			if (index === -1) {
				this.selectedImage = this.images.length - 1;
				return;
			}
			if (index === this.images.length) {
				this.selectedImage = 0;
				return;
			}
			this.selectedImage = index;
		}
  }
};
</script>

<style>

#modalCarousell {
	font-family: 'Nunito', sans-serif;
	background-color: #000000;
	color: #FFF;
	width: 100vw;
	height: 100vh;
	margin: 0;
	padding: 0;
	overflow: hidden;
	border: 10px solid #fff;
} 
*, *:before, *:after {
	box-sizing: border-box;
}	
	
#app {
  text-align: center;
}
	
h1 {
	position: absolute;
	top: 35px;
	left: 11vw;
	transform: translate(-50%, -50%);
	font-size: 1rem;
}
	
.gallery__item {
	height: 100vh;
	width: 100%;
	position: relative;
	overflow: hidden;
	transition: all 0.4s ease;
}
	
.gallery__item:before {
	position: absolute;
	content: '';
	top: 0;
	left: 0;
	width: 100%;
	height: calc(100% - 20px);
	background-color: #006266;
	opacity: 0.25;
	transform: translateY(110%);
	transition: all 0.25s;
	transition-delay: 0.25s;
}
	
	.gallery__item:hover:before {
		transform: translateY(0);
		transition-delay: 0s;
	}
	
.gallery__item .caption {
	position: absolute;
	top: 0;
	width: 100%;
	height: 100%;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	transform: translateY(-20px);
  opacity: 0;
  transition: all 0.25s ease;
}
	
	.gallery__item:hover .caption {
		transform: translateY(0);
		opacity: 1;
		transition-delay: 0.3s;
	}
	
	.caption h2, .caption p {
		margin: 0;
		letter-spacing: 1px;
	}
	
	.caption h2 {
		margin-bottom: 10px;
		font-weight: 400;
		font-size: 2rem;
		text-transform: uppercase;
	}
	
	.caption p {
		font-weight: 300;
		opacity: 0.7;
		font-style: italic;
	}

.gallery__img {
	/* width: 100%;
	height: 90%; */
	margin: 0;
	z-index: -1;
	filter: brightness(100%);
}
	
.prev, .next {
		border-bottom: 3px solid;
		border-left: 3px solid;
		position: absolute;
		top: 50%;
		z-index: 1;
		border-color: #fff;
		width: 24px;
		height: 24px;
		transform: translate(0, -100%) rotate(45deg);
	}
	
	.prev {
		left: 30px;
	}
	
	.next {
		right: 30px;
		transform: translate(0, -100%) rotate(-135deg);
	}
	
	.prev:hover, .next:hover {
		cursor: pointer;
	}

.image__list {
	overflow: hidden !important;
	position: absolute !important;
	padding: 10px;
	background: rgba(128, 128, 128, 0.25);
	bottom: 10px;
	z-index: 1;
	height: auto;
	left: 10px;
	right: 10px;
}

.image__list ul {
	display: flex !important;
	list-style-type: none;
}
	
.image__list li {
	padding: 10px;
}

.image__list img {
	width: 50%;
	transition: all 0.3s ease;
}
	
	.image__list img:hover {
		cursor: pointer;
		outline: 2px solid #fff;
		filter: brightness(150%);
	}
	
img.active {
	filter: grayscale(1);
	border: 5px solid #fff;
}
	
.visually-hidden { 
    position: absolute !important;
    height: 1px; 
    width: 1px;
    overflow: hidden;
    clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px, 1px, 1px, 1px);
    white-space: nowrap; /* added line */
}


.form-control {
  font-weight: bold;
}

.form-actions.stuck {
  position: fixed;
  bottom: 0;
  width: 100%;
  margin-left: -15px;
  margin-bottom: 0;
  z-index: 5;
  border-radius: 0;
}
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}

.table-responsive::-webkit-scrollbar {
  background: lightyellow;
  width: 12px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: gray;
}

.table-responsive {
  overflow-x: auto !important;
}

.modal-dialog {
  max-width: 90% !important;
}
.table-responsive > .fixed-column {
  right: 0;
  top: 0px;
  background: #f4f4f4;
  position: absolute;

  display: inline-block;
  width: auto;
  border-top: 0px solid;
  border-left: 1px solid #808080;
}

.nav-tabs .nav-link.active {
  border-top-color: #3c8dbc !important;
  border-top: 3px solid transparent;
}
.modal-content {
  /* width: 600px !important;*/
  width: 100% !important;
  position: absolute !important;

  /*  display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 10px;
    background-color: transparent;
    z-index: 1060; */
  /*     overflow-x: hidden;
 */
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  background-color: #3c29297a !important;
  position: absolute !important;
  background-color: #3c29297a !important;
  /* display: none;
    position: relative;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 32em;
    max-width: 100%;
    padding: 1.25em;
    border-radius: .3125em;
    background-color: #fff;
    font-family: inherit;
    font-size: 1rem;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    overflow-x: hidden;
    overflow-y: auto */
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
@media (min-width: 600px) {
  .btnagregar {
    margin-top: 2rem;
  }
}
</style>