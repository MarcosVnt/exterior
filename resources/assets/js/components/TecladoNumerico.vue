<template>
  <!--  <div class="input">
    <label>Amount: </label>
    <NumericInput placeholder="touch to input" v-model="amount" />
  </div>-->

  <div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i> Teclado
      </div>
      <div class="card-body">
        <div class="playground">
          <!-- All you need to play with -->

          <div class="numpad">
            <div class="button" name="1" value="1" id="1" @click="addNumber('1')">1</div>
            <div class="button" @click="addNumber('2')">2</div>
            <div class="button" @click="addNumber('3')">3</div>
            <div class="button" @click="addNumber('4')">4</div>
            <div class="button" @click="addNumber('5')">5</div>
            <div class="button" @click="addNumber('6')">6</div>
            <div class="button" @click="addNumber('7')">7</div>
            <div class="button" @click="addNumber('8')">8</div>
            <div class="button" @click="addNumber('9')">9</div>
            <div class="button" @click="addNumber('0')">0</div>
            <div class="button" @click="validar()">OK</div>
            <div class="button" @click="reset()">BORRAR</div>

            <div class="button">
              <div>{{valorAMostrar}}</div>
              <BR />
              <div>{{mensaje}}</div>
            </div>
           <h6> ver.20</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
//import { NumericInput } from 'resources/assets/plantilla/js/numeric_keyboard.vue.js'
//import { NumericInput } from 'numeric-keyboard'
//'numeric-keyboard$': 'numeric-keyboard/dist/numeric_keyboard.vue.js'

export default {
  components: {
    // NumericInput
  },
  data() {
    return {
      horasReales : [],
      amount: "",
      valor: "",
      mensaje: "",
      valorAMostrar: "",
      tipoRegistro : "tipoRegistro",
      hoy :'',
      dia :'',
      hora :'',
      quehora: '',
    }
  },
  mounted() {
            this.reset();
            this.getFecha();
            
        },
  methods: {
       addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
},
      getFecha() {
      var fecha = new Date();
      var dia = this.addZero(fecha.getDate());
      var mes = this.addZero(fecha.getMonth() + 1);
      var ano = fecha.getFullYear();
      var hora = this.addZero(fecha.getHours());
      var min = this.addZero(fecha.getMinutes());


      this.hoy = dia + "-" + mes + "-" + ano + " "+hora+':'+min;
            this.dia = ano + "-" + mes + "-" + dia ;
            this.queHora =  hora + ':' + min;


            console.log('fecha', fecha,'this.hoy '+this.hoy);

    },
    validar() {
      console.log("validar");
      this.getFecha();
      let codigo = this.valor;
      let tipoReg = 'Entrada';// this.tipoRegistro;
      let hoy = this.hoy;
      let horas = this.queHora;
      let dia = this.dia;
      let horasReales = this.horasReales;
      this.reset();
            console.log("valor a buscar ", codigo);


 
               
                var url= '/teclado/validar?codigo=' + codigo+'&fecha='+dia;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var seHaPasado = respuesta.turnosLleva >= (respuesta.turnosTiene*2);
                        var esEntradaOSalida = respuesta.turnosLleva%2;
                        var turnosLleva = respuesta.turnosLleva;
                    horasReales = respuesta.horasReales;
                    console.log('VALIDAR - RESPUESTA : ',horasReales,horasReales[1]);
                    //CALCULO TipoReg
                    if (respuesta.turnosLleva%2) {
                        tipoReg = 'Salida';
                                                console.log(esEntradaOSalida,'ifffffffffff',respuesta.turnosLleva%2);

                    }else{
                        console.log(esEntradaOSalida,'else',respuesta.turnosLleva%2);
                    }

                    
                    //console.log(respuesta.validar[0]['name'],'TECLADO/VALIDAR',respuesta.validar.length);
console.log(respuesta.turnosLleva%2,'TECLADO/VALIDAR',respuesta,
'tipo rega',tipoReg,
respuesta.turnosLleva,respuesta.turnosTiene*2,
respuesta.turnosLleva > (respuesta.turnosTiene*2),seHaPasado);
                   
                    //TEST 1 
                    if (respuesta.validar.length==0) {
                        swal('CODIGO INCORRECTO !', 'Repita de nuevo le quedan aun intentos.', 'warning');
                        return;
                    }

                    //TEST 2
                    if(seHaPasado===true) {
                        console.log('sehapasado.true');
                        swal('Aviso !', 'Ha excedido Los registros Permitidos.', 'warning');
                        return;

                    }else {
                        /* console.log('sehapasado.false');
                        swal('Aviso !', 'Ha registro fallido , repita el proceso.', 'warning');
                        return; */
                    
                    }
                    //

                    if (respuesta.validar.length==1 ){ //swal('BIENVENIDO ! '+respuesta.validar[0]['name'], 'Se procede al registro de '+tipoReg+ ' Del Dia :  '+hoy, 'success');;
                        let user = respuesta.validar[0]['id'];
//                            title:'BIENVENIDO ! '+respuesta.validar[0]['name']+ '  -  Se procede al registro de '+tipoReg+ ' Del Dia :  '+hoy,


                    swal({
                             title: ' BIENVENIDO  <strong>'+respuesta.validar[0]['name']+'</strong>',
                            type: 'info',
                            html:
                                'Se procede al registro de <strong><b>'+tipoReg+
                                '  '+horasReales[turnosLleva+1]+
                                '<br /> Del Dia :  '+hoy+'<b></strong>',
                                
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Aceptar!',
                            cancelButtonText: 'Cancelar',
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            buttonsStyling: false,
                            reverseButtons: true
                            }).then((result) => {
                            if (result.value) {
                                let me = this;
                                console.log('ENVIAR PARA REGISTRAR ','turnoslleva',turnosLleva, 'horasReales',horasReales[turnosLleva+1]);
                                //result.value,'USER',user,'IDA',dia,'hora',horas,'horasReales',horasReales,'turnoslleva',turnosLleva, 'horasReales',horasReales[turnosLleva+1]);
                                 axios.put('/teclado/registrar',{
                                    'id': user,
                                    'fecha': dia,

                                    'hora': horas,
                                    'horasReales':horasReales[turnosLleva+1],
                                    'turnosLleva' : turnosLleva,
                                    //'observaciones':
                                    

                                }).then(function (response) {
                                   
                                   console.log(user,dia, horas,'GRABO PARTE HORA',response);
                                
                                      swal({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            type: "success",
                                            background: "#179e6e",
                                            title: "REGISTRO GRABADO! EL registro se ha grabado correctamente "
                                            });

                                }).catch(function (error) {
                                    console.log(error);
                                   /*  if (error.response.status === 401) {
                                    window.location = "/login";
                                    }   */
                                }); 
                                
                                
                            } else if (
                                // Read more about handling dismissals
                                result.dismiss === swal.DismissReason.cancel
                                

                                
                            ) {
                                 swal({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            type: "warning",
                                            background: "#f86c6b",
                                            title: "CANCELAR --- NO SE HA GRABADO NINGUN REGISTRO  "
                                            });
                                
                            }else{
                              console.log('ELES CANCESL',swal.DismissReason);
                                swal({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            type: "warning",
                                            background: "#f86c6b",
                                            title: "CANCELAR --- NO SE HA GRABADO NINGUN REGISTRO  "
                                            });
                            }
                            })
               
               
               } 
                //fin swal
                })
                .catch(function (error) {
                    console.log(error);
                });
            






    },
    reset() {
      console.log("reset");
      this.valorAMostrar = "";
      this.valor='';
      this.mensaje = "";
      
    },
    
    uno(n) {
      console.log("UNO", n);
    },
    addNumber(n) {
      console.log("n", n);

      this.valor = this.valor + n; //val( v + e.value );
      this.valorAMostrar = this.valorAMostrar + "*";
     // var v = this.valor;

      console.log(this.valor, " - this.vlaor -", this.valor.length);
      if (this.valor.length == 4) {
        console.log("iniciar busqueda");
        this.valorAMostrar='';
        this.mensaje = "INCIAR BUSQUEDA";
        this.validar();
      }
      if (this.valor.length > 4) {
        console.log("mahor de 4");
        this.valorAMostrar='';
        this.valor='';
        this.mensaje = "LONGITUD INCORRECTA";
      }
    }
  }
};
</script>


<style>
.numpad {
  width: 420px;
  height: 500px;

  display: flex;
  flex-flow: row wrap;
       font-size: 2rem; 
    font-weight: bold;
}
.button {
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 1 0 33.3333%;

  color: white;
  border: 1px solid rgba(255, 255, 255, 0.25);
}

.playground {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #41668c;
}
</style>