<template>

    <div class="container">




        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                    Vallas Disponibles
                    </li>
                    <ul class="list-group" v-for="valla in vallas" :key="valla.id"> 
                        <li class="list-group-item list-group-item-action list-group-item-dark" >
                            {{valla.nombre}}
                            <br>
                            {{valla.direccion}}
                            <br>
                            {{valla.postal}} -  {{valla.poblacion}}
                            <br>
                            
                        <span class="badge badge-primary badge-pill">{{valla.estado}}</span>

                        </li>  
                    </ul>

                   
  
            
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>



          <div class="container">
                    
                           
                                <div class="col input-group">
                                    
                                    <input type="text" v-model="buscar" @keyup.enter="listarVallas(buscar,criterio,estado)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarVallas(buscar,criterio,estado)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                                 <div class="col input-group">
                                 <label class="btn btn-primary" for="estado" >Estado</label>
                                    <select class="form-control " id="estado" v-model="estado" @change="selectEstado">
                                         <option value="Todas">Todas</option>
                                        <option value="Libre">Libre</option>
                                        <option value="Ocupada">Ocupada</option>
                                        <option value="Reservada">Reservada</option>
                                    
                                    </select>
                                </div>
                        

                    
                </div>
                <div  class="row justify-content-center">
                    {{vallas.length}} = Numero de Vallas encontradas  para la busqueda : [ {{buscar}}] con estado {{estado}}

                </div>

                 <GmapMap
                    :center="mapCenter"
                    :zoom="6"
                    map-type-id="satellite"
                    style="width: 100%; height: 600px"
                    
                    >
                

                    <gmap-info-window
                        :options="infoWindowOptions"
                        :position="infoWindowPosition"
                        :opened="infoWindowOpened"
                        @closeclick="handleInfoWindowClose"
                    >
                        <div class="info-window">
                            <h2 v-text="activeValla.nombre"></h2>
                            <h5 v-text="activeValla.dni"></h5>
                            <p v-text="activeValla.direccion"></p>

                        </div>
                    </gmap-info-window>
                    <gmap-marker
                            v-for="(r, index) in vallas"
                            :key="r.id"
                            :position="getPosition(r)"
                            :clickable ="true"
                            :draggable ="false"
                            @click="handleMarkerClicked(r)"
                           


                        >
                        </gmap-marker>
                </GmapMap>
                
              


    </div>
</template>
<script>
export default {
        /*  props: {
             vallas : String,
         }, */
         created(){
               this.listarVallas(this.buscar,this.criterio,this.estado);
            
         },
   
          data(){
                return {
                    estado : 'Todas',
                        vallas: {},
                        page : '',
                        buscar: '',
                        criterio : '',
                      center: {lat: 5, lng: -5 },
          

                        infoWindowOptions:{
                            pixelOffset:{
                                width:0,
                                height: -55
                            }
                        },
                        infoWindowOpened: false,

                        activeValla : {},

                        valla:{
                            id : 0,
                                dni : '',
                                nombre : '',
                                direccion : '',
                                poblacion : '',
                                postal : '',
                                provincia :  '',
                                telefono : '',
                                email : '',
                                longitud : '',
                                latitud : '',
                                ancho : 1,
                                alto : 1,
                                m2 : 1,
                                tipo : 'Valla',
                                elemento : 'Vinilo',

                        },

                }
            
          },
          mounted(){

          },
          methods: {
              selectEstado(){
                  console.log('selectEstado');
                  this.listarVallas(this.buscar, this.criterio, this.estado);

              },
                listarVallas(buscar,criterio,estado){
                     let me=this;
                //var url= this.ruta + '/valla?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                var url= '/vallas?buscar='+ me.buscar + '&criterio='+me.criterio+ '&estado='+me.estado;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log('respouesta',response, respuesta);
                    me.vallas = respuesta.vallas.data;
                    console.log('created', me.vallas);
                })
                .catch(function (error) {
                    console.log(error);
                });

                },
                handleMapClick(e){
                    console.log('handleMapClick',e, this.valla);
                    this.valla.push({
                        nombre:"valla nueva",
                        dni: "rererencia",
                        latitud: e.latLng.lat(),
                        longitud: e. latLng.lng()
                    });
                },

        getPosition(r){
            console.log('getPosition',r);
                                // parseFloat(r.latitud),this.valla.latitud, parseFloat(r.longitud), this.valla.longitud);

                return {

                    lat : parseFloat(r.latitud),
                    lng : parseFloat(r.longitud)
                }
        },
        handleMarkerClicked(r){
            console.log('handleMarkerClicked',r);

            this.activeValla = r ; 
            this.infoWindowOpened = true;

        },
        handleInfoWindowClose(){
                        console.log('handleInfoWindowClose');

            this.activeValla = {};
            this.infoWindowOpened = false;
        },
       

          },
          computed: {
     
        mapCenter() {

            console.log('mapCenter');
            if(!this.vallas.length){
                console.log('mapCenter',this.vallas);
                return {
                     
                   // lat: 42.60003,
                   // lng: -5.57032
                     lat: 10,
                     lng: 10
                }
            }
                console.log('mapCenter 33333');

            return {

                lat : parseFloat(this.vallas[0].latitud),
                lng : parseFloat(this.vallas[0].longitud)
            }
        },
        infoWindowPosition() {
            console.log('infoWindowPosition',this.activeValla);
            return {

               
                lat : parseFloat(this.activeValla.latitud),
                lng : parseFloat(this.activeValla.longitud)
            }
        }
      
        
    }


}
</script>