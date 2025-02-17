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
                        <i class="fa fa-align-justify"></i> Listado de Compras
                        <!-- <button type="button" @click="abrirModal('gestorcompra','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button> -->
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <!-- <select class="form-control col-md-3" v-model="criterio">
                                      <option value="articulo">Articulo</option>
                                      <option value="descripcion">Descripción</option>
                                      <option value="proveedor">proveedor</option>

                                    </select> -->
                                    <input type="text" v-model="buscar" @keyup.enter="ComprasVntXml(buscar)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="ComprasVntXml(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar2</button>
                                </div>
                            </div>
                        </div>
                        <!-- style="overflow-x: auto" -->
                        <div class="table-responsive">
                        <table  class="table table-bordered table-striped table-xl table-responsive table-condensed" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>PROV</th>
                                    <th>EMPRESA</th>
                                    <th>ARTICULO</th>
                                    <th>DENOMINA    </th>
                                    <th>ANC</th>
                                    <th>LON</th>
                                    <th>M2</th>
                                    <th>PRECIO</th>
                                    <th>UNIDAD</th>
                                    <th>DTO</th>
                                    <th>PRECIO FINAL</th>
                                    <th>NOTAS</th>
                                    <th>COSTE</th>
                                    <th>FECHA</th>
                                    <th>COMPRA</th>
                                    <th>OFERTA</th>

                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="gestorcompra in arrayGestorcompra" :key="gestorcompra.denomina">

<!--                                 <tr v-for="gestorcompra in arrayGestorcompra" :key="gestorcompra.id">
 -->
                                     <!-- <td>
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
                                    </td> -->
                                    <!-- <td v-text="arrayGestorcompra.length" ></td> -->
                                    <td v-text="gestorcompra.PROVEEDOR"></td>
                                    <td v-text="gestorcompra.EMPRESA"></td>
                                    <td v-text="gestorcompra.ARTICULO"></td>
                                    <td v-text="gestorcompra.DENOMINA"></td>
                                    <td v-text="gestorcompra.ANCHO"></td>
                                    <td v-text="gestorcompra.LONGITUD"></td>
                                    <td v-text="gestorcompra.M2"></td>
                                    <td v-text="gestorcompra.PRECIO"></td>
                                    <td v-text="gestorcompra.UNIDAD"></td>
                                    <td v-text="gestorcompra.DTO"></td>
                                    <td v-text="gestorcompra.PRECIO_F"></td>
                                    <td v-text="gestorcompra.NOTAS"></td>
                                    <td v-text="gestorcompra.COSTE_U"></td>
                                    <td v-text="gestorcompra.FECHA"></td>
                                    <td v-text="gestorcompra.COMPRA"></td>
                                    <td v-text="gestorcompra.OFERTA"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                   <!--  <nav>
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
                        </nav>  -->
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
                proveedor : '',
                empresa : '',
                articulo : '',
                denomina : '',
                ancho : '',
                longitud : '',
                m2 : '',
                precio : '',
                unidad : '',
                dto : '',
                precio_f : '',
                notas : '',
                coste_u : '',
                fecha : '',
                compra : '',
                oferta : '',
   
               

               arrayGestorcompra2 : [ { ANCHO: '00', ARTICULO: 'VNT', DENOMINA: 'VNT'}],
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

            ComprasVntXml (buscar){
               
                  
                
               
                let me=this;
                var url= 'comprasvnt?'+'&buscar='+buscar;
                
              
                axios.get(url)
                .then(function (response) {

 var self = this; 
    parseString(response.data, function (err, result) {
      self.events = result
                      console.info("response:", self.events);

    });   
                console.info("response:", self);
                //console.info("response:", response.data);




                    
                    var respuesta= response.data;
                    console.log('---------respuesta----------------',respuesta);
                    console.log(response.data);
                    console.log('respuesta.gestorcompras.articulo',respuesta.gestorcompras.articulo);
 
                    
                    //console.log(len(respuesta));
                  /*   console.log('---------respuesta.gestorcompras.articulo----------------');
                    console.log(respuesta.gestorcompras);
                    console.log('-------------------------'); */
                    me.arrayGestorcompra = respuesta.gestorcompras.articulo;
                    
/* 
                        console.log('---------me.array----------------');
                    console.log(me.arrayGestorcompra);
                    console.log('-------------------------'); */
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
            this.ComprasVntXml(this.buscar);
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
