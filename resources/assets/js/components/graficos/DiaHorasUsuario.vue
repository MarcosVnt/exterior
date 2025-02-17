<template>
<main class="main">
   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="car-body">
               <!--  <div class="row"> -->
                    <!-- <div class="col-md-12"> -->
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Horas</h4>
                            </div>
                          
                             <div class="form-group col-md-12">
                                <h3 class="col-md-3">Seleccione Fecha</h3>
                                <input type="date" class="form-control col-md-3" placeholder="Date" v-model="fecha.dia" @change="getDiaHorasUsuario(fecha.dia)"> 
                            </div>
                           <div class="card-content" >
                                <div class="chart-container" style="position: relative;height: 40vh; width: 80vw;">
                                    <canvas id="dhu" ></canvas>
                                </div>
                               <!--  <div class="ct-chart">
                                    <canvas id="dhu">                                                
                                    </canvas>
                                </div> -->
                            </div> 
                            <div class="card-footer">
                                <p>Horas por Usuario en el dia de </p> <h3>{{fecha.dia}}</h3>
                            </div>
                        </div>
                   <!--  </div> -->
                   
               <!--  </div> -->
            </div>
        </div>
    </div>

</main>
</template>
<script>
import moment from "moment";

export default {
  data() {
    return {
      //charjs
      graf: {
        varHoras: null,
        charHoras: null,
        usuarioHoras: [],
        varTotalHoras: [],
        varUsuarioHoras: []
      },

      labels: ["Red", "Blue", "Yellow"],

      fecha: {
        dia: "2019-05-21"
      },
      consulta: {
        hdu: null
       

      }
    };
  },
  methods: {
    initgrafico() {
      this.varHoras = null;
      this.charHoras = null;
      this.ObraHoras = [];
      this.varTotalHoras = [];
      this.varObraHoras = [];
      this.ObraHoras = [];
      this.charHoras = null;
     
    },
    getDia() {
      let me = this;
      var fecha = new Date();
      if (fecha) {
        me.fecha.dia = moment(String(fecha)).format("YYYY-MM-DD");
        //console.log(me.fecha.dia);
      }
      var dia = fecha.getDate();
      var mes = fecha.getMonth() + 1;
      var ano = fecha.getFullYear();

      //console.log(fecha);

      /* this.dia = dia+'-'+mes+'-'+ano; */
      this.dia = me.fecha.dia;

      //console.log(this.dia);
    },

    getDiaHorasUsuario(dia) {
      let me = this;

      var url = "/usuario/horas?dia=" + dia;

      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.consulta.hdu = respuesta.horasDiaUsuario;
     console.log('getDiaHorasUsuario');
console.log(me.consulta.hdu);
          //cargamos los datos del chart
          me.loadHorasUsuario();
        })
        .catch(function(error) {
          //console.log('getObrasyHOras--------------------error');
          //console.log(error);
        });
    },

    loadHorasUsuario() {
      let me = this;
      
      me.graf.varTotalHoras=[];
      me.graf.varUsuarioHoras=[];
      //init cero porque duplicaba columnas al cambiar de dia en calendario

      me.consulta.hdu.map(function(x) {
        
        me.graf.varUsuarioHoras.push(x.name);
        me.graf.varTotalHoras.push(x.minutos2 / 3600);
        //console.log( me.graf.varUsuarioHoras);
        //console.log( me.graf.varTotalHoras);
      });
      console.log('loadHorasUsurio');
      console.log(me.consulta.hdu);

 me.initgrafico();
      me.graf.varHoras = document.getElementById("dhu").getContext("2d");

      if (me.graf.charHoras != undefined) me.graf.charHoras.destroy();

      me.graf.charHoras = new Chart(me.graf.varHoras, {
        type: "bar",
        data: {
          labels: me.graf.varUsuarioHoras,
          datasets: [
            {
              label: "Horas",
              data: me.graf.varTotalHoras,
              backgroundColor: "rgba(255, 99, 132, 0.2)",
              borderColor: "rgba(255, 99, 132, 0.2)",
              borderWidth: 1
            }
          ]
        },
        options: {
            responsive: true,
    maintainAspectRatio: false,
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true
                }
              }
            ]
          }
        }
      });
      // //console.log(me.graf.charHoras);
    }
  },
  mounted() {
    this.initgrafico();
    this.getDia();
    this.getDiaHorasUsuario(this.fecha.dia); //DIA??
  }
};
</script>
