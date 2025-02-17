<template>
    
    <div
      class="modal fade"
      id="modalBuscarrArticulo"
      tabindex="-3"
      :class="{ mostrar: modalBuscar }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModalBuscar()"
              aria-label="Close"
            >
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterioA">
                   
                    <option value="descripcion">Descripción</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscarA"
                    @keyup.enter="listarArticulo(buscarA, criterioA)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarArticulo(buscarA, criterioA)"
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
                    <th>Empresa</th>
                    <th>Denominacion</th>
                    <th>Precio</th>
                    <th>DTO</th>
                    <th>COSTE UNIDAD</th>

                    <th>Unidad</th>
                    <th>Ancho</th>
                    <th>Longitud</th>
                    <th>m2</th>
                    <th>Notas</th>
                    <th>Fecha</th>
                  </tr>
                </thead>

                <tbody>
                  <tr
                    v-for="articulo in arrayArticulosCompra"
                    :key="articulo.articulo"
                  >
                    <!-- 19122020 -->
                    <td>
                      <button
                        type="button"
                        data-dismiss="modal"
                        @click="agregarDetalleModal(articulo)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>
                    <td v-text="articulo.EMPRESA"></td>
                    <td v-text="articulo.DENOMINA"></td>
                    <td v-text="articulo.PRECIO"></td>
                    <td v-text="articulo.DTO"></td>
                    <td v-text="articulo.COSTE_U"></td>
                    <td v-text="articulo.TIPOUNID"></td>
                    <td v-text="articulo.ANCHO"></td>
                    <td v-text="articulo.LONGITUD"></td>
                    <td v-text="articulo.M2"></td>
                    <td v-text="articulo.NOTAS"></td>
                    <td v-text="articulo.FECHA"></td>
                    <!--  <td>
                                                <div v-if="articulo.condicion">
                                                    <span class="badge badge-success">Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">Desactivado</span>
                                                </div>
                                                
                    </td>-->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="cerrarModalBuscar()"
            >
              Cerrar
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
  name: "BuscarArticuloVnt",

  props: {
   
   /*  Idx : Number, */

  },
  data() {
    return {
        modalBuscar: true,
        tituloModal: "Buscar Productos Vnt",
        buscarA : "",
        criterioA: "descripcion",
        tipoAccion : 0,
         arrayArticulosCompra: [],


    }
    
    },

    
   mounted() {
   this.inicializar();
  },
  methods: {
      inicializar(){

      },

      cerrarModalBuscar() {
      this.modalBuscar = 0;
      this.tituloModal = "";
    },

    
    listarArticulo(buscar, criterio) {
      let me = this;
      var url = "/comprasvnt/buscar?buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data.gestorcompras;

          console.log(
            "RESPONSE ",
            response,
            response.data.gestorcompras,
            respuesta,
            respuesta.articulo
          );

          me.arrayArticulosCompra = respuesta.articulo;

          console.log("arrayArticulosCompra ", me.arrayArticulosCompra);

          console.log(
            "RESPONSE  33333 ",
            response,
            respuesta,
            me.arrayArticulosCompra
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401) {
            window.location = "/login";
          }
        });
    },
    agregarDetalleModal(artVnt = []) {


      let me = this;
      console.log("agregarDetalleModal", artVnt);
      this.$emit('agregarDetalleModal',artVnt);

    
     

      this.cerrarModalBuscar();
       return artVnt ;
      
    },

  }
}
</script>