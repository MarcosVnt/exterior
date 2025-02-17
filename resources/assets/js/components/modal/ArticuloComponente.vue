<template>
  <div
    class="modal fade"
    id="modalAltaArticuloComponente"
    tabindex="-1"
    :class="{ mostrar: ModalArticulo }"
    role="dialog"
    aria-labelledby="myModalLabel"
    style="display: none"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="loading" style="display: none">
          <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
          </div>
        </div>

        <div class="modal-header">
          <h4 class="modal-title" v-text="Titulo"></h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            @click="cerrarModal()"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!--  <button
              type="button"
              data-toggle="modal"
              data-target="#modalBuscarrArticulo"
              @click="abrirModalArticulo('articulo', 'buscar')"
              class="btn btn-sm btn-primary"
            >
              <i class="icon-plus"></i>&nbsp;Buscar Artículo :.
            </button> -->
            <button
              type="button"
              data-toggle="modal"
              data-target="#modalBuscarArticuloVnt"
              @click="buscarArticuloModal = true"
              class="btn btn-sm btn-primary"
            >
              <i class="icon-plus"></i>&nbsp;Buscar Artículo :.
            </button>

            <!--  <div class="col-md-6 col-sm-4">
                        <div class="form-group"><label class="control-label" for="anchura">Código</label> <input type="text" v-model="articulo.articulo" id="articulo" name="articulo" class="rm-width form-control" >  </div> 
              </div>-->

             <div v-if="Modelo==='tarifaProductoA'" class="col-md-12 col-sm-12">
              <div class="form-group">
                <label
                  style="color: green"
                  class="control-label"
                  for="referencia"
                  >REFERENCIA PRODUCTO TARIFA : {{Modelo}}
                </label>
                <input
                  type="text"
                  v-model="acReferencia"
                  id="referencia"
                  name="referencia"
                  class="rm-height form-control"
                
                ></input>
              </div>
            </div>  
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label
                  style="color: green"
                  class="control-label"
                  for="descripcion"
                  >DESCRIPCION : {{acId}}
                </label>
                <textarea
                  type="text"
                  v-model="acDescripcion"
                  id="descripcion"
                  name="descripcion"
                  class="rm-height form-control"
                  rows="8"
                ></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="anchura">Anchura</label>
                <input
                  type="number"
                  v-model.number="acAnchura"
                  v-on:change="calcularTotalPvp"
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
                  v-model.number="acAltura"
                  v-on:change="calcularTotalPvp"
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
                  v-model.number="acMetros"
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
                  v-model.number="acBultos"
                  id="bultos"
                  name="bultos"
                  class="rm-uds form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label
                  v-if="acTipoUnidad === 'M2'"
                  class="control-label"
                  for="unidades"
                >
                  {{ acTipoUnidad }}
                </label>
                <input
                  v-if="acTipoUnidad === 'M2'"
                  type="number"
                  v-model.number="acUnidades"
                  id="unidades"
                  name="unidades"
                  class="rm-uds form-control"
                  v-on:change="calcularTotalPvp"
                />
                <!--  <input
                  v-else
                  type="number"
                  v-model.number="acUnidades"
                  id="unidades"
                  name="unidades"
                  v-on:change="calcularTotalPvp"
                  class="rm-uds form-control"

                />-->
              </div>
            </div>
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="unidades">Tipo Unidad</label>
                <select
                  class="form-control col-md-12"
                  v-on:change="calcularTotalPvp"
                  v-model="acTipoUnidad"
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

            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="precio">Coste Unidad</label>
                <input
                  type="number"
                  v-model.number="acPrecio"
                  id="precioU"
                  name="precioU"
                  class="rm-uds form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="mermas">%Mermas</label>
                <input
                  type="number"
                  v-model.number="acMermas"
                  id="mermas"
                  name="mermas"
                  class="rm-m2 form-control"
                  v-on:change="calcularTotalPvp"
                  v-on:input="calcularTotalPvp"
                />
              </div>
            </div>

            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label class="control-label" for="precio"
                  >Coste Unidad + Merma
                </label>
                <input
                  type="number"
                  v-model.number="acCosteMasMerma"
                  id="acPrecioFinalMe"
                  name="acPrecioFinalMe"
                  class="rm-uds form-control"
                  readonly
                />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="pvp">TOTAL COSTE </label>

                <input
                  type="number"
                  id="base"
                  v-model="acSubtotal2"
                  name="acBase"
                  class="form-control"
                  readonly
                />
                <!-- <div class="col-md-3 col-sm-4">
                  <h6>{{coUnidades*coPrecioFinal}}</h6>-->
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="beneficios"
                  >%Beneficios</label
                >
                <input
                  type="number"
                  v-model.number="acBeneficios"
                  id="beneficios"
                  name="beneficios"
                  class="form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="gastos">Gastos</label>
                <input
                  type="number"
                  v-model.number="acGastos"
                  id="gastos"
                  name="gastos"
                  class="form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="montaje">Montaje</label>
                <input
                  type="number"
                  v-model.number="acMontaje"
                  id="montaje"
                  name="montaje"
                  class="form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="subcontratacion"
                  >Subcontratacion</label
                >
                <input
                  type="number"
                  id="subcontratacion"
                  v-model.number="acSubcontratacion"
                  name="subcontratacion"
                  class="form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>

            <!--  <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="pvp">Beneficio Importe</label>

                <input
                  type="number"
                  id="beneficioImporte"
                  v-model="acBeneficioImporte"
                  name="beneficioImporte"
                  class="form-control"
                  readonly
                />
               
              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label style="color: green" class="control-label" for="precio"
                  >PRECIO VENTA UNIDAD</label
                >
                <input
                  type="number"
                  v-model.number="acPrecioVentaUnidad"
                  id="acPrecioFinalCo"
                  name="acPrecioFinalCo"
                  class="rm-uds form-control"
                  v-on:change="calcularTotalPvp"
                  readonly
                />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label style="color: green" class="control-label" for="pvp"
                  >SUBTOTAL</label
                >

                <input
                  type="number"
                  id="subtotal"
                  v-model="acSubtotal3"
                  name="subtotal"
                  class="form-control"
                  readonly
                />
              </div>
            </div>

            <div class="col-md-3 col-sm-3">
              <div class="form-group">
                <label style="color: green" class="control-label" for="precio"
                  >Dto%</label
                >
                <input
                  type="number"
                  v-model.number="acDto"
                  id="acDto"
                  name="acDto"
                  class="rm-uds form-control"
                  v-on:change="calcularTotalPvp"
                />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label style="color: green" class="control-label" for="pvp"
                  >PVP</label
                >

                <input
                  type="number"
                  id="pvp"
                  v-on:change="recalcularBeneficio"
                  v-model="acSubtotal4"
                  name="pvp"
                  class="form-control"
                />
                <!-- <div class="col-md-3 col-sm-4">
                  <h6>{{coUnidades*coPrecioFinal}}</h6>-->
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 col-sm-4"></div>
          <div
            class="col-sm-6 col-sm-12 no-width-info-content"
            style="display: block"
          >
            <!--<p>$ {{total=calcularPvp}}</p> -->
            <!--  <p v-if="coAltura >0 || coMetros > 0">
                  Total :
                  {{ coMetros = coAltura*coAnchura}}
              </p>-->
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-4"></div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal"
            @click="cerrarModal()"
          >
            Cerrar
          </button>
          <button
            type="button"
            v-if="TipoAccion == 1"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="guardarModal()"
          >
            Guardar
          </button>
          <button
            type="button"
            v-if="TipoAccion == 2"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="actualizarModal()"
          >
            Actualizar
          </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <BuscarArticuloVnt
      v-if="buscarArticuloModal"
      @agregarDetalleModal="traerArticuloVnt"
    ></BuscarArticuloVnt>
  </div>
</template>
<script>
import BuscarArticuloVnt from "./BuscarArticuloVnt.vue";

export default {
  name: "ArticuloComponente",

  props: {
    Modelo: {
      type: String,
    },
    Datos: { type: Array },
    Accion: String,
    Titulo: String,
    TipoAccion: Number,
    Idx: Number,
    ModalArticulo: Number,
  },
  components: {
    BuscarArticuloVnt: BuscarArticuloVnt,
  },

  data() {
    return {
      buscarArticuloModal: false,

      modalcomponente: 1, // true se muestra
      tituloModal: "",
      acDescripcion: "",
      acReferencia: "",
      acCodigoArticulo: "",
      acId:"",
      acIdPresupuesto:"",
      acIdPresupuestoLinea:"",
      acCodigoPrincipal:"",
      acAnchura: 0,
      acAltura: 0,
      acMetros: 0,
      acMermas: 0,
      acTipoUnidad: "Ud",
      acBultos: 1,
      acUnidades: 0,
      acPrecio: 0,
      acPrecioFinal: 0,
      acPrecioFinalCo: 0, // coste medio unidad
      acPrecioFinalMe: 0,
      acSubtotal: 0,
      acGastos: 0,
      acMontaje: 0,
      acSubcontratacion: 0,
      acBeneficios: 0,
      acBeneficioImporte: 0,
      acCostes: 0,
      acBase: 0,
      acPvp: 0,
      acDto: 0,
      acDtoImporte: 0,

      acCosteMasMerma: 0,
      acSubtotal1: 0,
      acSubtotal2: 0,
      acSubtotal3: 0,
      acSubtotal4: 0,
      acPrecioVentaUnidad: 0,

      // tipoAccion: "", // 1 - guardar 2-actualizar
    };
  },
  computed: {},
  mounted() {
    this.inicializar();
  },
  methods: {
    traerArticuloVnt(artVnt) {
      console.log("traerArticuloVnt", artVnt);
      this.acDescripcion = artVnt["DENOMINA"];

      this.acReferencia = artVnt["REFERENCIA"];
      
      this.acCodigoArticulo = artVnt["ARTICULO"];

      this.acAnchura = artVnt["ANCHO"];

      this.acAltura = artVnt["LONGITUD"];
      this.acMetros = artVnt["M2"];
      // this.acMermas=artVnt['mermas'];
      if (this.acMetros) {
        this.acTipoUnidad = "M2";
      } else {
        this.acTipoUnidad = "Ud";
      }
      this.acBultos = 1;
      this.acUnidades = artVnt["UNIDAD"];
      this.acPrecio = parseFloat(artVnt["PRECIO_C"]);

      //this.acPrecioFinal=artVnt['PRECIO_F'];

      this.acPvp = parseFloat(artVnt["PRECIO_F"]);
      console.log("INICIALIZAR");
      //      this.calcularTotalPvp();
    },
    inicializar() {
      console.log("bbb inicializar AC", this.ModalArticulo, this.Datos,this.$parent.componentes);
      /* if(this.Accion == "registrar"){
        tipoAccion = 1;
      } */

      // si es articulo y registrar
      // si es articulo y actualiar 
      // si es componente y registrar

      if (this.Datos.id) {

        if((this.Modelo ==="componente" || this.Modelo ==="tarifaProductoC") && this.Accion === "registrar"){
          
          console.log(" AAA if modelo y accion", this.Datos);

        this.acIdPresupuesto = this.Datos["idpresupuesto"];
        
        this.acIdPresupuestoLinea = this.Datos["idpresupuestolinea"];
        this.acCodigoPrincipal = this.Datos['articulo_principal'];
        

        }else{
        
        console.log("AAA if datos", this.Datos);

        this.acId = this.Datos["id"];
        this.acIdPresupuesto = this.Datos["idpresupuesto"];
        
        this.acIdPresupuestoLinea = this.Datos["idpresupuestolinea"];

         console.log("AAA if datos2", this.Datos, this.acId,  this.Datos["id"]);

        this.acDescripcion = this.Datos["descripcion"];
        
        this.acReferencia = this.Datos["referencia"];

        this.acCodigoArticulo = this.Datos["articulo"];
                this.acCodigoPrincipal = this.Datos['articulo_principal'];

        this.acAnchura = this.Datos["ancho"];

        this.acAltura = this.Datos["longitud"];
        this.acMetros = this.Datos["m2"];
        this.acMermas = this.Datos["mermas"];
        this.acTipoUnidad = this.Datos["tipounidad"];
        this.acBultos = this.Datos["bultos"];
        this.acUnidades = this.Datos["cantidad"];
        this.acPrecio = parseFloat(this.Datos["precio"]);
        this.acPrecioFinal = this.Datos["preciofinal"];
        //  this.acPrecioFinalCo=this.Datos['descripcion'];  // coste medio unidad
        //  this.acPrecioFinalMe=this.Datos['descripcion'];
        this.acGastos = this.Datos["gastos"];
        this.acMontaje = this.Datos["montaje"];
        this.acSubcontratacion = this.Datos["subcontratado"];
        this.acBeneficios = this.Datos["beneficios"];
        //this.acBeneficioImporte=this.Datos['descripcion'];

        this.acBase = this.Datos["base"];

        this.acPvp = this.Datos["importefinal"];
        this.acBeneficioImporte = +this.acPvp - +this.acBase;

        this.acDto = this.Datos["descuento"];
        // this.acDtoImporte =this.Datos['descripcion'];
        }
        console.log("INICIALIZAR");
        this.calcularTotalPvp();
      }
    },

    abrirModalArticulo(articulo, buscar) {},

    calcularM2() {
      //acnho x alto
    },
    calcularTotalPvp() {
     
      let me = this;

        me.acCosteMasMerma= 0;
      me.acSubtotal1 = 0;
      me.acSubtotal2 = 0;
      me.acSubtotal3 = 0;
      me.acSubtotal4 = 0;
      me.acPrecioVentaUnidad= 0; 


      let ac = me.acTipoUnidad;
    /*   me.acAnchura = Math.round(me.acAnchura);
      me.acAltura = Math.round(me.acAltura); */
                    me.acMetros = +(me.acAnchura * me.acAltura).toFixed(3);


      if (me.acMetros > 0) {

        me.acUnidades = +(me.acMetros * me.acBultos).toFixed(3);
        me.acTipoUnidad = "M2";

        console.log(" metros > 0 ",me.acMetros);
      } else {

        me.acUnidades = me.acBultos;
        if (me.acTipoUnidad === "M2") { me.acTipoUnidad="Ud"};

       // me.acTipoUnidad = "Ud";

        console.log("else > 0 ", me.acUnidades, me.acAnchura,me.acAltura,me.acMetros);
      }
      let precioCoste = 0 ;
      if (me.acMermas > 0) {
        me.acCosteMasMerma = +((me.acPrecio * me.acMermas) / 100 + me.acPrecio).toFixed(3);
        precioCoste = me.acCosteMasMerma;

        //me.acSubtotal1 = +(me.acCosteMasMerma * me.acUnidades).toFixed(2);
      } else {
        me.acCosteMasMerma = 0;
        precioCoste = me.acPrecio ;
       // me.acSubtotal1 = +(me.acPrecio * me.acUnidades).toFixed(2);
      }
        //coste      
        me.acSubtotal1 = +(precioCoste * me.acUnidades).toFixed(2);



      me.acSubtotal2 = +(+me.acSubtotal1 + +me.acMontaje + +me.acSubcontratacion + +me.acGastos).toFixed(2);

      if (me.acBeneficios > 0) {
        me.acSubtotal3 = +((me.acSubtotal2 * me.acBeneficios) / 100 + me.acSubtotal2).toFixed(2);
      } else {
        me.acSubtotal3 = me.acSubtotal2;
      }

      me.acPrecioVentaUnidad = +(me.acSubtotal3 / me.acBultos).toFixed(3);
      //me.acPrecioFinal;
      //170322 cambiado para que no actualice +(me.acSubtotal3 / me.acBultos).toFixed(3);

      //me.acSubtotal4 = me.acBultos * me.acPrecioVentaUnidad;

      if (me.acDto > 0) {
        me.acSubtotal4 = +(+me.acSubtotal3 - (me.acSubtotal3 * me.acDto) / 100).toFixed(2);
      } else {
        me.acSubtotal4 = me.acSubtotal3;
      }

      console.log(
        "calcularTotalPvp",
        me.acMetros,
        me.acSubtotal1,
        me.acSubtotal2
      );

      me.acPrecioFinal = me.acPrecioVentaUnidad;
      me.acCostes = me.acSubtotal1;
      me.acBase = me.acSubtotal3;
      me.acPvp = me.acSubtotal4;

      console.log("calcularTotalPvp", me.acPrecioFinal, me.acBase, me.acPvp);
    },
    
    recalcularBeneficio() {
      //coPvp
      
      let me = this;

      //paso uno , recalculo base con dto e importe final 

      //x(1-%b)=final  , x = final/1-%b
        me.acSubtotal3 = +(me.acSubtotal4 / (1-(me.acDto/100))).toFixed(2);

        me.acBeneficios = +(((me.acSubtotal3 - me.acSubtotal2) / me.acSubtotal2) * 100).toFixed(3);
/* 
 let bene2 = +([(me.articulos[objIndex].base - me.articulos[objIndex].costes) / me.articulos[objIndex].costes] * 100).toFixed(3); */





      console.log('recalcularBeneficio 1', me.acDto, me.acBeneficios, me.acBase, me.acSubtotal4);
      if(me.acDto== 0 || me.acDto === null){
          me.acBeneficios = +([(me.acSubtotal4 - me.acSubtotal2) / me.acSubtotal2] * 100).toFixed(3);
          me.acBeneficioImporte = +me.acSubtotal4 - +me.acSubtotal2;
          //me.acSubtotal4 = +((me.acSubtotal2 * me.acBeneficios) / 100 + me.acSubtotal2).toFixed(2);
        me.acSubtotal3 = +((me.acSubtotal2 * me.acBeneficios) / 100 + me.acSubtotal2).toFixed(2);


      me.acPrecioVentaUnidad = +(me.acSubtotal3 / me.acBultos).toFixed(3);
      //me.acPrecioFinal;
      //170322 cambiado para que no actualice +(me.acSubtotal3 / me.acBultos).toFixed(3);


            console.log('recalcularBeneficio 1.1', me.acDto, me.acBeneficios, me.acBase, me.acSubtotal4);

      }else{
            console.log('recalcularBeneficio 1.2', me.acDto, me.acBeneficios, me.acBase, me.acSubtotal4);
            //quito descuento

              let sinDto =  +(+me.acSubtotal4 - (me.acSubtotal3 * me.acDto) / 100).toFixed(2);
            // recalculo benefico



      }

      me.acCostes = me.acSubtotal2;
      me.acBase = me.acSubtotal3;
      me.acPvp = me.acSubtotal4;

            console.log('recalcularBeneficio 1000', me.acDto, me.acBeneficios, me.acBase, me.acSubtotal4);

      //total = base + benefico - dto ;
    },

    guardaPresupuesto() {
        console.log('aaa articulocomponete guardapresupuesto');
          this.$emit("guardaPresupuesto");
    },

    cerrarModal() {
      this.$emit("cerrarModal");
      this.modalcomponente = 0;
      this.modalarticulo = 0;

      this.acId = 0;
      this.acIdPresupuesto = 0;
      this.acDescripcion = "";
      this.acReferencia ="";
      this.acAnchura = 0;
      this.acAltura = 0;
      this.acMetros = 0;
      this.acMermas = 0;
      this.acTipoUnidad = 0;
      this.acBultos = 0;
      this.acPrecio = 0;
      this.acPrecioFinal = 0;
      this.acPrecioFinalCo = 0;
      this.acSubtotal = 0;
      this.acPrecioFinalMe = 0;
      this.acGastos = 0;
      this.acMontaje = 0;
      this.acSubcontratacion = 0;
      this.acBeneficios = 0;
      this.acBeneficioImporte = 0;
      this.acDto = 0;
      this.acDtoImporte = 0;
      this.acBase = 0;
      this.acCostes = 0;

      console.log(
        "cerrarModal",
        this.modalcomponente,
        this.Accion,
        this.Datos,
        this.Modelo
      );
    },


     guardarModal(){

      console.log('aaa guardarModal', this.Modelo);
      if(this.Modelo ===  "componente"){
          this.guardarModalComponente();

      }
      if(this.Modelo === "articulo"){
         this.guardarModalArticulo();

      } 
        if(this.Modelo === "tarifaProductoA"){
         this.guardarModalTarifaProductoArticulo();

      } 
         if(this.Modelo === "tarifaProductoC"){
         this.guardarModalTarifaProductoComponente();

      } 

    },

    




guardarModalTarifaProductoComponente() {
      let me = this;
      const nuevocodigoco =
        8000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);
      me.coCodigo = nuevocodigoco;

      //const lin = me.$parent.articulos.length + 1;


      console.log("guardarModalComponente", nuevocodigoco);

      axios
        .post("/tarifaproducto/componente/guardar", {
          //idpresupuesto: me.cabecera.id,
          //idpresupuestolinea: me.coIdx, // id del articulo
          articulo: me.acCodigoPrincipal,
          componente: nuevocodigoco,

           descripcion: me.acDescripcion,
            ancho: me.acAnchura,
            longitud: me.acAltura,
            m2: me.acMetros,
            mermas: me.acMermas,

            tipounidad: me.acTipoUnidad,
            bultos: me.acBultos,
            cantidad: me.acUnidades,

            precio: me.acPrecio,

            preciofinal: me.acPrecioFinal,

            gastos: me.acGastos,
            montaje: me.acMontaje,
            subcontratado: me.acSubcontratacion,

            costes: me.acCostes,

            beneficio: me.acBeneficios,

            base: me.acBase,

            dto: me.acDto,

            importefinal: me.acPvp,
            //linea : lin,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          //var componente = response.data.componente;
          //var idcompo = response.data.componente.id;

          console.log(
            "guardarModalComponente",
            response
            // response.data.componente.id
          );

          console.log(
            "guardarModalComponente componentes ",

            me.$parent.componentes
          );
          //me.insertComponente(idcompo);

          me.$parent.componentes.push({
            tipo: "C",
            articulo: response.data.tarifaProducto.articulo,
            componente: response.data.tarifaProducto.componente,
            descripcion: response.data.tarifaProducto.descripcion,
            m2: response.data.tarifaProducto.m2,
            ancho: response.data.tarifaProducto.ancho,
            longitud: response.data.tarifaProducto.longitud,
            tipounidad: response.data.tarifaProducto.tipounidad,
            cantidad: response.data.tarifaProducto.cantidad,
            montaje: response.data.tarifaProducto.montaje,
            gastos: response.data.tarifaProducto.gastos,
            subcontratado: response.data.tarifaProducto.subcontratado,
            beneficios: response.data.tarifaProducto.beneficios,

            mermas: response.data.tarifaProducto.mermas,
            precio: response.data.tarifaProducto.precio,

            preciofinal: response.data.tarifaProducto.preciofinal,
            importefinal: response.data.tarifaProducto.importefinal,
            costes: response.data.tarifaProducto.costes,
            id: response.data.tarifaProducto.id,
            bultos: response.data.tarifaProducto.bultos,
            linea: response.data.tarifaProducto.linea,
            descuento: response.data.tarifaProducto.descuento,
            base:response.data.tarifaProducto.base,
            

            //descuento

            comentarios: "observaciones",
          });

          //me.recalcularTotalArticulo("guardar", me.coCodigoPrincipal);

          //me.cerrarModalComponente();
         

          /*   swal(
                      "Insertado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); */
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
          this.cerrarModal();

      console.log("todo ", me.coCodigoPrincipal);
    },


    

  guardarModalTarifaProductoArticulo() {
      let me = this;
      
      console.log('guardarModalTarifaProducto',me.acDescripcion,'1:',!me.acDescripcion.length===0 ,'2: ', me.acDescripcion == null);
      
      if (!me.acDescripcion.length===0 || me.acDescripcion == null) {
        swal({
          type: "error",
          title: "Error...",
          text: "Descripcion Obligatoria!",
        });
       }

     /*  if (me.encuentra(me.acCodigoArticulo)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else { */

        const lin = me.$parent.articulos.length + 1;

        const nuevocodigo =
          9000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);


        axios
          .post("/tarifaproducto/articulo/guardar", {
            articulo: nuevocodigo,
            descripcion: me.acDescripcion,
            anchura: me.acAnchura,
            altura: me.acAltura,
            m2: me.acMetros,
            mermas: me.acMermas,

            tipounidad: me.acTipoUnidad,
            bultos: me.acBultos,
            cantidad: me.acUnidades,

            precio: me.acPrecio,

            preciofinal: me.acPrecioFinal,

            gastos: me.acGastos,
            montaje: me.acMontaje,
            subcontratado: me.acSubcontratacion,

            costes: me.acCostes,

            beneficio: me.acBeneficios,

            base: me.acBase,

            dto: me.acDto,

            importefinal: me.acPvp,
            linea : lin,
            referencia: me.acReferencia,
          })
          .then(function (response) {
            var articulo = response.data.tarifaProducto;

            console.log(
              "guardarModalArticulo",
              response,
              response.data.tarifaProducto
            );
                me.$parent.articulos.push({
              id: articulo.id,
              idpresupuesto: articulo.idpresupuesto,
              articulo: articulo.articulo,
              descripcion: articulo.descripcion,
              ancho: articulo.ancho,
              linea: articulo.linea,
              longitud: articulo.longitud,
              m2: articulo.m2,
              mermas: articulo.mermas,

              tipounidad: articulo.tipounidad,
              bultos: articulo.bultos,
              cantidad: articulo.cantidad,

              precio: articulo.precio,
              descuento: articulo.descuento,
              preciofinal: articulo.preciofinal,
              gastos: articulo.gastos,
              montaje: articulo.montaje,
              subcontratado: articulo.subcontratado,
              beneficios: articulo.beneficios,
              costes: articulo.costes,
              base: articulo.base,
              importefinal: articulo.importefinal,
              referencia: articulo.referencia,
            });
           

               swal(
                      "Insertado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); 
          })
          .catch(function (error) {
            console.log(error);
            if (error.response.status === 401 || error.response.status === 419) {
              window.location = "/login";
            }
          });

        console.log("guardarModalArticulo", me.articulos);
        this.cerrarModal();
     
      //}
    },



    


    guardarModalArticulo() {
      let me = this;
      console.log("inicializar", this.$parent.cabecera);

      if (!me.acDescripcion) {
        swal({
          type: "error",
          title: "Error...",
          text: "Descripcion obligatoria",
        });

        return;
      }

      if (this.$parent.cabecera.id === undefined) {
        swal({
          type: "error",
          title: "Error...",
          text: "Debe Guardar el presupuesto antes de añadir productos",
        });

        return;
      }

      if (me.encuentra(me.acCodigoArticulo)) {
        console.log(
          me.acCodigoArticulo || me.encuentra(me.acCodigoArticulo),
          me.acCodigoArticulo,
          me.encuentra(me.acCodigoArticulo)
        );
        swal({
          type: "error",
          title: "Error...",
          text: "Este artículo Vnt ya se encuentra agregado!",
        });
      } else {
        
        
        const lin = me.$parent.articulos.length + 1;

        const nuevocodigo =
          9000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);

        axios
          .post("/presupuesto/detalle/guardar", {
            idpresupuesto: me.$parent.cabecera.id,
            articulo: nuevocodigo,
            descripcion: me.acDescripcion,
            anchura: me.acAnchura,
            altura: me.acAltura,
            m2: me.acMetros,
            mermas: me.acMermas,

            tipounidad: me.acTipoUnidad,
            bultos: me.acBultos,
            cantidad: me.acUnidades,

            precio: me.acPrecio,

            preciofinal: me.acPrecioFinal,

            gastos: me.acGastos,
            montaje: me.acMontaje,
            subcontratado: me.acSubcontratacion,

            costes: me.acCostes,

            beneficio: me.acBeneficios,

            base: me.acBase,

            dto: me.acDto,

            importefinal: me.acPvp,
            linea : lin,

            /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
          })
          .then(function (response) {
            var articulo = response.data.detalle;

            console.log(
              "aaa guardarModalArticulo",
              response,
              /*  response,
              response.data.detalle, */
              "articulo-> ",
              articulo
            );
            me.$parent.articulos.push({
              id: articulo.id,
              idpresupuesto: articulo.idpresupuesto,
              articulo: articulo.articulo,
              descripcion: articulo.descripcion,
              ancho: articulo.ancho,
              linea: articulo.linea,
              longitud: articulo.longitud,
              m2: articulo.m2,
              mermas: articulo.mermas,

              tipounidad: articulo.tipounidad,
              bultos: articulo.bultos,
              cantidad: articulo.cantidad,

              precio: articulo.precio,
              descuento: articulo.descuento,
              preciofinal: articulo.preciofinal,
              gastos: articulo.gastos,
              montaje: articulo.montaje,
              subcontratado: articulo.subcontratado,
              beneficios: articulo.beneficios,
              costes: articulo.costes,
              base: articulo.base,
              importefinal: articulo.importefinal,
            });
           
          
                   

                swal(
                      "Insertado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); 

                    // me.$parent.guardarPresupuesto();


          })
          .catch(function (error) {
            console.log(error);
            if (error.response.status === 401 || error.response.status === 419) {
              window.location = "/login";
            }
          });

          

        console.log("guardarModalArticulo", me.$parent.articulos);
        this.cerrarModal();
         this.$parent.guardarPresupuesto();
      }
    },


guardarModalComponente() {
      let me = this;
      const nuevocodigoco =
        8000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);
      me.acCodigo = nuevocodigoco;
      console.log('AAAA guardarModalComponente',me.Datos["id"],me.Datos["articulo"]);

    
      axios
        .post("/presupuesto/componente/guardar", {
          idpresupuesto: me.$parent.cabecera.id,
          idpresupuestolinea: me.Datos["id"], // 
          articulo_principal: me.Datos["articulo"],
          articulo: me.acCodigo,

          descripcion: me.acDescripcion,
          m2: me.acMetros,
          ancho: me.acAnchura,
          longitud: me.acAltura,
          tipounidad: me.acTipoUnidad,
          bultos: me.acBultos,

          cantidad: me.acUnidades,
          mermas: me.acMermas,
          montaje: me.acMontaje,
          gastos: me.acGastos,
          subcontratado: me.acSubcontratacion,
          beneficios: me.acBeneficios,
          preciofinal: me.acPrecioFinal,
          precio: me.acPrecio,
          base: me.acBase,
          importefinal: me.acPvp,
          costes: me.acCostes,
          descuento: me.acDto,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          var componente = response.data.componente;
          var idcompo = response.data.componente.id;
        

          console.log(
            "guardarModalComponente",
            response,
            response.data.componente.id
          );

          console.log(
            "guardarModalComponente componentes ",

            me.$parent.componentes
          );
          //me.insertComponente(idcompo);

          me.$parent.componentes.push({
            articulo_principal: response.data.componente.articulo_principal,
            articulo: response.data.componente.articulo,
            idpresupuesto: response.data.componente.idpresupuesto,
            idpresupuestolinea: response.data.componente.idpresupuestolinea,
            descripcion: response.data.componente.descripcion,
            m2: response.data.componente.m2,
            ancho: response.data.componente.ancho,
            longitud: response.data.componente.longitud,
            tipounidad: response.data.componente.tipounidad,
            mermas: response.data.componente.mermas,
            precio: response.data.componente.precio,
            cantidad: response.data.componente.cantidad,
            montaje: response.data.componente.montaje,
            gastos: response.data.componente.gastos,
            subcontratado: response.data.componente.subcontratado,
            beneficios: response.data.componente.beneficios,
            preciofinal: response.data.componente.preciofinal,
            importefinal: response.data.componente.importefinal,
            costes: response.data.componente.costes,
            id: response.data.componente.id,
            bultos: response.data.componente.bultos,
            linea: response.data.componente.linea,
            descuento: response.data.componente.dto,
            base: response.data.componente.base,

            //descuento

            comentarios: "observaciones",
          });

        
          me.$parent.recalcularTotalArticulo(
            "guardar",
            response.data.componente.idpresupuestolinea
          );

          me.$parent.guardarPresupuesto();
          me.cerrarModal();

          /*   swal(
                      "Insertado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); */
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });

      
    },




    encuentra(id) {
      var sw = false;
      for (var i = 0; i < this.$parent.arrayDetalle.length; i++) {
        if (this.$parent.arrayDetalle[i].idarticulo == id) {
          sw = true;
        }
      }
      console.log("aaa encuentra", sw, id, this.$parent.arrayDetalle);
      return sw;
    },

    actualizarModal(){

      console.log('actualizarModal', this.Modelo);
      if(this.Modelo ===  "componente"){
          this.actualizarModalComponente();

      }
      if(this.Modelo === "articulo"){
         this.actualizarModalArticulo();

      } 
        if(this.Modelo === "tarifaProductoA"){
         this.actualizarModalTarifaProductoArticulo();

      } 
         if(this.Modelo === "tarifaProductoC"){
         this.actualizarModalTarifaProductoComponente();

      } 

      

    },

actualizarModalTarifaProductoComponente() {
      let me = this;
    
      axios
        .put("/tarifaproducto/componente/actualizar", {
          //idpresupuesto : acIdPresupuesto,
          id: me.acId,

          articulo: me.acCodigoArticulo,
          descripcion: me.acDescripcion,

          anchura: me.acAnchura,
          altura: me.acAltura,
          m2: me.acMetros,
          mermas: me.acMermas,

          tipounidad: me.acTipoUnidad,
          bultos: me.acBultos,
          cantidad: me.acUnidades,

          precio: me.acPrecio,
          dto: me.acDto,
          preciofinal: me.acPrecioFinal,
          gastos: me.acGastos,
          montaje: me.acMontaje,
          subcontratado: me.acSubcontratacion,
          beneficio: me.acBeneficios,
          costes: me.acCostes,
          base: me.acBase,
          importefinal: me.acPvp,
        })
        .then(function (response) {
          let respuesta;
          respuesta = response.data.tarifaProducto;
          console.log(
            "yye 11 actualizar articulo",
            response,
            respuesta,
            respuesta.descripcion,
            me.$parent.articulos[me.Idx],
            me.Idx,
            me.$parent.cabecera
          );

          me.$parent.componentes[me.Idx].descripcion = respuesta.descripcion;
          me.$parent.componentes[me.Idx].ancho = respuesta.ancho;
          me.$parent.componentes[me.Idx].base = respuesta.base;
          me.$parent.componentes[me.Idx].beneficios = respuesta.beneficios;

          me.$parent.componentes[me.Idx].bultos = respuesta.bultos;
          me.$parent.componentes[me.Idx].cantidad = respuesta.cantidad;

          me.$parent.componentes[me.Idx].costes = respuesta.costes;
          me.$parent.componentes[me.Idx].descuento = respuesta.descuento;
          me.$parent.componentes[me.Idx].gastos = respuesta.gastos;

          me.$parent.componentes[me.Idx].importefinal = respuesta.importefinal;
          // me.$parent.articulos[me.Idx].linea = me.acLinea;
          me.$parent.componentes[me.Idx].longitud = respuesta.longitud;
          me.$parent.componentes[me.Idx].m2 = respuesta.m2;
          me.$parent.componentes[me.Idx].mermas = respuesta.mermas;
          me.$parent.componentes[me.Idx].montaje = respuesta.montaje;
          me.$parent.componentes[me.Idx].precio = respuesta.precio;

          me.$parent.componentes[me.Idx].preciofinal = respuesta.preciofinal;
          me.$parent.componentes[me.Idx].subcontratado = respuesta.subcontratado;
          me.$parent.componentes[me.Idx].tipounidad = respuesta.tipounidad;

          swal(
                      "Actualizado!",
                      "Componente ha sido guardado con éxito.",
                      "success"
                    ); 
           
          
        })
        
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });

      this.cerrarModal();
    },







    
    actualizarModalTarifaProductoArticulo() {
      let me = this;
    
      axios
        .put("/tarifaproducto/articulo/actualizar", {
          //idpresupuesto : acIdPresupuesto,
          id: me.acId,

          articulo: me.acCodigoArticulo,
          descripcion: me.acDescripcion,

          anchura: me.acAnchura,
          altura: me.acAltura,
          m2: me.acMetros,
          mermas: me.acMermas,

          tipounidad: me.acTipoUnidad,
          bultos: me.acBultos,
          cantidad: me.acUnidades,

          precio: me.acPrecio,
          dto: me.acDto,
          preciofinal: me.acPrecioFinal,
          gastos: me.acGastos,
          montaje: me.acMontaje,
          subcontratado: me.acSubcontratacion,
          beneficio: me.acBeneficios,
          costes: me.acCostes,
          base: me.acBase,
          importefinal: me.acPvp,
          referencia: me.acReferencia,

        })
        .then(function (response) {
          let respuesta;
          respuesta = response.data.tarifaProducto;
          console.log(
            "yye 11 actualizar articulo",
            response,
            respuesta,
            respuesta.descripcion,
            me.$parent.articulos[me.Idx],
            me.Idx,
            me.$parent.cabecera
          );

          me.$parent.articulos[me.Idx].descripcion = respuesta.descripcion;
          me.$parent.articulos[me.Idx].ancho = respuesta.ancho;
          me.$parent.articulos[me.Idx].base = respuesta.base;
          me.$parent.articulos[me.Idx].beneficios = respuesta.beneficios;

          me.$parent.articulos[me.Idx].bultos = respuesta.bultos;
          me.$parent.articulos[me.Idx].cantidad = respuesta.cantidad;

          me.$parent.articulos[me.Idx].costes = respuesta.costes;
          me.$parent.articulos[me.Idx].descuento = respuesta.descuento;
          me.$parent.articulos[me.Idx].gastos = respuesta.gastos;

          me.$parent.articulos[me.Idx].importefinal = respuesta.importefinal;
          // me.$parent.articulos[me.Idx].linea = me.acLinea;
          me.$parent.articulos[me.Idx].longitud = respuesta.longitud;
          me.$parent.articulos[me.Idx].m2 = respuesta.m2;
          me.$parent.articulos[me.Idx].mermas = respuesta.mermas;
          me.$parent.articulos[me.Idx].montaje = respuesta.montaje;
          me.$parent.articulos[me.Idx].precio = respuesta.precio;

          me.$parent.articulos[me.Idx].preciofinal = respuesta.preciofinal;
          me.$parent.articulos[me.Idx].subcontratado = respuesta.subcontratado;
          me.$parent.articulos[me.Idx].tipounidad = respuesta.tipounidad;
me.$parent.articulos[me.Idx].referencia = respuesta.referencia;




swal(
                      "Actualizado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); 
           

          
        })
        
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });


         


      this.cerrarModal();
    },




     actualizarModalComponente() {
      let me = this;

      var sw = 0;
      var componente = 0;
      console.log( 
        "bbb AAAA recalcularTodosBeneficioComponente actualizarModalComponente",
        this.$parent.componentes
      );
      for (var i = 0; i < this.$parent.componentes.length; i++) {
       
        console.log('bbb ->for',  this.$parent.componentes[i].articulo_principal == this.acCodigoPrincipal &&
          this.$parent.componentes[i].articulo == this.acCodigoArticulo,
            this.$parent.componentes[i].articulo_principal , this.acCodigoPrincipal ,
          this.$parent.componentes[i].articulo , this.acCodigoArticulo


      );
        if (
          this.$parent.componentes[i].articulo_principal == this.acCodigoPrincipal &&
          this.$parent.componentes[i].articulo == this.acCodigoArticulo
        ) {
          sw = true;
          componente = i;
          
        }
      }

      //BUSCO COMPONENTE PARA ACTUALIZAR
    console.log('bbb' ,  me.$parent.componentes[componente], componente);
      me.$parent.componentes[componente].descripcion = me.acDescripcion;
      me.$parent.componentes[componente].m2 = me.acMetros;
      me.$parent.componentes[componente].longitud = me.acAltura;
      me.$parent.componentes[componente].ancho = me.acAnchura;
      me.$parent.componentes[componente].cantidad = me.acUnidades;
      me.$parent.componentes[componente].bultos = me.acBultos;

      me.$parent.componentes[componente].tipounidad = me.acTipoUnidad;
      me.$parent.componentes[componente].preciofinal = me.acPrecioFinal;
      me.$parent.componentes[componente].precio = me.acPrecio;

      me.$parent.componentes[componente].mermas = me.acMermas;
      me.$parent.componentes[componente].costes = me.acCostes;

      me.$parent.componentes[componente].montaje = me.acMontaje;

      me.$parent.componentes[componente].gastos = me.acGastos;

      me.$parent.componentes[componente].subcontratado = me.acSubcontratacion;
      me.$parent.componentes[componente].beneficios = me.acBeneficios;
      me.$parent.componentes[componente].importefinal = me.acPvp;
      me.$parent.componentes[componente].descuento = me.acDto;


me.$parent.componentes[componente].base = me.acBase;
      
      console.log(
        "bbb AAAA recalcularTodosBeneficioComponente actualizarModalComponente actualizar componente FINAL",
        me.$parent.componentes,
        me.componente,
        me.$parent.componentes[componente].altura,
        me.acIdx
      );

      axios
        .put("/presupuesto/componente/actualizar", {
          id: me.acId, // id componente
          idpresupuesto: me.$parent.cabecera.id, // o coIdPresupueto
          idpresupuestolinea: me.acIdPresupuestoLinea,

          articulo_principal: me.acCodigoPrincipal,
          articulo: me.acCodigo,

          descripcion: me.acDescripcion,
          m2: me.acMetros,
          ancho: me.acAnchura,
          longitud: me.acAltura,
          tipounidad: me.acTipoUnidad,
          bultos: me.acBultos,
          cantidad: me.acUnidades,
          mermas: me.acMermas,
          montaje: me.acMontaje,
          gastos: me.acGastos,
          subcontratado: me.acSubcontratacion,
          beneficios: me.acBeneficios,
          precio: me.acPrecio,
          preciofinal: me.acPrecioFinal,
          importefinal: me.acPvp,
          descuento: me.acDto,
          base: me.acBase,

          costes: me.acCostes,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          var componente = response.data.componente;

         
        

        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });

      //0612 this.recalcularTotalArticulo("actualizar", me.coCodigoPrincipal);
      this.$parent.recalcularTotalArticulo("actualizar", me.acIdPresupuestoLinea);
      me.$parent.guardarPresupuesto();

      this.cerrarModal();
    },

    




    actualizarModalArticulo() {
      let me = this;
    


      axios
        .put("/presupuesto/detalle/actualizar", {
          //idpresupuesto : acIdPresupuesto,
          id: me.acId,

          articulo: me.acCodigoArticulo,
          descripcion: me.acDescripcion,

          anchura: me.acAnchura,
          altura: me.acAltura,
          m2: me.acMetros,
          mermas: me.acMermas,

          tipounidad: me.acTipoUnidad,
          bultos: me.acBultos,
          cantidad: me.acUnidades,

          precio: me.acPrecio,
          dto: me.acDto,
          preciofinal: me.acPrecioFinal,
          gastos: me.acGastos,
          montaje: me.acMontaje,
          subcontratado: me.acSubcontratacion,
          beneficio: me.acBeneficios,
          costes: me.acCostes,
          base: me.acBase,
          importefinal: me.acPvp,
        })
        .then(function (response) {
          let respuesta;
          respuesta = response.data.detalle;
          console.log(
            "yye 11 actualizar articulo",
            response,
            respuesta,
            respuesta.descripcion,
            me.$parent.articulos[me.Idx],
            me.Idx,
            me.$parent.cabecera
          );

          me.$parent.articulos[me.Idx].descripcion = respuesta.descripcion;
          me.$parent.articulos[me.Idx].ancho = respuesta.ancho;
          me.$parent.articulos[me.Idx].beneficios = respuesta.beneficios;
          me.$parent.articulos[me.Idx].bultos = respuesta.bultos;
          me.$parent.articulos[me.Idx].costes = respuesta.costes;
          me.$parent.articulos[me.Idx].descuento = respuesta.descuento;
          me.$parent.articulos[me.Idx].gastos = respuesta.gastos;
          me.$parent.articulos[me.Idx].importefinal = respuesta.importefinal;
          // me.$parent.articulos[me.Idx].linea = me.acLinea;
          me.$parent.articulos[me.Idx].longitud = respuesta.longitud;
          me.$parent.articulos[me.Idx].m2 = respuesta.m2;
          me.$parent.articulos[me.Idx].mermas = respuesta.mermas;
          me.$parent.articulos[me.Idx].montaje = respuesta.montaje;
          me.$parent.articulos[me.Idx].precio = respuesta.precio;

          me.$parent.articulos[me.Idx].preciofinal = respuesta.preciofinal;
          me.$parent.articulos[me.Idx].subcontratado = respuesta.subcontratado;
          me.$parent.articulos[me.Idx].tipounidad = respuesta.tipounidad;
          me.$parent.articulos[me.Idx].base = respuesta.base;
swal(
                      "Actualizado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); 
           

me.$parent.guardarPresupuesto();



console.log("yye 222 fin actualizar , antes de cerrar ", 
        me.$parent.articulos[me.Idx],
            me.Idx,
      me.$parent.articulos,
      me.$parent.cabecera);
    
          
        })
        
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });


         

      console.log("yye 222 fin actualizar , antes de cerrar ", 
        me.$parent.articulos[me.Idx],
            me.Idx,
      me.$parent.articulos,
      me.$parent.cabecera);
      this.cerrarModal();
    },





},
};
</script>
<style>
.form-control {
  font-weight: bold;
}

.form-actions.stuck {
  position: fixed;
  bottom: 0;
  width: 100%;
  margin-left: -15px;
  margin-bottom: 0;
  z-index: 5;
  border-radius: 0;
}
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}

.table-responsive::-webkit-scrollbar {
  background: lightyellow;
  width: 12px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: gray;
}

.table-responsive {
  overflow-x: auto !important;
}

.modal-dialog {
  max-width: 90% !important;
}
.table-responsive > .fixed-column {
  right: 0;
  top: 0px;
  background: #f4f4f4;
  position: absolute;

  display: inline-block;
  width: auto;
  border-top: 0px solid;
  border-left: 1px solid #808080;
}

.nav-tabs .nav-link.active {
  border-top-color: #3c8dbc !important;
  border-top: 3px solid transparent;
}
.modal-content {
  /* width: 600px !important;*/
  width: 100% !important;
  position: absolute !important;

  /*  display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 10px;
    background-color: transparent;
    z-index: 1060; */
  /*     overflow-x: hidden;
 */
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
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
@media (min-width: 600px) {
  .btnagregar {
    margin-top: 2rem;
  }
}
</style>