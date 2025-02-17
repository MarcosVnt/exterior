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
          <i class="fa fa-align-justify"></i> Producto Tarifa
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criterio">
                  <option value="descripcion">Descripción</option>
                </select>
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarProductoTarifa(1, buscar, criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarProductoTarifa(1, buscar, criterio)"
                  class="btn btn-primary"
                >
                  <i class="fa fa-search"></i> Buscar
                </button>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <div style="padding: 15px; display: block; min-height: 65px">
              <button
                type="button"
                data-toggle="modal"
                data-target="#modalAltaArticulo"
                @click="abrirModalArticulo('articulo', 'registrar')"
                class="btn btn-sm btn-primary"
              >
                <i class="icon-plus"></i>&nbsp;Nuevo Artículo
              </button>
            </div>
            <table
              id="table-fixed-last-column17"
              class="table table-bordered table-striped2 table-sm"
            >
              <thead>
                <tr style>
                  <th class="bg-grey" style="min-width: 50px">+</th>
                  <th class="bg-grey" style="min-width: 50px">REF</th>

                  <th class="bg-grey text-right">Ancho</th>
                  <th class="bg-grey text-right">Alto</th>

                  <th class="bg-grey text-right">
                    m
                    <sup>2</sup>
                  </th>
                  <!--  CABECERA ARTICULO -->
                  <th class="bg-grey text-right">Cantidad</th>
                  <th class="bg-grey text-right">Unidades.</th>
                  <th class="bg-grey text-right">Tipo Unidad.</th>

                  <th class="bg-grey text-right">Coste Unidad</th>
                  <th class="bg-grey text-right">%Mermas</th>
                  <th class="bg-grey text-right">TOTAL COSTES</th>
                  <th class="bg-grey text-right">%Beneficio</th>
                  <th class="bg-grey text-right">Precio Venta Unidad.</th>

                  <th class="bg-grey text-right">BASE IMPONIBLE</th>

                  <th class="bg-grey text-right">%DTO</th>

                  <th
                    class="bg-grey text-right"
                    style="width: 80px; min-width: 80px"
                  >
                    TOTAL IMPORTE
                  </th>
                  <th
                    class="bg-grey text-right"
                    style="width: 80px; min-width: 80px"
                  >
                    ACCIONES
                  </th>
                </tr>
              </thead>

              <tbody v-for="(articulo, idx) in articulos" :key="idx">
                <!-- <button
                type="button"
                @click="verArticulo = !verArticulo"
                class="btn btn-sm btn-primary" >
                <i v-if="verArticulo" class="angle-double-down">-A</i>
                <i v-else class="icon-plus">+A</i>
                
              </button> -->
                <tr v-if="verArticulo" style>
                  <td>
                    <button
                      type="button"
                      @click="verArticulo = !verArticulo"
                      class="btn btn-sm btn-primary"
                    >
                      <i class="angle-double-down">- A</i>
                    </button>
                     <button
                      type="button"
                      @click="verComponente = !verComponente"
                      class="btn btn-sm btn-primary"
                    >
                      <i v-if="verComponente" class="icon-plusd">- C</i>
                      <i v-else class="icon-pldus">+ C</i>
                    </button>
                  </td>

                  <td
                    class="product-name"
                    colspan="4"
                    style="background-color: #f4f4f4"
                  >
                    <b
                      style="
                        white-space: pre-wrap;
                        word-wrap: break-word;
                        font-family: inherit;
                      "
                      >[{{ articulo.referencia }}]<br>{{ articulo.descripcion }}</b
                    >
                  </td>

                  <td
                    class="text-right bg-highlighted"
                    style="background-color: #f4f4f4"
                  >
                    <b>{{ articulo.bultos }}</b>
                  </td>

                  <td class="text-right" style="background-color: #f4f4f4">
                    <p>{{ articulo.cantidad }}</p>
                  </td>
                  <td class="text-right" style="background-color: #f4f4f4">
                    <p>{{ articulo.tipounidad }}</p>
                  </td>
                  <td class="text-right" style="background-color: #f4f4f4">
                    <p>{{ articulo.precio }}</p>
                  </td>
                  <td class="text-right" style="background-color: #f4f4f4">
                    {{ articulo.mermas }}
                  </td>
                  <td class="text-right" style="background-color: #f4f4f4">
                    {{ articulo.costes }}
                  </td>

                  <td class="text-right" style="background-color: #f4f4f4">
                    {{ articulo.beneficios }} %
                  </td>

                  <td
                    class="text-right bg-highlighted"
                    style="background-color: #f4f4f4"
                  >
                    <b>{{ articulo.preciofinal }}</b>
                  </td>

                  <td
                    class="text-right bg-highlighted"
                    style="background-color: #f4f4f4"
                  >
                    <b>{{ articulo.base }} €</b>
                  </td>

                  <td class="text-right" style="background-color: #f4f4f4">
                    {{ articulo.descuento }} %
                  </td>

                  <td
                    class="text-right bg-highlighted"
                    style="background-color: #f4f4f4"
                  >
                    <b>{{ articulo.importefinal }} €</b>
                  </td>

                  <td style="background-color: #f4f4f4">
                    <div class="btn-group btn-budget-group pull-right">
                      <button
                        type="button"
                        data-toggle="modal"
                        data-target="#modalAltaArticuloComponente"
                        @click.prevent="
                          abrirModalComponente(
                            'componente',
                            'registrar',
                            articulo
                          )
                        "
                        class="btn btn-sm btn-success"
                        title="Alta Nuevo Componente"
                      >
                        <i class="icon-plus"></i>
                      </button>

                      <button
                        type="button"
                        data-toggle="modal"
                        data-target="#modalAltaArticuloComponente"
                        @click="
                          abrirModalArticulo(
                            'articulo',
                            'actualizar',
                            articulo,
                            idx
                          )
                        "
                        class="btn btn-sm btn-primary"
                        title="Editar Articulo"
                      >
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button
                        type="button"
                        @click="eliminarArticulo(articulo)"
                        class="btn btn-sm btn-danger delete_link"
                        title="Eliminar Articulo"
                      >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>

                      <!--  <button
                              type="button"
                              @click="tarifaProductoCrear(articulo)"
                              class="btn btn-sm btn-warning delete_link"
                              title="Crear Producto Tarifa"
                            >
                              <i class="fa fa-tint" aria-hidden="true"></i>
                            </button> -->

                      <!--   {{idx}} 
                             @click="moveA(idx, 0)"-->
                      <button
                        type="button"
                        @click="moveLinea(idx)"
                        class="btn btn-sm btn-success"
                        title="Mover Articulo"
                      >
                        {{ idx + 1 }}
                        <i class="fa fa-level-up" aria-hidden="true"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-else style>
                  <td>
                    <button
                      type="button"
                      @click="verArticulo = !verArticulo"
                      class="btn btn-sm btn-primary"
                    >
                      <i class="icon-pluss">+ A</i>
                    </button>
                    
                    <button
                      type="button"
                      @click="verComponente = !verComponente"
                      class="btn btn-sm btn-primary"
                    >
                      <i v-if="verComponente" class="icon-plusd">- C</i>
                      <i v-else class="icon-pldus">+ C</i>
                    </button>
                  </td>
                  <td
                    class="product-name"
                    colspan="16"
                    style="background-color: #f4f4f4"
                  >
                    <b
                      style="
                        white-space: pre-wrap;
                        word-wrap: break-word;
                        font-family: inherit;
                      "
                      >{{ articulo.referencia }}</b
                    >
                  </td>
                </tr>

                <tr
                  v-for="(componente, index) in filteredRows1(articulo)"
                  :key="index"
                >
                  <td v-if="verComponente"></td>
                  <td v-if="verComponente">{{ componente.descripcion }}</td>

                  <td v-if="verComponente" class="text-right">
                    {{ componente.ancho }}
                  </td>
                  <td v-if="verComponente" class="text-right">
                    {{ componente.longitud }}
                  </td>
                  <td
                    v-if="verComponente"
                    class="text-right bg-highlighted"
                    data-toggle="tooltip"
                    data-placement="top"
                    title
                    data-original-title="M2 corte"
                  >
                    {{ componente.m2 }}
                  </td>

                  <td v-if="verComponente" class="text-right">
                    {{ componente.bultos }}
                  </td>
                  <td v-if="verComponente" class="text-right">
                    {{ componente.cantidad }}
                  </td>
                  <td v-if="verComponente" class="text-right">
                    {{ componente.tipounidad }}
                  </td>
                  <td v-if="verComponente" class="text-right">
                    {{ componente.precio }} €
                  </td>

                  <td v-if="verComponente" class="text-right">
                    {{ componente.mermas }}
                  </td>

                  <td v-if="verComponente" class="text-right">
                    {{ componente.costes }}
                  </td>

                  <td v-if="verComponente" class="text-right bg-highlighted">
                    {{ componente.beneficios }} %
                  </td>
                  <td v-if="verComponente" class="text-right">
                    {{ componente.preciofinal }}
                  </td>
                  <td v-if="verComponente" class="text-right bg-highlighted">
                    {{ componente.base }} €
                  </td>
                  <td v-if="verComponente" class="text-right bg-highlighted">
                    {{ componente.descuento }} %
                  </td>
                  <td v-if="verComponente" class="text-right bg-highlighted">
                    {{ componente.importefinal }} €
                  </td>

                  <td v-if="verComponente">
                    <div class="btn-group btn-budget-group pull-right">
                      <button
                        type="button"
                        data-toggle="modal"
                        data-target="#modalAltaArticuloComponente"
                        @click="
                          abrirModalComponente(
                            'componente',
                            'actualizar',
                            componente,
                            index
                          )
                        "
                        class="btn btn-sm btn-primary edit_link"
                        title="Editar Componente"
                      >
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>

                      <button
                        type="button"
                        @click="eliminarComponente(componente)"
                        class="btn btn-sm btn-danger delete_link"
                        title="Eliminar Componente"
                      >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>

                      <!--   {{index}}-{{idx}} -->
                      <button
                        type="button"
                        @click="moveC(index, 0, componente, articulo)"
                        class="btn btn-sm btn-success"
                        title="Mover Componente"
                      >
                        <i class="fa fa-level-up" aria-hidden="true"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <div style="min-height: 15px"></div>
              </tbody>

              <div style="min-height: 15px"></div>

              <tfoot>
                <!-- <tr style>
                        <th
                          colspan="14"
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          TOTAL
                        </th>
                 
                        <th class="text-right bg-highlighted">
                          {{ calcularTotalPresupuesto }} €
                        </th>
                        <th>
                          <div class="btn-group btn-budget-group pull-right">
                 
                          </div>
                        </th>
                      </tr> -->
              </tfoot>
            </table>
          </div>

          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                    cambiarPagina(pagination.current_page - 1, buscar, criterio)
                  "
                  >Ant</a
                >
              </li>
              <li
                class="page-item"
                v-for="page in pagesNumber"
                :key="page"
                :class="[page == isActived ? 'active' : '']"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(page, buscar, criterio)"
                  v-text="page"
                ></a>
              </li>
              <li
                class="page-item"
                v-if="pagination.current_page < pagination.last_page"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                    cambiarPagina(pagination.current_page + 1, buscar, criterio)
                  "
                  >Sig</a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>

    <!-- ALTA ARTICULO  modelo, accion, data = [], index-->
    <ArticuloComponente
      v-if="modalarticulo"
      :Modelo="modelo"
      :Datos="data"
      :Accion="accion"
      :Titulo="tituloModalArticulo"
      :TipoAccion="tipoAccion"
      :Idx="idx"
      :ModalArticulo="modalarticulo"
      @guardaPresupuesto="guardarPresupuesto()"
      @cerrarModal="cerrarModalArticulo"
    >
    </ArticuloComponente>

    <!--Inicio del modal AGREGAR ARTICULO-->
    <!-- <div
    id="modalAltaArticulo"
      class="modal fade"
      tabindex="-1"
      :class="{ mostrar: modalarticulo }"
      
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >

      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       

          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModalArticulo"></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModalArticulo()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
             
              <div class="col-md-12 col-sm-4">
                <div class="form-group">
                  <label class="control-label" for="descripcion"
                    >Descripcion</label
                  >
                  <textarea
                    style="
                      margin: 0px 158.516px 0px 0px;
                      width: 570px;
                      height: 200px;
                    "
                    type="text"
                    v-model="articulodescripcion"
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
                  <label class="control-label" for="unidades"
                    >Tipo Unidad</label
                  >
                  <select
                    class="form-control col-md-12"
                    v-model="articulotipounidad"
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
                    v-model.number="articulobultos"
                    id="bultos"
                    name="bultos"
                    class="rm-uds form-control"
                    v-on:change="calcularTotalArticulo"
                  />
                </div>
              </div>

              <div class="col-md-3 col-sm-3">
                <div class="form-group">
                  <label class="control-label" for="unidades">{{
                    articulotipounidad
                  }}</label>
                  <input
                    type="number"
                    v-model.number="articulounidades"
                    id="unidades"
                    name="unidades"
                    class="rm-uds form-control"
                    v-on:change="calcularTotalArticulo"
                  />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="pvp">PVP</label>
                  <input
                    type="number"
                    id="pvp"
                    v-model.number="articulopreciofinal"
                    name="pvp"
                    class="form-control"
                    v-on:change="calcularTotalArticulo"
                  />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="pvp">Total Coste</label>
                  <input
                    type="number"
                    id="pvp"
                    v-model.number="articulocoste"
                    name="pvp"
                    class="form-control"
                    v-on:change="calcularTotalArticulo"
                    
                  />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="beneficio">Beneficio</label>
                  <input
                    type="number"
                    id="beneficio"
                    v-model.number="articulobeneficio"
                    name="beneficio"
                    class="form-control"
                    v-on:change="calcularTotalArticulo"
                  />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="importefinal">Total</label>
                  <input
                    type="number"
                    v-model.number="articuloimportefinal"
                    id="importefinal"
                    name="importefinal"
                    class="form-control"
                    v-on:change="recalcularBeneficioArticulo"
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3 col-sm-4"></div>
              <div
                class="col-sm-6 col-sm-12 no-width-info-content"
                style="display: block"
              >
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-4"></div>
            
            </div>
          </div>

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
               data-dismiss="modal"
              @click="cerrarModalArticulo()"
            >
              Cerrar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 1"
              class="btn btn-primary"
               data-dismiss="modal"
              @click="guardarModalArticulo()"
            >
              Guardar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 2"
              class="btn btn-primary"
               data-dismiss="modal"
              @click="actualizarModalArticulo()"
            >
              Actualizar
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <!--Inicio del modal AGREGAR COMPONENTE-->
    <div
      class="modal fade"
      id="modalAltaComponente"
      tabindex="-1"
      :class="{ mostrar: modalcomponente }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
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
            <h4 class="modal-title" v-text="tituloModalComponente">
              {{ coCodigo }}
            </h4>
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
                <i class="icon-plus"></i>&nbsp;Buscar Artículo3
              </button>

              <!--  <div class="col-md-6 col-sm-4">
                        <div class="form-group"><label class="control-label" for="anchura">Código</label> <input type="text" v-model="articulo.articulo" id="articulo" name="articulo" class="rm-width form-control" >  </div> 
              </div>-->

              <div class="col-md-12 col-sm-4">
                <div class="form-group">
                  <label class="control-label" for="descripcion"
                    >Descripcion :({{ coCodigoPrincipal }}-{{ coIdx }})</label
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
              <div class="col-md-3 col-sm-3">
                <div class="form-group">
                  <label class="control-label" for="mermas">%Mermas</label>
                  <input
                    type="number"
                    v-model.number="coMermas"
                    id="mermas"
                    name="mermas"
                    class="rm-m2 form-control"
                    v-on:change="calcularTotalPvpComponente"
                    v-on:input="calcularTotalPvpComponente"
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
                  <label class="control-label" for="unidades">{{
                    coTipoUnidad
                  }}</label>
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
                    v-model.number="coPrecioFinal"
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
                  <h6>{{coUnidades*coPrecioFinal}}</h6>-->
                </div>
              </div>
              <div class="col-md-9 col-sm-9 float-right" v-if="coMermas">
                <div class="form-group">
                  <label class="control-label" for="precio"
                    >Coste Unidad sin Mermas
                  </label>
                  <input
                    type="number"
                    v-model.number="coPrecio"
                    id="precio"
                    name="precio"
                    class="rm-uds form-control"
                    v-on:change="calcularTotalPvpComponente"
                    v-on:input="calcularTotalPvpComponente"
                  />
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

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="cerrarModalComponente()"
            >
              Cerrar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 1"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="guardarModalComponente()"
            >
              Guardar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 2"
              class="btn btn-primary"
              data-dismiss="modal"
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
  </main>
</template>

<script>
export default {
  //props : ['ruta'],
  data() {
    return {
      verComponente: false,
      verArticulo: false,
      modelo: "",
      accion: "",
      data: {},
      idx: "",

      tituloModalArticulo: "",
      modalarticulo: 0,

      articulodescripcion: "",
      articuloprecio: "",
      articulounidades: "",
      articulobultos: "",
      articulotipounidad: "",
      articulototal: 0,
      articulopvp: "",
      articulopreciofinal: "",
      articulobeneficio: "",
      articuloimportefinal: "",
      articulocoste: "",
      articulocodigo: "",
      articuloidx: "",

      coIdx: "",
      coIdPresupuesto: "",
      coIdPresupuestoLinea: "",
      coDescripcion: "",
      coAnchura: "",
      coAltura: "",
      coMetros: "",
      coUnidades: "",
      coMermas: 0,
      coTipoUnidad: "Ud",
      coBultos: 1,
      coPrecioFinal: "",
      coMontaje: "",

      coGastos: "",
      coCostes: "",

      coSubcontratacion: "",
      coBeneficios: "",
      coPvp: "",
      coCodigoPrincipal: "",
      coCodigo: "",
      modalcomponente: 0,
      tituloModalComponente: "",

      pt_id: 0,
      nombre: "",
      descripcion: "",
      arrayProductoTarifa: [],

      articulos: [],
      componentes: [],

      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "descripcion",
      buscar: "",
    };
  },
  computed: {
    isActived: function () {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.articulos.length; i++) {
        if (this.articulos[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },

    guardarModalArticulo() {
      let me = this;

      if (!me.articulodescripcion.length === 0) {
        swal({
          type: "error",
          title: "Error...",
          text: "Descripcion Obligatoria!",
        });
      }

      if (me.encuentra(me.articulocodigo)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else {
        const nuevocodigo =
          9000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);

        console.log("201020", this.articulocoste);

        axios
          .post("/tarifaproducto/articulo/guardar", {
            // idpresupuesto: me.cabecera.id,
            articulo: nuevocodigo,
            descripcion: me.articulodescripcion,
            cantidad: me.articulounidades,
            bultos: me.articulobultos,
            tipounidad: me.articulotipounidad,
            precio: me.articulopvp,
            preciofinal: me.articulopreciofinal,
            beneficio: me.articulobeneficio,
            importefinal: me.articuloimportefinal,
            costes: me.articulocoste,
            /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
          })
          .then(function (response) {
            var articulo = response.data.tarifaProducto;

            console.log(
              "guardarModalArticulo",
              response,
              response.data.tarifaProducto
            );
            me.articulos.push({
              id: articulo.id,
              //  idpresupuesto: articulo.idpresupuesto,
              articulo: articulo.articulo,
              descripcion: articulo.descripcion,
              cantidad: articulo.cantidad,
              tipounidad: articulo.tipounidad,
              precio: articulo.precio,
              preciofinal: articulo.preciofinal,
              beneficios: articulo.beneficios,
              importefinal: articulo.importefinal,
              costes: articulo.costes,
              linea: articulo.linea,
              bultos: articulo.bultos,
              //TODO HOY
            });

            /*   swal(
                      "Insertado!",
                      "Articulo ha sido guardado con éxito.",
                      "success"
                    ); */
          })
          .catch(function (error) {
            console.log(error);
            if (
              error.response.status === 401 ||
              error.response.status === 419
            ) {
              window.location = "/login";
            }
          });

        console.log("guardarModalArticulo", me.articulos);
        this.cerrarModalArticulo();
        me.articulodescripcion = "";
        me.articulounidades = "";
        me.articulobultos = "";
        me.articulotipounidad = "";
        me.articulocodigo = "";
        me.articulopvp = "";
        me.articulopreciofinal = "";
        me.articulobeneficio = "";
        me.articulocoste = "";
        me.articuloimportefinal = "";
        me.articulototal = 0;

        me.tipoAccion = 0;
      }
    },

    actualizarModalArticulo() {
      let me = this;

      /*  me.articulos[me.articuloidx].importefinal =
        me.articulopreciofinal * me.articulounidades;
      me.articulos[me.articuloidx].preciofinal = me.articulopreciofinal; */

      axios
        .put("/tarifaproducto/articulo/actualizar", {
          id: me.articulos[me.articuloidx].id,
          descripcion: me.articulodescripcion,
          cantidad: me.articulounidades,
          bultos: me.articulobultos,
          tipounidad: me.articulotipounidad,
          precio: me.articulopvp,
          preciofinal: me.articulopreciofinal,
          beneficio: me.articulobeneficio,
          importefinal: me.articuloimportefinal,
          costes: me.articulocoste,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          var articulo = response.data.tarifaProducto;

          console.log(
            "guardarModalArticulo todo ",
            response,
            response.data.tarifaProducto,
            articulo
          );

          me.articulos[me.articuloidx].descripcion = articulo.descripcion;
          me.articulos[me.articuloidx].cantidad = articulo.cantidad;
          me.articulos[me.articuloidx].bultos = articulo.bultos;
          me.articulos[me.articuloidx].linea = articulo.linea;
          me.articulos[me.articuloidx].tipounidad = articulo.tipounidad;
          me.articulos[me.articuloidx].preciofinal = articulo.preciofinal;
          me.articulos[me.articuloidx].beneficios = articulo.beneficios;
          me.articulos[me.articuloidx].costes = articulo.costes;

          me.articulos[me.articuloidx].importefinal = articulo.importefinal;

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

      /*  this.recalcularTodosBeneficioComponente(
        me.articulos[me.articuloidx].id,
        me.articulobeneficio
      );
 */
      console.log("actualizar articulo", me.articulos, me.articulopvp);

      this.cerrarModalArticulo();

      me.articulodescripcion = "";
      me.articulounidades = "";
      me.articulobultos = "";
      me.articulotipounidad = "";
      me.articulocodigo = "";
      me.articulopvp = "";
      me.articulopreciofinal = "";
      me.articulocoste = "";

      me.articulobeneficio = "";
      me.articuloimportefinal = "";

      me.articulototal = 0;
      me.tipoAccion = 0;

      /*  me.articulos.push({
            codigo:me.articulocodigo,
          descripcion: me.articulodescripcion,
          cantidad: me.articulounidades,
          precio: me.articulopvp,
          total : me.articulounidades*me.articulopvp,
          
        });


      me.articulos.splice(this.articuloidx, 1); */
    },

    recalcularBeneficioArticulo: function () {
      console.log(
        "recalcularBeneficioArticulo",
        this.articulounidades,
        this.articulopreciofinal,
        this.articuloimportefinal,
        this.articulobeneficio
      );

      //this.bene = ((this.base * this.coBeneficios) / 100).toFixed(2);
      //this.coBeneficios =(( this.bene * 100) / this.base ).toFixed(2);

      let base = 0;
      if (
        isNaN(this.articulocoste) ||
        this.articulocoste === undefined ||
        this.articulocoste === null
      ) {
        base = (this.articulounidades * this.articulopreciofinal).toFixed(2);
      } else {
        base = this.articulocoste;
      }
      // hoy let base = (this.articulounidades * this.articulopreciofinal).toFixed(3);

      /*  let base =
        +importe +  + +this.coGastos + +this.coSubcontratacion; */

      this.articulobeneficio = (
        [(this.articuloimportefinal - base) / base] * 100
      ).toFixed(3);

      console.log(
        "recalcularBeneficioArticulo 222",
        this.articulounidades,
        this.articulopreciofinal,
        this.articuloimportefinal,
        this.articulobeneficio
      );
    },

    calcularTotalArticulo: function () {
      console.log(
        "calcularTotalArticulo aaaaaaaaa",
        this.articulounidades,
        this.articulopreciofinal,
        this.articuloimportefinal,
        this.articulobeneficio
      );
      if (
        isNaN(this.articulobultos) ||
        this.articulobultos === undefined ||
        this.articulobultos === null ||
        this.articulobultos == 0.0
      ) {
        this.articulobultos = 1;
        console.log(
          "calcularTotalArticulo aaaaaaaaa articulobultos 0 ",
          this.articulobultos
        );
      }

      if (
        isNaN(this.articulounidades) ||
        this.articulounidades === undefined ||
        this.articulounidades === null ||
        this.articulounidades == 0.0
      ) {
        this.articulounidades = 1;
        console.log(
          "calcularTotalArticulo aaaaaaaaa UNIDADES 0 ",
          this.articulounidades
        );
      }
      /*  this.articulocoste = (this.articulounidades * this.articulopreciofinal).toFixed(2); */
      //  let base  = (this.articulounidades * this.articulopreciofinal).toFixed(2);
      let base = 0;
      let cantidad = this.articulobultos * this.articulounidades;

      if (
        isNaN(this.articulocoste) ||
        this.articulocoste === undefined ||
        this.articulocoste === null ||
        this.articulocoste == 0.0
      ) {
        base = (cantidad * this.articulopreciofinal).toFixed(2);

        console.log(
          "calcularTotalArticulo aaaaaaaaa IF",
          this.articulocoste,
          base
        );
      } else {
        //base = this.articulocoste;
        base = (cantidad * this.articulocoste).toFixed(2);
        console.log(
          "calcularTotalArticulo aaaaaaaaa else",
          this.articulocoste,
          base
        );
      }

      let benet = ((base * this.articulobeneficio) / 100).toFixed(2);

      this.articuloimportefinal = (+base + +benet).toFixed(2);

      console.log(
        "calcularTotalArticulo",
        this.articulounidades,
        this.articulopreciofinal,
        this.articuloimportefinal,
        this.articulobeneficio,
        base,
        benet
      );
    },

    cerrarModalArticulo() {
      this.modalarticulo = 0;
      this.tituloModalArticulo = "";
    },

    abrirModalArticulo(modelo, accion, data = [], idx) {
      /* this.arrayArticulo = [];
      this.modalarticulo = 1;
      this.tituloModalArticulo = "Alta de articulo";
      */

      this.modelo = "tarifaProductoA";
      this.accion = accion;
      this.data = data;
      this.idx = idx;

      switch (modelo) {
        case "articulo": {
          switch (accion) {
            case "registrar": {
              this.modalarticulo = 1;
              this.tituloModalArticulo = "Alta de artículo";

              this.articulocodigo = "";
              this.articuloidx = "";
              this.articulodescripcion = "";
              this.articulounidades = "";
              this.articulobultos = "";
              this.articulotipounidad = "";
              this.articulopvp = "";
              this.articulopreciofinal = "";

              this.articulobeneficio = "";
              this.articuloimportefinal = "";
              this.articulocoste = "";

              this.articulototal = 0;

              this.tipoAccion = 1;
              break;
            }

            case "actualizar": {
              console.log(data, data["descripcion"], idx);
              this.modalarticulo = 1;
              this.tituloModalArticulo = "Actualizar Articulo";
              this.tipoAccion = 2;
              this.articuloidx = idx;
              this.articulocodigo = data["articulo"];
              this.articulodescripcion = data["descripcion"];
              this.articulotipounidad = data["tipounidad"];
              this.articulounidades = data["cantidad"];
              this.articulobultos = data["bultos"];
              this.articulopreciofinal = data["preciofinal"];
              this.articulobeneficio = data["beneficios"];
              this.articulocoste = data["costes"];

              this.articuloimportefinal = data["importefinal"];
              this.tipoAccion = 2;

              break;
            }

            case "buscar": {
              // buscar desde componentes
              console.log(data, data["descripcion"], idx);
              this.modalBuscar = 1;
              this.tituloModal = "Buscar Articulo";

              this.tipoAccion = 3;

              break;
            }
            case "buscarArticulo": {
              // buscar componetes desde articulos
              console.log(data, data["descripcion"], idx);
              this.modalBuscar = 1;
              this.tituloModal = "Buscar Articulo";
              this.modalBuscarArticulo = 2; // solo si se llama desde articulos

              this.tipoAccion = 3;

              break;
            }
          }
        }
      }
    },

    actualizarModalComponente() {
      let me = this;

      var sw = 0;
      var componente = 0;
      console.log(
        "recalcularTodosBeneficioComponente actualizarModalComponente",
        this.componentes
      );
      for (var i = 0; i < this.componentes.length; i++) {
        console.log(
          "recalcularTodosBeneficioComponente actualizarModalComponente",
          this.coCodigoPrincipal,
          this.coCodigo
        );
        console.log(
          "recalcularTodosBeneficioComponente xxx actualizarModalComponente",
          i,
          this.componentes[i].componente,
          this.componentes[i].articulo,

          "--",
          this.coCodigo,
          this.coCodigoPrincipal,
          "---",
          this.componentes[i].articulo == this.coCodigoPrincipal,
          this.componentes[i].componente == this.coCodigo
        );

        if (
          this.componentes[i].articulo == this.coCodigoPrincipal &&
          this.componentes[i].componente == this.coCodigo
        ) {
          sw = true;
          componente = i;
          // me.coIdx = i;
          console.log(
            "***222",
            i,
            this.componentes[i].componente,
            this.componentes[i].articulo
          );
        }
      }

      //BUSCO COMPONENTE PARA ACTUALIZAR

      me.componentes[componente].descripcion = me.coDescripcion;
      me.componentes[componente].m2 = me.coMetros;
      me.componentes[componente].longitud = me.coAltura;
      me.componentes[componente].ancho = me.coAnchura;
      me.componentes[componente].cantidad = me.coUnidades;
      me.componentes[componente].bultos = me.coBultos;

      me.componentes[componente].tipounidad = me.coTipoUnidad;
      me.componentes[componente].preciofinal = me.coPrecioFinal;
      me.componentes[componente].mermas = me.coMermas;
      me.componentes[componente].precio = me.coPrecio;

      me.componentes[componente].cantidad = me.coUnidades;
      me.componentes[componente].costes = me.coCostes;

      me.componentes[componente].montaje = me.coMontaje;

      me.componentes[componente].gastos = me.coGastos;

      me.componentes[componente].subcontratado = me.coSubcontratacion;
      me.componentes[componente].beneficios = me.coBeneficios;
      me.componentes[componente].importefinal = me.coPvp;

      console.log(
        "recalcularTodosBeneficioComponente actualizarModalComponente actualizar componente FINAL",
        me.componentes,
        me.componente,
        me.componentes[componente].altura,
        me.coIdx
      );

      axios
        .put("/tarifaproducto/componente/actualizar", {
          id: me.coIdx, // id componente
          //idpresupuesto: me.cabecera.id, // o coIdPresupueto
          //idpresupuestolinea: me.coIdPresupuestoLinea,

          articulo: me.coCodigoPrincipal,
          componente: me.coCodigo,

          descripcion: me.coDescripcion,
          m2: me.coMetros,
          ancho: me.coAnchura,
          longitud: me.coAltura,
          tipounidad: me.coTipoUnidad,
          bultos: me.coBultos,
          cantidad: me.coUnidades,
          montaje: me.coMontaje,
          gastos: me.coGastos,
          subcontratado: me.coSubcontratacion,
          beneficios: me.coBeneficios,
          mermas: me.coMermas,
          precio: me.coPrecio,
          preciofinal: me.coPrecioFinal,
          importefinal: me.coPvp,
          costes: me.coCostes,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          var tarifaProducto = response.data.tarifaProducto;

          console.log(
            "recalcularTodosBeneficioComponente actualizarModalComponente guardarModalComponente",
            response,
            response.data.tarifaProducto.id
          );

          console.log(
            "recalcularTodosBeneficioComponente actualizarModalComponente guardarModalComponente componentes ",

            me.componentes
          );

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

      this.recalcularTotalArticulo("actualizar", me.coCodigoPrincipal);
      this.cerrarModalComponente();
    },

    recalcularBeneficioComponente: function () {
      let importe = (this.coUnidades * this.coPrecioFinal).toFixed(3);

      this.base =
        +importe + +this.coMontaje + +this.coGastos + +this.coSubcontratacion;

      this.coBeneficios = (
        [(this.coPvp - this.base) / this.base] * 100
      ).toFixed(3);
    },

    calcularM2() {
      this.coMetros = (this.coAnchura * this.coAltura).toFixed(3);
      this.coTipoUnidad = "M2";
      this.coUnidades = this.coMetros;

      this.calcularTotalPvpComponente();
    },
    calcularTotalPvpComponente2: function () {
      console.log(
        "calcularTotalPvpComponente Total 1",
        this.coPrecioFinal,
        this.coPvp,
        this.coBultos
      );

      if (isNaN(this.coPrecioFinal) || this.coPrecioFinal === null) {
        this.coPrecioFinal = 0.0;
      }
      if (isNaN(this.coUnidades) || this.coUnidades === null) {
        this.coUnidades = 0.0;
      }

      if (this.coMetros || this.coBultos) {
        this.coUnidades = this.coMetros * this.coBultos;
      }

      if (isNaN(this.coMontaje) || this.coMontaje === null) {
        this.coMontaje = 0.0;
      }

      if (isNaN(this.coGastos) || this.coGastos === null) {
        this.coGastos = 0.0;
      }
      if (
        isNaN(this.coBultos) ||
        this.coBultos === null ||
        this.coBultos === undefined
      ) {
        this.coBultos = 1;
      }
      if (this.coBultos === 0.0) {
        this.coBultos = 1;
      }

      let sub, mon, pre;

      sub = this.coSubcontratacion;
      console.log(
        "calcularTotalPvpComponente Total sub =",
        this.coSubcontratacion,
        this.coBultos
      );

      if (isNaN(this.coSubcontratacion) || this.coSubcontratacion === null) {
        this.coSubcontratacion = 0;
        console.log(
          "calcularTotalPvpComponente Total sub 0",
          this.coSubcontratacion
        );
      } else {
        this.coSubcontratacion = this.coSubcontratacion;
        console.log(
          "calcularTotalPvpComponente Total sub",
          this.coSubcontratacion
        );
      }

      console.log(
        "calcularTotalPvpComponente Total sub",
        this.coSubcontratacion
      );
      let cantidad = this.coBultos * this.coUnidades;

      let importe = (cantidad * this.coPrecioFinal).toFixed(2);
      console.log(
        "calcularTotalPvpComponente Total importe",
        importe,
        "mon",
        this.coMontaje,
        "sub",
        this.coSubcontratacion
      );

      this.base =
        +importe + +this.coGastos + +this.coMontaje + +this.coSubcontratacion;

      //this.coCostes = importe;
      this.coCostes = this.base;

      console.log(
        "calcularTotalPvpComponente Total base costes ",
        this.coCostes,
        this.base
      );

      this.bene = ((this.base * this.coBeneficios) / 100).toFixed(2);

      console.log("calcularTotalPvpComponente Total bene", this.bene);

      let total = +this.base + +this.bene;

      this.coPvp = total.toFixed(2);

      console.log(
        "calcularTotalPvpComponente Total FIN ",
        this.coPvp,
        importe,
        this.base,
        this.bene,
        total
      );
      /* 
    return    this.coPrecioFinal*this.coUnidades;
 */
    },

    calcularTotalPvpComponente: function () {
      console.log(
        "calcularTotalPvpComponente Total 1",
        this.coPrecioFinal,
        this.coPvp,
        this.coBultos
      );

      if (isNaN(this.coPrecio) || this.coPrecio === null) {
        this.coPrecio = 0.0;
      }

      if (isNaN(this.coPrecioFinal) || this.coPrecioFinal === null) {
        this.coPrecioFinal = 0.0;
      }

      if (isNaN(this.coUnidades) || this.coUnidades === null) {
        this.coUnidades = 0.0;
      }

      if (isNaN(this.coBultos) || this.coBultos === null) {
        this.coBultos = 0.0;
      }

      if (this.coBultos) {
        console.log(
          "0812 calcularTotalPvpComponente",
          this.coUnidades,
          this.coMetros,
          this.coBultos
        );
      }
      if (this.coMetros) {
        this.coUnidades = this.coMetros * this.coBultos;
        console.log(
          "0812 calcularTotalPvpComponente",
          this.coUnidades,
          this.coMetros,
          this.coBultos
        );
      }

      this.coMermas = parseFloat(this.coMermas);

      if (
        isNaN(this.coMermas) ||
        this.coMermas === null ||
        this.coMermas === 0 ||
        this.coMermas === 0.0
      ) {
        console.log("calcularTotalPvpComponente MEERMAS  1", this.coMermas);

        this.coMermas = parseFloat(this.coMermas);

        if (this.coPrecio > 0) {
          console.log("calcularTotalPvpComponente MEERMAS  2", this.coMermas);
          this.coPrecioFinal = this.coPrecio;
          this.coPrecio = 0;
        }
        console.log("calcularTotalPvpComponente MEERMAS  3", this.coMermas);
      } else {
        let merma,
          precioUnidad = 0.0;
        this.coMermas = parseFloat(this.coMermas);

        console.log(
          "calcularTotalPvpComponente MEERMAS  4",
          this.coMermas,
          isNaN(this.coMermas),
          this.coMermas === null,
          this.coMermas === 0,
          this.coPrecio,
          this.coPrecioFinal,
          precioUnidad
        );

        if (this.coMermas || this.coMermas > 0) {
          console.log(
            "calcularTotalPvpComponente MEERMAS  5",
            this.coMermas,
            this.coPrecio,
            this.coPrecioFinal,
            precioUnidad
          );
        } else {
          console.log(
            "calcularTotalPvpComponente MEERMAS  6",
            this.coMermas,
            this.coPrecio,
            this.coPrecioFinal,
            precioUnidad
          );

          this.coPrecioFinal = this.coPrecio;
          this.coPrecio = 0;
        }

        if (this.coPrecio > 0 || this.coPrecioFinal === 0) {
          this.coPrecioFinal = this.coPrecio;
          console.log(
            "calcularTotalPvpComponente MEERMAS  7",
            this.coMermas,
            this.coPrecio,
            this.coPrecioFinal,
            precioUnidad
          );
        } else {
          this.coPrecio = this.coPrecioFinal;
          console.log(
            "calcularTotalPvpComponente MEERMAS  8",
            this.coMermas,
            this.coPrecio,
            this.coPrecioFinal,
            precioUnidad
          );
        }

        merma = (this.coPrecio * this.coMermas) / 100;
        // precioUnidad = (parseFloat(this.coPrecio, 4) + parseFloat(merma,4));
        precioUnidad = +this.coPrecio + +merma;

        this.coPrecioFinal = precioUnidad.toFixed(2);
        console.log(
          "calcularTotalPvpComponente MEERMAS  9",
          this.coMermas,
          this.coPrecio,
          this.coPrecioFinal,
          precioUnidad
        );
        console.log(
          "calcularTotalPvpComponente MEERMAS  fin -----------------------------------------",
          this.coMermas,
          this.coPrecio,
          this.coPrecioFinal,
          precioUnidad
        );

        console.log(
          "precioUnidad",
          precioUnidad,
          "%mermca",
          this.coMermas,
          "mermas",
          merma,
          "precioUnidad",
          this.coPrecioFinal,
          precioUnidad
        );
      }

      if (isNaN(this.coMontaje) || this.coMontaje === null) {
        this.coMontaje = 0.0;
      }

      if (isNaN(this.coGastos) || this.coGastos === null) {
        this.coGastos = 0.0;
      }
      if (
        isNaN(this.coBultos) ||
        this.coBultos === null ||
        this.coBultos === undefined
      ) {
        this.coBultos = 1;
      }

      if (this.coBultos === 0.0) {
        this.coBultos = 1;
      }

      let sub, mon, pre;

      sub = this.coSubcontratacion;
      console.log(
        "calcularTotalPvpComponente Total sub =",
        this.coSubcontratacion,
        this.coBultos
      );

      if (isNaN(this.coSubcontratacion) || this.coSubcontratacion === null) {
        this.coSubcontratacion = 0;
        console.log(
          "calcularTotalPvpComponente Total sub 0",
          this.coSubcontratacion
        );
      } else {
        this.coSubcontratacion = this.coSubcontratacion;
        console.log(
          "calcularTotalPvpComponente Total sub",
          this.coSubcontratacion
        );
      }

      console.log(
        "calcularTotalPvpComponente Total sub",
        this.coSubcontratacion
      );
      let cantidad = this.coBultos * this.coUnidades;

      let importe = (cantidad * this.coPrecioFinal).toFixed(2);
      console.log(
        "calcularTotalPvpComponente Total importe",
        importe,
        "mon",
        this.coMontaje,
        "sub",
        this.coSubcontratacion
      );

      this.base =
        +importe + +this.coGastos + +this.coMontaje + +this.coSubcontratacion;

      //this.coCostes = importe;
      this.coCostes = this.base;

      console.log(
        "calcularTotalPvpComponente Total base costes ",
        this.coCostes,
        this.base
      );

      this.bene = ((this.base * this.coBeneficios) / 100).toFixed(2);

      console.log("calcularTotalPvpComponente Total bene", this.bene);

      let total = +this.base + +this.bene;

      this.coPvp = total.toFixed(2);

      console.log(
        "calcularTotalPvpComponente Total FIN ",
        this.coPvp,
        importe,
        this.base,
        this.bene,
        total
      );
      /* 
    return    this.coPrecioFinal*this.coUnidades;
 */
    },

    abrirModalComponente(modelo, accion, data = [], index) {
      // window.scrollTo(0,0);
      console.log(
        "abrirmodalComponente",
        modelo,
        accion,
        data,
        data.articulo,
        //data.articulo.id,
        index,
        data["id"]
      );

      this.modelo = "tarifaProductoC";
      this.accion = accion;
      this.data = data;
      this.idx = index;

      switch (modelo) {
        case "componente": {
          switch (accion) {
            case "registrar": {
              this.modalarticulo = 1;
              this.tituloModalArticulo = "Alta de Componente";

              this.data.articulo_principal = data.articulo;
              console.log(
                "abrir modal componente registrar",
                data.articulo,
                this.data.articulo_principal,

                index
              );

              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              console.log(
                "abrir modal componente actualizar",
                data,
                data["descripcion"],
                index
              );
              this.modalarticulo = 1;
              this.tituloModalArticulo = "Actualizar de Componente";

              /*   this.modalcomponente = 1;
              this.tituloModalComponente = "Actualizar Componente"; */

              this.tipoAccion = 2;

              this.data = data;

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
    guardarModalComponente() {
      let me = this;
      const nuevocodigoco =
        8000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);
      me.coCodigo = nuevocodigoco;

      console.log("guardarModalComponente", nuevocodigoco);

      axios
        .post("/tarifaproducto/componente/guardar", {
          //idpresupuesto: me.cabecera.id,
          //idpresupuestolinea: me.coIdx, // id del articulo
          articulo: me.coCodigoPrincipal,
          componente: nuevocodigoco,

          descripcion: me.coDescripcion,
          m2: me.coMetros,
          ancho: me.coAnchura,
          longitud: me.coAltura,
          tipounidad: me.coTipoUnidad,
          bultos: me.coBultos,

          cantidad: me.coUnidades,
          montaje: me.coMontaje,
          gastos: me.coGastos,
          subcontratado: me.coSubcontratacion,
          beneficios: me.coBeneficios,
          preciofinal: me.coPrecioFinal,
          precio: me.coPrecio,
          mermas: me.coMermas,
          importefinal: me.coPvp,
          costes: me.coCostes,

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

            me.componentes
          );
          //me.insertComponente(idcompo);

          me.componentes.push({
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

            //descuento

            comentarios: "observaciones",
          });

          me.recalcularTotalArticulo("guardar", me.coCodigoPrincipal);

          me.cerrarModalComponente();

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

      console.log("todo ", me.coCodigoPrincipal);
    },

    recalcularTotalArticulo(origen, id) {
      let me = this;
      console.log("recalcularTotalArticulo INICIO  ", origen, id);

      console.log(
        "recalcularTotalArticulo",
        me.componentes,
        me.componentes.length
      );

      /*  const objIndex = this.articulos.findIndex(
        (obj) => obj.articulo === me.coCodigoPrincipal
      ); */
      const objIndex = this.articulos.findIndex((obj) => obj.articulo === id);

      /*  const resultado = this.articulos.find(
        (fruta) => fruta.articulo === me.coCodigoPrincipal
      ); */

      console.log(
        "recalcularTotalArticulo",
        // resultado,
        objIndex,
        me.articulos[objIndex].importefinal,
        me.componentes.length
      );

      let sw = 0;
      let tpvp = 0;
      let tcoste = 0;
      let tbene = 0;

      for (var i = 0; i < me.componentes.length; i++) {
        console.log(
          "recalcularTotalArticulo",
          "me.componentes.articulo",
          me.componentes[i].articulo,
          "me.articulos[objIndex].componente",
          me.articulos[objIndex].componente,
          "componentes",
          me.componentes,
          me.componentes[i].articulo === me.articulos[objIndex].articulo,
          me.componentes[i].articulo == me.articulos[objIndex].articulo
        );

        if (me.componentes[i].articulo === me.articulos[objIndex].articulo) {
          tpvp = (+tpvp + +me.componentes[i].importefinal).toFixed(2);

          sw = (+sw + +me.componentes[i].importefinal).toFixed(2);

          tcoste = (+tcoste + +me.componentes[i].costes).toFixed(2);

          console.log(
            i,
            "recalcularTotalArticulo",
            sw,
            me.componentes[i].importefinal,
            tcoste,
            tpvp
          );
        }
      }

      if (tcoste === 0) {
        me.articulos[objIndex].beneficios = 0;
        tpvp = (
          me.articulos[objIndex].cantidad * me.articulos[objIndex].preciofinal
        ).toFixed(2);
      } else {
        me.articulos[objIndex].beneficios = (
          [(tpvp - tcoste) / tcoste] * 100
        ).toFixed(3);
      }

      // me.articulos[objIndex].importefinal = sw;
      me.articulos[objIndex].costes = tcoste;
      me.articulos[objIndex].importefinal = tpvp;

      console.log(
        "recalcularTotalArticulo fin",
        me.articulos[objIndex].costes,
        tcoste,
        me.articulos[objIndex].importefinal,
        tpvp,
        me.articulos[objIndex].beneficios,
        ([(tpvp - tcoste) / tcoste] * 100).toFixed(3)
      );

      //BUSCO ARTICULO Y ACTUALIZSO COSTE
      axios
        .put("/tarifaproducto/actualizar/coste", {
          id: me.articulos[objIndex].id,
          costes: tcoste,
          beneficio: me.articulos[objIndex].beneficios,
          importefinal: tpvp,
        })
        .then(function (response) {
          console.log(
            "recalcularTotalArticulo,presupuesto/detalle/actualizar/coste",
            response
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });

      console.log(
        "recalcularTotalArticulo TOTAL ARTICULO FIN ARTICULOS",
        me.articulos[objIndex]
      );

      //  me.actualizarModalArticulo();
    },

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
      this.coTipoUnidad = "";
      this.coBultos = "";
      this.coPrecioFinal = "";
      this.coMontaje = "";
      this.coGastos = "";
      this.coSubcontratacion = "";
      this.coBeneficios = "";
      this.coPvp = "";
    },

    eliminarComponente(componente, index) {
      swal({
        title: "Esta seguro de anular este Componente?",
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
          console.log(
            "ELIMINAR COMPONENTE",
            componente,
            index,
            this.componentes
          );

          for (var i = 0; i < this.componentes.length; i++) {
            console.log("ELIMINAR COMPONENTE", componente, i, this.componentes);

            if (this.componentes[i].id === componente.id) {
              if (this.componentes[i].id === undefined) {
                // if (this.componentes[i].id === componente.id) {
                this.componentes.splice(i, 1);
                /*  swal(
                  "Anulado!",
                  "Componente ha sido anulada con éxito.",
                  "success"
                );
                */ console.log(
                  "elminarComonetne IF",
                  this.componentes[i].id
                );
              } else {
                console.log("elminarComonetne ELSE", this.componentes[i].id);

                axios
                  .put("/tarifaproducto/eliminar", {
                    id: this.componentes[i].id,
                  })
                  .then(function (response) {
                    //this.guardarPresupuesto();
                    swal(
                      "Anulado!",
                      "Articulo ha sido anulada con éxito.",
                      "success"
                    );
                  })
                  .catch(function (error) {
                    console.log(error);
                    if (
                      error.response.status === 401 ||
                      error.response.status === 419
                    ) {
                      window.location = "/login";
                    }
                  });

                this.componentes.splice(i, 1);

                /*     this.recalcularTotalArticulo("eliminar", componente.articulo); */
              }

              //this.componentes.splice(i, 1);
            }
          }
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    filteredRows1(a) {
      //console.log("filtered dos ", a);
      return this.componentes.filter((componente) => {
        /*  console.log("filter dos ", this.componentes, componente.articulo, a);*/
        const compo = componente.articulo.toString().toLowerCase();

        return compo.includes(a.articulo);
      });
    },

    listarProductoTarifa(page, buscar, criterio) {
      let me = this;
      //var url= this.ruta + '/rol?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      var url =
        "/productotarifa?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;

          me.arrayProductoTarifa = respuesta.articulos.data;
          me.articulos = respuesta.articulos.data;
          me.componentes = respuesta.componentes;

          me.pagination = respuesta.pagination;

          console.log(
            "listarProductoTarifa",
            me.arrayProductoTarifa,
            me.articulos,
            me.componentes,
            respuesta
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarProductoTarifa(page, buscar, criterio);
    },

    eliminarArticulo(articulo) {
      swal({
        title: "Esta seguro de anular este Articulo y sus Componentes?",
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

          for (var i = 0; i < this.componentes.length; i++) {
            if (this.componentes[i].articulo == articulo.articulo) {
              console.log("BORRO componente", i);
              this.componentes.splice(i, 1);
            }
          }

          for (var i = 0; i < this.articulos.length; i++) {
            if (this.articulos[i].articulo == articulo.articulo) {
              console.log("BORRO artiuclos", i, this.articulos[i].id);

              if (this.articulos[i].id === undefined) {
                this.articulos.splice(i, 1);
                swal(
                  "Anulado!",
                  "Articulo ha sido anulada con éxito.",
                  "success"
                );
              } else {
                axios
                  .put("/tarifaproducto/articulo/eliminar", {
                    id: this.articulos[i].id,
                    articulo: this.articulos[i].articulo,
                  })
                  .then(function (response) {
                    //this.guardarPresupuesto();
                    swal(
                      "Anulado!",
                      "Articulo ha sido anulada con éxito.",
                      "success"
                    );
                  })
                  .catch(function (error) {
                    console.log(error);
                    if (
                      error.response.status === 401 ||
                      error.response.status === 419
                    ) {
                      window.location = "/login";
                    }
                  });

                this.articulos.splice(i, 1);
              }
            }
          }
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
  },
  mounted() {
    this.listarProductoTarifa(1, this.buscar, this.criterio);
  },
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
.table tbody + tbody {
  border-top: 20px solid #c2cfd6;
}
</style>
