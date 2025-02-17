<template>
<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Exterior Play</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Vallas</p>
               
                <li  v-for="valla in vallasLista" :key="valla.id">
                     <a class="nav-link pl-0 text-nowrap" href="#" @click="listarVallas(valla.dni,'vallasLista',estado)"><i class="fa fa-bullseye fa-fw"></i>
                                        <span class="small">
                                        {{valla.dni}}-{{valla.nombre}}
                                            <br>
                                            {{valla.direccion}}
                                            <br>
                                            {{valla.postal}} -  {{valla.poblacion}}
                                            <br>
                                        </span>    
                                       
                                        <span class="badge badge-danger badge-pill" v-if="valla.estado === 'Ocupada'">{{valla.estado}}</span>
                                       
                                         <span class="badge badge-success badge-pill" v-else-if="valla.estado === 'Libre'">{{valla.estado}}</span>

                                            <span class="badge badge-warning badge-pill" v-else>{{valla.estado}}</span>
                                        
                                        <br>
                            </a>
                </li>
             
            </ul>

      
        </nav>

        <!-- Page Content  -->
        <div id="content">

               <div class="row">
                        <div class="col-6">
                                            
                                            <input type="text" v-model="buscar" @keyup.enter="listarVallas(buscar,criterio,estado)" class="form-control mb-4 mr-sm-4" placeholder="Texto a buscar">
                                            <button type="submit" @click="listarVallas(buscar,criterio,estado)" class="btn btn-primary mb-2"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                        <div class="col-6">
                                        <label class="btn btn-primary" for="estado" >Estado</label>
                                            <select class="form-control " id="estado" v-model="estado" @change="selectEstado">
                                                <option value="Todas">Todas</option>
                                                <option value="Libre">Libre</option>
                                                <option value="Ocupada">Ocupada</option>
                                                <option value="Reservada">Reservada</option>
                                                <option value="Baja">Baja</option>

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
                        style="width: 100%; height: 1000px"
                        
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
                    opened: false,
                    estado : 'Todas',
                        vallas: {},
                        vallasLista: {},
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
                     console.log('listar Vallas','b->',buscar, 'c->',criterio, 'e->',estado);
                     if(criterio==='vallasLista'){
                         me.buscar = buscar;
                       // me.vallasLista = me.vallas;
                     }

                    //var url= this.ruta + '/valla?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                    var url= '/listarVallas?buscar='+ me.buscar + '&criterio='+me.criterio+ '&estado='+me.estado;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        console.log('respouesta',response, respuesta, respuesta.vallas);
                        if(criterio==='vallasLista'){
                        //me.vallasLista = me.vallas;
                        me.vallas = respuesta.vallas;  

                        }else{
                            me.vallas = respuesta.vallas;
                                me.vallasLista = respuesta.vallas;
                        }
                    
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
<style >

@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #20a8d8;
    color: #fff;
    transition: all 0.3s;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #20a8d8;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    color: #20a8d8;
    background: #fff;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #20a8d8;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #20a8d8;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #20a8d8;
}

a.article,
a.article:hover {
    background: #20a8d8 !important;
    color: #fff !important;
}

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #sidebarCollapse span {
        display: none;
    }
}

</style>