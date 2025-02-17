


<template>
    
       <!--Inicio del modal AGREGAR COMPONENTE-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{ mostrar: modalcomponente }"
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
            <h4 class="modal-title" v-text="tituloModalComponente"></h4>
            <button
              type="button"
              class="close"
              @click="cerrarModalComponente()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <button
                type="button"
                @click="abrirModalArticulo('articulo', 'buscar')"
                class="btn btn-sm btn-primary"
              >
                <i class="icon-plus"></i>&nbsp;Buscar Artículo
              </button>

              <!--  <div class="col-md-6 col-sm-4">
                        <div class="form-group"><label class="control-label" for="anchura">Código</label> <input type="text" v-model="articulo.articulo" id="articulo" name="articulo" class="rm-width form-control" >  </div> 
              </div>-->
              <div class="col-md-12 col-sm-4">
                <div class="form-group">
                  <label class="control-label" for="descripcion"
                    >Descripcion</label
                  >
                  <textarea
                    type="text"
                    v-model="coDescripcion"
                    id="descripcion"
                    name="descripcion"
                    class="rm-height form-control"
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
                    v-model.number="coAnchura"
                    v-on:change="calcularM2"
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
                    v-model.number="coAltura"
                    v-on:change="calcularM2"
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
                    v-model.number="coMetros"
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
                  <label class="control-label" for="unidades"
                    >Tipo Unidad</label
                  >
                  <select
                    class="form-control col-md-12"
                    v-on:change="calcularTotalPvpComponente"
                    v-model="coTipoUnidad"
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
                  <label class="control-label" for="bultos">Piezas</label>
                  <input
                    type="number"
                    v-model.number="coBultos"
                    id="bultos"
                    name="bultos"
                    class="rm-uds form-control"
                    v-on:change="calcularTotalPvpComponente"
                  />
                </div>
              </div>
              <div class="col-md-3 col-sm-3">
                <div class="form-group">
                  <label class="control-label" for="unidades">{{coTipoUnidad}}</label>
                  <input
                    v-if="coTipoUnidad === 'M2'"
                    type="number"
                    v-model.number="coUnidades"
                    id="unidades"
                    name="unidades"
                    class="rm-uds form-control"
                    v-on:change="calcularTotalPvpComponente"
                  />
                  <input
                    v-else
                    type="number"
                    v-model.number="coUnidades"
                    id="unidades"
                    name="unidades"
                    v-on:change="calcularTotalPvpComponente"
                    class="rm-uds form-control"
                  />
                </div>
              </div>

              <div class="col-md-3 col-sm-3">
                <div class="form-group">
                  <label class="control-label" for="precio">Coste Unidad</label>
                  <input
                    type="number"
                    v-model.number="coPrecioUnidad"
                    id="precio"
                    name="precio"
                    class="rm-uds form-control"
                    v-on:change="calcularTotalPvpComponente"
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
                    v-model.number="coGastos"
                    id="gastos"
                    name="gastos"
                    class="form-control"
                    v-on:change="calcularTotalPvpComponente"
                  />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="montaje">Montaje</label>
                  <input
                    type="number"
                    v-model.number="coMontaje"
                    id="montaje"
                    name="montaje"
                    class="form-control"
                    v-on:change="calcularTotalPvpComponente"
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
                    v-model.number="coSubcontratacion"
                    name="subcontratacion"
                    class="form-control"
                    v-on:change="calcularTotalPvpComponente"
                  />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="beneficios"
                    >%Beneficios</label
                  >
                  <input
                    type="number"
                    v-model.number="coBeneficios"
                    id="beneficios"
                    name="beneficios"
                    class="form-control"
                    v-on:change="calcularTotalPvpComponente"
                  />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="pvp">PVP</label>

                  <input
                    type="number"
                    id="pvp"
                    v-on:change="recalcularBeneficioComponente"
                    v-model="coPvp"
                    name="pvp"
                    class="form-control"
                  />
                  <!-- <div class="col-md-3 col-sm-4">
                  <h6>{{coUnidades*coPrecioUnidad}}</h6>-->
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
            <!--  <div class="col-sm-6 col-sm-12 no-width-info-content" style="display: block;">
                        <p><i class="fa fa-info-circle"></i> La materia prima no tiene ancho definido, por favor trabaje con m<sup>2</sup></p>
            </div>-->
          </div>
          <!--  <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterioA">
                    <option value="nombre">Nombre</option>
                    <option value="descripcion">Descripción</option>
                    <option value="articulo">Código</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscarA"
                    @keyup.enter="listarArticulo(buscarA,criterioA)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarArticulo(buscarA,criterioA)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                    <td>
                      <button
                        type="button"
                        @click="agregarDetalleModal(articulo)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="articulo.articulo"></td>
                    <td v-text="articulo.nombre"></td>
                    <td v-text="articulo.nombre_categoria"></td>
                    <td v-text="articulo.precio_venta"></td>
                    <td v-text="articulo.stock"></td>
                    <td>
                      <div v-if="articulo.condicion">
                        <span class="badge badge-success">Activo</span>
                      </div>
                      <div v-else>
                        <span class="badge badge-danger">Desactivado</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>-->

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModalComponente()"
            >
              Cerrar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 1"
              class="btn btn-primary"
              @click="guardarModalComponente()"
            >
              Guardar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 2"
              class="btn btn-primary"
              @click="actualizarModalComponente()"
            >
              Actualizar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
</template>
<script>
export default {
    props: {
        cards: Array,

        size: {
            type: String,
            default: '',
        },

    },

    methods: {
        cerrarModalComponente() {
            this.modalcomponente = 0;
            this.tituloModalComponente = "";
            this.coCodigoPrincipal = "";
            this.coIdPresupuesto = "";
            this.coIdPresupuestoLinea = "";

            this.coDescripcion = "";
            this.coAnchura = "";
            this.coAltura = "";
            this.coMetros = "";
            this.coUnidades = "";
            this.coMermas = "";
            this.coTipoUnidad = "";
            this.coBultos = "";
            this.coPrecioFinal = "";
            this.coPrecio = "";
            this.coMontaje = "";
            this.coGastos = "";
            this.coSubcontratacion = "";
            this.coBeneficios = "";
            this.coPvp = "";
          },
          calcularTotalPvpComponente(){

      },
      recalcularBeneficioComponente(){

      },
      guardarModalComponente(){

      },
      actualizarModalComponente(){

      }
    
    },
}
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
 
  overflow-x : auto !important;
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
  width: 600px !important;
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
 */}
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
