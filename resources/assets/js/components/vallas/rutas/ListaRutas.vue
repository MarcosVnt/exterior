<template>
    <div>
        
        

        <input type="text" v-model="buscarRuta" @keyup.enter="listarRutas(buscarRuta)"
        class="form-control mb-2 mr-sm-4" placeholder="Ruta a buscar">

        <h4>Lista de Rutas</h4>
         <li  v-for="ruta in listadoDeRutas" :key="ruta.id">
                     <a href="#"
                
                         :class="[ruta.id === rutaSeleccionada.id ?  'badge-light nav-link pl-0 text-nowrap' : 'nav-link pl-0 text-nowrap' ]"

                            @click="listarVallasDeRuta(ruta)">
                            <i class="fa fa-bullseye fa-fw"></i>
                                <span class="small">
                                        {{ruta.id}}-{{rutaSeleccionada.id}}
                                            <br>
                                            {{ruta.descripcion}}
                                            
                                            <br>
                                            Emails : {{ruta.email}}
                                            <br>
                                            {{ruta.fecha_inicio | formatoFecha}} -  {{ruta.fecha_final | formatoFecha}}
                                            <br>
                                </span>    
                            <!--           
                                 <span class="badge badge-success">
                                    <button  @click="vallaEditar(ruta)" type="button">
                                        Editar
                                    </button>
                                    
                                
                                </span>
                                <span class="badge badge-danger">
                                    <button  @click="vallaBaja(ruta)" type="button">
                                        Baja
                                    </button>
                                    
                                </span>
                             -->   
                                       
                            <!--    <span class="badge badge-success badge-pill" v-else-if="valla.estado === 'Libre'">{{valla.estado}}</span>
                                <span class="badge badge-warning badge-pill" v-else-if="valla.estado === 'Reservada'">{{valla.estado}}</span>


                                <span class="badge badge-info badge-pill" v-else>{{valla.estado}}</span>
                           -->              
                                <br>
                                <!-- <span class="badge badge-danger">
                                    <button  @click="vallaBaja(ruta)" type="button">
                                        Ver Solo Vallas de la Ruta
                                    </button>
                                    
                                </span>
                              -->  
                            </a>
                </li>
    </div>
   
</template>
<script>

export default {
    name:"ListaRutas",
    props: {

    },

    data() {
        return {

            listadoDeRutas: {},
            rutas: {},
            rutaSeleccionada:{},
            vallasdeRuta:{},
            buscarRuta: '',

            listadoDeVallas: {},
            vallas: {},
            buscar: '',
            criterio: '',
            estado:'RutasTodas',
            vallasLista:{}, 


        }
        
    },
        created(){
            
    },

    mounted(){
               this.listarRutas();

        console.log("0303 listarutas",this.listadoDeVallas);

    },
     filters: {
        formatoFecha(value) {
        if (!value) return ''; // Manejar caso de fecha nula o indefinida
        const fecha = new Date(value);
        const options = { day: 'numeric', month: 'numeric', year: 'numeric' };
        return fecha.toLocaleDateString('es-ES', options);
        }
    },
    methods: {
        envioVallas(){
            console.log('enviarVallas.......',this.vallasdeRuta);
               this.$emit('enviarVallas',this.vallasdeRuta,this.rutaSeleccionada);
        },
        listarVallasDeRuta(ruta){
                    let me=this;
                    me.rutaSeleccionada=ruta;
                 
                   // var url= '/ruta-vallas/vallas?id='+ruta.id;
                   me.estado="Rutas"
                    var url= '/listarVallas?buscar='+ me.buscar + '&criterio='+me.criterio+ '&estado='+me.estado+ '&ruta='+ruta.id;
                    console.log('ruta',ruta, ruta.id,url);

                 
                     axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        console.log('0303 respouesta',response, respuesta, respuesta.vallas,respuesta.vallas.vallas);
                        me.vallasdeRuta= response.data.vallas

                        me.envioVallas();

                        console.log('vallasdeRuta dddddd',me.vallasdeRuta, ruta.valla_lineas);



                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 

                },

           listarRutas(buscar,criterio,estado){
                     let me=this;
                 

                    //                    var url= '/ruta-vallas/listar?buscar='+ me.buscar + '&criterio='+me.criterio+ '&estado='+me.estado;

                    var url= '/ruta-vallas/listar?buscar='+me.buscarRuta;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        console.log('0303 respouesta',response, respuesta, respuesta.vallas);
                        me.listadoDeRutas= response.data.rutasConVallas
                        console.log('created 0603',me.listadoDeRutas);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },

    }

}
</script>
