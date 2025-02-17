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
                        <i class="fa fa-align-justify"></i> Pedios de Compras
                        <button type="button" @click="abrirModal('gestorcompra','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <!-- <select class="form-control col-md-3" v-model="criterio">
                                      <option value="referencia">Referencia</option>
                                      <option value="descripcion">Descripción</option>
                                      <option value="proveedor">proveedor</option>

                                    </select> -->
                                    <input type="text" v-model="buscar" @keyup.enter="listarGestorcompra(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar --">
                                    <button type="submit" @click="listarGestorcompra(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                                 

                            </div>
                          
                        </div>
                       <div class="table-responsive">
                        <table  class="table table-bordered table-striped table-xl table-responsive table-condensed" cellspacing="0" width="100%">
                            <thead>                                
                                <tr>
                                    <th>Opciones</th>
<!--                                     <th>Código Rotuleon</th>
 -->                                    <th style="width: 40%">Descripción Del Articulo A Pedir</th>
<!--                                     <th>Código Proveedor</th>
 -->                                    <th>Proveedor</th>

                                     <th>Anchura</th>
                                      <th>Altura</th>
                                       <th>M2 Unidad</th>
                                        <th>Cantidad</th>
                                         <th>M2 totales</th>
                                         <th>Tipo Unidad</th>
                                        <th>Coste Unidad</th>

                                          <th>Dto</th>

                                           <th>Coste-dto</th>
                                           <th>Importe (M2totales * Coste-dto)</th>
                                           
                                            <th style="width: 30%">Comentarios de la linea de pedido</th>
                                              <th>Fecha</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="gestorcompra in arrayGestorcompra" :key="gestorcompra.id">
                                    <td>
                                       <!--  <button type="button" @click="abrirModal('gestorcompra','actualizar',gestorcompra)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button>  -->
                            <button
                              type="button"
                             @click="abrirModal('gestorcompra','actualizar',gestorcompra, gestorcompra.id)"
                             class="btn btn-sm btn-success edit_link"
                              title="Editar Linea De Pedido"
                            >
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>

                            <button
                              type="button"
                              @click="eliminarGestorCompra(gestorcompra.id)"
                              class="btn btn-sm btn-danger delete_link"
                              title="Eliminar Linea De Pedido"
                            >
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>

                                        <!-- <template v-if="gestorcompra.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarGestorcompra(gestorcompra.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarGestorcompra(gestorcompra.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template> -->
                                    </td>
<!--                                     <td v-text="gestorcompra.referencia"></td>
 -->                                    <td v-text="gestorcompra.descripcion"></td>

<!--                                     <td v-text="gestorcompra.codigoProveedor"></td>
 -->                                    <td v-text="gestorcompra.proveedor"></td>

                                    <td v-text="gestorcompra.anchura"></td>
                                    <td v-text="gestorcompra.altura"></td>
                                    <td v-text="gestorcompra.metros"></td>
                                    <td v-text="gestorcompra.bultos"></td>
                                    <td v-text="gestorcompra.unidades"></td>
                                    <td v-text="gestorcompra.tipoUnidad"></td>
                                    <td v-text="gestorcompra.costeunidad"></td>


                                    <td v-text="gestorcompra.dto"></td>
                                    <td v-text="gestorcompra.costefinal"></td>

                                    <td v-text="gestorcompra.costetotal"></td>

                                    <td v-text="gestorcompra.comentarios"></td>
                                  
                                   <!--  <td v-text="gestorcompra.fecha"></td> -->
                                    <td type="date">
                      {{ gestorcompra.fecha | fechaF }}
                    </td>

                                   <!--  <td>
                                        <div v-if="gestorcompra.compra">
                                            <span class="badge badge-success">Compra</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">-</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div v-if="gestorcompra.oferta">
                                            <span class="badge badge-success">Oferta</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">-</span>
                                        </div>
                                        
                                    </td> -->
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>

  <PedidosCompras
      v-if="modalpedidocompra"
      :Modelo="modelo"
      :Datos="data"
      :Accion="tipoAccion"
      :Titulo="tituloModalPedidoCompra"
      :TipoAccion="tipoAccion"
      :Idx="idx"
      :ComentarioCompra = "comentarioCompra"
      :ModalPedidoCompra="modalpedidocompra"
      @cerrarGuardarModal="cerrarGuardarModalPedidoCompra"
      @cerrarModal="cerrarModalPedidoCompra"
    >
     </PedidosCompras>
            <!--Inicio del modal agregar/actualizar-->
          <!--   <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Referencia</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="referencia" class="form-control" placeholder="Referencia">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Proveedor</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="proveedor" class="form-control" placeholder="Proveedor">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ancho</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="ancho" class="form-control" placeholder="Ancho">
                                    </div>
                               
                                    <label class="col-md-3 form-control-label" for="text-input">Longitud</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="longitud" class="form-control" placeholder="Longitud">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">M2</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="m2" class="form-control" placeholder="M2">
                                    </div>
                               
                                    <label class="col-md-3 form-control-label" for="text-input">Precio</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="precio" class="form-control" placeholder="Precio">
                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Unidad</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="unidad" class="form-control" placeholder="Unidad">
                                    </div>
                                </div>
                                 
                                
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dto</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="dto" class="form-control" placeholder="Dto">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                
                                    <label class="col-md-3 form-control-label" for="text-input">Precio Final</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="preciofinal" class="form-control" placeholder="Precio Final">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Comentarios</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="comentarios" class="form-control" placeholder="Comentarios">
                                    </div>
                                </div>

                                                         
                                 <div class="form-group row">
                            
                                    <label class="col-md-3 form-control-label" for="text-input">Coste Unidad</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="costeunidad" class="form-control" placeholder="Coste Unidad">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="fecha" class="form-control" placeholder="Fecha">
                                    </div>
                                </div>
                                 
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Compra</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="compra" class="form-control" placeholder="Compra">
                                    </div>
                                </div>
                                 
                                 
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Oferta</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="oferta" class="form-control" placeholder="Oferta">
                                    </div>
                                </div>
                                 



                                <div v-show="errorGestorcompra" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjGestorcompra" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarGestorcompra()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarGestorcompra()">Actualizar</button>
                        </div>
                    </div>
                   
                </div>
               
            </div> -->
            <!--Fin del modal-->
        </main>
</template>

<script>

import PedidosCompras from "./modal/PedidosCompras.vue";
import moment from "moment";


    export default {

         components: {
    PedidosCompras: PedidosCompras,
    },
        data (){
            return {

                comentarioCompra : '',
                gestorcompra_id: 0,
                referencia : '',
                descripcion : '',
                proveedor : '',
                ancho : '',
                longitud : '',
                m2 : '',
                precio : '',
                unidad : '',
                dto : '',
                preciofinal : '',
                comentarios : '',
                costeunidad : '',
                fecha : '',
                oferta : '',
                compra : '',


                arrayGestorcompra : [],
                modalpedidocompra : 0,
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
         filters: {
    fechaF: function (value) {
      //console.log('fecha-->',value);
      if (!value) return "";
      return moment(String(value)).format("DD/MM/YYYY");
    },
  },
        methods : {
          
            
            listarGestorcompra (page,buscar,criterio){
                let me=this;
                var url= '/compras?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    //console.log(respuesta);
                    me.arrayGestorcompra = respuesta.gestorcompras.data;
                    me.pagination= respuesta.pagination;

                    
                    console.log(me.arrayGestorcompra);
                   // console.log(me.pagination);
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
                me.listarGestorcompra(page,buscar,criterio);
            },
            registrarGestorcompra(){
                if (this.validarGestorcompra()){
                console.log('validarGestorcompra'+this);
                
                return;
                }
                
                let me = this;
                console.log('registrarCompra'+this);

                axios.post('/compras/registrar',{
                    'referencia': this.referencia,
                    'descripcion': this.descripcion,
                    'proveedor': this.proveedor,
                    'ancho': this.ancho,
                    'longitud': this.longitud,
                    'm2': this.m2,
                    'precio': this.precio,
                    'unidad': this.unidad,
                    'dto': this.dto,
                    'preciofinal': this.preciofinal,
                    'comentarios': this.comentarios,
                    'costeunidad': this.costeunidad,
                    'fecha': this.fecha,
                    'oferta': this.oferta,
                    'compra': this.compra
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarGestorcompra(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarGestorcompra(){
               if (this.validarGestorcompra()){
                    return;
                }
                
                let me = this;

                axios.put('/compras/actualizar',{
                   'referencia': this.referencia,
                    'descripcion': this.descripcion,
                    'proveedor': this.proveedor,
                    'ancho': this.ancho,
                    'longitud': this.longitud,
                    'm2': this.m2,
                    'precio': this.precio,
                    'unidad': this.unidad,
                    'dto': this.dto,
                    'preciofinal': this.preciofinal,
                    'comentarios': this.comentarios,
                    'costeunidad': this.costeunidad,
                    'fecha': this.fecha,
                    'oferta': this.oferta,
                    'compra': this.compra
                }).then(function (response) {
                
                 me.listarGestorcompra(1,me.buscar,me.criterio);
                       
                me.cerrarModal();
                
                
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            eliminarGestorCompra(id){
               swal({
                title: 'Esta seguro de Eliminar Pedido de Compra?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/compras/eliminar',{
                        'id': id
                    }).then(function (response) {

                         me.listarGestorcompra(1,me.buscar,me.criterio);
                       
                       swal({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                               type: "success",
                                background:"#179e6e",
                                          
                                title: "Pedido eliminado correctamente"
                            });

                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarGestorcompra(id){
               swal({
                title: 'Esta seguro de activar esta categoría?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/categoria/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarGestorcompra(){
                this.errorGestorcompra=0;
                this.errorMostrarMsjGestorcompra =[];

                if (!this.referencia) this.errorMostrarMsjGestorcompra.push("El nombre de la Gestorcompra no puede estar vacío.");

                if (this.errorMostrarMsjGestorcompra.length) this.errorGestorcompra = 1;

                return this.errorGestorcompra;
            },
         /*    cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.descripcion='';
                this.referencia = '',
                this.descripcion = '',
                this.proveedor = '',
                this.ancho = '',
                this.longitud = '',
                this.m2= '',
                this.precio = '',
                this.unidad = '',
                this.dto = '',
                this.preciofinal= '',
                this.comentarios = '',
                this.costeunidad = '',
                this.fecha = '',
                this.oferta = '',
                this.compra = ''



            }, */
           
           cerrarModalPedidoCompra(){
             console.log('cerrarModalPedido');
                      this.tipoAccion=0;
                                this.modalpedidocompra = 0;
                                this.tituloModalPedidoCompra = '';
                                this.modelo = '';
                                this.data ='';
                                this.idx = '';
            },

            cerrarGuardarModalPedidoCompra(){
             console.log('cerrarGuardarModalPedidoCompra');
                      this.tipoAccion=0;
                                this.modalpedidocompra = 0;
                                this.tituloModalPedidoCompra = '';
                                this.modelo = '';
                                this.data ='';
                                this.idx = '';
                                this.listarGestorcompra(1,this.buscar,this.criterio);

                                
            },
           
           abrirModal(modelo, accion, data = [],idx){
                switch(modelo){
                    case "gestorcompra":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.tipoAccion=1;
                                this.modalpedidocompra = 1;
                                this.tituloModalPedidoCompra = 'Registrar Pedido Compra';
                                this.modelo = modelo;
                                this.data = {};
                                this.idx = 0;
                                
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modalpedidocompra=1;
                                this.tituloModalPedidoCompra='Actualizar Pedido Compra';
                                this.tipoAccion=2;
                                this.modelo = modelo;
                                this.data = data;
                                this.idx = idx;

                               /*  this.gestorcompra_id=data['id'];
                                 this.referencia = data['referencia'];
                                this.descripcion = data['descripcion'];
                                this.proveedor = data['proveedor'];
                                this.anchura = data['ancho'];
                                this.longitud = data['longitud'];
                                this.m2= data['m2'];
                                this.precio = data['precio'];
                                this.unidad = data['unidad'];
                                this.dto = data['dto'];
                                this.preciofinal= data['preciofinal'];
                                this.comentarios = data['comentarios'];
                                this.costeunidad = data['costeunidad'];
                                this.fecha = data['fecha'];
                                this.oferta = data['oferta'];
                                this.compra = data['compra']; */
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarGestorcompra(1,this.buscar,this.criterio);
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
