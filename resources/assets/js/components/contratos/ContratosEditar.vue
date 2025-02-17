<template>
<!--Inicio del modal agregar/actualizar-->
   
   <div>
            <h2>Contrato</h2>
            <div class="card-body">

                <div class="form-group row">
                  
               
                    <label class="col-md-2 form-control-label" for="cliente-input">Cliente</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="contrato.cliente.nombre"
                            class="form-control"
                            placeholder="Cliente Nombre"
                            readonly
                        />
                    </div>

                      <label class="col-md-2 form-control-label" for="Agencia-input">Anunciante</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="agencia.nombre"
                            class="form-control"
                            placeholder="Anunciante Nombre"
                            readonly
                        />
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="Terreno-input">Terreno</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="terreno.nombre"
                            class="form-control"
                            placeholder="Terreno Nombre"
                            readonly
                        />
                    </div>
               
                    <label class="col-md-2 form-control-label" for="provincia-input">Valla</label>
                    <div class="col-md-4">
                        <input
                            type="text"
                            v-model="valla.dni"
                            class="form-control"
                            placeholder="Valla Nombre"
                            readonly
                        />
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Ejercicio </label>
                        <div class="col-md-3">
                        <input
                            type="number"
                            v-model="contrato.ejercicio"
                            class="form-control"
                            placeholder="Ejercicio"
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="descripcion-input">Numero </label>
                        <div class="col-md-5">
                            <input
                                type="number"
                                v-model="contrato.numero"
                                class="form-control"
                                placeholder="Numero"
                            />
                        </div>
                    </div>
              

                 <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="referencia-input">Referencia </label>
                        <div class="col-md-3">
                        <input
                            type="text"
                            v-model="contrato.referencia"
                            class="form-control"
                            placeholder="referencia"
                        />
                        </div>
                   
                        <label class="col-md-2 form-control-label" for="descripcion-input">Descripcion </label>
                        <div class="col-md-5">
                            <input
                                type="text"
                                v-model="contrato.descripcion"
                                class="form-control"
                                placeholder="Descripcion"
                            />
                        </div>
                    </div>
              
              
                    <div class="form-group row">
                        <label class="col-md-1 form-control-label" for="direccion-input">Fecha Incio</label>
                        <div class="col-md-3">
                            <input
                                type="date"
                                v-model="fechaII"
                                class="form-control"
                                placeholder="fecha inicio "
                            />
                        </div>
               
                    <label class="col-md-1 form-control-label" for="codigo-input">Fecha Final</label>
                    <div class="col-md-3">
                        <input
                            type="date"
                            v-model="fechaFF"
                            class="form-control"
                            placeholder="Fecha Final"
                        />
                    </div>
                    <label class="col-md-1 form-control-label" for="codigo-input">Duracion</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            v-model="contrato.duracion"
                            class="form-control"
                            placeholder="Duracion"
                        />
                    </div>
                </div>

                  <div class="form-group row">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" rows="3" v-model="contrato.observaciones"></textarea>
                </div>
  

             <div class="form-group row">
                    <label class="col-md-1 form-control-label" for="direccion-input">Forma de Pago</label>
                    
                           <select 
                            @change="calcularAlquiler($event)"
                            class="form-control col-md-3" 
                            id="forma_pago" v-model="contrato.forma_pago">
                   
                            <option value="12">Mensual</option>
                            <option value="4">Trimestral</option>
                            <option value="2">Semestral</option>
                            <option value="1">Anual</option>
                            <option value="1">Otras</option>
                        
                        
                            </select>
                        
                    <label class="col-md-1 form-control-label" for="direccion-input">Importe Periodo</label>
                        <div class="col-md-3">
                            <input
                                type="number"
                                v-model="contrato.importe_periodo"
                                class="form-control"
                                placeholder="Importe Periodo "
                                 @change="calcularAlquiler($event)"
                            />
                        </div>
               
                    <label class="col-md-1 form-control-label" for="codigo-input">Alquiler Anual</label>
                    <div class="col-md-3">
                        <input
                            type="number"
                            v-model="contrato.alquiler_anual"
                            class="form-control"
                            placeholder="Alquiler Anual"
                        />
                    </div>

                     <label class="col-md-1 form-control-label" for="direccion-input">Estado</label>
                    
                           <select class="form-control col-md-3" id="estado" v-model="contrato.baja">
                   
                            <option value="2">Baja</option>
                            <option value="1">Alta</option>
                           
                        
                        
                            </select>
            </div>

            <div class="form-group row">
                    <button
                        type="button"
                        @click="guardarFormulario"
                        class="btn btn-success"
                        >
                        <i class="icon-plus"></i>&nbsp;Guardar Datos    
                    </button>
                    <button
                        type="button"
                        @click="duplicarContrato"
                        class="btn btn-warning"
                        >
                        <i class="icon-eye"></i>&nbsp;Duplicar Contrato    
                    </button>

            </div>







            </div>
        </div>



</template>

<script>
 import moment from "moment";

export default {

   
     props: {
             modal : Number,
            
             contratoE: Object,
             
        },
    data(){
        return {

            editoCliente: false,
            editoAgencia: false,
            
            fechaFF: '',
            fechaII: '',
            vallaEnviada : [],

            center: {lat: 5, lng: -5 },
            longitud: 0,

            latitud: 0,

            infoWindowOptions:{
                pixelOffset:{
                    width:0,
                    height: -55
                }
            },
            infoWindowOpened: false,

            tieneTerrenos : false, 
            activeValla : {},
            valla:{
                id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    longitud : '',
                    latitud : '',
                    ancho : 1,
                    alto : 1,
                    m2 : 1,
                    tipo : 'Valla',
                    elemento : 'Vinilo',
                    estado : 'Libre'

            },
           
               agencia: {
                    id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
            },
            cliente: {
                id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
            },
             terreno: {
                id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
            },
            contrato: {
                id: 0,
                ejercicio : (new Date()).getFullYear(),
                numero: 0,
                agencia_id: 0,
                cliente_id: 0,
                valla_id : 0,
                referencia : '',
                descripcion: '',
                observaciones : '',
                fecha_inicio: '',
                fecha_final: '',
                duracion: '',
                forma_pago: '12',
                importe_periodo: 0,
                alquiler_anual:0,
                baja: 1,
                valla:{
                    id : 0,
                        dni : '',
                        nombre : '',
                        direccion : '',
                        poblacion : '',
                        postal : '',
                        provincia :  '',
                        telefono : '',
                        email : '',
                        longitud : '',
                        latitud : '',
                        ancho : 1,
                        alto : 1,
                        m2 : 1,
                        tipo : 'Valla',
                        elemento : 'Vinilo',
                        estado : 'Libre'

                },
                agencia: {
                    id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
                 },
                  cliente: {
                    id : 0,
                    dni : '',
                    nombre : '',
                    direccion : '',
                    poblacion : '',
                    postal : '',
                    provincia :  '',
                    telefono : '',
                    email : '',
                    observaciones: '',
            },

            },
            mostrarBuscar: 0,
            textoBuscar: '',
            arrayPropietarios:[],
            arrayTerrenos:[],
            pagination:'',
            pagesNumber: '',

            currentstep : 1,
            indicatorclass: true,
            step: 1,
            active: 1,
            firststep: true,
            nextStep:"",
            lastStep: "",
            laststep: false,
            errores: "",
            steps: [
                {
                    id: 1,
                    title: 'Datos Propietario',
                    icon_class: "fa fa-user-o"
                }, {
                    id: 2,
                    title: 'Datos Terreno',
                    icon_class: "fa fa-folder-open"
                }, {
                    id: 3,
                    title: 'Datos Valla',
                    icon_class: "fa fa-paper-plane"
                }
                , {
                    id: 4,
                    title: 'Ubicacion Maps',
                    icon_class: "fa fa-map-marker"
                }
            ]



        }
    },
     mounted() {
             let me = this;
             console.log('mounted, Inicio',this.contratoE);
             me.cargarDatosContrato(me.contratoE);
        
     },
      filters: {
        fechaF: function (value) {
        //console.log('fecha-->',value);
        if (!value) return "";
        return moment(String(value)).format("DD/MM/YYYY");
        },
    },
 
   
     methods: {

            calcularAlquiler(e){
                console.log('2102',e);

            },


           duplicarContrato(){
            console.log('duplicarContrato',);
             let me = this;

             me.contrato.agencia_id = me.agencia.id;
             me.contrato.cliente_id = me.cliente.id;
             me.contrato.valla_id = me.valla.id;
             me.contrato.id = 0 ;

            // me.contrato.ejercicio = (new Date()).getFullYear();
             //me.contrato.numero =0;



           // if (me.terrenos= true){return};
            axios
                .post("/contrato/create", {
                data: {
                    contrato: this.contrato,
                    agencia: this.agencia,
                    cliente: this.cliente,
                  
                },
                })
                .then(function (response) {
                    me.$emit('modalRecibido', {modal: '0'})


                })

                .catch((err) => {
                    me.errores = err;
                    me.currentstep = 4;
                     if (err.response.status === 401 || err.response.status === 419) {
                            window.location = "/login";
                        }
                });

        },
        
         cargarDatosContrato(v){
                let me = this;
       
                var url ="/api/contrato/datos/"+v.id;

                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.contrato = response.data.contrato;
                    me.valla = me.contrato.valla;
                    me.agencia = me.contrato.agencia;
                    me.cliente = me.contrato.cliente;
                    me.terreno = me.valla.terreno;
                  
                     let fechaI =  me.contrato['fecha_inicio'];
                    me.fechaII = moment(fechaI).format('YYYY-MM-DD');

                    let fechaF =  me.contrato['fecha_final'];
                    me.fechaFF = moment(fechaF).format('YYYY-MM-DD');

               

                    })
                    .catch(function (error) {
                    console.log(error);
                    if (error.response.status === 401 || error.response.status === 419) {
                        window.location = "/login";
                    }
            });

         },
         guardaError(type,message, stack){

                axios.post('/log-error', {
                        type: type,
                        message: message,
                        stack: stack,
                    });

         },
      
      
         guardarFormulario(){
             let me = this;
           this.contrato.fecha_inicio = this.fechaII;
           this.contrato.fecha_final = this.fechaFF;
            axios
                .post("/contrato/update", {
                data: {
                    contrato: this.contrato,
                  
                },
                })
                .then(function (response) {
                console.log("guardarFormulario", response, response.data);
                           // me.$emit('modalR', 0)
                
                me.contratoEnviado = response.data;

                me.guardaError('log','Contrato actualizado','guardarFormulario');


                console.log("guardarFormulario", me.contratoEnviado, response.data);
                me.$emit('modalRecibido', {modal: '0'})


                })

                .catch((err) => {
                    console.log('guardarFormulario',err);
                    me.errores = err;
                    me.currentstep = 4;

                    axios.post('/log-error', {
                        type: 'Axios Request Failure',
                        message: me.err.message,
                        stack: me.err.stack || 'N/A',
                    });



                     if (error.response.status === 401 || error.response.status === 419) {
                       
                       
                       
                       window.location = "/login";
                    }
                });

        },
     


     },
    computed: {
      
      
        
    }

    
  };

</script>
<style>

body {
	 padding: 0;
	 margin: 0;
	 background-color: #f6f6f6;
	 font-family: 'Roboto', sans-serif;
}
 .container {
	 width: 1000px;
	 background-color: #fff;
}
 .step-wrapper {
	 padding: 20px 0;
	 display: none;
}
 .step-wrapper.active {
	 display: block;
}
 .step-indicator {
	 border-collapse: separate;
	 display: table;
	 margin-left: 0px;
	 position: relative;
	 table-layout: fixed;
	 text-align: center;
	 vertical-align: middle;
	 padding-left: 0;
	 padding-top: 20px;
}
 .step-indicator li {
	 display: table-cell;
	 position: relative;
	 float: none;
	 padding: 0;
	 width: 1%;
}
 .step-indicator li:after {
	 background-color: #ccc;
	 content: "";
	 display: block;
	 height: 1px;
	 position: absolute;
	 width: 100%;
	 top: 32px;
}
 .step-indicator li:after {
	 left: 50%;
}
 .step-indicator li:last-child:after {
	 display: none;
}
 .step-indicator li.active .step {
	 border-color: #4183d7;
	 color: #4183d7;
}
 .step-indicator li.active .caption {
	 color: #4183d7;
}
 .step-indicator li.complete:after {
	 background-color: #87d37c;
}
 .step-indicator li.complete .step {
	 border-color: #87d37c;
	 color: #87d37c;
}
 .step-indicator li.complete .caption {
	 color: #87d37c;
}
 .step-indicator .step {
	 background-color: #fff;
	 border-radius: 50%;
	 border: 1px solid #ccc;
	 color: #ccc;
	 font-size: 24px;
	 height: 64px;
	 line-height: 64px;
	 margin: 0 auto;
	 position: relative;
	 width: 64px;
	 z-index: 1;
}
 .step-indicator .step:hover {
	 cursor: pointer;
}
 .step-indicator .caption {
	 color: #ccc;
	 padding: 11px 16px;
}
</style>