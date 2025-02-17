<template>

     <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Fotos Obra
          
                    </div>
                      
                    <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputUsuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" v-model="usuarioNombre" readonly >
                                </div>


                                <div  v-if="anadirFoto2" class="form-group col-md-12">
                                     <label for="selectObrar">Obra seleccionada</label>
                                    
                                    <input type="text" class="form-control" id="obracodigo" placeholder="obra.codigo" v-model="obra.codigo" readonly >

                                    
                                    <input type="text" class="form-control" id="obra" placeholder="obra.nombre" v-model="obra.nombre" readonly >
                                    
                                   <button type="button" @click="nuevaFoto(obra)" class="btn btn-success">
                                            <i class="icon-plus"></i>&nbsp;Cambiar Obra
                                        </button> 
                                

                                </div>
                                 
                                 <div v-else class="form-group col-md-12">
                                     <!-- <label for="selectObrar">Obras :</label> -->
                                     <div class="col-md-12">
                                         <div id="obra" class="form-row">
                                            <label class="typo__label"><h6>Obras</h6></label>
                                            <multiselect  
                                            class="form-control  col-md-12"  
                                        @select="actualizaCodigoObra" 
                                        @input="actualizaCodigoObra"
                                        v-model="obra" 
                                        :options="obrasUsuario" 
                                        :max-height="600"
                                        :custom-label="selectObra" 
                                        placeholder="Seleccione una Obra" 
                                        label="obra" 
                                        required
                                        track-by="id"></multiselect>
                                         </div>

                                     </div>
                                     
                                 

                                 <!--    <select v-model="obra" class="form-control"  @change="actualizaCodigoObra(obra)">
                                            <option selected="true" disabled="disabled">Seleccione Obra</option>
                                            <option v-for="obra in obrasUsuario" :key="obra.id" :value="obra" v-text="obra.codigo+'-'+obra.nombre" ></option>
                                    </select> -->
                                    <div v-if="obraDescripcion" class="col-md-12 is-valid" >
                                            <input type="text"  v-model="obraDescripcion" class="form-control" placeholder="nombre de la  obra" readonly>
                                            
                                    </div>                                
                                    <div   v-if="obraDescripcion" class="col-md-12">
                                        <hr>
                                        <button type="button" @click="obraAnadirFoto(obra)" class="btn btn-success">
                                            <i class="icon-plus"></i>&nbsp;Añadir Fotos
                                        </button>       
                                    </div>
                                    <hr>
                                    <div v-if="siQuiero" class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">
                                                No existe la obra en la lista , Pero tengo codigo de obra facilitado por Rotuleon. </label>
                                        
                                            
                                            <div class="col-md-3">
                                                <button type="submit" v-on:click.stop.prevent="obraSiCodigo()" class="btn btn-primary">
                                                        <i class="fa fa-search"></i> Introducir código Facilitado</button>
                                                
                                            </div>
                                        

                                    </div>
                                    <div v-else class="form-group row">
                                        <!-- <label class="col-md-3 form-control-label" for="text-input">Codigo de obra (AAOOOOCCCC)</label>
                                        <div class="col-md-4">
                                        <input type="text" v-model="buscar" @keyup.enter="obraBuscar(buscar)" class="form-control" placeholder="Introduce Codigo Obra">
                                            
                                        </div>
                                        
                                        <div class="col-md-3">
                                        <button type="submit" v-on:click.stop.prevent="obraBuscar(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                            
                                        </div>  -->
                                                                    <!-- busca obra x codigo -->
                            <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Codigo de obra</label>
                                    <div class="col-md-4">
                                    <input type="text" v-model="buscar" @keyup.enter="buscarObra(buscar)" class="form-control" placeholder="Introduce Codigo Ej: 001/2018">
                                        
                                    </div>
                                    
                                    <div class="col-md-3">
                                    <button type="submit" v-on:click.stop.prevent="buscarObra(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        
                                    </div>
                                    

                                </div>

                             </form>
                                        

                                    </div>
                                </div>


                            </div>

                               

                               
                                <hr>
                                 <div v-show="mensajes" class="col-md-12 div-error">
                                    <div class="text-center text-error">
                                        <div class="alert alert-danger" role="alert" v-for="error in mensajes" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>


                    </div>

                
                </div>
    </div>




</template>

<script>
import Multiselect from 'vue-multiselect'

    export default {

    components:{
        Multiselect
    },
         props: {
             anadirFoto : Boolean
          
        },
        data: function data() {
            return {

                anadirFoto2 : false,
                siQuiero : false,//true,
               // anadirFoto: false,
                
                usuarioNombre: "",
                usuarioId: 0,

                mensaje: "",
                mensajes: [],

                obrasUsuario: [],
                obra : [],
                obraDescripcion: "",
                obraCodigo : "",
                buscar : "",
                obraEncontrada: "",
            }
        },
          mounted() {

              console.log('FOTO CABMOUUUUUUUUUUUUUUNTED',this.anadirFoto);
                this.obra = [];
               // this.anadirfoto = false;
        },
        
        
        methods: {
               validarIdObra(){
                this.errorObra=0;
                //console.log('validarObra1')
                this.errorMostrarMsjObra =[];
                
     

                /* if (!this.buscar) this.errorMostrarMsjObra.push("Codigo de obra no válido o  no puede estar vacío."); */
                //if (this.buscar.length!=8) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.)");
                if (this.buscar.substr(-5,1)!='/') this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.) Ej 1/2018 :"+this.buscar.substr(-5,1));
                if (this.buscar.length>9 || this.buscar.length<6) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta Ej 1/2018)");
                if (this.errorMostrarMsjObra.length) this.errorObra = 1;
                console.log('validarObra2'+this.errorMostrarMsjObra)

                return this.errorObra;
            },
            buscarObra (buscar, event){

                console.log('buscarobra',buscar,event);
          
                if (event) event.preventDefault()
           
                    let me=this;
                    me.textoObra = '';  
                    
                if (this.validarIdObra()){
                    return;
                }
        


       
                var url= '/obraid?&buscar='+this.buscar;
                 axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayObras = respuesta.obra.tblobras_registro;
                    if (typeof me.arrayObras === "undefined"){                    
                            //console.log('vacio');
                             me.buscarResponseError = 'Undefined : CODIGO INEXISTENTE';
                                me.buscarResponse= '';
                          
                        
                             return me.buscarResponseError;
                        }else{
                           
                              me.buscarResponseError = '';
                              this.actualizaCodigoObraOld(me.arrayObras.CODIGO);
                           /*  me.textoObra = me.arrayObras.TEXTO;
                            me.codigoAlta = me.arrayObras.CODIGO;
                            return me.buscarResponse = me.arrayObras.TEXTO; */
                            
                        }
                   
                    if (respuesta.length = 0){
                        me.buscarResponseError = 'Length : Respuesta Erronea del Servidor';
                         me.buscarResponse= '';
                   
                    }
                    me.buscarResponseError = respuesta.texto;
                       me.buscarResponse= '';
                   
                })
                .catch(function (error) {
                    me.buscarResponseError = 'Consulta : ERROR DE CONSULTA';
                       me.buscarResponse= '';
                    // this.errorMostrarMsjObra.push("Consulta : ERROR DE CONSULTA");
                    console.log(error);
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                }); 
               // if (this.errorMostrarMsjObra.length) this.errorObra = 1;
            },

            selectObra ({codigo, nombre}) {
                return `${codigo} - ${nombre}`


            },
            nuevaFoto () {
                    this.anadirFoto2 = false;
                    this.obra = [];
                   this.obra = [];
                this.obraDescripcion= "";
                this.obraCodigo = "";
                
            },

            obraSiCodigo : function obraSiCodigo (){
                if(this.siQuiero === false)
                {
                    this.siQuiero= false;//true;
                }else{
                    this.siQuiero = false;
                }
                

            },
            obraAnadirFoto : function obraAnadirFoto(obra){

                this.obraDescripcion = '';
                this.siQuiero = false;
                let tr = true;
                this.anadirFoto2 = tr;
                //this.anadirFoto2 = this.anadirFoto;
                console.log('obraAnadirFoto', obra, this.anadirFoto2 , this.anadirFoto);
                
                
                this.$emit('obraAnadirFoto',obra);


            },
            actualizaCodigoObra(obra){
                console.log('ACTUALIZA CODIGO OBRA ', obra);
                 let me = this;
                
                me.siQuiero=false;//true;
                me.mensajes=[];
                 
                 me.obraCodigo =  obra.codigo;
                 me.obraDescripcion = obra.nombre;

 console.log('FOTO CAB -> ACTUALIZAR CODIGO OBRA', obra,this.anadirFoto,
 me.siQuiero,me.mensajes,me.obraCodigo,me.obraDescripcion);

                this.$emit('obraSeleccionada',obra);

            },

            actualizaCodigoObraOld : function actualizaCodigoObraOld(obra){

                 let me = this;
                
                me.siQuiero=true;
                me.mensajes=[];


              /*    let a = obra.nombreObra.indexOf("@@");
                 let t = obraSelect.length;
                 me.obraCodigo =  obraSelect.substring(0,a);
                 me.obraDescripcion = obraSelect.substring(a+2,t);

                this.$emit('obraSeleccionada',obraSelect); */

                console.log('FOTO CAB -> ACTUALIZAR CODIGO OBRA', obra,this.anadirFoto);
                 me.obraCodigo =  obra.codigo;
                 me.obraDescripcion = obra.nombre;

                this.$emit('obraSeleccionada',obra);


            },
            obrasUsuarioListar: function obrasUsuarioListar() {
                var me = this;
                var url = '/obrasusuario';
                

                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.obrasUsuario = respuesta.obrasUsuario;
                              console.log('OBRASUSUARIOLISTAR ',response, me.obrasUsuario);

                    me.usuarioNombre = respuesta.user_nombre;
                    me.usuarioId = respuesta.user;
                }).catch(function (error) {
                    if (error.response.status === 401) {
                        window.location = "/login";
                    }
                    me.mensaje = error.response;
                    this.mensajes.push("ERROR :",me.mensaje);

                    //console.log('UUUUNO -> ERROR',error,error.response,me.mensaje);
                });
            },
            obraBuscar: function obraBuscar(buscar, event) {

                let me = this;

                if (event) event.preventDefault();

                me.mensajes = [];
            
                if (me.buscar.length != 10) {

                 me.mensajes.push("Codigo de obra no válido -> (vacio o Longitud incorrecta. OBLIGATORIO 10 DIGITOS)");
                 return ; 
                }

            

                me.anoObra = me.buscar.substring(0, 2);
                me.codObra = me.buscar.substring(2, 6);
                me.cliObra = me.buscar.substring(6, 10);
                me.idObra = me.codObra + '/20' + me.anoObra;
            
            
                var url = '/obra?&buscar=' + me.buscar;
                // var url = 'http://rotuleon.rutasgp.com:8081/obra?buscar='+me.buscar;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
            
                    me.obraEncontradas = respuesta.obra.tblobras_registro;
                    
                    if (typeof me.obraEncontradas === "undefined") {
                        me.mensajes.push( 'CODIGO DE OBRA INEXISTENTE . undefined');
                        return;
                    } else {
                        me.obraDescripcion = me.obraEncontradas.TEXTO;
                        me.obraCodigo = me.obraEncontradas.CODIGO;

                        return ;
                    }
                    if (respuesta.length = 0) {
                        me.mensajes.push('Length : Respuesta Erronea del Servidor');
                    }
                    me.obraDescripcion = respuesta.texto;
            
                }).catch(function (error) {
                    me.mensajes.push('Consulta : ERROR DE CONSULTA',error);
                    //console.log(error);
                    if (error.response.status === 401) {
                        window.location = "/login";
                    }
                });
            }
    



        },
        computed: {
                     inicio: function(){
                         console.log('iiiiiiiiiiiiiiiiiiinicio');
                       
                return this.anadirFoto2 = this.anadirFoto;
            },

        
        },
        
        mounted: function mounted() {
            this.obrasUsuarioListar();
         }
    }
</script>
<style>    
    
</style>
