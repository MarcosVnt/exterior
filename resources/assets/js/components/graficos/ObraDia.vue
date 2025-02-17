<template>
<!-- <main class="main">
 -->   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="car-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Horas Trabajadas por Obra en el día : </h4>
                            </div>
                            <div class="form-group col-md-12">
                                <h3 class="col-md-3">Seleccione Fecha</h3>
                                <input type="date" class="form-control col-md-3" placeholder="Date" v-model="fecha.dia" @change=" getObrasyHoras(fecha.dia)"> 
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="obraHoras">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                               <!--  <p>Horas por Obra en el dia de :</p><h3>{{fecha.dia}}</h3>  -->
                            </div>
                        </div>
                     
                    </div>
                   
                </div>
                <div class="row  border-end border-secondary">
                  
                    <div class="col-md-12 row m-2 justify-content-md-center  " v-for="obra in ObraHoras " :key="obra.id">
                         <div class="col-md-6">
                        [{{obra.codigo}}]  - <h6>{{obra.nombre}}</h6>
                         </div> 
                         <div class="col-md-3">
                             {{obra.minutos/60}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- </main>-->
</template>
<script>
  import moment from 'moment'

    export default {
        
        data (){
            return {
                fecha:{
                        dia : '2017-07-04'
                    },
               
               
                varHoras:null,
                charHoras:null,
                ObraHoras:[],
                varTotalHoras: [],
                varObraHoras: [],
                varNombreObra: [],
 labels: ["Red", "Blue", "Yellow"],
        votes: [12, 19, 3]

              
            }
        },
        methods : {
            getDia(){
                  let me=this;
                var fecha = new Date();
                if (fecha) {
                    me.fecha.dia= moment(String(fecha)).format("YYYY-MM-DD");
                    console.log(me.fecha.dia);
                    }
                 var dia = fecha.getDate();
                 var mes = fecha.getMonth()+1;
                 var ano = fecha.getFullYear();
                
                  
                //console.log(fecha);

                 /* this.dia = dia+'-'+mes+'-'+ano; */
                 this.dia=me.fecha.dia;
                
                 
                  //console.log(this.dia); 
                  

            },
            initgrafico(){
                
                 
               this.varHoras=null;
              //  this.charHoras=null;
                this.ObraHoras=[];
                this.varTotalHoras=[];
                this.varObraHoras=[];
                this.ObraHoras=[];
               //  this.charHoras= null;
                 //console.log('iiiiiiiiiiiiiiiinitgrafico');
                 //console.log(this.ObraHoras);
                 //console.log(this.charHoras);
            },
            getObrasyHoras(dia){
                let me=this;
                                //console.log('getObrasyHOras--------------------INI');
                this.initgrafico();
               
                //console.log(dia);
                var url='/obra/horas?dia='+dia;
                              

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ObraHoras = respuesta.horasPorDia;
                    //console.log('getObrasyHOras--------------------ObraHoras');
                    //console.log(me.ObraHoras);
                    //cargamos los datos del chart
                    me.loadHorasObras();
                    //console.log('getObrasyHOras--------------------AXIOX');
                })
                .catch(function (error) {
                    //console.log('getObrasyHOras--------------------error');
                    //console.log(error);
                });
            },


             loadHorasObras(){
                let me=this;

                console.log('loadHorasObras--------------------INI');
                console.log(me.ObraHoras);

                me.ObraHoras.map(function(x){
                    me.varObraHoras.push(x.codigo);
                    me.varNombreObra.push(x.nombre);
                    me.varTotalHoras.push(x.minutos/60);
                });
               
                me.varHoras=document.getElementById('obraHoras').getContext('2d');
                //console.log(me.varObraHoras);
               
               // if (me.charHoras != undefined) me.charHoras.destroy();
                console.log(me.charHoras);
                if (me.charHoras != undefined){
          console.log('111111111');
         me.charHoras.destroy();
      }else{
              console.log(me.charHoras);

          console.log('22222222222222',me.ObraHoras);
          }

                      console.log(me.charHoras);

               me.charHoras = new Chart(me.varHoras, {
                    type: 'bar',
                    data: {
                        labels: me.varObraHoras,
                        datasets: [{
                            label: 'Horas',
                            data: me.varTotalHoras,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 1
                        }
                        /* ,
                        {
                            label: 'Nombre:',
                            data: me.varTotalHoras,
                        } */
                        
                        ]
                    },
                    options: {
                        responsive: true,
    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                    
                });

                  console.log(me.charHoras);
            }


            
        },
        mounted() {
            this.initgrafico();
            this.getDia();
            this.getObrasyHoras(this.dia);//DIA??
           
        }
    }
</script>
