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
                        <i class="fa fa-align-justify"></i> Fotos Obra
                        <!-- <a class="nav-link" href="{{ route('logout') }}">Desconectar</a>
                        <button type="button" @click="abrirModal('fotoObra','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Añadir Fotos
                        </button> -->
                        <a class="nav-link" href="/altafoto" ><i class="icon-plus"></i> Añadir Fotos</a>

                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <!-- <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarRol(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarRol(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div> -->
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Obra</th>
                                    <th scope="col">usuario</th>
<!--                                     <th scope="col">Url</th>
 -->                                    <th scope="col" >Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="obrafoto in arrayObrafoto" :key="obrafoto.id">
                                    
                                    <td scope="row" v-text="obrafoto.obra_id"></td>
                                    <td v-text="obrafoto.user_id"></td>
<!--                                     <td v-text="obrafoto.imagen"></td>
 -->                                    <td>
                                        <!-- <img src="'storage/obras/images/'+obrafoto.obra_id" class="img-fluid"/> -->
                                        <img class="img-fluid" :src="`${obrafoto.imagen}`">
<!--                                     <img src={{ Storage::get(obrafoto.imagen);}} class="img-thumbnail">
 -->                                    </td>  
                                   <!--  <td>
                                        <div v-if="obrafoto.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td> -->
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        </main>
</template>

<script>
    export default {
        //props : ['ruta'],
        data (){
            return {
                obrafoto_id: 0,
                nombre : '',
                descripcion : '',
                arrayObrafoto : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
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
                buscar : ''
            }
        },
        computed:{
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

            }
        },
        methods : {
            listarFotosObras (page,buscar,criterio){
                let me=this;
                //var url= this.ruta + '/rol?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                var url= '/fotosobras?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     console.log(respuesta);
                    me.arrayObrafoto = respuesta.obraFoto.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                        if (error.response.status === 401) {
                         window.location = "/login";
                         }                
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarFotosObras(page,buscar,criterio);
            }
        },
        mounted() {
            this.listarFotosObras(1,this.buscar,this.criterio);
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
