<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card" >
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Administrar Usuarios de una OBRA
                        <!-- <button type="button" @click="abrirModal('obraHora','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button> -->
                    </div>
                    <div class="card-body" >
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
                            <div v-if="buscarResponse" class="col-md-18 is-valid" >
                                <input type="text"  v-model="buscarResponse" class="form-control" placeholder="nombre de la  obra" readonly>
                                
                            </div>
                             <div v-if="buscarResponseError" class="col-md-18 danger" >
                                <input type="text"  v-model="buscarResponseError" class="form-control" placeholder="nombre de la  obra" readonly>
                                
                            </div>
                            <div v-show="errorObra" class="col-md-12 div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjObra" :key="error" v-text="error">

                                            </div>
                                        </div>
                            </div>

                            
                    </div>
                    <div v-if="buscarResponse" class="col-md-18 is-valid" >

                                <div class="form-group col-md-8">
                                     <label for="selectUsuarios">Usuarios</label>
                                    
                                    <select v-model="selectUsuario" class="form-control"   @change="obrasUsuario(selectUsuario)">
                                            <option value="0" disabled>Seleccione Usuario</option>
                                             <option v-for="taller in arraylistaTaller" :key="taller.id" :value="taller.id" v-text="taller.name" ></option>
                                        </select>

                                </div>
                                <button type="submit" v-on:click.stop.prevent="asignarObra(selectUsuario)" class="btn btn-primary">
                                 Asignar <i class="icon-plus"></i>&nbsp;Obra a Usuario
                                </button>

                    </div>
                           
            <!--Fin del modal-->
                    <div v-if="buscarResponse" class="col-md-18 " >






                        <table class="table table-responsive table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">OBRA</th>
                                    <th scope="col">Descripción Obra</th>
                                   <!--  <th scope="col">Usuario</th> -->

                               
                                </tr>
                            </thead>
                            
                                        
                            <tbody>
                                <tr v-for="obrausuario in arrayObraUsuario" :key="obrausuario.id">
                                    
                                    <td  >{{obrausuario.idobra}}</td>
                                    <td scope="row" v-text="obrausuario.codigo+'-'+obrausuario.nombre"></td>
                                   <!--  <td>{{obrausuario.de_fecha_hora}}</td>
                                    <td>{{obrausuario.a_fecha_hora}}</td>
                                    <td>{{obrausuario.texto}}</td> -->

                                   <!--  <td>
                                        <button type="button" @click="eliminarParte(obramano.obraManoId)" class="btn btn-warning btn-sm">
                                          <i class="icon-trash"></i>
                                        </button> &nbsp;
                                    </td>  -->                     
                                </tr>                                
                            </tbody>  
                             <nav>
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                    </li>
                                </ul>
                             </nav>
                        </table>
                     </div>       
                </div> <!-- div card -->
            </div> <!-- div container-fluid -->
                <!-- Fin ejemplo de tabla Listado -->
          
        </main>
</template>
<script>
    export default {
        data (){
            return {
                arrayObraUsuario : {},
                selectUsuario : 0,
                
                errorObra : 0,
                buscarResponse:'',
                buscarResponseError:'',
                buscar : '',
                errorMostrarMsjObra : [],
                textoObra :'',
                codigoAlta :'',
                usuarioId : 0,



                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
             
            }
        },
        computed:{
           

         
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                console.log('paaaaaaaaagesNumber');
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        filters:{
            fecha : function (de,a){
                if (!value) return ''
                //value = val
            }

        },
        methods : {
            asignarObra(obra){
                console.log(this.buscar);
                console.log(this.selectUsuario);
                
                  let me = this;
                  let user = this.selectUsuario;

                axios.post('/obrausuario/registrar',{
                    'obraCodigo': this.codigoAlta,
                    'obraNombre': this.textoObra,
                    'obraId': this.selectObra,
                    'usuarioId': this.usuarioId,
                   
            
                }).then(function (response) {
                   
                 
                                      console.log('response');

                  console.log(response);
                  console.log(user);
               
                  //me.listarObraMano(1,'','nombre');
                     me.obrasUsuario(user);
                //     me.inicialiciarParte();
                  /*    this.obraHoraD = 0;
                    this.obraMinutoD = 0;
                    this.obraMinutoA = 0;
                    this.obraHoraA =0; */
                }).catch(function (error) {
                    console.log(error);
                     me.buscarResponse = 'Guarda Parte : Error '+error;
                      if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                });
               
                 // console.log(this.missingName+'----'+ this.wrongNumber);
              



            },
              obrasUsuario (usuario){
                let me=this;
                
                console.log(usuario);

                var url= '/obrasusuario?&usuario='+usuario;
                                //var url= '/obraMano';
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log('obrasUsuario');
                    console.log(response);
                     console.log('---------------------------');

                    me.arrayObraUsuario = respuesta.obrasUsuario;
                    me.paginationU= respuesta.paginationU;
                    me.usuarioNombre = respuesta.user_nombre;
                    me.usuarioId = usuario;
                    console.log(usuario);
                    console.log(me.usuarioId);
                   /*  me.obraId = respuesta.id;
                    me.usuarioId= respuesta.userid; */
                    //me.hoy = respuesta.hoy;
                   
                                        console.log(me.arrayObraUsuario);
                                        console.log(me.usuarioNombre);
                                        console.log(me.hoy);
                                        console.log(respuesta.length);


                       if (respuesta.length = 0){
                        me.buscarResponseError = 'Length : Respuesta Erronea del Servidor';
                        me.buscarResponse= '';                 
                    }
                                     

                })
                .catch(function (error) {
                    console.log(error);
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                });
            },
            listaUsuarios(){
                let me=this;
                var url= '/user/taller';
                                //var url= '/obraMano';
                this.selectTaller = 0;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log('obrasUsuario');
                    console.log(respuesta);
                     console.log('---------------------------');

                    me.arraylistaTaller = respuesta.taller;
                    me.paginationU= respuesta.paginationU;
                    /* me.usuarioNombre = respuesta.user_nombre;
                    me.usuarioId = respuesta.user; */
                   /*  me.obraId = respuesta.id;
                    me.usuarioId= respuesta.userid; */
                    //me.hoy = respuesta.hoy;
                   
                                        console.log(me.arraylistaTaller);
                                      /*   console.log(me.usuarioNombre);
                                        console.log(me.hoy); */

                })
                .catch(function (error) {
                    console.log(error);
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                });
            },
            validarIdObra(){
                this.errorObra=0;
                //console.log('validarObra1')
                this.errorMostrarMsjObra =[];
                
     

                /* if (!this.buscar) this.errorMostrarMsjObra.push("Codigo de obra no válido o  no puede estar vacío."); */
                //if (this.buscar.length!=8) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.)");
                if (this.buscar.substr(-5,1)!='/') this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.) Ej 1/2018 :"+this.buscar.substr(-5,1));
                if (this.buscar.length>9 || this.buscar.length<6) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta Ej 1/2018)");
                if (this.errorMostrarMsjObra.length) this.errorObra = 1;
                //console.log('validarObra2'+this.errorMostrarMsjObra)

                return this.errorObra;
            },
            buscarObra (buscar, event){
            
                if (event) event.preventDefault()
           
               let me=this;
               me.textoObra = '';  
               
                if (this.validarIdObra()){
                    return;
                }
             
                var url= '/obraid?&buscar='+this.buscar;
                 axios.get(url).then(function (response) {
                    var respuesta= response.data;

                     console.log('--------BUSCAR OBRA---'); 
                     console.log(respuesta); 
                     console.log('----------------------');
                    me.arrayObras = respuesta.obra.tblobras_registro;
                    if (typeof me.arrayObras === "undefined"){                    
                            
                            me.buscarResponseError = 'Undefined : CODIGO INEXISTENTE';
                            me.buscarResponse= '';
               
                            return me.buscarResponseError;

                        }else{
                          
                            me.buscarResponseError = '';
                            me.textoObra = me.arrayObras.TEXTO;
                            me.codigoAlta = me.arrayObras.CODIGO;
                          
                            return me.buscarResponse = me.arrayObras.TEXTO;
                            
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
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  




                    console.log(error);
                }); 
               // if (this.errorMostrarMsjObra.length) this.errorObra = 1;
            },
        
        },
        mounted() {
            this.listaUsuarios();
          
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>