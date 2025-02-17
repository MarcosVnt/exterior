<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Obra - Resumen
                        <!-- <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button> -->
                    </div>
                    <div class="card-body">
                        
                    <div v-if="verListaObras">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="codigo">Codigo Obra</option>
                                      <option value="nombre">Nombre Obra</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarObras(1,criterio,buscar)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarObras(1,criterio,buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                   <!--  <th>Nombre</th> -->
                                  <!--   <th>Tipo Documento</th>
                                    <th>Número</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th> -->
                                    <th>codigo Obra</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="obras in arrayObras" :key="obras.id">
                                    <!-- <td>
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="persona.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(persona.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td> -->
                                    <td>
                                        <button type="button"  @click="listarHorasObra(obras.id,obras.codigo,obras.nombre,1)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;     
                                    </td>                            
                                    <td v-text="obras.codigo"></td>
                                    <td v-text="obras.nombre"></td> 
                                    <td>
                                        
                                        <div v-if="obras.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
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
                    </div>
                    <div v-if="verListaObrasHoras">
                       <!--  <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="codigo">Codigo Obra</option>
                                      <option value="nombre">Nombre Obra</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarObras(1,criterio,buscar)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarObras(1,criterio,buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div> -->
                        <button type="submit" @click="listarObras(1,criterio,buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Listar Obras</button>
                         <div class="form-group row alert alert-primary ">
                            <div class="col-md-3">
                                <h6>{{codigoObra}}</h6>
                            </div>
                            <div class="col-md-7">
                                <h6>{{nombreObra}}</h6>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered table-striped table-sm">
                            <thead>
                               <!--  <tr>
                                   <th v-bind="codigoObra"></th>
                                   <th v-bind="nombreObra"></th>
                                </tr> -->
                                <tr>
<!--                                     <th>Opciones</th> -->
                                   <!--  <th>Nombre</th> -->
                                  <!--   <th>Tipo Documento</th>
                                    <th>Número</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th> -->
                                    <th>Usuario</th>
                                    <th>Descripción</th>
                                    <th>Dia</th>
                                    <th>de hora</th>
                                    <th>a hora</th>
                                    <th>Horas</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="horasObras in arrayHorasObras" :key="horasObras.id">
                                    <!-- <td>
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="persona.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(persona.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td> -->
                                   <!--  <td>
                                        <button type="button"  @click="listarHorasObra(obras.id)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;     
                                    </td>     -->                        
                                    <td v-text="horasObras.name"></td>
                                    <td v-text="horasObras.texto"></td>
                                    <!-- <td v-text="horasObras.de_fecha_hora"></td>
                                    <td v-text="horasObras.a_fecha_hora"></td> -->
                                    <td >{{horasObras.de_fecha_hora | moment("YY.MM.DD")}}</td>
                                    <td>{{horasObras.de_fecha_hora| moment("HH:mm")}}</td>
                                    <td>{{horasObras.a_fecha_hora| moment("HH:mm")}}</td>
                                     <td>{{horasObras.minutos/60}}</td>
 <!--                                     <td>{{moment.duration(horasObras.de_fecha_hora.diff(horasObras.a_fecha.hora))}}</td>                                   
 -->
                                    <td>
                                        
                                        <div v-if="horasObras.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <div class="form-group row alert alert-primary">
                            <div class="col-md-4 ">
                               <h6>Total Horas :</h6>
                            </div>
                            <div class="col-md-4">
                               <h6> {{totalHoras}}</h6>
                            </div>
                        </div>
                         <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="paginationH.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPaginaH(paginationH.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumberH" :key="page" :class="[page == isActivedH ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPaginaH(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="paginationH.current_page < paginationH.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPaginaH(paginationH.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    

                    
                    </div>
                    <obraDia></obraDia>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
           <!--  <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                             
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Role</label>
                                    <div class="col-md-9">
                                        <select v-model="idrol" class="form-control">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="role in arrayRol" :key="role.id" :value="role.id" v-text="role.nombre"></option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control" placeholder="Nombre del usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">password</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="password del usuario">
                                    </div>
                                </div>
                                <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                        </div>
                    </div>
                    <!.modal-content
                </div> -->
                <!-- /.modal-dialog>
            </div> -->
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        props : ['ruta'],
        data (){
            return {
                idObra : '',
                codigoObra: '',
                nombreObra: '',

                verListaObras: 'ver',
                verListaObrasHoras:'',
                 modal : 0,
                tituloModal : '',
               
               arrayObras : [],
               arrayHorasObras :[],
               arrayTodasHorasObras : [],
                errorObra : 0,
                errorMostrarMsjObra : [],
                paginationH : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
               
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
                buscar : '',
            }
        },
        computed:{
            totalHoras: function(){
                                console.log('TOOOOOOOOOOOOOOOOTAL HORAS');

                console.log(this.arrayTodasHorasObras);
                return this.arrayTodasHorasObras.reduce(function(total,item){
                   return (total+item.minutos/60); 
                },0);
            

            },
               isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
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

            },
        
            
            isActivedH: function(){
                return this.paginationH.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumberH: function() {
                if(!this.paginationH.to) {
                    return [];
                }
                
                var from = this.paginationH.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.paginationH.last_page){
                    to = this.paginationH.last_page;
                }  

                var pagesArrayH = [];
                while(from <= to) {
                    pagesArrayH.push(from);
                    from++;
                }
                return pagesArrayH;             

            }
        },
         
        methods : {

               
              listarObras (page,criterio,buscar){
                let me=this;
                    this.verListaObras='ver';
                    this.verListaObrasHoras='';
                /* var url= this.ruta + '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio; */
                //var url= '/obra/listar?page=' + page +'&criterio='+ criterio+'&buscar='+ buscar ;
                var url= '/obra/listar?page=' + page +'&criterio='+ criterio+'&buscar='+ buscar ;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    
                    console.log('-------listarObras-----------');
                    //console.log(this.current_page);
                    console.log(response);

                    me.arrayObras = respuesta.listaObras.data;
                   
                    me.pagination= respuesta.pagination;
                    console.log(respuesta);
                    console.log(me.pagination);
                                        console.log('----fin---listarObras-----------');


                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarHorasObra (obra,codigo,nombre,page){
                    this.idObra = obra;
                    this.codigoObra=codigo;
                    this.nombreObra = nombre;
                    this.verListaObras='';
                    this.verListaObrasHoras='ver';
                    console.log(obra);
                let me=this;
              
                var url= '/obraMano/horas?obra='+obra+'&page='+page ;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    
                    console.log('--------listarHorasObra----------');
                    //console.log(this.current_page);
                    console.log(response);

                    me.arrayHorasObras = respuesta.listaHorasObra.data;
                     me.arrayTodasHorasObras = respuesta.listaTodasHorasObra;
                    me.paginationH= respuesta.paginationH;
                    console.log(respuesta);
                     console.log(respuesta.listaHorasObra);
                     console.log(respuesta.listaHorasObra.data);

                    console.log(me.arrayHorasObras);

                    console.log('pagination'+response);
                                        console.log('-----FIN---listarHorasObra----------');


                })
                .catch(function (error) {
                    console.log(error);
                });
             },
             cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                 this.listarObras(page,criterio,buscar);
            },
             cambiarPaginaH(page,buscar,criterio){
                                     console.log('--------cambiarPaginaH----------');
                                     console.log(page);
                                     console.log(buscar);
                                     console.log(page);

                let me = this;
                //Actualiza la página actual
                me.paginationH.current_page = page;
                //Envia la petición para visualizar la data de esa página
                // this.listarHorasObra(page,criterio,buscar);
                this.listarHorasObra(this.idObra,this.codigoObra,this.nombreObra,page)
            },
     
            
        },
        mounted() {
            this.listarObras(1,this.criterio,this.buscar);
            
           //  this.listarHorasObra();
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
