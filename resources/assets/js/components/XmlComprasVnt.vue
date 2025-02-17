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
                        <i class="fa fa-align-justify"></i> LISTADO DE COMPRAS
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
                                    <button type="submit" @click="ComprasVntXml(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                   
                                    <input type="text" v-model="buscar" @keyup.enter="filtroXmlNotas(buscar)" class="form-control" placeholder="Filtro">
                                    <button type="submit" @click="filtroXmlNotas(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Filtro Notas</button>
                                </div>
                            </div>
                              <div class="col-md-3">
<a href="/comprasvntxls" class="btn btn-xs btn-info pull-right">EXPORTAR EXCEL</a>

                                     </div>
                        </div>
                        <!-- style="overflow-x: auto" -->
                        <div class="table-responsive-sm">
                        <table  class="table table-bordered table-striped table-responsive table-condensed" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                     <th>Opciones</th> 
                                    <th>EMPRESA</th>
                                    <!-- <th>ARTICULO</th> -->
                                    <th>DENOMINA    </th>
                                       <th>PRECIO</th>
                                       <th>DTO</th>
                                       <th>COSTE UNIDAD</th>
                                       
                                    <th>UNIDAD</th>
                                    <th>ANC</th>
                                    <th>LON</th>
                                    <th>M2</th>

                                  <!--   <th>NOTAS</th> -->
                                     <th>COMENTARIOS</th>

                                    <th>FECHA</th>
                                  

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(gestorcompra,idx) in arrayGestorcompra" :key="idx">
                             
                                    <!-- <td v-text="arrayGestorcompra.length" ></td> -->
                                   <!--  <td v-text="gestorcompra.PROVEEDOR"></td> -->
                                    
                                     <td style="background-color: #f4f4f4">
                                      <div class="btn-group btn-budget-group pull-right">
                                        <button
                                          type="button"
                                          data-toggle="modal"
                                          data-target="#modalPedidoCompra"
                                          @click.prevent="
                                            abrirModalPedidoCompra(
                                              'pedido',
                                              'registrar',
                                              gestorcompra,
                                              idx,
                                              filterNota(gestorcompra)
                                            )
                                          "
                                          class="btn btn-sm btn-success"
                                          title="Alta Nuevo Componente"
                                        >
                                          <i class="icon-plus"></i>
                                        </button>
                                        {{ filterPedidosCompras(gestorcompra)}}
                                        </div>
                            </td>

                                    <td v-text="gestorcompra.EMPRESA"></td>
                                   <!--  <td v-text="gestorcompra.ARTICULO"></td> -->
                                    <td v-text="gestorcompra.DENOMINA"></td> 
                                  
                                    <td v-text="gestorcompra.PRECIO"></td>
                                    <td v-text="gestorcompra.DTO"></td>
                                    <td v-text="gestorcompra.COSTE_U"></td>
                                    
                                    <td v-text="gestorcompra.TIPOUNID"></td>

                                    <td v-text="gestorcompra.ANCHO"></td>
                                    <td v-text="gestorcompra.LONGITUD"></td>
                                    <td v-text="gestorcompra.M2"></td>
                                 
                               <!--      <td v-text="gestorcompra.UNIDADTIPOUNID"></td>
                                    
                                    <td v-text="gestorcompra.DTO"></td>
                                    <td v-text="gestorcompra.PRECIO_F"></td> -->
                                   <!--  <td v-text="gestorcompra.NOTAS">  -->                              
                                      
                                    </td>
                                    <td 
                                    id="mouses"
                                    @click="mostrarArticuloNota(gestorcompra,idx)"
                                     data-toggle="modal"
                                     data-target="#modalArticuloNota"
                                     v-text="filterNota(gestorcompra)">
                                     
   
                                     </td>
                               
                                 <!--  oo  {{filterNota(gestorcompra)}}00 -->
                           <!--  <button
                              type="button"
                              @click="mostrarArticuloNota(gestorcompra,idx)"
                              class="btn btn-sm btn-success"
                              title="Mover Articulo"
                            >+N
                              <i class="fa fa-level-up" aria-hidden="true"></i>
                            </button> -->
                               
                                <!--     <td v-text="gestorcompra.COSTE_U"></td> -->
                                    <td v-text="gestorcompra.FECHA"></td>
                                  <!--   <td v-text="gestorcompra.COMPRA"></td>
                                    <td v-text="gestorcompra.OFERTA"></td> -->
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




             <!-- MODAL NOTAS ARTICULOS 
              -->

    <div
      class="modal fade"
      id="modalArticuloNota"
      tabindex="-1"
      :class="{ mostrar: modalArticuloNota }"
      :draggable="true"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >Notas de Articulo</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModalArticuloNota()"
              aria-label="Close"
            >
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-12">
                  {{codigoArticuloNota}}-{{codigoProveedorNota}}
                <div class="input-group">
                
                  <textarea
                    type="text"
                    v-model="articuloNota"
                   name="observaciones"
                      class="rm-height form-control"
                      rows="10"
                  ></textarea>

                
                </div>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="guardarModalArticuloNota()"
            >
              Guardar
            </button>

            <button v-if="articuloNota"
              type="button"
              class="btn btn-danger"
              data-dismiss="modal"
              @click="eliminarModalArticuloNota()"
            >
              Eliminar Nota
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
          
            <!--Fin del modal-->
        </main>
</template>

<script>

import PedidosCompras from "./modal/PedidosCompras.vue";

    export default {
       components: {
    PedidosCompras: PedidosCompras,
    },
        data (){
            return {

                comentarioCompra: '',
                modalpedidocompra:0,
                tituloModalPedidoCompra:'',
                codigoArticuloNota: '',
                codigoProveedorNota: '',
                articuloNota:'',
                modalArticuloNota:0,
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
                pedidosCompras: '',
                coste_u : '',
                fecha : '',
                compra : '',
                oferta : '',
   
               

               arrayGestorcompra3 : [ { ANCHO: '00', ARTICULO: 'VNT', DENOMINA: 'VNT'}],
                arrayGestorcompra2 : [],
               /*  arrayGestorcompra : {
                    ancho : '00',
                    ARTICULO: 'VNT'
                }, */
                 arrayGestorcompra : {},
                arrayGestorcompra4 : {  },
                    //articulo {ancho : '00', ARTICULO: 'VNT'},articulo{ ancho : '00', ARTICULO: 'VNT'
                
               

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
                buscar : '',

                logItems:{},
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

            },
           /*  resultCount () {
            return Object.keys(this.logItems).length 
            } */

         
        },
        methods : {

          filtroXmlNotas(b){
            console.log('filtroXmlNotas' , b);
             /*  return this.arrayGestorcompra.filter((componente) => {
        const compo = componente.articulo.toString().toLowerCase();

        return compo.includes(a.articulo);
      }); */
          },


           cerrarModalPedidoCompra(){
             console.log('cerrarModalPedido');
                     this.modalpedidocompra = 0;
                     this.tituloModalPedidoCompra="";
            },

   cerrarGuardarModalPedidoCompra(){
             console.log('cerrarGuardarModalPedidoCompra');
             this.ComprasVntXml(this.buscar);
                      this.tipoAccion=0;
                                this.modalpedidocompra = 0;
                                this.tituloModalPedidoCompra = '';
                                this.modelo = '';
                                this.data ='';
                                this.idx = '';
                               // this.listarGestorcompra(1,this.buscar,this.criterio);

                                
            },
         



 abrirModalPedidoCompra(modelo, accion, data = [], index,comentario) {
      // window.scrollTo(0,0);
      console.log(
        "abrirModalPedidoCompra",comentario,
        modelo,
        accion,
        data,
        //data.articulo.id,
        index,
        data["ARTICULO"]
      );
      this.modelo = modelo;
      this.accion = accion;
      this.data = data;
      this.idx = index;
      this.comentarioCompra = comentario;

      switch (modelo) {
        case "pedido": {
          switch (accion) {
            case "registrar": {
              this.modalpedidocompra = 1;
              console.log('modalpedidocompra registrar', this.modalpedidocompra);
              this.tituloModalPedidoCompra = "Alta de Pedido Compra";
                            this.tipoAccion = 1;

              //this.data = {};

              /* this.modalcomponente = 1;
              this.tituloModalComponente = "Alta de Componente";
               */
             /*  this.coIdPresupuesto = "";
              this.coIdPresupuestoLinea = "";

              this.coCodigoPrincipal = data.articulo;
              this.coDescripcion = "";
              this.coAnchura = "";
              this.coAltura = "";
              this.coMetros = "";
              this.coUnidades = "";
              this.coMermas = "";
              this.coPrecioFinal = "";
              this.coPrecio = "";

              this.coTipoUnidad = "";
              this.coBultos = "";
              this.coMontaje = "";
              this.coGastos = "";
              this.coSubcontratacion = "";
              this.coBeneficios = "";
              this.coPvp = "";
              this.coHoras = "";
              this.coObservaciones = "";
              this.coCodigo = "";
              this.coIdx = data["id"];

              this.coCostes = "";

              this.tipoAccion = 1 */;
              break;
            }
            case "actualizar": {
              console.log(
                "bbb abrir modal componente actualizar",
                data,
                data["descripcion"],
                index
              );

              this.modalpedidocompra = 1;

              /*               this.modalcomponente = 1;
               */ this.tituloModalPedidoCompra = "Actualizar Pedido Compra";

              this.tipoAccion = 2;

              this.coIdx = data["id"];

              this.coIdPresupuesto = data["idpresupuesto"];
              this.coIdPresupuestoLinea = data["idpresupuestolinea"];

              this.coCodigoPrincipal = data["articulo_principal"];
              this.coAltura = data["longitud"];
              this.coAnchura = data["ancho"];
              this.coBeneficios = data["beneficios"];
              this.coCodigo = data["articulo"];
              this.coDescripcion = data["descripcion"];
              //this.coHoras = data["horas"];
              this.coMetros = data["m2"];
              this.coMontaje = data["montaje"];
              this.coGastos = data["gastos"];
              this.coObservaciones = data["comentarios"];
              this.coPvp = data["importefinal"];
              this.coSubcontratacion = data["subcontratado"];
              this.coUnidades = data["cantidad"];
              this.coMermas = data["mermas"];
              this.coPrecioFinal = data["preciofinal"];
              this.coPrecio = data["precio"];
              this.coTipoUnidad = data["tipounidad"];
              this.coBultos = data["bultos"];
              this.coCostes = data["costes"];
              console.log(
                "abrir modal componente actualizar 2222",
                this.coDescripcion,
                data["descripcion"],
                index,
                data["id"]
              );

              break;
            }
          }
        }
      }
    },



    eliminarModalArticuloNota(id) {
      swal({
        title: "Anulamos Nota ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .put("/comprasvnt/eliminarnota", {
              articulo: me.codigoArticuloNota,
              proveedor: me.codigoProveedorNota,
                    nota: me.articuloNota,
            })
            .then(function (response) {
              swal(
                "Anulado!",
                "Articulo ha sido anulada con éxito.",
                "success"
              );
               me.cerrarModalArticuloNota();

                    
                   me.articuloNota = '';
                    me.ComprasVntXml(me.buscar);
            })
            .catch(function (error) {
              console.log(error);
              if (error.response.status === 401 || error.response.status === 419) {
                window.location = "/login";
              }
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
           

            cerrarModalArticuloNota(){
                     this.modalArticuloNota = 0;
            },

            filterNota(a){
               // const nota1 ;
               
                   // console.log('filternota 1111 ',a.ARTICULO);
                const q= this.notas.filter((nota) => {

                                console.log('filterNota 000',nota,'a',a);


                    const compo2 = nota.codigo.toString().toLowerCase()+'-'+nota.codigo_proveedor.toString().toLowerCase();
                    console.log('filternota 222222222222',nota,compo2);
                     

                    return compo2.includes(a.ARTICULO+'-'+a.PROVEEDOR);
                 });

                // console.log('filternota 33333',q, q[0]);
                 if(q[0]){
                     //console.log('44444',q[0]['nota']);
                     return q[0]['nota'];
                     }
                    // console.log('55555555');

                 return  ; 
                

            },

               filterPedidosCompras(a){
               // const nota1 ;
               
                   //console.log('filterPedidosCompras 1111 -a ',a);
                   if(a){
                      //console.log('filterPedidosCompras 1111 -b ',a);
                      const q= this.pedidosCompras.filter((pedido) => {
                          const compo2 = pedido.referencia;
                        
                          return compo2.includes(a.ARTICULO);
                            //+'-'+a.codigoProveedor);
                      });

                    if(q[0]){
                    //   console.log('44444',q[0]);
                        return q[0]['id'];
                     }
                    // console.log('55555555');

                 return  ; 
                
                     
                   }
               

               

                 return  ; 
                

            },


              mostrarArticuloNota(articulo,idx){
                console.log('articuloNota 11',articulo,idx,this.arrayGestorcompra);
                this.modalArticuloNota = 1;
                 let me = this;
                 let nota = me.filterNota(articulo);
                 me.articuloNota = nota;
                 me.codigoArticuloNota = articulo.ARTICULO;
                 me.codigoProveedorNota = articulo.PROVEEDOR;

                  console.log('articuloNota 22',me.codigoArticuloNota,articulo.ARTICULO);
                 
                 if(nota){
                      console.log('articuloNota 22',articulo,idx,nota,nota[0][nota]);
                                
                                 this.arrayGestorcompra[idx].articuloNota = nota[0].nota;
                                  console.log('articuloNota 33',this.arrayGestorcompra[idx]);
                 }


     

            },
            guardarModalArticuloNota(){
                let me = this; 

                console.log("agregarProductoTerminado");

                let $url = "comprasvnt/nota";

                axios
                    .post($url, {
                    /*TODO : GUARDAR GASTOS, ETC*/
                    proveedor : me.codigoProveedorNota,
                    articulo: me.codigoArticuloNota,
                    nota: me.articuloNota,
                    })
                    .then(function (response) {
                   me.cerrarModalArticuloNota();

                    
                   me.articuloNota = response.data.nota.nota;
                    console.log('axios nota',response, response.data, response.data.nota, me.articuloNota );
                    me.ComprasVntXml(me.buscar);
                 
                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
                    });
            },

            
            ComprasVntXml (buscar){
               
                  
                
               
                let me=this;
                var url= 'comprasvnt?'+'&buscar='+buscar;
             

                axios.get(url)
                .then(function (response) {
                    
                    var respuesta= response.data;
                    /* this.logItems = response.data;
                        console.log('count',this.resultCount); */

                    me.arrayGestorcompra = respuesta.gestorcompras.articulo;
                    me.notas = respuesta.notas;
                    
                    
                    me.pedidosCompras = respuesta.pedidosCompras;



                   

                  
                    /* console.log(response.status);
                    console.log(response.statusText);
                    console.log(response.headers);
                    console.log(response.config);
                    console.log(response.request); */
                console.log('---------------xmlcompras---------------',me.notas);
                
               /*  if(response.data.gestorcompras.articulo.length)
                {
                        console.log('LISTAR PRESUPUESTO entro');
                        swal({
                    type: "error",
                    title: "Error...",
                    text: "No hay registros que cumplan, las condiciones establecidas ",
                    });
                
                } */
                
                if (typeof me.arrayGestorcompra === "undefined"){                    
                    console.log('vacio');
                       swal({
                    type: "error",
                    title: "Error...",
                    text: "No hay registros que cumplan, las condiciones establecidas ",
                    });
                    return;
                }
                if (typeof me.arrayGestorcompra.length === "undefined"){  
                    me.arrayGestorcompra = respuesta.gestorcompras;
                  
                    console.log('sin longitud');
                    return;
                }
                if (me.arrayGestorcompra == 'object') {  
                    console.log('es object'); 
                }else{
                    console.log('es NO object'); 

                }
                if (Array.isArray(me.arrayGestorcompra)) {  
                    console.log('es Array'); 
                }else{
                    console.log('es NO Array'); 

                }

                console.log('------------------------------');

                 if (me.arrayGestorcompra2 == 'object') {  
                    console.log('arrayGestorcompra2 es object'); 
                }else{
                    console.log('arrayGestorcompra2es NO object'); 

                }
                if (Array.isArray(me.arrayGestorcompra2)) {  
                    console.log('arrayGestorcompra2 es Array'); 
                }else{
                    console.log('arrayGestorcompra2 es NO Array'); 

                }
 console.log('------------------------------');

                 if (me.arrayGestorcompra3 == 'object') {  
                    console.log('arrayGestorcompra4 es object'); 
                }else{
                    console.log('arrayGestorcompra4es NO object'); 

                }
                if (Array.isArray(me.arrayGestorcompra3)) {  
                    console.log('arrayGestorcompra4 es Array'); 
                }else{
                    console.log('arrayGestorcompra4 es NO Array'); 

                }
                    console.log(me.arrayGestorcompra.length);
                   //console.log(JSON.stringify(me.arrayGestorcompra)); 
                    /* console.log(JSON.stringify(response))
                        console.log('respuesta',respuesta);
                        console.log(Object.keys( me.arrayGestorcompra))
                        console.log('resme.arrayGestorcomprauesta',me.arrayGestorcompra);
                        console.log('json',JSON.parse(me.arrayGestorcompra)); */

                 /*    Object.assign(me.arrayGestorcompra,'a',1);
                                        console.log('despues',me.arrayGestorcompra);
 */

                })
                //.then(response => console.info("response:", response))
                .catch(function (error) {
                       console.log('401 compras',error);
                     if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }

                });
                
            },

            ComprasVntXml2 (buscar){
                var array1 =[];
                var array2 =[];

                let me1=this;
                var url= '/todasobras?buscar='+ buscar ;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log('11111111111111111');
                    console.log(response.data); 

    /* console.log(response.status);
    console.log(response.statusText);
    console.log(response.headers);
    console.log(response.config); */
                    arrayGestorcompra2 = respuesta.data;
                    console.log(arrayGestorcompra2);
                    //console.log(me1);

                })
                .catch(function (error) {
                    console.log(error);
                });
                   

                let me2=this;
                var url= '/comprasvnt?buscar='+ buscar ;
                axios.get(url).then(function (response) {
                     console.log('22222222222222');
                    var respuesta= response.data;
                     //console.log(respuesta);
                    me2.arrayGestorcompra = respuesta.gestorcompras.articulo;

                    console.log(me2.arrayGestorcompra);

                })
                .catch(function (error) {
                    console.log('401',error);
                     if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }

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
   /*  .table-responsive{-sm -md -lg -xl} */
#mouses:hover {
    background-color: #20a8d8;
}
   tr:hover td {
    background-color: rgb(208, 208, 245);
}

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

    .modal-dialog {
  max-width: 90% !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  background-color: #3c29297a !important;
  position: absolute !important;
  background-color: #3c29297a !important;
  /* display: none;
    position: relative;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 32em;
    max-width: 100%;
    padding: 1.25em;
    border-radius: .3125em;
    background-color: #fff;
    font-family: inherit;
    font-size: 1rem;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    overflow-x: hidden;
    overflow-y: auto */
}

    
</style>
