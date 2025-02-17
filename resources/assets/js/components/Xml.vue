<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Compras
                        <button type="button" @click="abrirModal('gestorcompra','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="referencia">Referencia</option>
                                      <option value="descripcion">Descripción</option>
                                      <option value="proveedor">proveedor</option>

                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarGestorcompra(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarGestorcompra(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>TITLE</th>
                                    <th>ARTIST</th>
                                    <th>COUNTRY</th>
                                    <th>COMPANY</th>
                                     <th>PRICE</th>
                                      <th>YEAR</th>
                                     

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="gestorcompra in arrayGestorcompra" :key="gestorcompra.id">
                                    <td>
                                        <button type="button" @click="abrirModal('gestorcompra','actualizar',gestorcompra)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="gestorcompra.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarGestorcompra(gestorcompra.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarGestorcompra(gestorcompra.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="gestorcompra.TITLE"></td>
                                    <td v-text="gestorcompra.ARTIST"></td>
                                    <td v-text="gestorcompra.COUNTRY"></td>
                                    <td v-text="gestorcompra.COMPANY"></td>
                                    <td v-text="gestorcompra.PRICE"></td>
                                    <td v-text="gestorcompra.YEAR"></td>
                                   

                                </tr>                                
                            </tbody>
                        </table>
                        <!-- <nav>
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
                        </nav> -->
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
          
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data (){
            return {
                  gestorcompra_id: 0,
                title : '',
                artist : '',
                country : '',
                company : '',
                price : '',
                year : '',
               


                arrayGestorcompra : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorGestorcompra : 0,
                errorMostrarMsjGestorcompra : [],
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
         
        },
        methods : {

            listarXml (){
               
                let me=this;
                var url= '/xml';
                axios.get(url)
                .then(function (response) {
                //console.info("response:", response.data);
                    var respuesta= response.data;
                    //console.log(respuesta);
                    me.arrayGestorcompra = respuesta.gestorcompras.CD;
                    

                       
                    console.log(me.arrayGestorcompra);
                    //console.log(me.pagination);
                    


                })
                //.then(response => console.info("response:", response))
                .catch(function (error) {
                    console.log(error);
                });
                
            }
           
            
         





        },
        mounted() {
            //this.listarCategoria(1,this.buscar,this.criterio);
            this.listarXml();
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
