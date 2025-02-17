<template>
  <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header"></div>

        <div class="card-body">
          <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
              <div class="sidebar-header">
                <h3>Exterior Play</h3>
              </div>

              <ul class="list-unstyled components">
                <button
                  type="button"
                  @click="modoSideBar = 'Vallas'"
                  :class="[
                    modoSideBar === 'Vallas'
                      ? 'btn btn-sm btn-success'
                      : 'btn btn-sm btn-warning',
                  ]"
                >
                  <i class="icon-eye"></i> Vallas
                </button>
                .:.
                <button
                  type="button"
                  @click="RutasVallasVer()"
                  :class="[
                    modoSideBar === 'Rutas'
                      ? 'btn btn-sm btn-success'
                      : 'btn btn-sm btn-warning',
                  ]"
                >
                  <i class="icon-eye"></i> Rutas Vallas
                </button>
                <div v-if="modoSideBar === 'Rutas'">
                  <lista-rutas
                    @enviarVallas="enviarVallas"
                    :rutaSelect="rutaSelect"
                  ></lista-rutas>
                </div>
                <div v-else>
                  <li v-for="valla in vallasLista" :key="valla.id">
                    <a
                      class="nav-link pl-0 text-nowrap"
                      href="#"
                      @click="listarVallas(valla.dni, 'vallasLista', estado)"
                    >
                      <i class="fa fa-bullseye fa-fw"></i>
                      <span class="small">
                        {{ valla.dni }}-{{ valla.nombre }}
                        <br />
                        {{ valla.direccion }}
                        <br />
                        {{ valla.postal }} - {{ valla.poblacion }}
                        <br />
                      </span>

                      <span
                        class="badge badge-danger badge-pill"
                        v-if="valla.estado === 'Ocupada'"
                        >{{ valla.estado }}</span
                      >

                      <span
                        class="badge badge-success badge-pill"
                        v-else-if="valla.estado === 'Libre'"
                        >{{ valla.estado }}</span
                      >
                      <span
                        class="badge badge-warning badge-pill"
                        v-else-if="valla.estado === 'Reservada'"
                        >{{ valla.estado }}</span
                      >

                      <span class="badge badge-info badge-pill" v-else>{{
                        valla.estado
                      }}</span>

                      <br />
                    </a>
                  </li>
                </div>
              </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">
              <div class="row mb-2">
                <div class="col-6">
                  <button
                    type="button"
                    data-toggle="modal"
                    data-target="#modalFormRutaVallas"
                    @click="altaRutaValla('ruta', 'alta')"
                    class="btn btn-sm btn-primary"
                  >
                    <i class="icon-plus"></i>Alta Ruta de Vallas
                  </button>
                </div>
              </div>

              <div class="row" v-if="rutaVallasAlta">
                <div class="col-6">
                  <form-rutas
                    @cerrarModal="cerrarModalRutaVallas"
                    :rutaSelect="rutaSelect"
                    :modo="modo"
                  ></form-rutas>
                </div>
              </div>

              <div class="row mb-4" v-if="rutaSelect.descripcion">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label class="control-label" for="descripcion"
                      >Ruta Seleccionada</label
                    >
                    <input
                      type="text"
                      v-model="rutaSelect.descripcion"
                      id="descripcion"
                      name="descripcion"
                      class="rm-width form-control"
                    />
                  </div>
                </div>
                <div class="col-3" v-if="rutaSelect.token">
                  <button
                    type="button"
                    class="btn btn-sm btn-success"
                    @click="abrirEnOtraPestana(rutaSelect.token)"
                  >
                    Abrir en Otra Pestaña
                  </button>
                </div>
                <div class="col-3">
                  <button
                    type="button"
                    data-toggle="modal"
                    data-target="#modalFormRutaVallas"
                    @click="editarRutaValla('ruta', 'editar', rutaSelect)"
                    class="btn btn-sm btn-success"
                  >
                    <i class="icon-plus"></i>Editar Ruta de Vallas
                  </button>
                </div>
                <div class="col-3" v-if="rutaSelect.id">
                  <button
                    type="button"
                    class="btn btn-sm btn-warning"
                    @click="eliminarRuta(rutaSelect.id)"
                  >
                    Eliminar Ruta
                  </button>
                </div>
                <!--    <div class="col-4">
                        <button
                            type="button"
                            data-toggle="modal"
                            data-target="#modalFormRutaVallas"
                            @click="altaRutaValla('ruta', 'alta')"
                            class="btn btn-sm btn-warning"
                            >
                              <i class="icon-plus"></i>Eliminar  Ruta de Vallas 
                        </button>
                    </div>-->
                <!--<div class="col-4">
                  <button
                    v-if="veoTodas"
                    type="button"
                    @click="verTodasLasVallas(false)"
                    class="btn btn-sm btn-primary"
                  >
                    <i class="icon-plus"></i>Ver solo vallas ruta"
                  </button>

                  <button
                    v-else
                    type="button"
                    @click="verTodasLasVallas(true)"
                    class="btn btn-sm btn-primary"
                  >
                    <i class="icon-plus"></i>Ver Todas Las Vallas
                  </button>
                </div>-->
              </div>

              <div class="row">
                <div class="col-6">
                  <input
                    type="text"
                    v-model="buscar"
                    @keyup.enter="listarVallas(buscar, criterio, estado)"
                    class="form-control mb-2 mr-sm-4"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listarVallas(buscar, criterio, estado)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
                <div class="col-6">
                  <label class="btn btn-primary" for="estado">Estado</label>
                  <select
                    class="form-control"
                    id="estado"
                    v-model="estado"
                    @change="selectEstado"
                  >
                    <option value="Todas">Todas</option>
                    <option value="Libre">Libre</option>
                    <option value="Ocupada">Ocupada</option>
                    <option value="Reservada">Reservada</option>
                    <option value="Baja">Baja</option>
                    <option value="Rutas">Rutas</option>
                  </select>
                </div>
              </div>

              <div class="row justify-content-center">
                {{ vallas.length }} = Numero de Vallas encontradas para la
                busqueda : [ {{ buscar }}] con estado {{ estado }}
              </div>

              <GmapMap
                :center="mapCenter"
                :zoom="6"
                map-type-id="satellite"
                style="width: 100%; height: 800px"
              >
                <gmap-info-window
                  :options="infoWindowOptions"
                  :position="infoWindowPosition"
                  :opened="infoWindowOpened"
                  @closeclick="handleInfoWindowClose"
                >
                  <div class="info-window">
                    <h2 v-text="activeValla.nombre"></h2>
                    <h5 v-text="activeValla.dni"></h5>
                    <p v-text="activeValla.direccion"></p>
                    <p v-text="activeValla.estado"></p>

                    <button
                      type="button"
                      v-if="rutaSelect.id === activeValla.ruta_id"
                      @click="quitarVallaDeRuta(activeValla)"
                    >
                      <i class="icon-eye"></i> Quitar de Ruta
                    </button>
                    <button
                      type="button"
                      v-else-if="rutaSelect.id"
                      @click="anadirVallaDeRuta(activeValla, rutaSelect)"
                    >
                      <i class="icon-eye"></i> Añadir a Ruta
                    </button>
                  </div>
                </gmap-info-window>
                <gmap-marker
                  v-for="(r, index) in vallas"
                  :key="r.id"
                  :position="getPosition(r)"
                  :clickable="true"
                  :draggable="false"
                  :icon="getIcon(r)"
                  @click="handleMarkerClicked(r)"
                >
                </gmap-marker>
              </GmapMap>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>



 

<script>
import formRutas from "./rutas/formRutas.vue";
import ListaRutas from "./rutas/ListaRutas.vue";

export default {
  /*  props: {
             vallas : String,
         }, */
  created() {
    this.listarVallas(this.buscar, this.criterio, this.estado);
  },
  components: {
    formRutas: formRutas,
    ListaRutas: ListaRutas,
  },
  data() {
    return {
      modoSideBar: "Vallas",
      rutaSelect: {},
      veoTodas: false,
      modo: "", // alta o editar

      opened: false,
      estado: "Todas",
      rutaVallasRecibida: {},
      rutaVallasAlta: false,
      vallas: {},
      vallas_copia: {},
      vallasLista: {},
      page: "",
      buscar: "",
      criterio: "",
      ruta: "",
      center: { lat: 5, lng: -5 },

      infoWindowOptions: {
        pixelOffset: {
          width: 0,
          height: -55,
        },
      },
      infoWindowOpened: false,

      activeValla: {},

      valla: {
        id: 0,
        dni: "",
        nombre: "",
        direccion: "",
        poblacion: "",
        postal: "",
        provincia: "",
        telefono: "",
        email: "",
        longitud: "",
        latitud: "",
        ancho: 1,
        alto: 1,
        m2: 1,
        tipo: "Valla",
        elemento: "Vinilo",
      },
    };
  },
  mounted() {},
  methods: {
    eliminarRuta(id) {
      console.log("eliminar", id);
      let me = this;

      var ruta_id = id;

      console.log("quitarVallaDeRuta", ruta_id);

      axios
        .put("/ruta-vallas/delete", {
          id: ruta_id,
        })
        .then(function (response) {
          var rutaVallaR = response.data;
          me.modoSideBar = "Vallas";

          swal("Eliminado!", "Ruta ha sido creada con éxito.", "success");
        })
        .catch(function (error) {});
    },
    abrirEnOtraPestana(token) {
      console.log("1303", token);
      //let $baseUrl = "http://192.168.0.77:8082";
      let $baseUrl = window.location.origin;

      // Construye la URL utilizando el token y abre la nueva pestaña
      const url = `${$baseUrl}/ruta/${token}`;

      console.log("1403 vallaMapa abrir en ", url);

      window.open(url, "_blank");
    },
    verTodasLasVallas(veoTodas) {
      console.log("veotodas", this.veoTodas, veoTodas);

      this.veoTodas = veoTodas;

      console.log("veotodas", this.veoTodas, veoTodas);

      if (this.veoTodas) {
        this.estado = "Todas";
        this.listarVallas(this.buscar, this.criterio, this.estado, this.ruta);
        console.log("veotodas listar true", this.veoTodas, veoTodas);
      } else {
        console.log("veotodas listar else", this.ruta, veoTodas);
        this.estado = "Rutas";
        this.listarVallas(this.buscar, this.criterio, this.estado, this.ruta);
      }
      this.handleInfoWindowClose();
    },
    //anadirVallaDeRuta
    anadirVallaDeRuta(valla, ruta) {
      console.log("anadirVallaDeRuta", valla, ruta);
      let me = this;

      axios
        .post("/ruta-vallas-lineas/create", {
          valla: valla,
          ruta: ruta,
        })
        .then(function (response) {
          var valla = response.data.detalle;

          swal("Creada!", "Ruta ha sido creada con éxito.", "success");
          console.log(
            "añadir valla",
            me.buscar,
            me.criterio,
            me.estado,
            me.ruta
          );

          me.listarVallas(me.buscar, me.criterio, me.estado, me.ruta);
          console.log(
            "añadir valla",
            me.buscar,
            me.criterio,
            me.estado,
            me.ruta
          );
          me.handleInfoWindowClose();
        })
        .catch(function (error) {
          console.log(error);

          axios.post("/log-error", {
            type: "error",
            message: error,
            stack:
              "añadirValla a Ruta :b->" +
              me.buscar +
              " cri->" +
              me.criterio +
              " estado->" +
              me.estado +
              " ruta->" +
              me.ruta,
          });

          /*if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                        }*/
        });
    },

    quitarVallaDeRuta(valla) {
      let me = this;

      var ruta_id = me.ruta;

      console.log("quitarVallaDeRuta", valla, me.ruta, me.ruta.id);

      axios
        .put("/ruta-vallas-lineas/delete", {
          valla_id: valla.id,
          ruta_id: ruta_id,
        })
        .then(function (response) {
          var rutaVallaR = response.data.detalle;

          console.log("0303", rutaVallaR, response.data);
          swal("Eliminado!", "Ruta ha sido creada con éxito.", "success");
          me.handleInfoWindowClose();
          me.estado = "Rutas";
          me.listarVallas(me.buscar, me.criterio, me.estado, me.ruta);
        })
        .catch(function (error) {
          axios.post("/log-error", {
            type: "error",
            message: error,
            stack:
              "quitarVallas :b->" +
              me.buscar +
              " cri->" +
              me.criterio +
              " estado->" +
              me.estado +
              " ruta->" +
              me.ruta,
          });
          console.log(error);
          /* if (error.response.status === 401 || error.response.status === 419) {
                window.location = "/login";
                }
                */
        });
    },
    irAValla(valla) {
      console.log("irAvalla", valla);
      // Base URL de tu aplicación
      const baseUrl = "http://192.168.0.77:8082";
      // Ruta específica dentro de tu aplicación Vue que quieres abrir
      const rutaInterna = "/valla/datos/" + valla.id;
      // Construye la URL completa
      const urlCompleta = baseUrl + rutaInterna;
      // Abre la URL en una nueva pestaña
      window.open(urlCompleta, "_blank");
    },
    enviarVallas(vallas_ruta, ruta_select) {
      console.log("enviarVallas vallasMapa ", vallas_ruta, ruta_select);
      this.vallas = vallas_ruta;
      this.vallas_copia = this.vallas;
      this.rutaSelect = ruta_select;
      this.rutaVallasAlta = true;

      this.ruta = this.rutaSelect.id;
      console.log(
        "enviarVallas vallasMapa ",
        this.ruta,
        this.rutaSelect.id,
        ruta_select
      );

      // listar vallas de la ruta o todas ...
    },
    RutasVallasVer() {
      this.modoSideBar = "Rutas";
    },
    cerrarModalRutaVallas(ruta) {
      this.rutaVallasRecibida = ruta;
      this.modoSideBar = "Vallas";

      //this.modo = "Vallas";
      //this.listarVallas(this.buscar, this.criterio, this.estado);

      // this.enviarVallas(this.vallas, ruta);
      console.log("1303 cerrarModal vallasMap", this.modoSideBar);
    },

    altaRutaValla() {
      this.rutaVallasAlta = true;
      this.modo = "alta";
      this.RutasVallasVer();
      console.log("alta Valla");
    },

    editarRutaValla(modo, tipo, ruta) {
      this.rutaVallasAlta = true;
      this.modo = "editar";
      this.RutasVallasVer();

      this.rutaVallasRecibida = ruta;
      console.log("1103 editar Valla", modo, tipo, ruta);
    },

    getIcon2(marker) {
      return marker.estado === "Ocupada"
        ? "http://maps.google.com/mapfiles/ms/icons/red-dot.png" // Marcador rojo para los de baja
        : "http://maps.google.com/mapfiles/ms/icons/green-dot.png"; // Marcador verde para los activos
    },

    getIcon(marker) {
      switch (marker.estado) {
        case "Rutas":
          return "http://maps.google.com/mapfiles/ms/icons/white-dot.png"; // Marcador rojo

        case "Baja":
          return "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"; // Marcador rojo
        case "Reservada":
          return "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"; // Marcador amarillo
        case "Ocupada":
          return "http://maps.google.com/mapfiles/ms/icons/red-dot.png"; // Marcador azul
        case "Libre":
          return "http://maps.google.com/mapfiles/ms/icons/green-dot.png"; // Marcador verde
        default:
          return "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"; // Marcador gris para estados no definidos
      }
    },
    selectEstado() {
      console.log("selectEstado");
      this.listarVallas(this.buscar, this.criterio, this.estado);
    },
    listarVallas(buscar, criterio, estado) {
      let me = this;
      console.log(
        "listar Vallas",
        "b->",
        buscar,
        "c->",
        criterio,
        "e->",
        estado
      );
      if (criterio === "vallasLista") {
        me.buscar = buscar;
        // me.vallasLista = me.vallas;
      }

      //var url= this.ruta + '/valla?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      var url =
        "/listarVallas?buscar=" +
        me.buscar +
        "&criterio=" +
        me.criterio +
        "&estado=" +
        me.estado +
        "&ruta=" +
        me.ruta;
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          console.log(
            "respouesta 0603",
            me.buscar,
            me.criterio,
            me.estado,
            response,
            respuesta,
            respuesta.vallas
          );
          if (criterio === "vallasLista") {
            //me.vallasLista = me.vallas;
            me.vallas = respuesta.vallas;
          } else {
            me.vallas = respuesta.vallas;
            me.vallasLista = respuesta.vallas;
          }

          console.log("created", me.vallas);
        })
        .catch(function (error) {
          console.log(error);

          axios.post("/log-error", {
            type: "error",
            message: error,
            stack:
              "listarVallas :b->" +
              me.buscar +
              " cri->" +
              me.criterio +
              " estado->" +
              me.estado +
              " ruta->" +
              me.ruta,
          });
        });
    },
    handleMapClick(e) {
      console.log("handleMapClick", e, this.valla);
      this.valla.push({
        nombre: "valla nueva",
        dni: "rererencia",
        latitud: e.latLng.lat(),
        longitud: e.latLng.lng(),
      });
    },

    getPosition(r) {
      console.log("getPosition", r);
      // parseFloat(r.latitud),this.valla.latitud, parseFloat(r.longitud), this.valla.longitud);

      return {
        lat: parseFloat(r.latitud),
        lng: parseFloat(r.longitud),
      };
    },
    handleMarkerClicked(r) {
      console.log("handleMarkerClicked", r);

      this.activeValla = r;
      this.infoWindowOpened = true;
    },
    handleInfoWindowClose() {
      console.log("handleInfoWindowClose");

      this.activeValla = {};
      this.infoWindowOpened = false;
    },
  },
  computed: {
    mapCenter() {
      console.log("mapCenter");
      if (!this.vallas.length) {
        console.log("mapCenter", this.vallas);
        return {
          lat: 42.60003,
          lng: -5.57032,
          // lat: 10,
          // lng: 10
        };
      }
      console.log("mapCenter 33333");

      return {
        lat: parseFloat(this.vallas[0].latitud),
        lng: parseFloat(this.vallas[0].longitud),
      };
    },
    infoWindowPosition() {
      console.log("infoWindowPosition", this.activeValla);
      return {
        lat: parseFloat(this.activeValla.latitud),
        lng: parseFloat(this.activeValla.longitud),
      };
    },
  },
};
</script>
<style >
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
body {
  font-family: "Poppins", sans-serif;
  background: #fafafa;
}

p {
  font-family: "Poppins", sans-serif;
  font-size: 1.1em;
  font-weight: 300;
  line-height: 1.7em;
  color: #999;
}

a,
a:hover,
a:focus {
  color: inherit;
  text-decoration: none;
  transition: all 0.3s;
}

.navbar {
  padding: 15px 10px;
  background: #fff;
  border: none;
  border-radius: 0;
  margin-bottom: 40px;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
  box-shadow: none;
  outline: none !important;
  border: none;
}

.line {
  width: 100%;
  height: 1px;
  border-bottom: 1px dashed #ddd;
  margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
  display: flex;
  width: 100%;
  align-items: stretch;
}

#sidebar {
  min-width: 250px;
  max-width: 250px;
  background: #20a8d8;
  color: #fff;
  transition: all 0.3s;
}

#sidebar.active {
  margin-left: -250px;
}

#sidebar .sidebar-header {
  padding: 20px;
  background: #20a8d8;
}

#sidebar ul.components {
  padding: 20px 0;
  border-bottom: 1px solid #47748b;
}

#sidebar ul p {
  color: #fff;
  padding: 10px;
}

#sidebar ul li a {
  padding: 10px;
  font-size: 1.1em;
  display: block;
}

#sidebar ul li a:hover {
  color: #20a8d8;
  background: #fff;
}

#sidebar ul li.active > a,
a[aria-expanded="true"] {
  color: #fff;
  background: #20a8d8;
}

a[data-toggle="collapse"] {
  position: relative;
}

.dropdown-toggle::after {
  display: block;
  position: absolute;
  top: 50%;
  right: 20px;
  transform: translateY(-50%);
}

ul ul a {
  font-size: 0.9em !important;
  padding-left: 30px !important;
  background: #20a8d8;
}

ul.CTAs {
  padding: 20px;
}

ul.CTAs a {
  text-align: center;
  font-size: 0.9em !important;
  display: block;
  border-radius: 5px;
  margin-bottom: 5px;
}

a.download {
  background: #fff;
  color: #20a8d8;
}

a.article,
a.article:hover {
  background: #20a8d8 !important;
  color: #fff !important;
}

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#content {
  width: 100%;
  padding: 20px;
  min-height: 100vh;
  transition: all 0.3s;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
  #sidebar {
    margin-left: -250px;
  }
  #sidebar.active {
    margin-left: 0;
  }
  #sidebarCollapse span {
    display: none;
  }
}
</style>