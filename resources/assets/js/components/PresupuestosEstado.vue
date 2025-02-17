<template>
  <main class="main">
    <div class="container-fluid" style="padding: 0 1px">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>
          Presupuestos
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-success btn-sm pull-right"
          >
            <i class="fa fa-plus-square" aria-hidden="true"></i> Nuevo
            Presupuesto
          </button>

          <button
            type="button"
            @click="listarPresupuesto(1, buscar, criterio)"
            class="btn btn-primary btn-sm pull-right"
          >
            <i class="fa fa-plus-square" aria-hidden="true"></i>Lista de
            Presupuestos
          </button>
        </div>
        <template v-if="listado == 1">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <input
                    type="text"
                    v-model="buscar"
                    @keyup.enter="listarPresupuesto(1, buscar, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarPresupuesto(1, buscar, criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>

            <table
              class="table table-responsive table-sm table-bordered caption-top table-striped"
            >
              <thead>
                <tr>
                  <th scope="col" style="width: 1px"></th>

                  <th scope="col" style="width: 5px">Ver</th>
                  <th scope="col" style="width: 6px">Nº</th>
                  <th scope="col" style="width: 6px">F. Presu</th>
                  <th scope="col" style="width: 10px">F. Entre</th>

                  <th scope="col" style="width: 30px">CLIENTE</th>
                  <th scope="col" style="width: 60px">TRABAJO</th>

                  <th scope="col" style="width: 10px">O.T.</th>

                  <th scope="col" class="bg-info text-white" style="width: 5px">
                    DISEÑO
                  </th>
                  <th
                    scope="col "
                    class="bg-info text-white"
                    style="width: 10px"
                  >
                    CORTE
                  </th>
                  <th
                    scope="col "
                    class="bg-info text-white"
                    style="width: 10px"
                  >
                    MANI.
                  </th>
                  <th
                    scope="col"
                    class="bg-info text-white"
                    style="width: 10px"
                  >
                    IMPR.
                  </th>

                  <th
                    scope="col"
                    class="bg-secondary text-white"
                    style="width: 10px"
                  >
                    FABRI
                  </th>
                  <th
                    scope="col"
                    class="bg-secondary text-white"
                    style="width: 10px"
                  >
                    FRESA
                  </th>
                  <th
                    scope="col"
                    class="bg-secondary text-white"
                    style="width: 10px"
                  >
                    LASER
                  </th>
                  <th
                    scope="col"
                    class="bg-secondary text-white"
                    style="width: 10px"
                  >
                    PINT
                  </th>

                  <th
                    scope="col"
                    class="bg-dark text-white"
                    style="width: 10px"
                  >
                    EMBA
                  </th>
                  <th
                    scope="col"
                    class="bg-dark text-white"
                    style="width: 10px"
                  >
                    ENVIO
                  </th>
                  <th
                    scope="col"
                    class="bg-dark text-white"
                    style="width: 10px"
                  >
                    MONT
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="presupuesto in arrayPresupuesto"
                  :key="presupuesto.id"
                  v-bind:style="[
                    fechaHoy > presupuesto.fecha_entrega
                      ? { 'background-color': '#F7D7D0' }
                      : '',
                  ]"
                >
                  <th scope="row"></th>
                  <td style="width: 4%">
                    <button
                      type="button"
                      @click="verPresupuesto(presupuesto.id)"
                      class="btn btn-success btn-sm"
                    >
                      <i class="icon-eye"></i>
                    </button>
                  </td>
                  <td
                    style="font-weight: bold; width: 4%"
                    v-text="presupuesto.id"
                  ></td>

                  <td type="date" style="width: 2%">
                    {{ presupuesto.fecha_presupuesto | fechaF }}
                  </td>
                  <td
                    type="date"
                    style=""
                    class="btn btn-primary btn-block"
                    @click="cambiarFechaEntrega(presupuesto.id)"
                  >
                    {{ presupuesto.fecha_entrega | fechaF }}
                  </td>
                  <!--                   <td v-text="presupuesto.fecha_presupuesto" ></td>
                  <td v-text="presupuesto.fecha_entrega"></td>-->
                  <!--  <td type="date" style="witdh: 10px;">

                      <input
                        type="date"
                        class="form-control"
                        style="witdh: 10px;"
                        v-model="presupuesto.fecha_entrega"
                        placeholder="Fecha Entrega"
                      />
                    </td> -->
                  <td style="font-weight: bold; width: 15%">
                    {{ presupuesto.cliente_descripcion | truncate(20, "...") }}
                  </td>
                  <td style="font-weight: bold; width: 40%">
                    {{ presupuesto.trabajo_descripcion | truncate(90, "...") }}
                  </td>
                  <!--                   <td  style="font-weight: bold" v-text="presupuesto.cliente_descripcion"></td>
                 <td  style="font-weight: bold" v-text="presupuesto.trabajo_descripcion"></td>-->
                  <td
                    style=""
                    v-text="presupuesto.codigo_obra"
                    class="btn btn-primary btn-block"
                    @click="ponerCodigoObra(presupuesto.id)"
                  ></td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasDiseno(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                        <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                         <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                        <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>
                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasCorte(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                      <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          > n </span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                     <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasManipulacion(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                      <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasImpresion(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                        <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasFabricacion(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasFresa(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                       <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>

                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                        <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasLaser(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    > 
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      > <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                         <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasPintura(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                      <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                         <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td>
                    <div
                      v-for="hora in filtroArrayHorasEmbalaje(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                         <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                         <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasEnvio(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                         <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                         <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span>
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                        <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>

                  <td style="width: 4%">
                    <div
                      v-for="hora in filtroArrayHorasMontaje(
                        presupuesto.codigo_obra
                      )"
                      :key="hora.id"
                    >
                      <div
                        v-if="hora.horas > 0 && hora.fin >= 1"
                        class="btn btn-success btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                       <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          >{{ hora.name }}</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-info"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                      <div
                        v-else
                        class="btn btn-info btn-block"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="hora.name + '[' + hora.horas / 60 + ']'"
                      >
                        <span
                          v-if="hora.name === 'nuevo'"
                          class="badge badge-pill badge-danger"
                          style="position: relative"
                          >N</span
                        >
                        <span
                          v-else
                          class="badge badge-pill badge-success"
                          style="position: relative"
                          >{{ hora.horas / 60 }}</span
                        >
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--  <div class="table-responsive" > -->

            <!--   </div> -->

            <!--  <div class="container-fuid">
              <div class="row">
                <div class="col-sm btn btn-primary min-w-0.5">ver</div>
                <div class="col-sm btn btn-primary">Nº Pre.</div>
                <div class="col-sm btn btn-primary">Fecha</div>
                <div class="col-sm btn btn-primary">Fecha Entrega</div>
                <div class="col-sm-1 btn btn-primary">Cliente</div>
                <div class="col-sm-1 btn btn-primary">Descripcion Trabajo</div>
                <div class="col-sm btn btn-primary">Codigo Obra</div>
                <div class="col-sm btn btn-secondary">Diseño</div>
                <div class="col-sm btn btn-secondary">Corte</div>
                <div class="col-sm btn btn-secondary">MANIPULACION</div>
                <div class="col-sm btn btn-secondary">IMPRESION</div>
                <div class="col-sm btn btn-green-300">FABRICACION</div>
                <div class="col-sm btn btn-green-300">FRESA</div>
                <div class="col-sm btn btn-green-300">LASER</div>
                <div class="col-sm btn btn-green-300">PINTURA</div>
                <div class="col-sm btn btn-primary">EMBALAJE</div>
                <div class="col-sm btn btn-primary">ENVIO</div>
                <div class="col-sm btn btn-primary">MONTAJE</div>
              </div>
              <div
                class="row border border-primary p-2"
                v-for="presupuesto in arrayPresupuesto"
                :key="presupuesto.id"
              >
                <div class="col-sm">
                  <button
                    type="button"
                    @click="verPresupuesto(presupuesto.id)"
                    class="btn btn-success btn-sm"
                  >
                    <i class="icon-eye"></i>
                  </button>
                </div>
                <div
                  class="col-sm"
                  style="font-weight: bold"
                  v-text="presupuesto.id"
                ></div>
                <div
                  class="col-sm"
                  v-text="presupuesto.fecha_presupuesto"
                ></div>
                <div class="col-sm" v-text="presupuesto.fecha_entrega"></div>
                <div
                  class="col-sm-1"
                  style="font-weight: bold"
                  v-text="presupuesto.cliente_descripcion"
                ></div>
                <div
                  class="col-sm-1"
                  v-text="presupuesto.trabajo_descripcion"
                ></div>
                <div
                  class="col-sm btn btn-primary"
                  v-text="presupuesto.codigo_obra"
                  @click="ponerCodigoObra(presupuesto.id)"
                ></div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                 
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasCorte(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasImpresion(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>

                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      v-text="hora.name + '[' + hora.horas / 60 + ']'"
                      style="font-weight: bold"
                    ></div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <div
                    class="row justify-content-md-center border-end border-secondary"
                    v-for="hora in filtroArrayHorasDiseno(
                      presupuesto.codigo_obra
                    )"
                    :key="hora.id"
                  >
                    <div
                      class="btn btn-info text-uppercase"
                      style="font-weight: bold"
                    >
                      <div
                        class="text-uppercase w-full"
                        v-text="hora.name"
                        style="font-weight: bold"
                      ></div>
                      <div
                        class="text-uppercase w-full"
                        v-text="'[' + hora.horas / 60 + ']'"
                        style="font-weight: bold"
                      ></div>
                    </div>
                  </div>
                </div>

              </div>
            </div> -->

            <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPagina(
                        pagination.current_page - 1,
                        buscar,
                        criterio
                      )
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
                      cambiarPagina(
                        pagination.current_page + 1,
                        buscar,
                        criterio
                      )
                    "
                    >Sig</a
                  >
                </li>
              </ul>
            </nav>
          </div>
        </template>
        <!--Fin Listado-->
        <!-- DATOS DEL PRESUPUESTO-->
        <template v-else-if="listado == 0">
          <div class="card-body">
            <div class="box-header">
              <!--  <button type="button" @click="mostrarDetalle()" class="btn btn-success btn-sm pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Nuevo Presupuesto
              </button>-->
              <!-- <a class="btn btn-success btn-sm pull-right" href="/admin/budget_generator/create?budget_id=18"><i class="fa fa-plus-square" aria-hidden="true"></i> Nuevo Presupuesto</a> -->
            </div>

            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="budget-tab active">
                <a
                  href="#budget18"
                  aria-controls="budget18"
                  role="tab"
                  data-toggle="tab"
                  style="float: left; position: relative !important"
                  aria-expanded="true"
                >
                  <b>{{ cabeceraEdita.updated_at }}</b>
                </a>
                <div class="btn-group pull-right" style="padding: 8px">
                  <h3>Presupuesto Nº : {{ cabecera.id }}</h3>
                  <!--   <a
                    class="btn btn-tab btn-primary btn-sm"
                    data-href="/process/clone_budget_file/budget_tab/18"
                    data-toggle="tooltip"
                    data-placement="top"
                    onclick="return confirm('¿Estás seguro que quieres duplicar este Parte?');"
                    data-original-title="Duplicar Parte"
                  >
                    <i class="fa fa-clone" aria-hidden="true"></i>
                  </a>
                  <a
                    class="btn btn-tab btn-warning btn-sm"
                    data-href="/admin/budget_generator/18/edit"
                    data-toggle="tooltip"
                    data-placement="top"
                    data-original-title="Editar"
                  >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a> -->
                </div>
              </li>
            </ul>

            <ul class="nav nav-tabs nav-justified">
              <li class="nav-item">
                <a
                  class="nav-link"
                  @click.prevent="setActive('administracion')"
                  :class="{ active: isActive('administracion') }"
                  href="#administracion"
                  >Administración</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  @click.prevent="setActive('destino')"
                  :class="{ active: isActive('destino') }"
                  href="#destino"
                  >Destino</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  @click.prevent="setActive('fabricacion')"
                  :class="{ active: isActive('fabricacion') }"
                  href="#fabricacion"
                  >Datos Fabricación
                  <i
                    class="fa fa-clone"
                    v-if="presupuestoDocumentosLista.length > 0"
                  ></i>
                  <span
                    v-if="presupuestoDocumentosLista.length > 0"
                    class="badge badge-pill badge-danger"
                    >{{ presupuestoDocumentosLista.length }}</span
                  >

                  <i
                    class="icon-camera"
                    v-if="presupuestoImagenesLista.length > 0"
                  ></i>
                  <span
                    v-if="presupuestoImagenesLista.length > 0"
                    class="badge badge-pill badge-danger"
                    >{{ presupuestoImagenesLista.length }}</span
                  >
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  @click.prevent="setActive('presupuesto')"
                  :class="{ active: isActive('presupuesto') }"
                  href="#presupuesto"
                  >Presupuesto</a
                >
              </li>
            </ul>
            <div class="tab-content py-3" id="myTabContent">
              <!-- ADMINISTRACION -->
              <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('administracion') }"
                id="administracion"
              >
                Datos del presupuesto .
                <div class="form-group row border">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Fecha Presupuesto</label>
                      <input
                        type="date"
                        class="form-control"
                        v-model="cabecera.fecha_presupuesto"
                        placeholder="000xx"
                      />
                    </div>
                  </div>

                  <div class="col-md-8">
                    <label for>Contacto</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="cabecera.contacto"
                    />
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for>Descricpcion del Trabajo(*)</label>

                      <input
                        type="text"
                        class="form-control"
                        v-model="cabecera.trabajo_descripcion"
                      />
                    </div>
                  </div>

                  <div
                    class="form-group row border"
                    style="margin: 10px; padding: 30px"
                  >
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for>Cliente(*)</label>
                        <button
                          class="btn btn-success"
                          type="submit"
                          @click="buscarCliente()"
                        >
                          <i class="fa fa-list" aria-hidden="true"></i>
                          Buscar Cliente
                        </button>

                        <!--   <button
                type="button"
                @click="abrirModalArticulo('articulo', 'buscar')"
                class="btn btn-sm btn-primary"
              >
                <i class="icon-plus"></i>&nbsp;Buscar Artículo
              </button> -->

                        <!-- <v-select
                                        :on-search="selectCliente"
                                        label="nombre"
                                        :options="arrayCliente"
                                        placeholder="Buscar Clientes..."
                                        :onChange="getDatosCliente"                                        
                                    >

                      </v-select> -->
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.cliente_descripcion"
                          placeholder="Nombre Comercial"
                        />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>DNI</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.dni"
                          placeholder="CIF, DNI"
                        />
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Nombre Fiscal</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.nombre_fiscal"
                          placeholder="Nombre Fiscal del Cliente"
                        />
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Dirección</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.direccion"
                          placeholder="Calle, numero "
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>C.P.</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="cabecera.codigo_postal"
                          placeholder="Código Postal "
                        />
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Población</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.poblacion"
                          placeholder="Población "
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Provincia</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.provincia"
                          placeholder="Provincia "
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="cabecera.telefono"
                          placeholder="Telefono "
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Movil</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="cabecera.movil"
                          placeholder="Movil "
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="cabecera.email"
                          placeholder="email "
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Estado</label>
                      <select class="form-control" v-model="cabecera.estado">
                        <option value="PENDIENTE DE CALCULO">
                          PENDIENTE DE CALCULO
                        </option>
                        <option selected value="PRESUPUESTADO">
                          PRESUPUESTADO
                        </option>
                        <option value="PRESUPUESTADO Y ENVIADO">
                          PRESUPUESTADO Y ENVIADO
                        </option>
                        <option value="ACEPTADO">ACEPTADO</option>
                        <option value="DENEGADO">DENEGADO</option>
                        <option value="FINALIZADO">FINALIZADO</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Referencia</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="cabecera.referencia"
                        placeholder="Referencia presupuesto"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Fecha Entrega</label>
                      <input
                        type="date"
                        class="form-control"
                        v-model="cabecera.fecha_entrega"
                        placeholder="Fecha Entrega"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Forma de Pago</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="cabecera.forma_pago"
                        placeholder="Forma de Pago"
                      />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div v-show="errorVenta" class="form-group row div-error">
                      <div class="text-center text-error">
                        <div
                          v-for="error in errorMostrarMsjVenta"
                          :key="error"
                          v-text="error"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- DESTINO -->
              <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('destino') }"
                id="destino"
              >
                Destino del presupuesto
                <div class="form-group row border">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for>Fecha de Envio</label>

                      <input
                        type="date"
                        class="form-control"
                        v-model="cabecera.fecha_envio"
                      />
                    </div>
                  </div>
                  <div class="col-md-9">
                    <label for>Direccion de envio(*)</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="cabecera.direccion_envio"
                    />
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Opción Envío</label>
                      <select
                        class="form-control"
                        v-model="cabecera.opcion_envio"
                      >
                        <option value="0">Seleccione</option>
                        <option value="entrega">Entrega Al Cliente</option>
                        <option value="montaje">Montaje</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Tipo de Envío</label>
                      <select
                        class="form-control"
                        v-model="cabecera.tipo_envio"
                      >
                        <option value="0">Seleccione</option>
                        <option value="entrega">Nuestros Medios</option>
                        <option value="montaje">Mensajero</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Contacto Envío</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="cabecera.contacto_envio"
                        placeholder="Contacto"
                      />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div v-show="errorVenta" class="form-group row div-error">
                      <div class="text-center text-error">
                        <div
                          v-for="error in errorMostrarMsjVenta"
                          :key="error"
                          v-text="error"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- FABRICACION -->
              <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('fabricacion') }"
                id="fabricacion"
              >
                Datos Fabricación

                <div class="form-group row border">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for>DOCUMENTOS</label>

                      <fotos-subir
                        v-if="cargado"
                        :presupuestoImagenesLista="
                          this.presupuestoImagenesLista
                        "
                        :presupuestoDocumentosLista="
                          this.presupuestoDocumentosLista
                        "
                        :tipo="'FICHERO'"
                        :dropzoneOptions="dropzoneOptionsFichero"
                      >
                      </fotos-subir>

                      <!--   <foto-lista-presupuesto
                      :listaDocumentos="presupuestoDocumentosLista"
                    ></foto-lista-presupuesto>

 -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for>IMAGENES</label>

                    <fotos-subir
                      v-if="cargado"
                      :presupuestoImagenesLista="this.presupuestoImagenesLista"
                      :presupuestoDocumentosLista="
                        this.presupuestoDocumentosLista
                      "
                      :tipo="'IMAGEN'"
                      :dropzoneOptions="dropzoneOptionsImagen"
                      @finalizar="finalizarFotosSubir"
                    >
                    </fotos-subir>

                    <!-- <foto-lista-presupuesto
                      :listaDocumentos="presupuestoImagenesLista"
                    ></foto-lista-presupuesto> -->
                    <button
                      type="button"
                      data-toggle="modal"
                      data-target="#modalCarousel"
                      @click="abrirCarousel()"
                      class="btn btn-sm btn-primary col-md-6"
                    >
                      <i class="icon-plus"></i>&nbsp;Ver Fotos :
                    </button>
                  </div>

                  <carousel
                    v-if="mostrarCarousel"
                    :images="this.images"
                    :presupuestoDocumentosLista="
                      this.presupuestoDocumentosLista
                    "
                  >
                  </carousel>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label
                      style="color: green"
                      class="control-label"
                      for="descripcion"
                      >COMENTARIOS INSTALACION :
                    </label>
                    <textarea
                      type="text"
                      v-model="cabecera.observaciones"
                      id="observaciones"
                      name="observaciones"
                      class="rm-height form-control"
                      rows="10"
                    ></textarea>
                  </div>
                </div>
              </div>
              <!-- DATOS DEL PRESUPUESTO -->

              <div
                class="tab-pane fade"
                :class="{ 'active show': isActive('presupuesto') }"
                id="presupuesto"
              >
                Datos del presupuesto
                <div class="table-responsive">
                  <div style="padding: 15px; display: block; min-height: 65px">
                    <button
                      type="button"
                      data-toggle="modal"
                      data-target="#modalAltaArticuloComponente"
                      @click="abrirModalArticulo('articulo', 'registrar')"
                      class="btn btn-sm btn-primary"
                    >
                      <i class="icon-plus"></i>&nbsp;Nuevo Artículo
                    </button>
                    <button
                      type="button"
                      data-toggle="modal"
                      data-target="#modalAltaArticuloComponente"
                      @click="abrirModalProdcutoTarifa()"
                      class="btn btn-sm btn-primary"
                    >
                      <i class="icon-search"></i>&nbsp;Producto Tarifa Buscar
                    </button>
                  </div>

                  <table
                    id="table-fixed-last-column17"
                    class="table table-bordered table-striped2 table-sm"
                  >
                    <thead>
                      <tr style>
                        <th class="bg-grey" style="min-width: 50px">REF</th>
                        <!--  <th class="bg-grey">Lam</th>
                        <th class="bg-grey">Trans</th>-->
                        <!--   <th class="bg-grey text-right">
                          m
                          <sup>2</sup>
                        </th>-->
                        <th class="bg-grey text-right">Ancho</th>
                        <th class="bg-grey text-right">Alto</th>
                        <!--  <th class="bg-grey text-right">Paños</th> -->

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
                        <!--                         <th class="bg-grey text-right">Gastos</th>
                        <th class="bg-grey text-right">Mont.</th>
                        <th class="bg-grey text-right">Subcont.</th>
 -->

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
                      <tr style>
                        <td
                          class="product-name"
                          colspan="4"
                          style="background-color: #f4f4f4"
                        >
                          <!--  <button type="button" @click="abrirModalComponente('componente','registrar',articulo)" class="
                     btn btn-sm btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo Componente
                          </button>-->

                          <b
                            style="
                              white-space: pre-wrap;
                              word-wrap: break-word;
                              font-family: inherit;
                            "
                            >{{ articulo.descripcion }}</b
                          >
                          <!-- <textarea><b>{{articulo.descripcion }}</b></textarea> -->
                        </td>

                        <td
                          class="text-right bg-highlighted"
                          style="background-color: #f4f4f4"
                        >
                          <b>{{ articulo.bultos }}</b>
                        </td>

                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          <p>{{ articulo.cantidad }}</p>
                        </td>
                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          <p>{{ articulo.tipounidad }}</p>
                        </td>
                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          <p>{{ articulo.precio }}</p>
                        </td>
                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          {{ articulo.mermas }}
                        </td>
                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          {{ articulo.costes }}
                        </td>

                        <!-- 

                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          {{ articulo.gastos }}
                        </td>

                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          {{ articulo.montaje }}
                        </td>

                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          {{ articulo.subcontratado }}
                        </td>

 -->
                        <!--   <td
                          class="text-right bg-highlighted"
                          style="background-color: #f4f4f4"
                        >
                          <b>{{ articulo.costes }} €</b>
                        </td>
                         -->
                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
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

                        <td
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
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

                            <button
                              type="button"
                              @click="tarifaProductoCrear(articulo)"
                              class="btn btn-sm btn-warning delete_link"
                              title="Crear Producto Tarifa"
                            >
                              <i class="fa fa-tint" aria-hidden="true"></i>
                            </button>

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

                            <button
                              type="button"
                              @click="duplicarArticulo(articulo)"
                              class="btn btn-sm btn-warning delete_link"
                              title="Duplicar Articulo y Componentes"
                            >
                              <i class="fa fa-clone" aria-hidden="true"></i>
                            </button>
                            <button
                              v-if="articulo.activado"
                              type="button"
                              @click="desactivarArticulo(articulo, idx)"
                              class="btn btn-sm btn-success"
                              title="Desactivar Articulo : NO suma total , no imprime pdf "
                            >
                              <i class="fa fa-remove" aria-hidden="true"></i>
                            </button>
                            <button
                              v-else
                              type="button"
                              @click="desactivarArticulo(articulo, idx)"
                              class="btn btn-sm btn-danger"
                              title="Activar Articulo : SI suma total , SI imprime pdf "
                            >
                              <i class="fa fa-remove" aria-hidden="true"></i>
                            </button>

                            <!-- <a
                              href="/process/remove_budget_file_product/31"
                              class="btn btn-sm btn-danger delete_link"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Eliminar Producto"
                              onclick="return confirm('¿Estás seguro que quieres borrar este producto?');"
                            >
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>-->
                          </div>
                        </td>
                      </tr>

                      <tr
                        v-for="(componente, index) in filteredRows1(articulo)"
                        :key="index"
                      >
                        <td>{{ componente.descripcion }}</td>
                        <!-- -{{componente.articulo}}-{{componente.articulo_principal}} -->
                        <!--   <td>BRILLO</td>
                        <td>NO</td>-->
                        <!--  <td class="text-right">0,00</td> -->
                        <td class="text-right">{{ componente.ancho }}</td>
                        <td class="text-right">{{ componente.longitud }}</td>
                        <!--  <td class="text-right">---</td> -->
                        <td
                          class="text-right bg-highlighted"
                          data-toggle="tooltip"
                          data-placement="top"
                          title
                          data-original-title="M2 corte"
                        >
                          {{ componente.m2 }}
                        </td>

                        <td class="text-right">{{ componente.bultos }}</td>
                        <td class="text-right">{{ componente.cantidad }}</td>
                        <td class="text-right">{{ componente.tipounidad }}</td>
                        <!-- 1501 precio compra unidad , -->
                        <!--  <td class="text-right">{{ componente.precio * componente.cantidad }}<br>
                          {{ componente.precio}}x{{ componente.cantidad }}
                          </td> -->
                        <td class="text-right">{{ componente.precio }} €</td>
                        <!-- 1501  precio venta uniad-->
                        <!-- <td class="text-right">{{ componente.preciofinal* componente.bultos }}<br>
                          {{ componente.preciofinal }}x{{ componente.bultos }}</td>-->

                        <td class="text-right">{{ componente.mermas }}</td>

                        <td class="text-right">{{ componente.costes }}</td>

                        <!--      <td class="text-right bg-highlighted">
                          {{ componente.gastos }}
                        </td>

                        <td class="text-right bg-highlighted">
                          {{ componente.montaje }}
                        </td>
                        <td class="text-right bg-highlighted">
                          {{ componente.subcontratado }}
                        </td>
                    -->
                        <!--   <td class="text-right bg-highlighted">0,00 €</td> -->
                        <!-- <td class="text-right bg-highlighted">
                         1501 COSTES 
                          {{ componente.costes * componente.bultos }} €
                          <br>
                          {{ componente.costes}}x{{ componente.bultos }}
                        </td>-->
                        <td class="text-right bg-highlighted">
                          {{ componente.beneficios }} %
                        </td>
                        <td class="text-right">{{ componente.preciofinal }}</td>
                        <td class="text-right bg-highlighted">
                          {{ componente.base }} €
                        </td>
                        <td class="text-right bg-highlighted">
                          {{ componente.descuento }} %
                        </td>
                        <td class="text-right bg-highlighted">
                          {{ componente.importefinal }} €
                        </td>
                        <!-- 1501 
                        <td class="text-right bg-highlighted">
                          {{ componente.importefinal * componente.bultos }} €
                          <br>
                          {{ componente.importefinal}}x{{ componente.bultos }}
                        </td>-->

                        <td>
                          <div class="btn-group btn-budget-group pull-right">
                            <!-- <a
                              class="btn btn-sm btn-primary edit_link"
                              data-target="#modalEditRawMaterial-52"
                              data-toggle="modal"
                            >
                              <i
                                class="fa fa-pencil"
                                aria-hidden="true"
                                title="Editar Componente"
                                data-toggle="tooltip"
                                data-placement="top"
                              ></i>
                            </a>-->
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

                            <!--  <a
                              href="/process/remove_budget_file_product/31"
                              class="btn btn-sm btn-danger delete_link"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Eliminar Producto"
                              onclick="return confirm('¿Estás seguro que quieres borrar este producto?');"
                            >
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>-->

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
                            <button
                              type="button"
                              @click="duplicarComponente(componente)"
                              class="btn btn-sm btn-warning delete_link"
                              title="Duplicar   Componentes"
                            >
                              <i class="fa fa-clone" aria-hidden="true"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <!-- <tr style="">
                            <td>TRANSFER ALTA GAMA 1,22cmX100m. (5030001)</td>
                                    <td></td>
                                    <td>NO</td>
                                    <td class="text-right">0,00</td>
                                    <td class="text-right">---</td>
                                    <td class="text-right">---</td>
                                    <td class="text-right">---</td>
                                    <td class="text-right">1</td>
                                    <td class="text-right bg-highlighted" data-toggle="tooltip" data-placement="top" title="" data-original-title="M2">0,000</td>
                                    <td class="text-right bg-highlighted">0,00</td>
                                    <td class="text-right bg-highlighted">0,00</td>
                                    <td class="text-right bg-highlighted">33,33 %</td>
                                    <td class="text-right bg-highlighted">0,00 €</td>
                                    <td class="text-right bg-highlighted">0,00 €</td>
                                    <td>
                                        <div class="btn-group btn-budget-group pull-right">
                                            <a class="btn btn-sm btn-primary edit_link" data-target="#modalEditRawMaterial-53" data-toggle="modal">
                                                <i class="fa fa-pencil" aria-hidden="true" title="Editar Materia Prima" data-toggle="tooltip" data-placement="top"></i>
                                            </a>
                                        </div>
                                    </td>
                      </tr>-->
                      <div style="min-height: 15px"></div>
                    </tbody>

                    <div style="min-height: 15px"></div>

                    <tfoot>
                      <tr style>
                        <th
                          colspan="14"
                          class="text-right"
                          style="background-color: #f4f4f4"
                        >
                          TOTAL
                        </th>

                        <!--   <th class="text-right" style="background-color:#f4f4f4;">0,00</th>
                        <th class="text-right" style="background-color:#f4f4f4;"></th> 
                        <th class="text-right" style="background-color:#f4f4f4;"></th>-->
                        <!--   <th
                          class="text-right"
                          style="background-color: #f4f4f4"
                        ></th>
                        <th
                          class="text-right"
                          style="background-color: #f4f4f4"
                        ></th>
                        <th class="text-right bg-highlighted"></th>
                  -->
                        <!--       <th class="text-right bg-highlighted"></th>
                             <th class="text-right bg-highlighted"></th>

                        <th class="text-right bg-highlighted">
                          {{ cabecera.gastos }} €
                        </th>
                        <th class="text-right bg-highlighted">
                          {{ cabecera.montaje }} €
                        </th>
                        <th class="text-right bg-highlighted">
                          {{ cabecera.subcontratado }} €
                        </th>
                        
                        <th class="text-right bg-highlighted">
                          {{ cabecera.costes }} €
                        </th>

                           <th class="text-right bg-highlighted">
                          {{ cabecera.base }} €
                        </th>

                        <th class="text-right bg-highlighted">
                      

                        {{ Math.round(((calcularTotalPresupuesto - cabecera.costes)/cabecera.costes)*100,2) }}
                        </th>
                   -->
                        <th class="text-right bg-highlighted">
                          {{ calcularTotalPresupuesto }} €
                        </th>
                        <th>
                          <div class="btn-group btn-budget-group pull-right">
                            <button
                              v-if="muestraTotalPresupuesto"
                              type="button"
                              @click="muestraTotalPresupuesto = false"
                              class="btn btn-sm btn-success"
                              title="NO MOSTRAR TOTAL PRESUPUESTO"
                            >
                              <i class="fa fa-remove" aria-hidden="true"></i>
                            </button>
                            <button
                              v-else
                              type="button"
                              @click="muestraTotalPresupuesto = true"
                              class="btn btn-sm btn-danger"
                              title="SI MOSTRAR TOTAL PRESUPUESTO"
                            >
                              <i class="fa fa-remove" aria-hidden="true"></i>
                            </button>

                            <!-- 1801 <button
                              type="button"
                              data-toggle="modal"
                              data-target="#modalEditarTotatles"
                              @click="
                                abrirModalEditarTotales('totales', 'editar')
                              "
                              class="btn btn-sm btn-primary"
                              title="Editar Totales"
                            >
                              <i class="fa fa-pencil"></i>
                              Editar Totales
                            </button> -->
                          </div>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>

                <!--  COMENTARIOS INSTALACION -->
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label
                      style="color: green"
                      class="control-label"
                      for="descripcion"
                      >COMENTARIOS INSTALACION :
                    </label>
                    <textarea
                      type="text"
                      v-model="cabecera.observaciones"
                      id="observaciones"
                      name="observaciones"
                      class="rm-height form-control"
                      rows="3"
                    ></textarea>
                  </div>
                </div>
              </div>
              <!--              FOOTER PRESUPUESTO -->
              <div>
                <div v-show="errorPresupuesto" class="form-group row div-error">
                  <div class="text-center text-error">
                    <div
                      v-for="error in erroresPresupuesto"
                      :key="error"
                      v-text="error"
                    ></div>
                  </div>
                </div>
                <button
                  v-if="cabecera.id"
                  class="btn btn-success"
                  type="submit"
                  name="guardarPresupuesto"
                  @click="guardarPresupuesto()"
                >
                  <i class="fa fa-save" aria-hidden="true"></i> Actualizar
                  Presupuesto
                </button>
                <button
                  v-else
                  class="btn btn-success"
                  type="submit"
                  name="guardarPresupuesto"
                  @click="guardarPresupuesto()"
                >
                  <i class="fa fa-save" aria-hidden="true"></i> Guardar
                  Presupuesto
                </button>

                <button
                  v-if="cabecera.id"
                  class="btn btn-success"
                  type="submit"
                  @click="guardarPresupuesto(1)"
                >
                  >
                  <i class="fa fa-save"></i>
                  <i class="fa fa-list" aria-hidden="true"></i> Actualizar y
                  regresar al listado
                </button>

                <button
                  v-else
                  class="btn btn-success"
                  type="submit"
                  @click="guardarPresupuesto(1)"
                >
                  >
                  <i class="fa fa-save"></i>
                  <i class="fa fa-list" aria-hidden="true"></i> Guardar y
                  regresar al listado
                </button>
                <a
                  class="btn btn-info"
                  @click="aceptarComoPresupuestado(cabecera.id)"
                >
                  <i class="fa fa-check" aria-hidden="true"></i> Aceptar como
                  Presupuestado
                </a>

                <button
                  class="btn btn-warning"
                  type="submit"
                  @click="presupuestoPdf(cabecera.id)"
                >
                  <i class="fa fa-save" aria-hidden="true"></i> PDF
                </button>
                <button
                  class="btn btn-warning"
                  type="submit"
                  @click="presupuestoPdfFabricacion(cabecera.id)"
                >
                  <i class="fa fa-save" aria-hidden="true"></i> PDF PRUEBA
                </button>
              </div>
            </div>
          </div>
        </template>
        <!-- Fin Detalle-->
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
              data-dismiss="modal"
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
                data-toggle="modal"
                data-target="#modalBuscarrArticulo"
                @click="abrirModalArticulo('articulo', 'buscar')"
                class="btn btn-sm btn-primary"
              >
                <i class="icon-plus"></i>&nbsp;Buscar Artículo :
              </button>

              <!--  <div class="col-md-6 col-sm-4">
                        <div class="form-group"><label class="control-label" for="anchura">Código</label> <input type="text" v-model="articulo.articulo" id="articulo" name="articulo" class="rm-width form-control" >  </div> 
              </div>-->
              <div class="col-md-12 col-sm-12">
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
                    id="precioU"
                    name="precioU"
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

    <!--Fin del modal-->

    <!-- MODAL PONER FECHA ENTREGA
 -->
    <!--   <div
      class="modal fade"
      id="modalFechaEntrega"
      tabindex="-1"
      :class="{ mostrar: modalFechaEntrega }"
      :draggable="true"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >Fecha de Entrega</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModalFechaEntrega()"
              aria-label="Close"
            >
              <span aria-hidden="true">X</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  
                  <input
                        type="date"
                        class="form-control"
                        style="witdh: 10px;"
                        v-model="presupuesto.fecha_entrega"
                        placeholder="Fecha Entrega"
                      />

                  <button
                    type="submit"
                    
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="cerrarModalFechaEntrega()"
            >
              Cerrar
            </button>
          </div>
         
        </div>
      </div>
    </div>
 -->

    <!-- BUSCAR CLIENTE -->

    <div
      class="modal fade"
      id="modalBuscarCliente"
      tabindex="-1"
      :class="{ mostrar: modalBuscarCliente }"
      :draggable="true"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModalCLiente"></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModalBuscarCliente()"
              aria-label="Close"
            >
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterioCli">
                    <option value="empresa">Nombre Comercial</option>
                    <option value="descripcion">Nombre Fiscal</option>
                    <option value="poblacion">Poblacion</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscarCli"
                    @keyup.enter="listarCliente(buscarCli, criterioCli)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />

                  <button
                    type="submit"
                    @click="listarCliente(buscarCli, criterioCli)"
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
                    <th>Nombre Fiscal</th>
                    <th>Provincia</th>
                    <th>Contacto</th>
                    <th>Email</th>

                    <th>Teléfono</th>
                    <th>Móvil</th>
                    <!--    <th>Ancho</th>
                    <th>Longitud</th>
                    <th>m2</th>
                    <th>Notas</th>
                    <th>Fecha</th> -->
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="cliente in clientesVnt" :key="cliente.codigo">
                    <td>
                      <button
                        type="button"
                        @click="agregarClienteModal(cliente)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                    </td>

                    <td v-text="cliente.EMPRESA"></td>
                    <td v-text="cliente.NOM_FISCAL"></td>
                    <td v-text="cliente.PROVINCIA"></td>
                    <td v-text="cliente.CONTACTO"></td>
                    <td v-text="cliente.EMAIL"></td>
                    <td v-text="cliente.TELEFONO"></td>
                    <td v-text="cliente.MOVIL"></td>
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
              @click="cerrarModalBuscarCliente()"
            >
              Cerrar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- BUSCAR PRODUCTOS  quitar-->

    <div
      class="modal fade"
      id="modalBuscarrArticulo"
      tabindex="-2"
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
                    <option value="nombre">Nombre</option>
                    <option value="descripcion">Descripción</option>
                    <option value="codigo">Código</option>
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
            <!--  <button
              type="button"
              v-if="tipoAccion == 1"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="registrarPersona()"
            >
              Guardar
            </button>
            <button
              type="button"
              v-if="tipoAccion == 2"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="actualizarPersona()"
            >
              Actualizar
            </button> -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- BUSCAR PRODUCTO TARIFA -->

    <div
      class="modal fade"
      id="modalBuscarrProductoTarifa"
      tabindex="-3"
      :class="{ mostrar: modalBuscarProductoTarifa }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModalPT"></h4>
            <!-- 09122020 -->
            <button
              type="button"
              class="close"
              data-toggle="modal"
              data-target="#modalBuscarrProductoTarifa"
              @click="cerrarModalProdcutoTarifa()"
              aria-label="Close"
            >
              <span aria-hidden="true">X</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-12">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterioPT">
                    <option value="descripcion">Descripcion</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscarPT"
                    @keyup.enter="
                      listarProtductoTerminado(buscarPT, criterioPT)
                    "
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarProtductoTerminado(buscarPT, criterioPT)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar Producto Terminado
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Referencia</th>
                    <th>Articulo</th>
                    <th>Denominacion</th>
                    <th>Precio</th>
                    <th>Unidad</th>
                    <th>Importe</th>

                    <th>Longitud</th>
                    <th>m2</th>
                    <th>Notas</th>
                    <th>Fecha</th>
                  </tr>
                </thead>

                <tbody>
                  <tr
                    v-for="articulo in arrayTarifaProductos"
                    :key="articulo.articulo"
                  >
                    <td>
                      <!-- 19122020 -->
                      <button
                        data-dismiss="modal"
                        type="button"
                        @click="agregarProductoTerminado(articulo)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-check"></i>
                      </button>
                      <!--   <button
                        type="button"
                        @click="verComponentesPT(articulo)"
                        class="btn btn-warning btn-sm"
                      >
                        <i class="icon-plus"></i>
                      </button> -->
                    </td>
                    <td v-text="articulo['referencia']"></td>
                    <td v-text="articulo['id']"></td>
                    <td v-text="articulo['descripcion']"></td>
                    <td v-text="articulo['precio']"></td>
                    <td v-text="articulo['cantidad']"></td>
                    <td v-text="articulo['cantidad']"></td>
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
            <button
              type="button"
              data-dismiss="modal"
              v-if="tipoAccion == 1"
              class="btn btn-primary"
              @click="registrarPersona()"
            >
              Guardar
            </button>
            <button
              type="button"
              data-dismiss="modal"
              v-if="tipoAccion == 2"
              class="btn btn-primary"
              @click="actualizarPersona()"
            >
              Actualizar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!--Inicio del modal EDITAR TOTALES -->
    <div
      class="modal fade"
      id="modalEditarTotales"
      tabindex="-1"
      :class="{ mostrar: modaleditartotales }"
      :dragable="true"
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
            <h4 class="modal-title" v-text="tituloModalEditarTotales"></h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="cerrarModalEditarTotales()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label" for="gastos">Suma Totales</label>
                <input
                  type="number"
                  v-model.number="cabecera.sumatotales"
                  id="sumatotales"
                  name="sumatotales"
                  class="form-control"
                  readonly
                />
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="gastos">Gastos</label>
                  <input
                    type="number"
                    v-model.number="cabeceraEdita.gastos"
                    id="gastos"
                    name="gastos"
                    class="form-control"
                    v-on:change="editarTotalPresupuesto"
                  />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="montaje">Montaje</label>
                  <input
                    type="number"
                    v-model.number="cabeceraEdita.montaje"
                    id="montaje"
                    name="montaje"
                    class="form-control"
                    v-on:change="editarTotalPresupuesto"
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
                    v-model.number="cabeceraEdita.subcontratado"
                    name="subcontratacion"
                    class="form-control"
                    v-on:change="editarTotalPresupuesto"
                  />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="beneficios"
                    >%Beneficio</label
                  >
                  <input
                    type="number"
                    v-model.number="cabeceraEdita.beneficios"
                    id="beneficios"
                    name="beneficios"
                    class="form-control"
                    v-on:change="editarTotalPresupuesto"
                  />
                </div>
                {{ cabeceraEdita.beneficios }}
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label" for="pvp">Total</label>

                  <input
                    type="number"
                    id="total"
                    v-on:change="recalcularBeneficioEditar"
                    v-model="cabeceraEdita.importefinal"
                    name="total"
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
            <!--  <div class="col-sm-6 col-sm-12 no-width-info-content" style="display: block;">
                        <p><i class="fa fa-info-circle"></i> La materia prima no tiene ancho definido, por favor trabaje con m<sup>2</sup></p>
            </div>-->
          </div>

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="cerrarModalEditarTotales()"
            >
              Cerrar
            </button>

            <button
              type="button"
              data-toggle="modal"
              data-target="#modalActualizarEditarTotales"
              class="btn btn-primary"
              @click="actualizarModalEditarTotales()"
            >
              Actualizar Totales
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!--Fin del modal-->
  </main>
</template>

<script>
import moment from "moment";

import ArticuloComponente from "./modal/ArticuloComponente.vue";

import FotosSubir from "./fotos/FotosSubir.vue";

export default {
  props: {},

  components: {
    ArticuloComponente: ArticuloComponente,
    FotosSubir: FotosSubir,
  },

  data() {
    return {
       windowHeight:'',
      //cerrarModalBuscar(),
      //listarArticulo
      fechaHoy: "",
      muestraTotalPresupuesto: true,
      images: [],
      envioImagenes: [],
      cargado: false,
      mostrarCarousel: false,

      presupuestoImagenesLista: [],
      cuantasImagenes: 0,
      cuantosDocumentos: 0,
      presupuestoDocumentosLista: [],

      modelo: "",
      accion: "",
      data: {},
      idx: "",

      modalBuscarCliente: 0,
      tituloModalCLiente: "",
      criterioCli: "empresa",
      buscarCli: "",
      clientesVnt: [],

      modalBuscar: 0,
      modalBuscarArticulo: 0,
      tituloModalBuscar: "",

      modalBuscarProductoTarifa: 0,

      base: 0,
      bene: 0,

      // calcularTotalPvpComponente : '',
      sinRevisar: "**Sin Revisar",
      arrayPresupuesto: [],
      arrayHoras: [],
      presupuestoId: "",

      errorPresupuesto: "",
      erroresPresupuesto: [],

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
      coPrecio: "",
      coMontaje: "",

      coGastos: "",
      coCostes: "",

      coSubcontratacion: "",
      coBeneficios: "",
      coPvp: "",
      coCodigoPrincipal: "",

      cabecera: {
        estado: "ACEPTADO",
        observaciones: "uno",
      },
      cabeceraEdita: [],
      activeItem: "administracion",
      articulo: [],
      importefinal: 0,
      anchura: 0,
      articulos: [],
      /* articulos: [
        {
          codigo: "0005",
          descripcion: "DESCRIPCION ARTICULO",
          cantidad: "1",
          precio: "50",
          total: 50,
          observaciones: "observaciones"
        },
        {
          codigo: "0001",
          descripcion: "DESCRIPCION ARTICULO",
          cantidad: "1",
          precio: "10",
          total: 10,
          observaciones: "observaciones"
        },
        {
          codigo: "0002",
          descripcion: "DESCRIPCION ARTICULO2",
          cantidad: "2",
          precio: "20",
          total: 22,
          observaciones: "observaciones2"
        }
      ], */
      componentes: [],
      /* componentes: [
        {
          articulo_principal: "0005",
          codigo: "10029",
          descripcion: "DESCRIPCION ARTICULO",
          metros: "1",
          anchura: "10",
          altura: "12112",
          unidades: "1",
          montaje: "1023",
          subcontratacion: "12112",
          beneficios: "1",
          pvp: 100,
          horas: "12112",
          observaciones: "observaciones"
        },
        {
          articulo_principal: "0001",
          codigo: "10029",
          descripcion: "DESCRIPCION ARTICULO",
          metros: "1",
          anchura: "1023",
          altura: "12112",
          unidades: "1",
          montaje: "1023",
          subcontratacion: "12112",
          beneficios: "1",
          pvp: 300,
          horas: "12112",
          observaciones: "observaciones"
        },
        {
          articulo_principal: "0001",
          codigo: "1002922",
          descripcion: "DESCRIPCION ARTICULO22",
          metros: "12",
          anchura: "10232",
          altura: "1211222",
          unidades: "12",
          montaje: "10232",
          subcontratacion: "121122",
          beneficios: "12",
          pvp: 200,
          horas: "121122",
          observaciones: "observaciones2"
        },
        {
          articulo_principal: "0002",
          codigo: "1002923",
          descripcion: "DESCRIPCION ARTICULO223",
          metros: "33",
          anchura: "333",
          altura: "33",
          unidades: "3",
          montaje: "33",
          subcontratacion: "333",
          beneficios: "3",
          pvp: 300,
          horas: "333",
          observaciones: "observaciones2"
        },
        {
          articulo_principal: "0002",
          codigo: "44444",
          descripcion: "DESCRIPCION ARTICULO224",
          metros: "124",
          anchura: "4",
          altura: "44",
          unidades: "444",
          montaje: "444",
          subcontratacion: "444",
          beneficios: "44",
          pvp: 400,
          horas: "444",
          observaciones: "observaciones2"
        }
      ],
 */
      //
      venta_id: 0,
      idcliente: 0,
      cliente: "",
      fecha_hora: "",

      tipo_comprobante: "BOLETA",
      serie_comprobante: "",
      num_comprobante: "",
      impuesto: 0.18,
      importefinal: 0.0,
      totalImpuesto: 0.0,
      totalParcial: 0.0,
      arrayVenta: [],
      arrayCliente: [],
      arrayDetalle: [],
      listado: 1,
      modal: 0,
      modalarticulo: 0,
      modalcomponente: 0,
      modaleditartotales: 0,
      tituloModal: "",
      tituloModalPT: "",
      tituloModalArticulo: "",
      tituloModalComponente: "",
      tituloModalEditarTotales: "",

      tipoAccion: 0,
      errorVenta: 0,
      errorMostrarMsjVenta: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "cliente_descripcion",
      buscar: "",
      criterioA: "nombre",
      buscarA: "", //q
      criterioPT: "descripcion",
      buscarPT: "",
      arrayTarifaProductos: [],
      arrayArticulo: [],
      arrayArticulosCompra: [], //q
      idarticulo: 0,
      articulo: "",
      articulo: "",
      precio: 0,
      cantidad: 0,
      descuento: 0,
      stock: 0,
      searchTerm: "0001",
      filter: "",

      dropzoneOptionsImagen: {
        /*  url: "{{ route('upload') }}", */
        url: "/altafotopresupuesto",
        addRemoveLinks: true,
        acceptedFiles: "image/*",
        duplicateCheck: true,

        timeout: 5000,
        maxFilesize: 52,
        /*   renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            }, */
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]")
            .content,
        },

        params: {
          id: "131",
          ruta: "/presupuestos/imagen/",
          tipo: "IMAGEN",
        },
      },
      dropzoneOptionsFichero: {
        url: "/altafichero",
        addRemoveLinks: true,
        duplicateCheck: true,
        timeout: 5000,
        maxFilesize: 52,
        // acceptedFiles: 'application/pdf,.psd,.doc,.docx,.xls,.xlsv',
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]")
            .content,
        },

        params: {
          id: "131",
          ruta: "/presupuestos/ficheros/",
          tipo: "FICHERO",
        },
      },
    };
  },

  filters: {
    fechaF: function (value) {
      //console.log('fecha-->',value);
      if (!value) return "";
      return moment(String(value)).format("DD/MM/YY");
    },

    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
    capitalize: function (value) {
      //this.searchTerm = value;
      console.log("capitalizce", value, value.toString());

      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
  },
  computed: {
    calcularPvp() {
      console.log("calcularPvp", this.importefinal, this.anchura);
      this.importefinal = this.anchura * this.anchura;
    },
    filteredRows() {
      //console.log('FILTER', this.searchTerm);
      return this.componentes.filter((componente) => {
        //  console.log("filter", this.componentes, componente.articulo_principal);
        const compo = componente.articulo_principal.toString().toLowerCase();

        return compo.includes(componente.articulo_principal);
      });
    },
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
    /* calcularTotal: function () {
      var resultado = 0.0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        resultado =
          resultado +
          (this.arrayDetalle[i].precio * this.arrayDetalle[i].cantidad -
            this.arrayDetalle[i].descuento);
      }
      resultado = resultado.toFixed(2);
      return resultado;
    }, */

    calcularTotalPresupuesto: function () {
      var resultado = 0.0;
      var costes = 0;
      console.log("CALCULARPRESUPUSTO 1111", this.articulos);

      for (var i = 0; i < this.articulos.length; i++) {
        console.log("CALCULARPRESUPUSTO 1111", this.articulos[i].activado == 1);

        if (this.articulos[i].activado == 1) {
          if (
            isNaN(this.articulos[i].costes) ||
            this.articulos[i].costes === undefined ||
            this.articulos[i].costes === null
          ) {
            console.log("CALCULARPRESUPUSTO 1111 IF", this.articulos);

            this.articulos[i].costes = 0.0;
          } else {
            console.log("CALCULARPRESUPUSTO 111  else", this.articulos);
          }

          costes = +costes + +this.articulos[i].costes;

          resultado = +resultado + +this.articulos[i].importefinal;

          resultado = +resultado.toFixed(2);
        }
        if (isNaN(resultado)) {
          swal({
            type: "error",
            title: "Error...",
            text: "Precio o cantidad no pueden ser caracteres",
          });

          resultado = 0.0;
        }

        this.cabecera.sumatotales = resultado;

        if (
          isNaN(this.cabecera.subcontratado) ||
          this.cabecera.subcontratado === undefined ||
          this.cabecera.subcontratado === null
        ) {
          this.cabecera.subcontratado = 0.0;
        }

        if (
          isNaN(this.cabecera.gastos) ||
          this.cabecera.gastos === undefined ||
          this.cabecera.gastos === null
        ) {
          this.cabecera.gastos = 0.0;
        }

        if (
          isNaN(this.cabecera.beneficios) ||
          this.cabecera.beneficios === undefined ||
          this.cabecera.beneficios === null
        ) {
          this.cabecera.beneficios = 0.0;
        }

        if (
          isNaN(this.cabecera.montaje) ||
          this.cabecera.montaje === undefined ||
          this.cabecera.montaje === null
        ) {
          this.cabecera.montaje = 0.0;
        }

        if (
          isNaN(this.cabecera.costes) ||
          this.cabecera.costes === undefined ||
          this.cabecera.costes === null
        ) {
          this.cabecera.costes = 0.0;
        }

        let baset = +(
          +this.cabecera.sumatotales +
          +this.cabecera.gastos +
          +this.cabecera.subcontratado +
          +this.cabecera.montaje
        ).toFixed(3);

        let benet = +((baset * this.cabecera.beneficios) / 100).toFixed(3);

        this.cabecera.importefinal = +(+baset + +benet).toFixed(2);
        this.cabecera.costes = +costes.toFixed(2);

        resultado = this.cabecera.importefinal;
        console.log("calcularTotalPresupuesto2", resultado, this.cabecera);
      }
      return resultado;
    },
  },

  methods: {
    verDatosHora: function (hora) {
      console.log("260521", hora);
    },
    fechaActual: function () {
      var f = new Date();
      var f2 = new Date().toLocaleString();

      f.getDate() + "/" + f.getMonth() + "/" + f.getFullYear();

      console.log("fechaActual", f);

      var currentDateWithFormat = new Date().toISOString().slice(0, 10);

      console.log("fechaActual 2", currentDateWithFormat);
      this.fechaHoy = currentDateWithFormat;
      console.log("fechaActual", this.fechaHoy, f2);
    },
    ponerCodigoObra(presupuesto) {
      swal({
        title: "Introduzca codigo de obra ",
        text: "Formato valido = 9999/9999",

        input: "text",
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
        inputValidator: (text) => {
          // Si el valor es válido, debes regresar undefined. Si no, una cadena
          if (!text || text.length < 9 || text.length > 9) {
            return "Por favor escribe un Codigo de Obra CORRECTO  1234/1234";
          } else {
            return undefined;
          }
        },
      }).then((result) => {
        if (result.value) {
          let me = this;

          console.log("ponerCodigoObra", result, presupuesto);
          let $url = "presupuesto/ponercodigoobra";

          axios
            .put($url, {
              presupuesto: presupuesto,
              obra: result.value,
            })
            .then(function (response) {
              /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */
              console.log(
                "ponerCodigoObra ",
                response,
                response.data,
                response.data.mensaje
              );
              let respuestaOk = response.data.mensajeOk;
              let respuesta = response.data.mensaje;
              me.listarPresupuesto(1, me.buscar, me.criterio);

              console.log("agregarProductoTerminado", response.data.mensaje);
              if (respuestaOk) {
                swal("Aviso", "Respuesta : " + respuestaOk, "success");
              } else {
                swal("Aviso", "Respuesta : " + respuesta, "error");
              }
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    cambiarFechaEntrega(presupuesto) {
      var a =
        '<input type="date" id="fechaE" class="form-control" style="witdh: 10px;" v-model="presupuesto.fecha_entrega" placeholder="Fecha Entrega"   />';
      swal({
        title: "Introduzca Fecha de entrega",
        html: a,

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
        inputValidator: (text) => {
          // Si el valor es válido, debes regresar undefined. Si no, una cadena
          let text1 = document.getElementById("fechaE").value;
          console.log(
            "fecha entrega ",
            document.getElementById("fechaE").value
          );

          if (!text1 || text1.length < 10 || text1.length > 10) {
            return "Fecha Incorrecta ";
          } else {
            return undefined;
          }
        },
      }).then((result) => {
        console.log("result", result, result.value);
        if (result.value) {
          let me = this;
          let text1 = document.getElementById("fechaE").value;
          if (!text1 || text1.length < 10 || text1.length > 10) {
            return "Fecha Incorrecta ";
          }
          console.log(
            "fecha entrega ",
            document.getElementById("fechaE").value
          );
          console.log("ponerCodigoObra", result, presupuesto.fecha_entrega);
          let $url = "presupuesto/ponerfechaentrega";

          axios
            .put($url, {
              presupuesto: presupuesto,
              fechaEntrega: text1,
            })
            .then(function (response) {
              /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */
              console.log(
                "ponerCodigoObra ",
                response,
                response.data,
                response.data.mensaje
              );
              let respuestaOk = response.data.mensajeOk;
              let respuesta = response.data.mensaje;
              me.listarPresupuesto(1, me.buscar, me.criterio);

              console.log("agregarProductoTerminado", response.data.mensaje);
              if (respuestaOk) {
                swal("Aviso", "Respuesta : " + respuestaOk, "success");
              } else {
                swal("Aviso", "Respuesta : " + respuesta, "error");
              }
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    /*  filteredRows1(a) {
      return this.componentes.filter((componente) => {
        
        const compo = componente.articulo_principal.toString().toLowerCase();
        const compo2 = componente.idpresupuestolinea.toString().toLowerCase();
       
        return compo2.includes(a.id);
      }); */

    filtroArrayHoras(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          //  console.log("filter", this.componentes, componente.articulo_principal);
          //   console.log('filtro obras2',arrayHora);

          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipo = "diseno";
          console.log("filtro obras3", hor);

          return hor.includes(obra);
        });
      }
    },

    filtroArrayHorasDiseno(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          //  console.log("filter", this.componentes, componente.articulo_principal);
          //   console.log('filtro obras2',arrayHora);

          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "diseno";
          //console.log('filtro obras3',hor);

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasCorte(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "corte";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },
    filtroArrayHorasManipulacion(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "manipulado";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasImpresion(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "impresion";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasFabricacion(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "fabricacion";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasFresa(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "fresadora";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasLaser(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "laser";
          //console.log("filtro obras 222222", hor, 'tipoA', tipoA, 'tipo', tipo, tipoA.includes(tipo));
          //console.log("filtro obras 222222", hor.includes(obra) && tipoA.includes(tipo),arrayHora.tipo_trabajo.toString().toLowerCase(),arrayHora.name.toString().toLowerCase(), arrayHora.horas.toString().toLowerCase());

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasPintura(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "pintura";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },
    filtroArrayHorasEmbalaje(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "embalaje";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },
    filtroArrayHorasEnvio(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "envio";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    filtroArrayHorasMontaje(obra) {
      if (obra) {
        console.log("filtro obras", obra, this.arrayHoras);
        return this.arrayHoras.filter((arrayHora) => {
          const hor = arrayHora.codigo.toString().toLowerCase();
          const tipoA = arrayHora.tipo_trabajo.toString().toLowerCase();
          const tipo = "montaje";

          return hor.includes(obra) && tipoA.includes(tipo);
        });
      }
    },

    finalizarFotosSubir(que) {
      console.log("2801 finalizargfotossubir ", que);
      this.presupuestoImagenesLista = que;
      this.presupuestoImagenesLista2 = que;
      this.mostrarCarousel = false;

      console.log(
        "2801 finalizargfotossubir ",
        que,
        this.presupuestoImagenesLista2
      );
    },
    recargarImage(img) {
      let me = this;
      console.log(
        "2801 2 - RECARGAR IMAGE 1 tamaño de array imagenes lista :",
        img,
        me.presupuestoImagenesLista.length,
        me.presupuestoImagenesLista,
        me.presupuestoImagenesLista2
      );

      me.images.length = img.length; /* [{
					src: "",
					caption: ""
				}, ]; */
      /*   var obj2 = new Object();
          obj2.sr="";
          obj2.caption="";
    
 me.images[0]=obj2 */ for (
        var i = 0;
        i < me.presupuestoImagenesLista.length;
        i++
      ) {
        /*me.image3[i].src=me.presupuestoImagenesLista[i].nombre;
    me.image3[i].caption=me.presupuestoImagenesLista[i].src; */

        var obj = new Object();
        //    obj.src = './storage/'+me.presupuestoImagenesLista[i].nombre;
        obj.src = me.presupuestoImagenesLista[i].nombre;

        obj.caption = me.presupuestoImagenesLista[i].slug;
        me.images[i] = obj;

        me.images[i] = {
          src: "./" + me.presupuestoImagenesLista[i].nombre,
          caption: me.presupuestoImagenesLista[i].slug,
        };

        console.log(
          "2801 2 -vfor recooro array ",
          me.images,
          "--->",
          me.presupuestoImagenesLista[i],
          "me.images",
          me.presupuestoImagenesLista,
          "creo OBJETO  oj "
        );
      }
      this.load = false;
    },

    abrirCarousel() {
      console.log(
        "2801 abrirCarousel  inicio MAS RECARGAR IMAGE",
        this.presupuestoImagenesLista
      );
      this.presupuestoImagenesLista2 = this.presupuestoImagenesLista;

      this.recargarImage(this.presupuestoImagenesLista2);

      this.mostrarCarousel = true;
      console.log("2801 abrirCarousel  fin", this.presupuestoImagenesLista2);
    },

    moveC(fromC, toC, compo, articulo) {
      let me = this;
      console.log(
        "move 1",
        fromC,
        toC,
        compo,
        me.componentes,
        me.componentes.indexOf(compo)
      );

      var c = me.componentes.indexOf(compo);
      var a = this.filteredRows1(articulo);

      var temp = me.componentes[c];
      console.log("move 2", temp, c, a);

      var l = a.length;
      toC = c - 1;
      console.log("move 2", l, fromC, toC, temp);
      //todo para que no se pase de
      /* if(toC === 0) {toC = l};
        if(toC === l) {toC = 0}; */

      console.log("move 22", l, fromC, toC, temp);

      console.log("move 7 -1", this.componentes);

      /*  var arr = ["C++ ", "Java ", "JS ", 
               "Ruby ", "Python "]; */
      var arr = this.componentes;

      console.log("move 7 -2", arr, this.componentes);

      //     Print the array before moving
      //document.write("Original array: "+arr+"<br>");

      // Position where from the element is
      // going to move here 'Ruby' is moved
      var moveEle = c;

      // Position at which element is to be moved
      // here 'Ruby' is moved to  index 1 which is
      // index of 'Java'
      var moveToIndx = toC;

      // If acctual index of moved element is
      // less than 0 when 'moveEle += array size'
      while (moveEle < 0) {
        moveEle += arr.length;
      }

      // Where the element to be moved f that
      // index is less than 0 when
      // 'moveToIndx += array size'
      while (moveToIndx < 0) {
        moveToIndx = moveToIndx + arr.length;
      }

      // If 'moveToIndx' is greater than the
      // size of the array then with need to
      // push 'undefined' in the array.
      if (moveToIndx >= arr.length) {
        var un = moveToIndx - arr.length + 1;
        while (un--) {
          arr.push(undefined);
        }
      }
      // Here element of 'moveEle' is removed and
      // pushed at 'moveToIndx' index
      //arr.splice(moveToIndx, 0, arr.splice(moveEle, 1));
      arr.splice(moveEle, 1);

      arr.splice(moveToIndx, 0, temp);

      console.log("move 100", arr, moveToIndx, moveEle, this.componentes);

      // Print the array after moving
      //document.write("<br>After move: "+arr+"<br>");
    },

    moveA(fromC, toC) {
      let me = this;
      console.log("move 1", fromC, toC, me.articulos);

      var temp = me.articulos[fromC];

      var l = me.articulos.length;
      toC = fromC - 1;
      console.log("move 2", l, fromC, toC, temp);
      if (toC === 0) {
        toC = l;
      }
      if (toC === l) {
        toC = 0;
      }

      console.log("move 22", l, fromC, toC, temp);

      /*
        var i ; 

        for (i = fromC; i> toC ; i--) {
        console.log('move 3', me.articulos[i]);

          me.articulos[i] = me.articulos[i - 1];
        console.log('move 4', me.articulos[i]);

        }

        me.articulos[toC]=temp;
        console.log('move 5', me.articulos[toC]=temp, temp);


      console.log('move 6',me.articulos); */

      console.log("move 7 -1", this.articulos);

      /*  var arr = ["C++ ", "Java ", "JS ", 
               "Ruby ", "Python "]; */
      var arr = this.articulos;

      console.log("move 7 -2", arr, this.articulos);

      //     Print the array before moving
      //document.write("Original array: "+arr+"<br>");

      // Position where from the element is
      // going to move here 'Ruby' is moved
      var moveEle = fromC;

      // Position at which element is to be moved
      // here 'Ruby' is moved to  index 1 which is
      // index of 'Java'
      var moveToIndx = toC;

      // If acctual index of moved element is
      // less than 0 when 'moveEle += array size'
      while (moveEle < 0) {
        moveEle += arr.length;
      }

      // Where the element to be moved f that
      // index is less than 0 when
      // 'moveToIndx += array size'
      while (moveToIndx < 0) {
        moveToIndx = moveToIndx + arr.length;
      }

      // If 'moveToIndx' is greater than the
      // size of the array then with need to
      // push 'undefined' in the array.
      if (moveToIndx >= arr.length) {
        var un = moveToIndx - arr.length + 1;
        while (un--) {
          arr.push(undefined);
        }
      }
      // Here element of 'moveEle' is removed and
      // pushed at 'moveToIndx' index
      //arr.splice(moveToIndx, 0, arr.splice(moveEle, 1));
      arr.splice(moveEle, 1);

      arr.splice(moveToIndx, 0, temp);

      console.log("move 100", arr, moveToIndx, moveEle, this.articulos);
      this.actualizaLineaDetalle(this.articulos);

      // Print the array after moving
      //document.write("<br>After move: "+arr+"<br>");
    },
    moveLinea(fromC) {
      let me = this;
      swal({
        title: "Numero de Linea",
        input: "number",
        showCancelButton: true,
        confirmButtonText: "Guardar",
        cancelButtonText: "Cancelar",
        inputValidator: (number) => {
          // Si el valor es válido, debes regresar undefined. Si no, una cadena
          if (!number || number <= 0 || number > me.articulos.length) {
            return "Por favor escribe Número Linea Destino Correcto";
          } else {
            return undefined;
          }
        },
      }).then((resultado) => {
        if (resultado.value) {
          let number = resultado.value - 1;
          console.log("move Hola, " + number, me.articulos);
          //me.moveA(fromC, number);
          // muevo array
          me.articulos.splice(number, 0, me.articulos.splice(fromC, 1)[0]);
          me.actualizaLineaDetalle(number, me.articulos);
        }
      });
    },
    actualizaLineaDetalle(numero, articulos) {
      console.log("move guardaLineaDetalle", articulos);
      axios
        .put("/presupuesto/detalle/actualizar/linea", {
          data: {
            articulos: articulos,
          },
        })
        .then(function (response) {
          console.log("move guardaLineaDetalle", response);
        })

        .catch((err) => {
          console.log(err);
        });
    },

    calcularTotalPresupuesto2: function () {
      var resultado = 0.0;
      var costes = 0;
      console.log("zzz CALCULARPRESUPUSTO 2", this.articulos);

      for (var i = 0; i < this.articulos.length; i++) {
        console.log("CALCULARPRESUPUSTO 1111", this.articulos[i].activado == 1);

        if (this.articulos[i].activado == 1) {
          if (
            isNaN(this.articulos[i].costes) ||
            this.articulos[i].costes === undefined ||
            this.articulos[i].costes === null
          ) {
            this.articulos[i].costes = 0.0;
          }

          costes = costes + +this.articulos[i].costes;

          console.log(
            i,
            "zzz CALCULARPRESUPUSTO222 COSTES ",
            costes,
            this.articulos[i].costes,
            this.articulos,
            this.articulos[i]
          );
          //costes = costes.toFixed(2);

          resultado = +resultado + +this.articulos[i].importefinal;
          resultado = +resultado.toFixed(2);
          console.log(" zzz CALCULARPRESUPUSTO22222", resultado);
        }
        if (isNaN(resultado)) {
          swal({
            type: "error",
            title: "Error...",
            text: "Precio o cantidad no pueden ser caracteres",
          });

          resultado = 0.0;
        }

        this.cabecera.sumatotales = resultado;

        if (
          isNaN(this.cabecera.subcontratado) ||
          this.cabecera.subcontratado === undefined ||
          this.cabecera.subcontratado === null
        ) {
          this.cabecera.subcontratado = 0.0;
        }

        if (
          isNaN(this.cabecera.gastos) ||
          this.cabecera.gastos === undefined ||
          this.cabecera.gastos === null
        ) {
          this.cabecera.gastos = 0.0;
        }

        if (
          isNaN(this.cabecera.beneficios) ||
          this.cabecera.beneficios === undefined ||
          this.cabecera.beneficios === null
        ) {
          this.cabecera.beneficios = 0.0;
        }

        if (
          isNaN(this.cabecera.montaje) ||
          this.cabecera.montaje === undefined ||
          this.cabecera.montaje === null
        ) {
          this.cabecera.montaje = 0.0;
        }

        if (
          isNaN(this.cabecera.costes) ||
          this.cabecera.costes === undefined ||
          this.cabecera.costes === null
        ) {
          this.cabecera.costes = 0.0;
        }

        let baset = +(
          +this.cabecera.sumatotales +
          +this.cabecera.gastos +
          +this.cabecera.subcontratado +
          +this.cabecera.montaje
        ).toFixed(3);

        let benet = +((baset * this.cabecera.beneficios) / 100).toFixed(3);

        console.log(
          "zzz CALCULARPRESUPUSTO 222222222222222 Total bene",

          this.cabecera.sumatotales,
          this.cabecera.subcontratado,
          this.cabecera.gastos,
          this.cabecera.montaje,

          "baset",
          baset,
          "beneficios",
          this.cabecera.beneficios,
          "calculo",
          baset * this.cabecera.beneficios,
          "benet",
          benet
        );

        console.log("CALCULARPRESUPUSTO 222 Total bene", benet, baset);

        //

        this.cabecera.importefinal = +(+baset + +benet).toFixed(2);
        this.cabecera.costes = +costes.toFixed(2);

        console.log(
          "CALCULARPRESUPUSTO 222 Costes",
          costes,
          this.cabecera.costes
        );

        console.log("zzz CALCULARPRESUPUSTO 2222 BASE : ", baset);
        console.log(
          "zzz CALCULARPRESUPUSTO 22222  this.cabecera.sumatotales : ",
          this.cabecera.sumatotales,
          this.cabecera.importefinal,
          baset,
          benet
        );
        resultado = this.cabecera.importefinal;

        console.log("calcularTotalPresupuesto2", resultado, this.cabecera);
      }
      return resultado;
    },

    cerrarModalBuscarCliente() {
      this.modalBuscarCliente = 0;
      this.tituloModalCliente = "";
    },

    agregarClienteModal(data = []) {
      let me = this;
      console.log("agregarClienteModal", data);

      if (typeof data.NOM_FISCAL === "object") {
        me.cabecera.nombre_fiscal = "";
      } else {
        me.cabecera.nombre_fiscal = data.NOM_FISCAL;
      }

      if (typeof data.EMPRESA === "object") {
        me.cabecera.cliente_descripcion = "";
      } else {
        me.cabecera.cliente_descripcion = data.EMPRESA;
      }

      if (typeof data.NIF === "object") {
        me.cabecera.dni = "";
      } else {
        me.cabecera.dni = data.NIF;
      }

      if (typeof data.VIA === "object") {
        me.cabecera.direccion = "";
      } else {
        me.cabecera.direccion = data.VIA;
      }

      if (typeof data.POSTAL === "object") {
        me.cabecera.codigo_postal = "";
      } else {
        me.cabecera.codigo_postal = data.POSTAL;
      }

      if (typeof data.MUNICIPIO === "object") {
        me.cabecera.poblacion = "";
      } else {
        me.cabecera.poblacion = data.MUNICIPIO;
      }

      if (typeof data.PROVINCIA === "object") {
        me.cabecera.provincia = "";
      } else {
        me.cabecera.provincia = data.PROVINCIA;
      }

      if (typeof data.TELEFONO === "object") {
        me.cabecera.telefono = "";
      } else {
        me.cabecera.telefono = data.TELEFONO;
      }

      if (typeof data.EMAIL === "object") {
        me.cabecera.email = "";
      } else {
        me.cabecera.email = data.EMAIL;
      }
      if (typeof data.MOVIL === "object") {
        me.cabecera.movil = "";
      } else {
        me.cabecera.movil = data.MOVIL;
      }
      if (typeof data.TXTPAGO === "object") {
        me.cabecera.forma_pago = "";
      } else {
        me.cabecera.forma_pago = data.TXTPAGO;
      }

      this.cerrarModalBuscarCliente();
    },

    listarCliente(buscar, criterio) {
      let me = this;
      var url = "/clientesvnt?buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function (response) {
          //var respuesta = response.data.clientesvnt;
          var respuesta = response.data;

          console.log(
            "listarCliente RESPONSE ",
            response,
            response.data.clientesvnt,
            respuesta,
            respuesta.articulo
          );

          me.clientesVnt = respuesta.clientesvnt.clientes_registro;

          if (typeof me.clientesVnt.length === "undefined") {
            me.clientesVnt = respuesta.clientesvnt;

            console.log("listarCliente sin longitud");
          }
          console.log("listarCliente clientesVnt ", me.clientesVnt);

          console.log(
            "listarCliente RESPONSE  33333 ",
            response,
            respuesta,
            me.clientesVnt
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    buscarCliente() {
      this.modalBuscarCliente = 1;
      this.tituloModal = "Buscar Cliente";
    },

    actualizarTotalPresupuesto: function () {
      axios
        .put("/presupuesto/actualizartotales", {
          id: this.cabecera.id,
          gastos: this.cabecera.gastos,
          montaje: this.cabecera.montaje,
          subcontratado: this.cabecera.subcontratado,
          beneficios: this.cabecera.beneficios,
          importefinal: this.cabecera.importefinal,
          sumatotales: this.cabecera.sumatotales,
        })
        .then(function (response) {
          console.log("actualizartotales", response);
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });

      return ["presupuesto actualizado", this.cabecera.id];
    },

    agregarProductoTerminado(articulo) {
      let me = this;

      console.log("agregarProductoTerminado", articulo);

      let $url = "tarifaproducto/traer";
      const lin = this.articulos.length + 1;

      axios
        .post($url, {
          /*TODO : GUARDAR GASTOS, ETC*/
          articulos: articulo,
          cabecera: this.cabecera,
          lin: lin,
        })
        .then(function (response) {
          /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */

          console.log(response, response.data, response.data.id);

          me.modalBuscarProductoTarifa = 0;
          me.modalarticulo = 0;
          me.verPresupuesto(response.data.id);

          console.log("agregarProductoTerminado", response);
          swal(
            "Insertado!",
            "Producto Terminado ha sido insertado Correctamente.",
            "success"
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    verComponentesPT() {},

    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },

    aceptarComoPresupuestado(id) {
      let me = this;
      me.erroresPresupuesto = [];
      me.errorPresupuesto = "";

      /*  

      if (!me.cabecera.email) {
        me.erroresPresupuesto.push("El correo electrónico es obligatorio.");
        console.log("validar Email 2", me.cabecera.email);
      } else if (!me.validEmail(me.cabecera.email)) {
        console.log("validar Email 3", me.cabecera.email);

        me.erroresPresupuesto.push("El correo electrónico debe ser válido.");
      } */
      if (me.erroresPresupuesto.length) {
        me.errorPresupuesto = 1;
        return;
      }

      var fechaAceptado = new Date();
      fechaAceptado.setDate(fechaAceptado.getDate() + 15);

      swal({
        title:
          "Confirme Presupuesto Aceptado Fecha de Entrega:  " +
          fechaAceptado.toLocaleDateString().slice(0, 10),
        input: "select",
        inputOptions: {
          ACEPTADO: "ACEPTADO",

          "PRESUPUESTADO Y ENVIADO": "PRESUPUESTADO Y ENVIADO",
          "PENDIENTE DE CALCULO": "PENDIENTE DE CALCULO",
          PRESUPUESTADO: "PRESUPUESTADO",
          ACEPTADO: "ACEPTADO",
          DENEGADO: "DENEGADO",
          FINALIZADO: "FINALIZADO",
        },
        inputValue: 20,
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
          let resultado = result.value;

          if ((resultado = "ACEPTADO")) {
            me.cabecera.fecha_entrega = fechaAceptado
              .toISOString()
              .slice(0, 10);

            console.log(
              "validar Email fecha ",
              fechaAceptado,
              fechaAceptado.toISOString().slice(0, 10)
            );
          }

          me.cabecera.estado = resultado;

          console.log(
            "ACEPTARCOMOPRESPUESTADO ",
            result,
            resultado,
            "estado",
            me.cabecera.estado,
            me.cabecera.fecha_entrega,
            id,
            this.cabecera
          );

          axios
            //.post("/nova-vendor/" + this.card.component + "/send-mail", {
            .post("/aceptarcomopresupuestado", {
              cabecera: this.cabecera,
              estado: result,
            })
            .then((response) => {
              //this.loading = false;
              let me = this;

              console.log("RESPONDIENDO DATOS :", response);
              if (response.status == 200) {
                console.log("RESPONDIENDO DATOS :", response, result);

                me.cabecera.estado = resultado;
                /*   this.mensajes.push("CORRECTO : Email enviado a : ",this.email , "para tramitar fotos de :", this.obra.codigo , "/", this.obra.nombre); */
                //alert("Email ha sido enviado a :  " + this.email + this.obra);
              } else {
                /*   this.mensajes.push("ERROR : en el envio de Email", response); */
                // alert("Error enviando email");
              }
            })
            .catch((error) => {
              //this.loading = false;
              alert("Ha habido un error , email no enviado.", error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    desactivarArticulo(articulo, idx) {
      console.log("desactivar Articulo", articulo, idx);
      let me = this;
      // añadir a db no imprime
      // si en db esta marcado no tener encuenta para calculo.
      swal({
        title:
          "Esta seguro de Desactivar este Articulo .No Imprime , No calcula total ?",
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
          axios
            .put("/presupuesto/detalle/desactivar", {
              id: articulo.id,
            })
            .then(function (response) {
              swal(
                "Anulado!",
                "Articulo ha sido Deactivado con éxito.",
                "success"
              );
              if (response) {
                console.log(
                  "eee",
                  me.articulos,
                  idx,
                  response,
                  response.data,
                  response.data.a
                );

                me.articulos[idx].activado = response.data.a;

                me.calcularTotalPresupuesto2();

                me.guardarPresupuesto();
                me.verPresupuesto(articulo.idpresupuesto);
              }
              //   me.listarPresupuesto(1, me.buscar, me.criterio);
              //me.calcularTotalPresupuesto2();
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    duplicarComponente(componente) {
      swal({
        title: "Duplicamos  COMPONENTE ?",
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

          const nuevocodigoco =
            8000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);
          me.coCodigo = nuevocodigoco;

          //const lin = this.articulos.length + 1;

          console.log("duplicarComponente", componente);

          axios
            .post("/presupuesto/componente/guardar", {
              idpresupuesto: componente.idpresupuesto,
              idpresupuestolinea: componente.idpresupuestolinea, //
              articulo_principal: componente.articulo_principal,
              articulo: nuevocodigoco,

              descripcion: componente.descripcion,
              m2: componente.m2,
              ancho: componente.ancho,
              longitud: componente.longitud,
              tipounidad: componente.tipounidad,
              bultos: componente.bultos,

              cantidad: componente.cantidad,
              mermas: componente.mermas,
              montaje: componente.montaje,
              gastos: componente.gastos,
              subcontratado: componente.sucontratado,
              beneficios: componente.beneficios,
              preciofinal: componente.preciofinal,
              precio: componente.precio,
              base: componente.base,
              importefinal: componente.importefinal,
              costes: componente.costes,
              descuento: componente.descuento,

              /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
            })
            .then(function (response) {
              swal({
                type: "success",
                title: "Correcto ...",
                text: "Componente  Duplicado  Correctamente...",
              });

              me.verPresupuesto(response.data.componente.idpresupuesto);
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    duplicarArticulo(articulo) {
      swal({
        title: "Duplicamos ARTICULO y COMPONENTES si los hay?",
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
          const lin = this.articulos.length + 1;

          console.log("duplicarArticulo", articulo);

          let componentes = this.filteredRows1(articulo);
          console.log("duplicarArticulo", articulo, componentes, me.cabecera);

          let $url = "presupuesto/duplicar";

          axios
            .post($url, {
              /*TODO : GUARDAR GASTOS, ETC*/
              cabecera: me.cabecera,
              articulos: articulo,
              componentes: componentes,
              lin: lin,
            })
            .then(function (response) {
              console.log("duplicar", response, response.data.id);

              swal({
                type: "success",
                title: "Correcto ...",
                text: "Articulo Duplicado  Correctamente...",
              });

              me.verPresupuesto(response.data.id);
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    tarifaProductoCrear(articulo) {
      swal({
        title: "Guardamos este Producto como PRODUCTO TARIFA?",
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

          console.log("tarifaProductoCrear", articulo);
          let componentes = this.filteredRows1(articulo);
          console.log("tarifaProductoCrear", articulo, componentes);

          let $url = "tarifaproducto/guardar";

          axios
            .post($url, {
              /*TODO : GUARDAR GASTOS, ETC*/
              articulos: articulo,
              componentes: componentes,
            })
            .then(function (response) {
              /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */
              console.log(
                "tarifaProductoCrear response.existe === true",
                response.data.existe === "true",
                response.data.existe == true,
                response.data
              );

              if (response.data.existe === true) {
                swal({
                  type: "error",
                  title: "Error...",
                  text: "Componente ya guardado",
                });
                //todo desea sobreescribir ??
              } else {
                swal({
                  type: "success",
                  title: "Correcto ...",
                  text: "Componente Guardado Correctamente...",
                });
              }
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },

    tarifaProductoCrearDos(articulo) {
      console.log("tarifaProductoCrear", articulo);
      let componentes = this.filteredRows1(articulo);
      console.log("tarifaProductoCrear", articulo, componentes);

      let $url = "tarifaproducto/guardar";

      axios
        .post($url, {
          /*TODO : GUARDAR GASTOS, ETC*/
          articulos: articulo,
          componentes: componentes,
        })
        .then(function (response) {
          /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */
          console.log(
            "tarifaProductoCrear response.existe === true",
            response.data.existe === "true",
            response.data.existe == true,
            response.data
          );

          if (response.data.existe === true) {
            swal({
              type: "error",
              title: "Error...",
              text: "Componente ya guardado",
            });
          }
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    calcularM2() {
      console.log(
        "calcularM2 inicio",
        this.coAnchura,
        this.coAltura,
        "METROS",
        this.coMetros,
        this.coTipoUnidad,

        this.coUnidades
      );

      this.coMetros = +(this.coAnchura * this.coAltura).toFixed(3);
      this.coTipoUnidad = "M2";
      this.coUnidades = this.coMetros;

      console.log(
        "calcularM2 fin ",
        this.coAnchura,
        this.coAltura,
        "METROS",
        this.coMetros,
        this.cotipoUnidad,
        this.coUnidades
      );
      this.calcularTotalPvpComponente();
    },
    calcularMermas() {},

    actualizarModalEditarTotales() {
      console.log(
        "actualizarModalEditarTotales",

        this.cabeceraEdita.gastos,
        this.cabeceraEdita.montaje,
        this.cabeceraEdita.subcontratado,
        this.cabeceraEdita.beneficios,
        this.cabeceraEdita.importefinal,
        this.cabecera.sumatotales
      );

      this.cabecera.costes = this.cabecera.sumatotales;
      this.cabecera.gastos = this.cabeceraEdita.gastos;
      this.cabecera.montaje = this.cabeceraEdita.montaje;
      this.cabecera.subcontratado = this.cabeceraEdita.subcontratado;

      this.cabecera.beneficios = this.cabeceraEdita.beneficios;
      this.cabecera.importefinal = this.cabeceraEdita.importefinal;

      console.log(
        "actualizarModalEditarTotales",

        this.cabecera.gastos,
        this.cabecera.montaje,
        this.cabecera.subcontratado,
        this.cabecera.beneficios,
        this.cabecera.importefinal
      );

      this.guardarPresupuesto();

      this.cerrarModalEditarTotales();
    },

    recalcularBeneficioComponente: function () {
      console.log(
        "recalcularBeneficioComponente",
        this.coPvp,
        this.base,
        this.bene
      );

      //this.bene = ((this.base * this.coBeneficios) / 100).toFixed(2);
      //this.coBeneficios =(( this.bene * 100) / this.base ).toFixed(2);

      let importe = +(this.coUnidades * this.coPrecioFinal).toFixed(3);
      console.log(
        "calcularTotalPvpComponente Total importe",
        importe,
        "mon",
        this.coMontaje,
        "sub",
        this.coSubcontratacion,
        "coPvp",
        this.coPvp,
        "base",
        this.base
      );

      this.base =
        +importe + +this.coMontaje + +this.coGastos + +this.coSubcontratacion;

      this.coBeneficios = +(
        [(this.coPvp - this.base) / this.base] * 100
      ).toFixed(3);

      console.log(
        "recalcularBeneficioComponente 222",
        this.coBeneficios,
        this.base,
        this.coPvp,
        this.coPvp - this.base,
        ((this.coPvp - this.base) / this.coPvp).toFixed(3)
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
        base = +(cantidad * this.articulopreciofinal).toFixed(2);

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

      this.articuloimportefinal = +(+base + +benet).toFixed(2);

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
        base = +(this.articulounidades * this.articulopreciofinal).toFixed(2);
      } else {
        base = this.articulocoste;
      }
      // hoy let base = (this.articulounidades * this.articulopreciofinal).toFixed(3);

      /*  let base =
        +importe +  + +this.coGastos + +this.coSubcontratacion; */

      this.articulobeneficio = +(
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
    recalcularBeneficioEditar: function () {
      let me = this;
      console.log("recalcularBeneficioEditar");

      let importe = me.cabeceraEdita.importefinal;

      let suma = me.cabecera.sumatotales;

      let gastos =
        +me.cabeceraEdita.gastos +
        +me.cabeceraEdita.montaje +
        +me.cabeceraEdita.subcontratado;

      let base = +suma + +gastos;

      me.cabeceraEdita.beneficios = +([(importe - base) / base] * 100).toFixed(
        3
      );

      console.log(
        "recalcularBeneficioEditar 2221",
        importe,
        suma,
        gastos,
        base,
        this.cabeceraEdita.beneficios,
        ([(importe - base) / base] * 100).toFixed(3)
      );
    },

    calcularTotalPvpComponenteOriginal: function () {
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

      if (isNaN(this.coMermas) || this.coMermas === null) {
        console.log("calcularTotalPvpComponente MEERMAS  1", this.coMermas);

        this.coMermas = 0.0;
        if (this.coPrecio > 0) {
          console.log("calcularTotalPvpComponente MEERMAS  2", this.coMermas);
          this.coPrecioFinal = this.coPrecio;
          this.coPrecio = 0;
        }
        console.log("calcularTotalPvpComponente MEERMAS  3", this.coMermas);
      } else {
        let merma,
          precioUnidad = 0.0;
        console.log(
          "calcularTotalPvpComponente MEERMAS  4",
          this.coMermas,
          this.coPrecio,
          this.coPrecioFinal,
          precioUnidad
        );
        if (this.coMermas) {
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

        this.coPrecioFinal = +precioUnidad.toFixed(2);
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

      if (isNaN(this.coUnidades) || this.coUnidades === null) {
        this.coUnidades = 0.0;
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

      let importe = +(cantidad * this.coPrecioFinal).toFixed(2);
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

      this.bene = +((this.base * this.coBeneficios) / 100).toFixed(2);

      console.log("calcularTotalPvpComponente Total bene", this.bene);

      let total = +this.base + +this.bene;

      this.coPvp = +total.toFixed(2);

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

        this.coPrecioFinal = +precioUnidad.toFixed(2);
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
      /*09122020 let cantidad = this.coBultos * this.coUnidades; */
      let cantidad = this.coUnidades;

      let importe = +(cantidad * this.coPrecioFinal).toFixed(2);
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

      this.bene = +((this.base * this.coBeneficios) / 100).toFixed(2);

      console.log("calcularTotalPvpComponente Total bene", this.bene);

      let total = +this.base + +this.bene;

      this.coPvp = +total.toFixed(2);

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

    listarPresupuesto(page, buscar, criterio) {
      let me = this;
      me.listado = 1;

      console.log("1103 no ", me.Aceptado);

      var url =
        //  "/presupuesto/aceptados?page=" +
        "/demo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      /* +
        "&aceptado=" +
        me.Aceptado ;
         */

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayPresupuesto = respuesta.presupuestos.data;
          me.arrayHoras = respuesta.datos;
          me.pagination = respuesta.pagination;
          console.log(
            "LISTAR PRESUPUESTO",
            me.arrayPresupuesto,
            me.arrayPresupuesto.length,
            respuesta.presupuestos.data.length
          );
          if (respuesta.presupuestos.data.length <= 0) {
            console.log("LISTAR PRESUPUESTO entro");
            swal({
              type: "error",
              title: "Error...",
              text:
                "No hay registros que cumplan, las condiciones establecidas ",
            });
          }
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    validarPrespuestos() {
      this.errorPresupuesto = 0;
      this.erroresPresupuesto = [];

      console.log("VALIDARPRESUPUESTO", this.cabecera);
      /*  
 cabecera.fecha_presupuFesto
 cabecera.cliente_descripcion
cabecera.contacto
cabecera.descripcion_trabajo
cabecera.estado
cabecera.referencia
cabecera.fecha_hora_entrega
cabecera.fecha_envio
cabecera.direccion_envio
cabecera.opcion_envio
cabecera.tipo_enfcabevio
cabecera.contacto_envio */

      /*   if (!this.cabecera.fecha_entrega)
        this.erroresPresupuesto.push("Fecha de Entrega, no puede estar vacío."); */

      if (!this.cabecera.fecha_presupuesto)
        this.erroresPresupuesto.push(
          "Fecha de presupuesto, no puede estar vacío."
        );

      if (!this.cabecera.cliente_descripcion)
        this.erroresPresupuesto.push(
          "Descripcion de cliente, no puede estar vacío."
        );
      if (!this.cabecera.trabajo_descripcion)
        this.erroresPresupuesto.push(
          "Descripcion de trabajo, no puede estar vacío."
        );

      if (this.erroresPresupuesto.length) this.errorPresupuesto = 1;

      console.log(
        "VALIDAR PRESUPUESTO",
        this.erroresPresupuesto,
        this.errorPresupuesto
      );

      return this.erroresPresupuesto;
    },

    guardarPresupuesto(listar) {
      let actualizar = false;

      this.calcularTotalPresupuesto2();

      console.log(
        "yye 333 guardarPresupuesto ACTUALIZAR PRESUPUESTO",
        this.cabecera
      );

      if (this.cabecera.id > 0) {
        console.log(
          "aaa  guardarPresupuesto ACTUALIZAR PRESUPUESTO",
          this.cabecera
        );
        actualizar = true;
      } else {
        console.log("aaa guardarPresupuesto NOOOOO ACTUALIZAR PRESUPUESTO");
        actualizar = false;
      }

      if (listar) {
        this.listado = 1;
        console.log("aaa guardarPresupuesto HAY LISTAR VOY A LISTADO", listar);
      } else {
        this.listado = 0;
        console.log(
          "aaa guardarPresupuesto NOOOOO HAY LISTAR VOY A pRESUPUSTO",
          listar
        );
      }

      console.log(
        this.tipoAccion,
        "aaa GUARDAR PRESUPUESTO guardarPresupuesto",
        this.presupuestoId,
        "cabecera ",
        this.cabecera,
        "articulos : ",
        this.articulos,
        "componentes ",
        this.componentes
      );

      this.erroresPresupuesto = [];
      this.validarPrespuestos();

      if (this.erroresPresupuesto.length > 0) {
        console.log(
          "guardarPresupuesto validar presupuesto ok",
          this.erroresPresupuesto
        );
        return;
      } else {
        console.log(
          "aaa guardarPresupuesto validar presupuesto NO ok",
          this.erroresPresupuesto
        );
      }

      let me = this;
      let $url = "";

      if (actualizar === true) {
        console.log("aaa guardarPresupuesto ACTUALIZAR ----");
        $url = "/presupuesto/actualizar";
        axios
          .put($url, {
            id: this.cabecera.id,
            fecha_presupuesto: this.cabecera.fecha_presupuesto,
            cliente_descripcion: this.cabecera.cliente_descripcion,
            contacto: this.cabecera.contacto,
            trabajo_descripcion: this.cabecera.trabajo_descripcion,
            estado: this.cabecera.estado,
            referencia: this.cabecera.referencia,
            fecha_entrega: this.cabecera.fecha_entrega,
            fecha_envio: this.cabecera.fecha_envio,
            direccion_envio: this.cabecera.direccion_envio,
            opcion_envio: this.cabecera.opcion_envio,
            tipo_envio: this.cabecera.tipo_envio,
            contacto_envio: this.cabecera.contacto_envio,

            costes: this.cabecera.sumatotales,

            gastos: this.cabecera.gastos,
            montaje: this.cabecera.montaje,
            subcontratado: this.cabecera.subcontratado,

            beneficios: this.cabecera.beneficios,
            importefinal: this.cabecera.importefinal,

            nombre_fiscal: this.cabecera.nombre_fiscal,
            dni: this.cabecera.dni,
            direccion: this.cabecera.direccion,
            codigo_postal: this.cabecera.codigo_postal,
            poblacion: this.cabecera.poblacion,
            provincia: this.cabecera.provincia,
            telefono: this.cabecera.telefono,
            movil: this.cabecera.movil,
            email: this.cabecera.email,

            forma_pago: this.cabecera.forma_pago,
            codigo_obra: this.cabecera.codigo_obra,

            observaciones: this.cabecera.observaciones,

            /*TODO : GUARDAR GASTOS, ETC*/
            articulos: this.articulos,
            componentes: this.componentes,
          })
          .then(function (response) {
            /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */
            console.log(
              "aaa GUARDA PRESUPUESTO guardarPresupuesto",
              me.presupuestoId,
              response,
              response.data.id
            );

            me.presupuestoId = response.data.id;
            if (me.listado === 1) {
              me.cabecera = [];
              me.articulos = [];
              me.componentes = [];
              // me.listado = 1;
              me.setActive("administracion");
              me.listarPresupuesto(1, me.buscar, me.criterio);
            } else {
              console.log("aaa ver presupuesto", me.presupuestoId);
              me.verPresupuesto(me.presupuestoId);
            }
          })
          .catch(function (error) {
            console.log("erroor -> 401", error);
            if (
              error.response.status === 401 ||
              error.response.status === 419
            ) {
              window.location = "/login";
            }
          });
      } else {
        console.log(" aaa zzz guardarPresupuesto REGISTRAR", this.cabecera);

        let $url = "presupuesto/registrar";

        axios
          .post($url, {
            id: 0,
            fecha_presupuesto: this.cabecera.fecha_presupuesto,
            cliente_descripcion: this.cabecera.cliente_descripcion,
            contacto: this.cabecera.contacto,
            trabajo_descripcion: this.cabecera.trabajo_descripcion,
            estado: this.cabecera.estado,
            referencia: this.cabecera.referencia,
            fecha_entrega: this.cabecera.fecha_entrega,
            fecha_envio: this.cabecera.fecha_envio,
            direccion_envio: this.cabecera.direccion_envio,
            opcion_envio: this.cabecera.opcion_envio,
            tipo_envio: this.cabecera.tipo_envio,
            contacto_envio: this.cabecera.contacto_envio,

            costes: this.cabecera.sumatotales,

            subcontratado: this.cabecera.subcontratado,
            gastos: this.cabecera.gastos,
            montaje: this.cabecera.montaje,

            beneficios: this.cabecera.beneficios,

            importefinal: this.cabecera.importefinal,

            nombre_fiscal: this.cabecera.nombre_fiscal,
            dni: this.cabecera.dni,
            direccion: this.cabecera.direccion,
            codigo_postal: this.cabecera.codigo_postal,
            poblacion: this.cabecera.poblacion,
            provincia: this.cabecera.provincia,
            telefono: this.cabecera.telefono,
            movil: this.cabecera.movil,
            email: this.cabecera.email,

            forma_pago: this.cabecera.forma_pago,
            codigo_obra: this.cabecera.codigo_obra,

            observaciones: this.cabecera.observaciones,

            /*TODO : GUARDAR GASTOS, ETC*/
            articulos: this.articulos,
            componentes: this.componentes,
          })
          .then(function (response) {
            /*  me.cerrarModal();
                    me.listarCategoria(1,'','nombre'); */
            console.log(
              "guardarPresupuesto actualiza PRESUPUESTO",
              me.presupuestoId,
              response,
              response.data.id
            );
            me.presupuestoId = response.data.id;
            me.verPresupuesto(me.presupuestoId);
            if (me.listado === 1) {
              console.log("guardarPresupuesto listado ", me.listado);
              me.cabecera = [];
              me.articulos = [];
              me.componentes = [];
              // me.listado = 1;
              me.setActive("administracion");
              me.listarPresupuesto(1, me.buscar, me.criterio);
            }
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
      }
    },
    filteredRows1(a) {
      // console.log("filteredRows1 inicio ", a);
      return this.componentes.filter((componente) => {
        /*  console.log(
          "filteredRows1 return ",
          this.componentes,
          componente.articulo_principal,
          a
        ); */
        const compo = componente.articulo_principal.toString().toLowerCase();
        const compo2 = componente.idpresupuestolinea.toString().toLowerCase();
        /* console.log(
          "filteredRows1 return dos compo  ",
         compo,compo2
        ); */
        //return compo.includes(a.articulo);
        return compo2.includes(a.id);
      });
    },
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
      /*  if(menuItem === 'administracion'){
        this.listarFicherosImagenesPresupuestos();
      } */
    },

    listarFicherosImagenesPresupuestos() {
      var me = this;
      var i = this.cabecera.id;

      var url = "/presupuesto/documentacion?id=" + i;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;

          me.presupuestoImagenesLista = response.data.imagenes;
          me.presupuestoDocumentosLista = response.data.documentos;
          console.log(
            "FOTOSSUBIR -> GET",
            me.presupuestoImagenesLista,
            me.presupuestoDocumentosLista
          );

          me.cargado = true;
        })
        .catch(function (error) {});
    },
    /*quitar listarVenta(page, buscar, criterio) {
      let me = this;
      var url =
        this.ruta +
        "/venta?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayVenta = respuesta.ventas.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
          console.log(error);
        });
    }, */
    cargarPdf() {
      window.open(this.ruta + "/venta/listarPdf", "_blank");
    },
    selectCliente(search, loading) {
      let me = this;
      loading(true);

      // var url = this.ruta + "/cliente/selectCliente?filtro=" + search;
      var url = this.ruta + "/clientesvnts?buscar=" + search;
      axios
        .get(url)
        .then(function (response) {
          let respuesta = response.data;
          q: search;
          me.arrayCliente = respuesta.clientes;
          loading(false);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getDatosCliente(val1) {
      let me = this;
      me.loading = true;
      me.idcliente = val1.id;
    },
    buscarArticulo() {
      let me = this;
      var url =
        this.ruta + "/articulo/buscarArticuloVenta?filtro=" + me.articulo;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayArticulo = respuesta.articulos;

          if (me.arrayArticulo.length > 0) {
            me.articulo = me.arrayArticulo[0]["nombre"];
            me.idarticulo = me.arrayArticulo[0]["id"];
            me.precio = me.arrayArticulo[0]["precio_venta"];
            me.stock = me.arrayArticulo[0]["stock"];
          } else {
            me.articulo = "No existe artículo";
            me.idarticulo = 0;
          }
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },
    presupuestoPdf(id) {
      console.log("09042021");
      window.open(
        "/presupuesto/pdf?id=" + id + "&T=" + this.muestraTotalPresupuesto,
        "_blank"
      );
      /* window.open("/presupuesto/pdf?id=" + id + "," + "_blank"); */
    },
    presupuestoPdfFabricacion(id) {
      window.open("/presupuesto/pdf-fabricacion?id=" + id, "_blank");
      /* window.open("/presupuesto/pdf?id=" + id + "," + "_blank"); */
    },

    pdfVenta(id) {
      window.open(this.ruta + "/venta/pdf/" + id + "," + "_blank");
    },
    pdfTicket(id) {
      window.open(this.ruta + "/venta/pdfTicket/" + id + "," + "_blank");
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      console.log("cambiarPagina", page, buscar, criterio);
      //Envia la petición para visualizar la data de esa página
      // me.listarVenta(page, buscar, criterio);
      this.listarPresupuesto(page, buscar, criterio);
    },
    //quitar
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].idarticulo == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentraArticulo(id) {
      var sw = 0;
      for (var i = 0; i < this.articulos.length; i++) {
        if (this.articulos[i].codigoArticulo == id) {
          sw = true;
        }
      }
      return sw;
    },
    eliminarDetalle(index) {
      let me = this;
      me.arrayDetalle.splice(index, 1);
    },
    agregarDetalle() {
      let me = this;
      if (me.idarticulo == 0 || me.cantidad == 0 || me.precio == 0) {
      } else {
        if (me.encuentra(me.idarticulo)) {
          swal({
            type: "error",
            title: "Error...",
            text: "Ese artículo ya se encuentra agregado!",
          });
        } else {
          if (me.cantidad > me.stock) {
            swal({
              type: "error",
              title: "Error...",
              text: "NO hay stock disponible!",
            });
          } else {
            me.arrayDetalle.push({
              idarticulo: me.idarticulo,
              articulo: me.articulo,
              cantidad: me.cantidad,
              bultos: me.bultos,
              precio: me.precio,
              descuento: me.descuento,
              stock: me.stock,
            });
            me.articulo = "";
            me.idarticulo = 0;
            me.articulo = "";
            me.cantidad = 0;
            me.precio = 0;
            me.descuento = 0;
            me.stock = 0;
          }
        }
      }
    },
    //quitar
    agregarDetalleModal(data = []) {
      let me = this;
      console.log("agregarDetalleModal", data);

      if (this.modalBuscarArticulo === 2) {
        // viene desde buscar componentes desde articulos
        this.articulodescripcion = data.DENOMINA;
        if (
          (isNaN(data.ANCHO) && isNaN(data.LONGITUD)) ||
          data.M2 === "0.000"
        ) {
          this.articulotipounidad = "Ud";
          this.articulounidades = data.UNIDAD;

          console.log("agregarDetalleModal if", this.coUnidades);
        } else {
          this.articulotipounidad = "M2";
          this.articulounidades = +(data.LONGITUD * data.ANCHO).toFixed(3);

          console.log("agregarDetalleModal else", this.coUnidades);
        }

        this.articulodescripcion = data.DENOMINA;
        this.articulocoste = data.COSTE_U;
        this.calcularTotalArticulo();

        console.log(
          "201020 IF",
          data,
          data.COSTE_U,
          this.articulocoste,
          this.articulounidades,
          this.articulopvp
        );
      } else {
        console.log("201020 ELSE", data, data.COSTE_U);

        // this.coCodigoPrincipal = data.articulo;
        this.coDescripcion = data.DENOMINA;
        this.coAnchura = data.ANCHO;
        this.coAltura = data.LONGITUD;
        this.coMetros = data.M2;

        if (
          (isNaN(data.ANCHO) && isNaN(data.LONGITUD)) ||
          data.M2 === "0.000"
        ) {
          this.coTipoUnidad = "Ud";
          this.coUnidades = data.UNIDAD;
          this.coBultos = data.BULTOS;

          console.log("agregarDetalleModal if", this.coUnidades);
        } else {
          this.coTipoUnidad = "M2";
          this.coUnidades = +(data.LONGITUD * data.ANCHO).toFixed(3);

          console.log("agregarDetalleModal else", this.coUnidades);
        }
        this.coPrecioFinal = data.COSTE_U;
        this.calcularTotalPvpComponente();

        console.log(
          "201020 calcularTotalPvpComponente",
          this.coPrecioFinal,
          data,
          data.COSTE_U,
          this.articulocoste,
          this.coPvp
        );

        // sera 0 y viene desde componentes

        /*  this.coMontaje = "";
          this.coGastos = "";
          this.coSubcontratacion = "";
          this.coBeneficios = "";
          this.coPvp = "";
          this.coHoras = "";
          this.coObservaciones = "";
          this.coCodigo = data.ARTICULO; */

        /*   this.cerrarModalBuscar();
          this.tipoAccion = 1; */
      }

      this.cerrarModalBuscar();
      this.modalBuscar = 0;
      this.tipoAccion = 1;
      this.modalBuscarArticulo = 0;

      /* if (me.encuentra(data["id"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!"
        });
      } else {
        me.arrayDetalle.push({
          idarticulo: data["id"],
          articulo: data["nombre"],
          cantidad: 1,
          precio: data["precio_venta"],
          descuento: 0,
          stock: data["stock"]
        }); 
      }*/
    },

    listarProtductoTerminado(buscar, criterio) {
      let me = this;
      var url =
        "/tarifaproducto/buscar?buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response;

          console.log(
            "RESPONSE ",
            response,
            response.data,
            respuesta,
            respuesta
          );

          me.arrayTarifaProductos = respuesta.data.tarifaproductos;

          console.log("arrayArticulosCompra ", me.arrayTarifaProductos);
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },
    //quitar
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
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });
    },

    /*quitar  registrarVenta() {
      if (this.validarVenta()) {
        return;
      }

      let me = this;

      axios
        .post(this.ruta + "/venta/registrar", {
          idcliente: this.idcliente,
          tipo_comprobante: this.tipo_comprobante,
          serie_comprobante: this.serie_comprobante,
          num_comprobante: this.num_comprobante,
          impuesto: this.impuesto,
          importefinal: this.importefinal,
          data: this.arrayDetalle,
        })
        .then(function (response) {
          me.listado = 1;
          me.listarVenta(1, "", "num_comprobante");
          me.idcliente = 0;
          me.tipo_comprobante = "BOLETA";
          me.serie_comprobante = "";
          me.num_comprobante = "";
          me.impuesto = 0.18;
          me.importefinal = 0.0;
          me.idarticulo = 0;
          me.articulo = "";
          me.cantidad = 0;
          me.precio = 0;
          me.stock = 0;
          me.articulo = "";
          me.descuento = 0;
          me.arrayDetalle = [];
          window.open(
            this.ruta + "/venta/pdf/" + response.data.id + "," + "_blank"
          );
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401) {
            window.location = "/login";
          }
        });
    },
 */

    vaciarFormularioPresupuesto() {
      this.cabecera = [];
      this.articulos = [];
      this.componentes = [];
      console.log("vaciarFormularioPresupuesto", this.cabeceras);
    },

    mostrarDetalle() {
      console.log("mostrar detalle");
      let me = this;
      me.listado = 0;

      me.setActive("administracion");
      this.vaciarFormularioPresupuesto();

      /*  me.idproveedor = 0;
      me.tipo_comprobante = "BOLETA";
      me.serie_comprobante = "";
      me.num_comprobante = "";
      me.impuesto = 0.18;
      me.importefinal = 0.0;
      me.idarticulo = 0;
      me.articulo = "";
      me.cantidad = 0;
      me.precio = 0;
      me.arrayDetalle = []; */
    },

    ocultarDetalle() {
      this.listado = 1;
    },

    verPresupuesto(id) {
      let me = this;
      me.listado = 0;
      me.cargado = false;

      //Obtener los datos del ingreso
      var arrayPresupuestoCab = [];
      var arrayPresupuestoLin = [];
      var url = "/presupuesto/view?id=" + id;

      me.dropzoneOptionsFichero.params.id = id;
      me.dropzoneOptionsImagen.params.id = id;

      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.cabecera = respuesta.cabecera;
          me.articulos = respuesta.articulos;
          me.componentes = respuesta.componentes;

          //pasado a fotos subir para que cargue lista en dropzone me.listarFicherosImagenesPresupuestos(me.cabecera.id);

          /*           me.dropzoneOptionsFichero.params.ruta= 'me.cabecera.id';
           */
          console.log(
            "response 2301 ñññññññññññññññ",
            response,
            me.cabecera,
            me.articulos,
            me.componentes,
            me.dropzoneOptionsImagen,
            me.dropzoneOptionsFichero
          );

          me.listarFicherosImagenesPresupuestos();

          /*  me.cliente = arrayVentaT[0]["nombre"];
          me.fecha_hora = arrayVentaT[0]["fecha_hora"];
          me.tipo_comprobante = arrayVentaT[0]["tipo_comprobante"];
          me.serie_comprobante = arrayVentaT[0]["serie_comprobante"];
          me.num_comprobante = arrayVentaT[0]["num_comprobante"];
          me.impuesto = arrayVentaT[0]["impuesto"];
          me.total = arrayVentaT[0]["total"]; */
        })
        .catch(function (error) {
          console.log(error);
          if (error.response.status === 401 || error.response.status === 419) {
            window.location = "/login";
          }
        });

      //Obtener los datos de los detalles
      /* var urld = this.ruta + "/venta/obtenerDetalles?id=" + id;

      axios
        .get(urld)
        .then(function(response) {
          //console.log(response);
          var respuesta = response.data;
          me.arrayDetalle = respuesta.detalles;
        })
        .catch(function(error) {
          console.log(error);
        }); */
    },

    cerrarModalArticulo() {
      console.log("cerrarModalArticulo");
      this.modalarticulo = 0;
      this.tituloModalArticulo = "";
    },

    editarTotalPresupuesto() {
      let baset = +(
        +this.cabecera.sumatotales +
        +this.cabeceraEdita.gastos +
        +this.cabeceraEdita.subcontratado +
        +this.cabeceraEdita.montaje
      ).toFixed(3);

      console.log(
        "editarTotalPresupuesto :",
        this.cabecera.sumatotales,
        this.cabeceraEdita.gastos,
        this.cabeceraEdita.subcontratado,
        this.cabeceraEdita.montaje,
        "baset",
        baset
      );

      let benet = +((baset * this.cabeceraEdita.beneficios) / 100).toFixed(2);
      console.log("editarTotalPresupuesto Total bene", benet, baset);

      this.cabeceraEdita.importefinal = +baset + +benet;

      console.log("editarTotalPresupuesto  BASE : ", baset);

      /*   this.cabeceraEdita.beneficios = (
        [(this.cabeceraEdita.importefinal - this.cabeceraEdita.sumatotales) / this.cabeceraEdita.sumatotales] * 100
      ).toFixed(2);

      console.log("editarTotalPresupuesto  BENEFICIOS : ", this.cabeceraEdita.beneficos); */
    },

    abrirModalEditarTotales(modelo, accion) {
      /* this.arrayArticulo = [];
      this.modalarticulo = 1;
      this.tituloModalArticulo = "Alta de articulo";
      */

      switch (modelo) {
        case "totales": {
          switch (accion) {
            case "editar": {
              this.modaleditartotales = 1;
              this.tituloModalEditarTotales = "Editar Totales";

              console.log("editarTotalPresupuesto");

              if (
                isNaN(this.cabecera.montaje) ||
                this.cabecera.montaje === null
              ) {
                this.cabeceraEdita.montaje = 0.0;
              } else {
                this.cabeceraEdita.montaje = this.cabecera.montaje;
              }
              if (
                isNaN(
                  this.cabecera.subcontratado ||
                    this.cabecera.subcontratado === null
                )
              ) {
                this.cabecera.subcontratado = 0.0;
              }
              this.cabeceraEdita.subcontratado = this.cabecera.subcontratado;

              if (
                isNaN(
                  this.cabeceraEdita.gastos ||
                    this.cabeceraEdita.gastos === null
                )
              ) {
                this.cabecera.gastos = 0.0;
              }
              this.cabeceraEdita.gastos = this.cabecera.gastos;

              if (
                isNaN(
                  this.cabeceraEdita.beneficios ||
                    this.cabeceraEdita.beneficios === null
                )
              ) {
                this.cabecera.beneficios = 0.0;
              }
              this.cabeceraEdita.beneficios = this.cabecera.beneficios;

              if (
                isNaN(
                  this.cabeceraEdita.importefinal ||
                    this.cabeceraEdita.importefinal === null
                )
              ) {
                this.cabeceraEdita.importefinal = 0.0;
              }
              this.cabeceraEdita.importefinal = this.cabecera.importefinal;

              // this.tipoAccion = 1;
              break;
            }
          }
        }
      }
    },

    abrirModalProdcutoTarifa() {
      console.log("abrirModalProdcutoTarifa");

      this.modalBuscarProductoTarifa = 1;
      this.tituloModalPT = "Buscar Producto Tarifa";

      this.tipoAccion = 3;
    },

    cerrarModalProdcutoTarifa() {
      this.modalBuscarProductoTarifa = 0;
      this.tituloModalPT = "";
    },

    abrirModalArticulo(modelo, accion, data = [], idx) {
      /* this.arrayArticulo = [];
      this.modalarticulo = 1;
      this.tituloModalArticulo = "Alta de articulo";
      */

      if (this.cabecera.id === undefined) {
        swal({
          type: "error",
          title: "Error...",
          text: "Debe Guardar el presupuesto antes de añadir productos",
        });

        return;
      }

      this.modelo = modelo;
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
              this.articulotipounidad = "Ud";
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
              console.log("buscar :", data, data["descripcion"], idx);
              this.modalBuscar = 1;
              this.tituloModal = "Buscar Articulo";

              this.tipoAccion = 3;

              break;
            }
            case "buscarArticulo": {
              // buscar componetes desde articulos
              //console.log(data, data["descripcion"], idx);
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

    actualizarModalArticulo() {
      let me = this;

      /*  me.articulos[me.articuloidx].importefinal =
        me.articulopreciofinal * me.articulounidades;
      me.articulos[me.articuloidx].preciofinal = me.articulopreciofinal; */

      axios
        .put("/presupuesto/detalle/actualizar", {
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
          var articulo = response.data.detalle;

          console.log(
            "guardarModalArticulo todo ",
            response,
            response.data.detalle,
            articulo
          );

          me.articulos[me.articuloidx].descripcion = articulo.descripcion;
          me.articulos[me.articuloidx].cantidad = articulo.cantidad;
          me.articulos[me.articuloidx].bultos = articulo.bultos;
          me.articulos[me.articuloidx].linea = articulo.linea;

          me.articulos[me.articuloidx].preciofinal = articulo.preciofinal;
          me.articulos[me.articuloidx].beneficios = articulo.beneficios;
          me.articulos[me.articuloidx].costes = articulo.costes;

          me.articulos[me.articuloidx].importefinal = articulo.importefinal;
          /* 11122020
           */
          me.calcularTotalPresupuesto2();

          console.log("xxx guardarModalArticulo", me.cabecera);
          me.guardarPresupuesto();
          console.log("xxx guardarModalArticulo", me.cabecera);

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

      /* 11122020 this.recalcularTodosBeneficioComponente(
        me.articulos[me.articuloidx].id,
        me.articulobeneficio
      ); */

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

    guardarModalArticulo() {
      let me = this;

      if (this.cabecera.id === undefined) {
        swal({
          type: "error",
          title: "Error...",
          text: "Debe Guardar el presupuesto antes de añadir productos",
        });

        return;
      }

      if (me.encuentra(me.articulocodigo)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else {
        const lin = this.articulos.length + 1;
        const nuevocodigo =
          9000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);

        console.log("201020", this.articulocoste);

        axios
          .post("/presupuesto/detalle/guardar", {
            idpresupuesto: me.cabecera.id,
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
            linea: lin,
            /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
          })
          .then(function (response) {
            var articulo = response.data.detalle;

            console.log(
              "guardarModalArticulo",
              response,
              response.data.detalle
            );
            me.articulos.push({
              id: articulo.id,
              idpresupuesto: articulo.idpresupuesto,
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

    eliminarPresupuesto(id) {
      swal({
        title: "Esta seguro de anular este Presupuesto ?",
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
            .put("/presupuesto/eliminar", {
              id: id,
            })
            .then(function (response) {
              swal(
                "Anulado!",
                "Articulo ha sido anulada con éxito.",
                "success"
              );
              me.listarPresupuesto(1, me.buscar, me.criterio);
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
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
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
            /*  console.log("***", this.componentes,articulo.codigo);
        console.log(
          "***111",
          i,
          this.componentes[i].articulo_principal
        ); */

            /* 0612 if (this.componentes[i].articulo_principal == articulo.articulo) {
              console.log("BORRO componente", i);
              this.componentes.splice(i, 1);
            } */
            console.log("eliminarArticulo", articulo);
            if (this.componentes[i].idpresupuestolinea == articulo.id) {
              console.log("BORRO componente", i, articulo.id);
              this.componentes.splice(i, 1);
            }
          }

          for (var i = 0; i < this.articulos.length; i++) {
            /*  console.log("***", this.articulos, articulo.codigo);
        console.log(
          "***111",
          i,
         
          this.componentes[i].codigo
        ); */

            //0612  if (this.articulos[i].articulo == articulo.articulo) {
            if (this.articulos[i].id == articulo.id) {
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
                  .put("/presupuesto/detalle/eliminar", {
                    id: this.articulos[i].id,
                  })
                  .then(function (response) {
                    me.guardarPresupuesto();
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

    recalcularTodosBeneficioComponente(articulo, bene) {
      let me = this;

      //var sw = 0;
      //var componente = 0 ;
      console.log(
        "recalcularTodosBeneficioComponente",
        me.componentes,
        articulo,
        bene
      );

      for (var i = 0; i < me.componentes.length; i++) {
        console.log("recalcularTodosBeneficioComponente FOR");

        if (this.componentes[i].idpresupuestolinea == articulo) {
          // 1.-ACTUALIzo valor de beneficio
          me.componentes[i].beneficios = bene;
          //2.-recargo valores del componente para utilizar actualizar , deberian ser paramentros .

          me.coIdx = me.componentes[i].id; // id componente
          me.coIdPresupuestoLinea = me.componentes[i].idpresupuestolinea;

          me.coCodigoPrincipal = me.componentes[i].articulo_principal;
          me.coCodigo = me.componentes[i].articulo;

          me.coDescripcion = me.componentes[i].descripcion;
          me.coMetros = me.componentes[i].m2;
          me.coAnchura = me.componentes[i].ancho;
          me.coAltura = me.componentes[i].longitud;
          me.coTipoUnidad = me.componentes[i].tipounidad;
          me.coBultos = me.componentes[i].bultos;
          me.coUnidades = me.componentes[i].cantidad;
          me.coMermas = me.componentes[i].mermas;
          me.coMontaje = me.componentes[i].montaje;
          me.coGastos = me.componentes[i].gastos;
          me.coSubcontratacion = me.componentes[i].subcontratado;
          me.coBeneficios = bene;
          me.coPrecio = me.componentes[i].precio;
          me.coPrecioFinal = me.componentes[i].preciofinal;
          me.coPvp = me.componentes[i].importefinal;
          me.coCostes = me.componentes[i].costes;

          // 3.- RECALCULO

          me.calcularTotalPvpComponente();
          me.actualizarModalComponente();
        }
      }
      console.log(
        "recalcularTodosBeneficioComponente FIN",
        me.componentes,
        bene
      );
    },

    //quitar llevado a acomponent
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
          this.componentes[i].articulo_principal,
          this.componentes[i].articulo,
          this.coCodigo,
          this.coCodigoPrincipal,
          this.coBeneficios
        );

        if (
          this.componentes[i].articulo_principal == this.coCodigoPrincipal &&
          this.componentes[i].articulo == this.coCodigo
        ) {
          sw = true;
          componente = i;
          // me.coIdx = i;
          console.log(
            "***222",
            i,
            this.componentes[i].articulo_principal,
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
      me.componentes[componente].precio = me.coPrecio;

      me.componentes[componente].mermas = me.coMermas;
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
        .put("/presupuesto/componente/actualizar", {
          id: me.coIdx, // id componente
          // idpresupuesto: me.cabecera.id, // o coIdPresupueto
          // idpresupuestolinea: me.coIdPresupuestoLinea,

          // articulo_principal: me.coCodigoPrincipal,
          // articulo: me.coCodigo,

          descripcion: me.coDescripcion,
          m2: me.coMetros,
          ancho: me.coAnchura,
          longitud: me.coAltura,
          tipounidad: me.coTipoUnidad,
          bultos: me.coBultos,
          cantidad: me.coUnidades,
          mermas: me.coMermas,
          montaje: me.coMontaje,
          gastos: me.coGastos,
          subcontratado: me.coSubcontratacion,
          beneficios: me.coBeneficios,
          precio: me.coPrecio,
          preciofinal: me.coPrecioFinal,
          importefinal: me.coPvp,
          costes: me.coCostes,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          var componente = response.data.componente;
          me.guardarPresupuesto();

          console.log(
            "recalcularTodosBeneficioComponente actualizarModalComponente guardarModalComponente",
            response,
            response.data.componente.id
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

      //0612 this.recalcularTotalArticulo("actualizar", me.coCodigoPrincipal);
      this.recalcularTotalArticulo("actualizar", me.coIdPresupuestoLinea);

      this.cerrarModalComponente();
    },

    eliminarComponente(componente) {
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
          console.log("elimiarCOmponene", componente);

          for (var i = 0; i < this.componentes.length; i++) {
            if (
              this.componentes[i].id === componente.id
              /*   this.componentes[i].articulo_principal ==
                componente.articulo_principal &&
              this.componentes[i].articulo == componente.articulo */

              /* 1501 quitado porque borraba todos menos el seleccionado 
              this.componentes[i].idpresupuestolinea ==
              componente.idpresupuestolinea
 */
            ) {
              if (this.componentes[i].id === undefined) {
                this.componentes.splice(i, 1);
                swal(
                  "Anulado!",
                  "Componente ha sido anulada con éxito.",
                  "success"
                );
                console.log("elminarComonetne IF", this.componentes[i].id);
              } else {
                console.log("elminarComonetne ELSE", this.componentes[i].id);

                axios
                  .put("/presupuesto/componente/eliminar", {
                    id: this.componentes[i].id,
                  })
                  .then(function (response) {
                    me.guardarPresupuesto();
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
                this.recalcularTotalArticulo(
                  "eliminar",
                  //0612 componente.articulo_principal
                  componente.idpresupuestolinea
                );
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

    recalcularTotalArticuloOriginal(origen, id) {
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
        "1601 recalcularTotalArticulo",
        // resultado,
        objIndex,
        //me.articulos[objIndex].importefinal,
        me.componentes.length
      );

      let sw = 0;
      let tpvp = 0;
      let tcoste = 0;
      let tbene = 0;

      for (var i = 0; i < me.componentes.length; i++) {
        console.log(
          "1601 recalcularTotalArticulo",
          "me.componentes.articulo_principal",
          me.componentes[i].articulo_principal,
          "me.articulos[objIndex].articulo",
          me.articulos[i].articulo,
          "componentes",
          me.componentes,
          me.componentes[i].articulo_principal === me.articulos[i].articulo,
          me.componentes[i].articulo_principal == me.articulos[i].articulo
        );

        if (
          me.componentes[i].articulo_principal ===
          me.articulos[objIndex].articulo
        ) {
          tpvp = +(+tpvp + +me.componentes[i].importefinal).toFixed(2);

          sw = +(+sw + +me.componentes[i].importefinal).toFixed(2);

          tcoste = +(+tcoste + +me.componentes[i].costes).toFixed(2);

          console.log(
            i,
            "1601 recalcularTotalArticulo",
            sw,
            me.componentes[i].importefinal,
            me.componentes[i].descripcion,
            tpvp
          );
        }
      }

      if (tcoste === 0) {
        me.articulos[objIndex].beneficios = 0;
        tpvp = +(
          me.articulos[objIndex].cantidad * me.articulos[objIndex].preciofinal
        ).toFixed(2);
      } else {
        me.articulos[objIndex].beneficios = +(
          [(tpvp - tcoste) / tcoste] * 100
        ).toFixed(3);
      }

      // me.articulos[objIndex].importefinal = sw;
      me.articulos[objIndex].costes = tcoste;
      me.articulos[objIndex].importefinal = tpvp;

      console.log(
        "1601 recalcularTotalArticulo fin",
        me.articulos[objIndex].costes,
        tcoste,
        me.articulos[objIndex].importefinal,
        tpvp,
        me.articulos[objIndex].beneficios,
        ([(tpvp - tcoste) / tcoste] * 100).toFixed(3)
      );

      //BUSCO ARTICULO Y ACTUALIZSO COSTE
      axios
        .put("/presupuesto/detalle/actualizar/coste", {
          id: me.articulos[objIndex].id,
          costes: tcoste,
          beneficio: me.articulos[objIndex].beneficios,
          importefinal: tpvp,
        })
        .then(function (response) {
          console.log(
            "1601 recalcularTotalArticulo,presupuesto/detalle/actualizar/coste",
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
        "1601 recalcularTotalArticulo TOTAL ARTICULO FIN ARTICULOS",
        me.articulos[objIndex]
      );

      //  me.actualizarModalArticulo();
    },

    recalcularTotalArticuloCambiado(origen, id) {
      let me = this;

      const objIndex = this.articulos.findIndex((obj) => obj.id === id);

      console.log(
        " recalcularTotalArticulo INICIO  ",
        origen,
        "ID->",
        id,
        "ONJINDEX ->",
        objIndex
      );

      let sw = 0;
      let tpvp = 0;

      let costeUnidad = 0; //con merma
      let tcoste = 0;
      let tbene = 0;
      let tmermas = 0;
      let precioVentaUnidad = 0;

      let tbase = 0;
      let tdto = 0;
      let timporte = 0;

      let a = 0;

      for (var i = 0; i < me.componentes.length; i++) {
        if (
          me.componentes[i].idpresupuestolinea === me.articulos[objIndex].id
        ) {
          a++;
          tcoste = +(+tcoste + +me.componentes[i].costes).toFixed(2);

          tmermas = +(+tmermas + +me.componentes[i].mermas).toFixed(2);

          timporte = +(+timporte + +me.componentes[i].importefinal).toFixed(2);

          tbene = +(+tbene + +me.componentes[i].beneficios).toFixed(2);

          tbase = +(+tbase + +me.componentes[i].base).toFixed(2);

          tdto = +(+tdto + +me.componentes[i].descuento).toFixed(2);

          tpvp = +(+tpvp + +me.componentes[i].importefinal).toFixed(2);

          sw = +(+sw + +me.componentes[i].importefinal).toFixed(2);
        }
      }

      /*   me.acBeneficios = +([(me.acSubtotal4 - me.acSubtotal2) / me.acSubtotal2] * 100).toFixed(3);
       */

      me.articulos[objIndex].precio = +(
        tcoste / me.articulos[objIndex].bultos
      ).toFixed(2);

      me.articulos[objIndex].mermas = +(tmermas / a).toFixed(2);
      me.articulos[objIndex].costes = +tcoste.toFixed(2);

      //me.articulos[objIndex].beneficios = +(tbene/a).toFixed(2);

      me.articulos[objIndex].preciofinal = +(
        tbase / me.articulos[objIndex].bultos
      ).toFixed(2);

      me.articulos[objIndex].base = +tbase.toFixed(2);
      //me.articulos[objIndex].dto = +(tdto/a).toFixed(2);
      me.articulos[objIndex].importefinal = +timporte.toFixed(2);

      let bene2 = +(
        [
          (me.articulos[objIndex].base - me.articulos[objIndex].costes) /
            me.articulos[objIndex].costes,
        ] * 100
      ).toFixed(3);

      /*   let merma2 = +([(me.articulos[objIndex].preciofinal - me.articulos[objIndex].precio) / me.articulos[objIndex].precio] * 100).toFixed(2); */

      let dto2 = +(
        me.articulos[objIndex].importefinal - me.articulos[objIndex].base
      );
      console.log("bbb dto2", dto2);

      dto2 = +(dto2 / me.articulos[objIndex].base);
      console.log("bbb dto2", dto2);

      dto2 = Math.abs((dto2 * 100).toFixed(3));

      console.log("bbb dto2", dto2);

      me.articulos[objIndex].dto = dto2;
      me.articulos[objIndex].beneficios = bene2;
      //me.articulos[objIndex].mermas=merma2;

      console.log(
        "bbb",
        me.articulos[objIndex].dto,
        me.articulos[objIndex].beneficios
      );

      console.log("bbb", a, tbene / a, tdto / a, me.articulos[objIndex]);
      //BUSCO ARTICULO Y ACTUALIZSO COSTE
      axios
        .put("/presupuesto/detalle/actualizar/coste", {
          id: me.articulos[objIndex].id,
          precio: me.articulos[objIndex].precio,
          mermas: me.articulos[objIndex].mermas,
          costes: me.articulos[objIndex].costes,
          beneficio: bene2,
          preciofinal: me.articulos[objIndex].preciofinal,
          base: me.articulos[objIndex].base,
          dto: Math.abs(dto2),
          //me.articulos[objIndex].dto,

          importefinal: me.articulos[objIndex].importefinal,
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
      recalcularTotalArticulo(origen, id) {
      let me = this;

      const objIndex = this.articulos.findIndex((obj) => obj.id === id);

      console.log(
        " recalcularTotalArticulo INICIO  1108",
        origen,
        "ID->",
        id,
        "ONJINDEX ->",
        objIndex
      );

      let sw = 0;
      let tpvp = 0;

      let costeUnidad = 0; //con merma
      let tcoste = 0;
      let tbene = 0;
      let tmermas = 0;
      let precioVentaUnidad = 0;

      let tbase = 0;
      let tdto = 0;
      let timporte = 0;

      let a = 0;

      for (var i = 0; i < me.componentes.length; i++) {
        if (
          me.componentes[i].idpresupuestolinea === me.articulos[objIndex].id
        ) {
          a++;
          tcoste = +(+tcoste + +me.componentes[i].costes).toFixed(2);

          tmermas = +(+tmermas + +me.componentes[i].mermas).toFixed(2);

          timporte = +(+timporte + +me.componentes[i].importefinal).toFixed(2);

          tbene = +(+tbene + +me.componentes[i].beneficios).toFixed(2);

          tbase = +(+tbase + +me.componentes[i].base).toFixed(2);

          tdto = +(+tdto + +me.componentes[i].descuento).toFixed(2);

          tpvp = +(+tpvp + +me.componentes[i].importefinal).toFixed(2);

          sw = +(+sw + +me.componentes[i].importefinal).toFixed(2);
        }
      }

      // recalculo articulo .. 
      // Precio Coste  = suma de costes de componentes = tcoste
      // SUBTOTAL1 = Precio Coste  x unidades  ; 
      
      // %Mermas  = no se acumula
      // SUBTOTAL2 = subtotal1 + montaje
    
      // Total Costes =  coste unidad x bultos ... 
      // % beneficio = se recalcula siempre .. antes no .. 
      //              = ((base - coste)/coste)100 
      // Precio venta unidad = coste unidad + beneficios
      // Base imponible = bultos * Precio venta unidad
      // dto = no se acumula 
      // total importe  ... base imponible - dto

      console.log('180322 - 1', tcoste, tmermas,'tcoste*bultos',   tbene,tpvp ,  tbase, tdto,timporte ,  sw );


      me.articulos[objIndex].precio = tcoste; 
    
      //COSTES
      let precioCoste =0 ; 
      let precioCosteMasMerma=0;
      if ( me.articulos[objIndex].mermas > 0) {
        precioCosteMasMerma = +((me.articulos[objIndex].precio * me.articulos[objIndex].mermas) / 100 + me.articulos[objIndex].precio).toFixed(3);
        precioCoste = precioCosteMasMerma;

        //me.acSubtotal1 = +(me.acCosteMasMerma * me.acUnidades).toFixed(2);
      } else {
        precioCosteMasMerma = 0;
        precioCoste = me.articulos[objIndex].precio ;
       // me.acSubtotal1 = +(me.acPrecio * me.acUnidades).toFixed(2);
      }



      let subtotal1 = +(precioCoste *  me.articulos[objIndex].bultos).toFixed(2);

      me.articulos[objIndex].costes = +(tcoste * me.articulos[objIndex].bultos).toFixed(2);


    
      //COSTES MAS GASTOS 
      let subtotal2 = +(subtotal1 + +me.articulos[objIndex].montaje 
      + +me.articulos[objIndex].subcontratado 
      + +me.articulos[objIndex].gastos      
      ).toFixed(2);
      

      // BENEFICIOS 
      let beneficio = 0;
      beneficio =  +([(tpvp- tcoste)/tcoste]*100 ).toFixed(3); 
      me.articulos[objIndex].beneficios  = beneficio;

      //SUBTOTAL2 + BENEFICIOS 
      let subtotal3 = 0 ; 
      if (beneficio  > 0) {
        subtotal3 = +((subtotal2 * beneficio) / 100 + subtotal2).toFixed(2);
      } else {
        subtotal3 = subtotal2;
      }

      //PRECIO VENTA 
      me.articulos[objIndex].preciofinal  = +(subtotal3 / me.articulos[objIndex].bultos);
    let subtotal4 = 0; 
    if (me.articulos[objIndex].descuento > 0) {
        subtotal4 = +(+subtotal3 - (subtotal3 * me.articulos[objIndex].descuento) / 100).toFixed(2);
      } else {
        subtotal4 = subtotal3;
      }


      me.articulos[objIndex].base = subtotal3;
      me.articulos[objIndex].importefinal = subtotal4;
      //me.articulos[objIndex].preciofinal = +(subtotal4 * me.articulos[objIndex].bultos).toFixed(2);

  console.log('180322 finnnnnn' , 
   
   me.articulos[objIndex].bultos,
   me.articulos[objIndex].precio, 
   me.articulos[objIndex].costes,
   me.articulos[objIndex].beneficios,
   me.articulos[objIndex].base,
   me.articulos[objIndex].descuento,
   
   me.articulos[objIndex].preciofinal,

   me.articulos[objIndex].importefinal);

   

  //*********
    // quitado 
  //*********** 


      axios
        .put("/presupuesto/detalle/actualizar/coste", {
          id: me.articulos[objIndex].id,
          precio: me.articulos[objIndex].precio,
         // mermas: me.articulos[objIndex].mermas,
          costes: me.articulos[objIndex].costes,
          beneficio: me.articulos[objIndex].beneficios,

          preciofinal: me.articulos[objIndex].preciofinal,
          base: me.articulos[objIndex].base,
          //dto: Math.abs(dto2),
          //me.articulos[objIndex].dto,
          dto:    me.articulos[objIndex].descuento,


          importefinal: me.articulos[objIndex].importefinal,
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

    guardarModalComponente() {
      let me = this;
      const nuevocodigoco =
        8000 + Math.floor(Math.random() * (999 - 1 + 1) + 1);
      me.coCodigo = nuevocodigoco;

      /* 

          me.componentes.push({
                      // id : id,
                        articulo_principal: me.coCodigoPrincipal,
                        articulo: me.coCodigo,
                        idpresupuesto: me.cabecera.id,
                        idpresupuestolinea : me.coIdx,
                        descripcion: me.coDescripcion,
                        m2: me.coMetros,
                        ancho: me.coAnchura,
                        longitud: me.coAltura,
                        tipounidad: me.coTipoUnidad,
                        cantidad: me.coUnidades,
                        montaje: me.coMontaje,
                        gastos: me.coGastos,
                        subcontratado: me.coSubcontratacion,
                        beneficios: me.coBeneficios,
                        preciofinal: me.coPrecioFinal,
                        importefinal: me.coPvp,
                        costes : me.coCostes,


                        comentarios: "observaciones",
                      });  */

      axios
        .post("/presupuesto/componente/guardar", {
          idpresupuesto: me.cabecera.id,
          idpresupuestolinea: me.coIdx, // id del articulo
          articulo_principal: me.coCodigoPrincipal,
          articulo: me.coCodigo,

          descripcion: me.coDescripcion,
          m2: me.coMetros,
          ancho: me.coAnchura,
          longitud: me.coAltura,
          tipounidad: me.coTipoUnidad,
          bultos: me.coBultos,

          cantidad: me.coUnidades,
          mermas: me.coMermas,
          montaje: me.coMontaje,
          gastos: me.coGastos,
          subcontratado: me.coSubcontratacion,
          beneficios: me.coBeneficios,
          preciofinal: me.coPrecioFinal,
          precio: me.coPrecio,
          importefinal: me.coPvp,
          costes: me.coCostes,

          /* importefinal: (
              me.articulounidades * me.articulopreciofinal
            ).toFixed(2), */
        })
        .then(function (response) {
          var componente = response.data.componente;
          var idcompo = response.data.componente.id;
          me.guardarPresupuesto(); //10/12/2020

          console.log(
            "guardarModalComponente",
            response,
            response.data.componente.id
          );

          console.log(
            "guardarModalComponente componentes ",

            me.componentes
          );
          //me.insertComponente(idcompo);

          me.componentes.push({
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

            //descuento

            comentarios: "observaciones",
          });

          //0612 me.recalcularTotalArticulo("guardar", me.coCodigoPrincipal);
          me.recalcularTotalArticulo(
            "guardar",
            response.data.componente.idpresupuestolinea
          );

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

      /*    me.recalcularTotalArticulo("guardar", me.coCodigoPrincipal);

      me.cerrarModalComponente(); */
    },

    /*     insertComponente(id, articulo, articuloprincipal) {

      let me = this;

      console.log('inserCOmponent',id,me.componentes);

      const objIndex = this.componentes.findIndex(
              (obj) => obj.articulo === articulo || obj.articulo_principal === articuloprincipal

            );


 
          me.componentes.push({
                        id : id,
                        articulo_principal: me.coCodigoPrincipal,
                        articulo: me.coCodigo,
                        idpresupuesto: me.cabecera.id,
                        idpresupuestolinea : me.coIdx,
                        descripcion: me.coDescripcion,
                        m2: me.coMetros,
                        ancho: me.coAnchura,
                        longitud: me.coAltura,
                        tipounidad: me.coTipoUnidad,
                        cantidad: me.coUnidades,
                        montaje: me.coMontaje,
                        gastos: me.coGastos,
                        subcontratado: me.coSubcontratacion,
                        beneficios: me.coBeneficios,
                        preciofinal: me.coPrecioFinal,
                        importefinal: me.coPvp,
                        costes : me.coCostes,

                        //descuento

                        comentarios: "observaciones",
                      }); 
             console.log('inserCOmponent fin',id,me.componentes);


    },
    
 */

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

    cerrarModalEditarTotales() {
      this.modaleditartotales = 0;
      this.tituloModalEditarTotates = "";
      this.cabeceraEdita.gastos = 0;
      this.cabeceraEdita.montaje = 0;
      this.cabeceraEdita.subcontratado = 0;
      this.cabeceraEdita.beneficios = 0;
      this.cabeceraEdita.importefinal = 0;
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
      this.modelo = modelo;
      this.accion = accion;
      this.data = data;
      this.idx = index;

      switch (modelo) {
        case "componente": {
          switch (accion) {
            case "registrar": {
              this.modalarticulo = 1;
              this.tituloModalArticulo = "Alta de Componente";
              //this.data = {};

              /* this.modalcomponente = 1;
              this.tituloModalComponente = "Alta de Componente";
               */
              this.coIdPresupuesto = "";
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

              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              console.log(
                "bbb abrir modal componente actualizar",
                data,
                data["descripcion"],
                index
              );

              this.modalarticulo = 1;

              /*               this.modalcomponente = 1;
               */ this.tituloModalComponente = "Actualizar Componente";

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

    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
    },

    cerrarModalBuscar() {
      this.modalBuscar = 0;
      this.tituloModal = "";
    },

    abrirModal() {
      this.arrayArticulo = [];
      this.modal = 1;
      this.tituloModal = "Alta de Componente";
    },

    /*quitar desactivarVenta(id) {
      swal({
        title: "Esta seguro de anular esta venta?",
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
            .put(this.ruta + "/venta/desactivar", {
              id: id,
            })
            .then(function (response) {
              me.listarVenta(1, "", "num_comprobante");
              swal(
                "Anulado!",
                "La venta ha sido anulada con éxito.",
                "success"
              );
            })
            .catch(function (error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    }, */
  },
  mounted() {
    window.addEventListener('resize', () => {
    this.windowHeight = window.innerHeight;
    console.log('mounted', this.windowHeight);
  })
    Echo.channel("example").listen("MessageSent", (e) => {
      console.log("mounted-> echo.channel ", e, e.message.id, this.arrayHoras);
      this.arrayHoras.push({
        tipo_trabajo: e.message.tipo_trabajo,
        user_id: e.message.user_id,
        obra_id: e.message.obra_id,
        fin: e.message.fin,
        id: e.message.id,
        name: "nuevo",
        codigo: e.message.codigo,
        final: e.message.fin,
        horas: "1",
      });
      console.log("mounted-> echo.channel 222222222222222", e, this.arrayHoras);
    });

    this.listarPresupuesto(1, this.buscar, this.criterio);
    this.fechaActual();
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
  /*  width: 600px !important; */
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

.table-fixed {
  width: 100%;
  background-color: #f3f3f3;
}
.table-fixed tbody {
  height: 200px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead,
.table-fixed tbody,
.table-fixed tr,
.table-fixed td,
.table-fixed th {
  display: block;
}
.table-fixed tbody td {
  float: left;
}
.table-fixed thead tr th {
  float: left;
  background-color: #f39c12;
  border-color: #e67e22;
}
</style>
