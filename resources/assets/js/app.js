
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(require('vue-moment'));

Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));


Vue.component('xmlcomprasvnt', require('./components/XmlComprasVnt.vue'));
Vue.component('productotarifa', require('./components/ProductoTarifa.vue'));

 Vue.component('xml', require('./components/Xml.vue'));

Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('compras', require('./components/Compras.vue'));
Vue.component('fotosobras', require('./components/FotosObras.vue'));
Vue.component('obramano', require('./components/ObraMano.vue'));
Vue.component('obrausuario', require('./components/ObraUsuario.vue'));
Vue.component('obramanotaller', require('./components/obraManoTaller.vue'));
Vue.component('obraresumen', require('./components/ObraResumen.vue'));
Vue.component('obradia', require('./components/graficos/ObraDia.vue'));
Vue.component('obradiausuario', require('./components/graficos/ObraDiaUsuario.vue'));
Vue.component('diahorasusuario', require('./components/graficos/DiaHorasUsuario.vue'));
Vue.component('teclado-numerico', require('./components/TecladoNumerico.vue'));


Vue.component('foto-global', require('./components/Fotos/FotoGlobal.vue'));
Vue.component('foto-cab', require('./components/Fotos/FotoCab.vue'));
Vue.component('foto-alta', require('./components/Fotos/FotoAlta.vue'));
Vue.component('foto-lista', require('./components/Fotos/FotoLista.vue'));
Vue.component('foto-lista-presupuesto', require('./components/Fotos/FotoListaPresupuesto.vue'));

Vue.component('fotos-subir', require('./components/fotos/FotosSubir.vue'));

Vue.component('foto-obra-dropzone', require('./components/Fotos/FotoObraDropzone.vue'));


Vue.component('foto-global-externo', require('./components/Fotos/FotoGlobalExterno.vue'));

Vue.component('presupuestos', require('./components/Presupuestos.vue'));
Vue.component('presupuestos-aceptados', require('./components/PresupuestosAceptados.vue'));
Vue.component('presupuestos-estado', require('./components/PresupuestosEstado.vue'));

Vue.component('ArticuloComponente', require('./components/modal/ArticuloComponente.vue'));

Vue.component('Carousel', require('./components/fotos/Carousel.vue'));
Vue.component('vallas-admin', require('./components/vallas/VallasAdmin.vue'));
Vue.component('vallas-editar', require('./components/vallas/VallasEditar.vue'));
Vue.component('vallas-mapa', require('./components/vallas/VallasMapa.vue'));
Vue.component('vallas-mapa-externo', require('./components/vallas/VallasMapaExterno.vue'));

Vue.component('contratos-admin', require('./components/contratos/ContratosAdmin.vue'));
Vue.component('contratos-editar', require('./components/contratos/ContratosEditar.vue'));
Vue.component('contratos-editar-todo', require('./components/contratos/ContratosEditarTodo.vue'));

Vue.component('terrenos-admin', require('./components/terrenos/TerrenosAdmin.vue'));
Vue.component('terrenos-editar', require('./components/terrenos/TerrenosEditar.vue'));
Vue.component('terrenos-modal', require('./components/terrenos/TerrenosModal.vue'));



Vue.component('step-navigation-step', {

    template: `<li :class="indicatorclass">
            <div class="step"><i :class="step.icon_class"></i></div>
            <div class="caption hidden-xs hidden-sm">
                Step {{ step.id }}: {{ step.title }}
            </div>
        </li>`,

    props: ['step', 'currentstep'],

    computed: {
        indicatorclass: function() {
            return {
                'active': (this.step.id == this.currentstep),
                'complete': (this.currentstep > this.step.id)
            }
        }
    }
});

Vue.component('step-navigation', {
    data: function () {
        return {
            indicatorclass: false
        }
    },
    template: `<ol class="step-indicator">
            <li
                v-for="step in steps"
                is="step-navigation-step"
                :step="step"
                :currentstep="currentstep">
            </li>
        </ol>`,

    props: ['steps', 'currentstep']
});

Vue.component('step-controls', {

    template: `<div class="step-wrapper" :class="{ 'active': active }">
    <button class="btn btn-primary" @click="lastStep()" :disabled="firststep">Back</button>
    <button class="btn btn-primary" @click="nextStep()" :disabled="laststep">Next</button>
    <button class="btn btn-primary" v-if="laststep">Submit</button>
    </div>`,

    props: ['step', 'stepcount', 'currentstep'],

    computed: {
        active: function() {
            return (this.step.id == this.currentstep)
        },

        firststep: function() {
            return (this.currentstep == 1)
        },

        laststep: function() {
            return (this.currentstep == this.stepcount)
        }
    },

    methods: {
        nextStep: function() {
            this.$emit('step-change', this.currentstep + 1)
        },

        lastStep: function() {
            this.$emit('step-change', this.currentstep - 1)
        }
    }
});



import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCoIaJVc-h-KyMOkxaS0tl72-TADPHYxs0',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
  
      //// If you want to set the version, you can do so:
      // v: '3.26',
    },
  
    //// If you intend to programmatically custom event listener code
    //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
    //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
    //// you might need to turn this on.
    // autobindAllEvents: false,
  
    //// If you want to manually install components, e.g.
    //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
    //// Vue.component('GmapMarker', GmapMarker)
    //// then set installComponents to 'false'.
    //// If you want to automatically install all the components this property must be set to 'true':
    installComponents: true
  })

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
