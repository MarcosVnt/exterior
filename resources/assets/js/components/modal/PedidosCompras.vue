

<template>
   <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalPedidoCompra"
            tabindex="-1" :class="{'mostrar' : ModalPedidoCompra}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                             <h4 class="modal-title" v-text="Titulo"></h4>
                            <button type="button" class="close"             data-dismiss="modal"                         @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group ">

                                        <label class="control-label" for="referencia">Codigo Rotuleon</label>
                                        <input
                                            type="number"
                                            v-model="referencia"
                                            id="referencia"
                                            name="referencia"
                                            class="rm-m2 form-control"
                                            
                                            />
                                    
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-9">

                                    <div class="form-group ">
                                        <label class="control-label" for="referencia">Descripción Artículo</label>
                                        <input
                                            type="text"
                                            v-model="descripcion"
                                            id="descripcion"
                                            name="descripcion"
                                            class="rm-m2 form-control"
                                            
                                            />
                                    
                                    </div>
                                </div>
                            
                                
                            </div>



                             <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group ">

                                        <label class="control-label" for="codigoProveedor">Codigo Proveedor</label>
                                        <input
                                            type="text"
                                            v-model="codigoProveedor"
                                            id="codigoProveedor"
                                            name="codigoProveedor"
                                            class="rm-m2 form-control"
                                            
                                            />
                                    
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-9">

                                    <div class="form-group ">
                                        <label class="control-label" for="proveedor">Nombre Proveedor</label>
                                        <input
                                            type="text"
                                            v-model="proveedor"
                                            id="proveedor"
                                            name="proveedor"
                                            class="rm-m2 form-control"
                                            
                                            />
                                    
                                    </div>
                                </div>
                            
                                
                            </div>

                              


                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="anchura">Anchura</label>
                                        <input
                                        type="number"
                                        v-model.number="anchura"
                                        v-on:change="calcularLinea"
                                        id="anchura"
                                        name="anchura"
                                        class="rm-width form-control"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="altura">Altura</label>
                                        <input
                                        type="number"
                                        v-model.number="altura"
                                        v-on:change="calcularLinea"
                                        id="altura"
                                        name="altura"
                                        class="rm-height form-control"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label" for="metros">M2 Unidad</label>
                                        <input
                                        type="number"
                                        v-model.number="metros"
                                        id="metros"
                                        name="metros"
                                        class="rm-m2 form-control"
                                        readonly
                                        />
                                    </div>
                                    </div>
                                </div>

                                


        <div class="row">
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label style="color: green" class="control-label" for="bultos"
                  >CANTIDAD</label
                >
                <input
                  type="number"
                  v-model.number="bultos"
                  id="bultos"
                  name="bultos"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
              </div>
            </div>
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label
                  v-if="tipoUnidad === 'M2'"
                  class="control-label"
                  for="unidades"
                >
                  {{ tipoUnidad }}
                </label>
                <input
                  v-if="tipoUnidad === 'M2'"
                  type="number"
                  v-model.number="unidades"
                  id="unidades"
                  name="unidades"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
                <!--  <input
                  v-else
                  type="number"
                  v-model.number="acUnidades"
                  id="unidades"
                  name="tipoUnidad"
                  v-on:change="calcularLinea"
                  class="rm-uds form-control"

                />-->
              </div>
            </div>
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="tipoUnidad">Tipo Unidad</label>
                <select
                  class="form-control col-md-12"
                  v-on:change="calcularLinea"
                  v-model="tipoUnidad"
                >
                  <option value="Metros">Metros</option>
                  <option value="M2">M2</option>
                  <option value="Ml">Ml</option>
                  <option value="Ud">Ud</option>
                  <option value="Kg">Kg</option>
                  <option value="€">€</option>
                  <option value="Horas">Horas</option>

                  <option value="Litros">Litros</option>
                  <option value="Modulo">Modulo</option>
                </select>
              </div>
            </div>

           <!--  <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="precio">Coste Unidad</label>
                <input
                  type="number"
                  v-model.number="costeunidad"
                  id="costeunidad"
                  name="costeunidad"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
              </div>
            </div> -->
          </div>
<!-- 
LINEA DTO  -->
 <div class="row">
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="precio">Coste Unidad</label>
                <input
                  type="number"
                  v-model.number="costeunidad"
                  id="costeunidad"
                  name="costeunidad"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
              </div>
            </div>
           <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="dto">Dto</label>
                <input
                  type="number"
                  v-model.number="dto"
                  id="dto"
                  name="dto"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
              </div>
            </div>
          

            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="costefinal">Coste - dto</label>
                <input
                  type="number"
                  v-model.number="costefinal"
                  id="costefinal"
                  name="costefinal"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
              </div>
            </div>

              <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="costetotal">Importe
                    {{unidades}} x {{costefinal}}
                </label>
                <input
                  type="number"
                  v-model.number="costetotal"
                  id="costetotal"
                  name="costetotal"
                  class="rm-uds form-control"
                  v-on:change="calcularLinea"
                />
              </div>
            </div>
          </div>                               
                                
 <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label
                  style="color: green"
                  class="control-label"
                  for="descripcion"
                  >Comentarios  : 
                </label>
                <textarea
                  type="text"
                  v-model="comentarios"
                  id="comentarios"
                  name="comentarios"
                  class="rm-height form-control"
                  rows="8"
                ></textarea>
              </div>
            </div>

                      

                             

                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                    <div class="col-md-3">
                                        <input type="date" v-model="fecha" class="form-control" placeholder="Fecha">
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
                            <button type="button" class="btn btn-secondary"   data-dismiss="modal"
                            @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="TipoAccion==1" class="btn btn-primary" 
                            data-dismiss="modal"   
                            @click="registrarGestorcompra()">Guardar</button>
                            <button type="button" v-if="TipoAccion==2" class="btn btn-primary" @click="actualizarGestorcompra()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
</template>
<script>
export default {
    name: "PedidosCompras",
    props: {
         Modelo: {
      type: String,
    },
    Datos: { type: Object },
    Accion: Number,
    Titulo: String,
    TipoAccion: Number,
    Idx: Number,
    ModalPedidoCompra: Number,
    ComentarioCompra : String,
      

    },

    data(){
        return {

            fecha : new Date().toISOString().slice(0,10),

            modal:0,
                tituloModal:'',
                
                referencia :'',
                descripcion:'',
                
                codigoProveedor: '',
                proveedor :'',
                
                anchura :'',
                altura :'',
                metros:'',
                bultos:1,
                unidades: '',
                //percioUnidad:'',

                costeunidad: '',
                costetotal : '',
                tipoUnidad :'',
                dto :'',
                costefinal:'',
                comentarios :'',
                costetipoUnidad :'',
                //fecha :'',
                oferta :'',
                compra : '',

                errorGestorcompra: '',
errorMostrarMsjGestorcompra:'',

        };
    },


      mounted() {
    this.inicializar();
  },

    methods: {

        validarGestorcompra(){
                this.errorGestorcompra=0;
                this.errorMostrarMsjGestorcompra =[];

                if (!this.costetotal) this.errorMostrarMsjGestorcompra.push("Importe NO PUEDE ESTAR VACIO, revise cantidad y/o precio ");

                if (this.errorMostrarMsjGestorcompra.length) this.errorGestorcompra = 1;

                return this.errorGestorcompra;
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
                    'codigoProveedor': this.codigoProveedor,
                    'proveedor': this.proveedor,
                    'anchura': this.anchura,
                    'altura': this.altura,
                    'metros': this.metros,
                    'bultos': this.bultos,// cantidad
                    'tipoUnidad': this.tipoUnidad, 
                    'precio': this.precio,
                    'unidades': this.unidades,
                    'costeunidad': this.costeunidad,
                    'dto': this.dto,
                    'costefinal' : this.costefinal,
                    'costetotal' : this.costetotal,

                   'preciofinal': this.costefinal,
                    'comentarios': this.comentarios,
                    'costeunidad': this.costeunidad,
                    'fecha': this.fecha,
                    /* 'oferta': this.oferta,
                    'compra': this.compra */
                    
                }).then(function (response) {

                    swal({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                               type: "success",
                                background:"#179e6e",
                                          
                                title: "Pedido procesado correctamente"
                            });
                    me.cerrarGuardarModal();
                   // me.listarGestorcompra(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },


            
          actualizarGestorcompra(){
                if (this.validarGestorcompra()){
                console.log('validarGestorcompra'+this);
                
                return;
                }
                
                let me = this;
                console.log('actualizar'+this);

                axios.put('/compras/actualizar',{
                    'id': this.id,
                    'referencia': this.referencia,
                    'descripcion': this.descripcion,
                    'codigoProveedor': this.codigoProveedor,
                    'proveedor': this.proveedor,
                    'anchura': this.anchura,
                    'altura': this.altura,
                    'metros': this.metros,
                    'bultos': this.bultos,// cantidad
                    'tipoUnidad': this.tipoUnidad, 
                    'precio': this.precio,
                    'unidades': this.unidades,
                    'costeunidad': this.costeunidad,
                    'dto': this.dto,
                    'costefinal' : this.costefinal,
                    'costetotal' : this.costetotal,

                   'preciofinal': this.costefinal,
                    'comentarios': this.comentarios,
                    'costeunidad': this.costeunidad,
                    'fecha': this.fecha,
                    /* 'oferta': this.oferta,
                    'compra': this.compra */
                    
                }).then(function (response) {
             

                    swal({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                               type: "success",
                                background:"#179e6e",
                                          
                                title: "Pedido Actualizado correctamente"
                            });
                    me.cerrarGuardarModal();
                   // me.listarGestorcompra(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            calcularLinea(){

                console.log('CalcularLinea');
                let me = this;

                let ac = me.tipoUnidad;

                me.metros = +(me.anchura * me.altura).toFixed(3);

                if (me.metros > 0) {

                        me.unidades = +(me.metros * me.bultos).toFixed(3);
                        me.tipoUnidad = "M2";

                        console.log(" metros > 0 ",me.metros);
                } else {

                        me.unidades = me.bultos;
                        if (me.tipoUnidad === "M2") { me.tipoUnidad="Ud"};

                    // me.acTipoUnidad = "Ud";

                        console.log("else > 0 ", me.unidades, me.anchura,me.altura,me.metros);
                }

                if (me.dto > 0) {
        me.costefinal = +(+me.costeunidad - (me.costeunidad * me.dto) / 100).toFixed(2);
      } else {
        me.costefinal = me.costeunidad;
      }

             me.costetotal = (me.costefinal * me.unidades).toFixed(2);



            },
            inicializar(){
                let me = this;
                console.log('inicializar',
                'modalpedidocompra',me.modalpedidocompra,
                'Modelo',me.Modelo,
                'Datos',me.Datos,
                'Accion',me.Accion,
                'Titulo',me.Titulo,
                'TipoAccion',me.TipoAccion,
                'Idx',me.Idx,
                'ComentarioCompra',me.ComentarioCompra,

               );
                if(me.ComentarioCompra){
                    console.log('si ComentarioCompra',me.comentarios , me.ComentarioCompra);
                    me.comentarios = me.ComentarioCompra;
                    console.log('si ComentarioCompra',me.comentarios , me.ComentarioCompra);


                }else{
                    console.log('no ComentarioCompra');
                    me.comentarios = me.Datos['comentarios'];

                }
                


                if(me.Datos && me.Modelo==='pedido'){ 
                console.log('inicializar pedido', me.Modelo);

        
                me.descripcion=me.Datos['ARTICULO'];
                me.referencia = me.Datos['ARTICULO'];
                me.descripcion = me.Datos['DENOMINA'];
                me.proveedor = me.Datos['EMPRESA'];
                me.anchura = me.Datos['ANCHO'];
                me.altura = me.Datos['LONGITUD'];
                me.metros= me.Datos['M2'];
                me.precio = me.Datos['PRECIO'];
                me.tipoUnidad = me.Datos['TIPOUNIDAD'];
                me.unidades = me.Datos['UNIDAD'];

        

                me.costeunidad = me.Datos['PRECIO_C'];

                me.dto = me.Datos['DTO'],
                me.costefinal= me.Datos['PRECIO_F'];

                me.codigoProveedor = me.Datos['PROVEEDOR'];

                me.calcularLinea();
                
               
                //me.fecha = '';
                me.oferta ='';
                me.compra ='';


                }

                //interfaz para agrupar datos todo 

                if(me.Datos && me.Modelo==='gestorcompra'){ 

                console.log('inicializar gestorcompra', me.Modelo,me.Datos['id']);

                me.id = me.Datos['id'];
                me.descripcion=me.Datos['descripcion'];
                me.referencia = me.Datos['referencia'];
                me.descripcion = me.Datos['descripcion'];
                me.proveedor = me.Datos['proveedor'];
                me.anchura = me.Datos['anchura'];
                me.altura = me.Datos['altura'];
                me.metros= me.Datos['metros'];
                me.precio = me.Datos['precio'];
                me.tipoUnidad = me.Datos['tipoUnidad'];
                me.unidades = me.Datos['unidades'];
                        me.bultos = me.Datos['bultos'];


                me.costeunidad = me.Datos['costeunidad'];

                me.dto = me.Datos['dto'],
                me.costefinal= me.Datos['costefinal'];

                me.codigoProveedor = me.Datos['codigoProveedor'];

                me.calcularLinea();
                
               
                //me.fecha = '';
                me.oferta ='';
                me.compra ='';


                }
                
            },

             cerrarGuardarModal(){

                this.modal=0;
               
                 this.$emit("cerrarGuardarModal");
                 this.modalpedidocompra = 0 ; 
               console.log('cerrarGuardarModal');
             },

           cerrarModal(){

                this.modal=0;
                 this.$emit("cerrarModal");
                 this.modalpedidocompra = 0 ; 
               console.log('cerrarModal');
               this.tituloModal='';
                this.descripcion='';
                this.referencia = '',
                this.descripcion = '',
                this.proveedor = '',
                this.anchura = '',
                this.altura = '',
                this.metros= '',
                this.precio = '',
                this.unidad = '',
                this.dto = '',
                this.costefinal= '',
                this.comentarios = '',
                this.costeunidad = '',
                this.fecha = '',
                this.oferta = '',
                this.compra = ''



            },
               abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "gestorcompra":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.TipoAccion=1;
                                this.modal = 1;
                                this.tituloModal = 'Registrar Pedido Compra';
                                this.referencia = '';
                                this.descripcion = '';
                                this.proveedor = '';
                                this.anchura = '';
                                this.altura = '';
                                this.metros= '';
                                this.precio = '';
                                this.unidad = '';
                                this.dto = '';
                                this.costefinal= '';
                                this.comentarios = '';
                                this.costeunidad = '';
                                this.fecha = '';
                                this.oferta = '';
                                this.compra = '';
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar categoría';
                                this.TipoAccion=2;
                                this.gestorcompra_id=data['id'];
                                 this.referencia = data['referencia'];
                                this.descripcion = data['descripcion'];
                                this.proveedor = data['proveedor'];
                                this.anchura = data['anchura'];
                                this.altura = data['altura'];
                                this.metros= data['m2'];
                                this.precio = data['precio'];
                                this.unidad = data['unidad'];
                                this.dto = data['dto'];
                                this.costefinal= data['costefinal'];
                                this.comentarios = data['comentarios'];
                                this.costeunidad = data['costeunidad'];
                                //this.fecha = data['fecha'];
                                this.oferta = data['oferta'];
                                this.compra = data['compra'];
                                break;
                            }
                        }
                    }
                }
            }
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
