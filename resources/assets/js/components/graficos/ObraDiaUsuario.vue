<template>
<main class="main">
   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="car-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Horas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="obraHoras">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Horas por Obra en el dia de hoy.</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ventas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventas">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Ventas de los últimos meses.</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</main>
</template>
<script>
    export default {
        props : ['ruta'],
        data (){
            return {
                varHoras:null,
                charHoras:null,
                ObraHoras:[],
                varTotalHoras: [],
                varObraHoras: [],
 labels: ["Red", "Blue", "Yellow"],
        votes: [12, 19, 3]

              
            }
        },
        methods : {
            getObrasyHoras(dia){
                let me=this;
                                console.log('getObrasyHOras--------------------INI');

                console.log(dia);
                var url='/obra/horas/usuario?dia='+dia;
                               

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ObraHoras = respuesta.horasPorDiaUsuario;
                    console.log('getObrasyHOras--------------------ObraHoras');
                    console.log(me.ObraHoras);
                    //cargamos los datos del chart
                    me.loadHorasObras();
                    console.log('getObrasyHOras--------------------AXIOX');
                })
                .catch(function (error) {
                    console.log('getObrasyHOras--------------------error');
                    console.log(error);
                });
            },


             loadHorasObras(){
                let me=this;

                 console.log('loadHorasObras--------------------INI');
                console.log(me.ObraHoras);

                me.ObraHoras.map(function(x){
                    me.varObraHoras.push(x.codigo);
                    me.varTotalHoras.push(x.minutos/60);
                });
                console.log('loadHorasObras--------------------INI');
                console.log(me.varObraHoras);
                console.log(this.labels);
                console.log(me.varTotalHoras);
                console.log(this.votes);
                console.log('loadHorasObras--------------------FIN');
                me.varHoras=document.getElementById('obraHoras').getContext('2d');
                      if (me.charHoras != undefined) me.charHoras.destroy();

                console.log(me.varObraHoras);
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
                        }]
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
            },


            
        },
        mounted() {
            this.getObrasyHoras('18/11/05');//DIA??
           
        }
    }
</script>
