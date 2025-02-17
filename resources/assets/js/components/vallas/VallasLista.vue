<template>
    <div>
        <h1>LISTA DE VALLAS</h1>

        <li  v-for="valla in vallasLista" :key="valla.id">
                     <a class="nav-link pl-0 text-nowrap" href="#" 
                            @click="listarVallas(valla.dni,'vallasLista',estado)">
                            <i class="fa fa-bullseye fa-fw"></i>
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
                                <span class="badge badge-warning badge-pill" v-else-if="valla.estado === 'Reservada'">{{valla.estado}}</span>


                                <span class="badge badge-info badge-pill" v-else>{{valla.estado}}</span>
                                        
                                <br>
                            </a>
                </li>
    </div>
</template>
<script>
export default {

    name:"VallasLista",
    props: {
        modal: Number,
        vallaE : Objet,
    },
    data() {
        return {
            listadoDeVallas: {},
            vallas: {},

        }
        
    },
    created(){
               this.listarVallas(this.buscar,this.criterio,this.estado);
            
    },
    mounted() {
        //recibo valla 
        //cargo datos valla 
        

    },
    methods: {

              enviarVallas(){
                console.log('enviarVallas');
              },
              listarVallas(buscar,criterio,estado){
                     let me=this;
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
                            me.listadoDeVallas = respuesta.vallas;
                        }
                    
                        console.log('created', me.vallas);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },
    }

}
</script>