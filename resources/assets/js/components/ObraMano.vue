<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card" >
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Parte de trabajo
                        <!-- <button type="button" @click="abrirModal('obraHora','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button> -->
                    </div>
                    <div class="card-body" >

                        
                           
                              
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputUsuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" v-model="usuarioNombre" readonly >
                                </div>
                                 
                                 <div class="form-group col-md-8">
                                     <label for="selectObrar">Obra</label>
                                    
                                    <select v-model="selectObra" class="form-control"  @change="actualizaCodigoObra(selectObra)">
                                            <option value="0" disabled>Seleccione Obra</option>
                                            <option v-for="obras in arrayObraUsuario" :key="obras.id" :value="obras.codigo" v-text="obras.codigo" ></option>
                                        </select>

                                </div>
                            </div>
                            <!-- busca obra x codigo -->
                            <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Codigo de obra</label>
                                    <div class="col-md-4">
                                    <input type="text" v-model="buscar" @keyup.enter="buscarObra(buscar)" class="form-control" placeholder="Introduce Codigo Ej: 001/2018">
                                        
                                    </div>
                                    
                                    <div class="col-md-3">
                                    <button type="submit" v-on:click.stop.prevent="buscarObra(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        
                                    </div>
                                    

                                </div>

                             </form>
                            <div v-if="buscarResponse" class="col-md-18 is-valid" >
                                <input type="text"  v-model="buscarResponse" class="form-control" placeholder="nombre de la  obra" readonly>
                                
                            </div>
                             <div v-if="buscarResponseError" class="col-md-18 danger" >
                                <input type="text"  v-model="buscarResponseError" class="form-control" placeholder="nombre de la  obra" readonly>
                                
                            </div>
                            <div v-show="errorObra" class="col-md-12 div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjObra" :key="error" v-text="error">

                                            </div>
                                        </div>
                            </div>

                            <!-- datos del parte -->
                    <div v-if="buscarResponse" class="col-md-18 is-valid" >
                        <form id="form-parte" method="post" v-on:submit="validarEnviarParte">
                            <div class="form-row">
                                 <div class="form-group col-md-2">
                                     <label for="horad">Hora Inicio</label>
                                    
                                    <select v-model="obraHoraD" class="form-control">
                                            <option value="0" disabled> Hora</option>
                                            <option v-for="horaobras in arrayHorasObra" :key="horaobras.value" :value="horaobras.value" v-text="horaobras.text"></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                     <label for="horad">Min. Incio</label>
                                    
                                    <select v-model="obraMinutoD" class="form-control">
                                            <option value="0" disabled> Minuto</option>
                                            <option v-for="minobras in arrayMinutosObra" :key="minobras.value" :value="minobras.value" v-text="minobras.text"></option>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-2">
                                     <label for="fechaParte">Fecha</label>
                                    <input type="text" class="form-control" id="fechaParte" placeholder="Fecha Parte Trabajo"  v-model="hoy">
                                </div>  -->
                                  <div class="form-group col-md-4">
                                     <label for="fechaParte">Fecha</label>


                                 <!--    20200727  
                                     <input type="date" class="form-control " placeholder="Date" v-model="hoy" @change="listarObraMano()"> 
                                  --> 
                                    <select v-model="hoy" class="form-control" @change="listarObraMano()">
                                            <option value="hoy" disabled>Días</option>
                                            <option v-for="dias in arrayfechas" :key="dias.value" :value="dias.value" v-text="dias.text" ></option>
                                    </select> 
                                </div>
                                 <div class="form-group col-sm-2">
                                     <label for="horad">Hora Final</label>
                                     
                                    
                                    <select v-model="obraHoraA" class="form-control" required>
                                            <option value="0" disabled> Hora</option>
                                            <option v-for="horaobras in arrayHorasObra" :key="horaobras.value" :value="horaobras.value" v-text="horaobras.text"></option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                     <label for="horad">Min. Final</label>
                                    
                                    <select v-model="obraMinutoA" class="form-control" required>
                                            <option value="0" disabled> Minuto</option>
                                            <option v-for="minobras in arrayMinutosObra" :key="minobras.value" :value="minobras.value" v-text="minobras.text"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-row">
                              <div class="col-sm-6">
                                     <label for="familia">Tipo de Trabajo {{usuarioRol}}</label>
                                    
                                    <select v-if="usuarioRol==2" v-model="obraFamiliaHora" class="form-control" required>
                                            <option value=" " disabled> Seleccione Tipo de Trabajo</option>

                                            <option value="diseno" > Diseño</option>
                                            <option value="corte" > Corte</option>
                                            <option value="impresion" > Impresion</option>
                                            <option value="manipulado" >Manipulado</option>
                                            <option value="envio" > Envio</option>
                                            <option value="otros" > OTROS</option>
                                            
                                            
                                    </select>
                                      <select v-if="usuarioRol==3" v-model="obraFamiliaHora" class="form-control" required>
                                                <option value=" " disabled> Seleccione Tipo de Trabajo</option>

                                            <option value="fresadora" > Fresadora</option>
                                            <option value="laser" > Láser</option>
                                            <option value="pintura" > Pintura</option>
                                            <option value="fabricacion" > Fabricación</option>
                                            <option value="embalaje" > Embalaje</option>
                                            <option value="envio" > Envío</option>
                                            <option value="montaje" > Montaje</option>


                                            <option value="otros" > OTROS</option>
                                            
                                    </select>


                                     <select v-if="usuarioRol==1 || usuarioRol==7" v-model="obraFamiliaHora" class="form-control" required>
                                               <option value=" " disabled> Seleccione Tipo de Trabajo</option>

                                            <option value="diseno" > Diseño</option>
                                            <option value="corte" > Corte</option>
                                            <option value="impresion" > Impresion</option>
                                            <option value="manipulado" >Manipulado</option>
                                            <option value="envio" > Envio</option>
                                            
                                            <option value="fresadora" > Fresadora</option>
                                            <option value="laser" > Láser</option>
                                            <option value="pintura" > Pintura</option>
                                            <option value="fabricacion" > Fabricación</option>
                                            <option value="embalaje" > Embalaje</option>
                                            <option value="envio" > Envío</option>
                                            <option value="montaje" > Montaje</option>


                                            <option value="otros" > OTROS</option>
                                            
                                    </select>

                                </div>
                                <div class="form-group col-sm-6 text-center">
                                    <label class="'form-checklabel " for="finTrabajo">Marque sólo si es FIN DE TIPO TRABAJO </label>
                                    <input v-model="obraFamiliaFin" type="checkbox" class="form-control form-check-input" id="finTrabajo">

                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                     <label for="Descripcion">Descripcion</label>
                                    <textarea type="text" v-model="descripcionParte" class="form-control" 
                                    :disabled="!obraFamiliaHora"
                                    v-bind:class="{'is-invalid':validaTexto}" id="descripcionParte" placeholder="Descripcion "></textarea>
                                 
                                </div>
                                
                            </div>
                            <!-- Validacion Parte -->
                            <div v-show="errorObraMano" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjObraMano" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>


                             <div class="form-row">

                                <div class="form-group col-md-12">
                                     <label for="Descripcion">Dia horas Seleccionadas</label><br>
                                </div>
                             </div>
                               <div class="form-row btn-success" v-if="obraHoraA > 0">

                                      
                                        <div class="form-group col-md-3">
                                          {{ 'Fecha :'+ hoy }}
                                        </div>
                                        <div class="form-group col-md-3">
                                          {{ 'De hora  '+obraHoraD+':'+obraMinutoD}}
                                        </div>
                                        <div class="form-group col-md-3">
                                          {{' A hora '+obraHoraA+':'+obraMinutoA}}
                                        </div>
                                       
                                
                            </div>
                            <button type="submit" class="btn btn-primary">
                                 Enviar <i class="icon-plus"></i>&nbsp;Parte
                            </button>
                           
                        </form>
                    </div>       
                        
                            
                        </div>

                           
            <!--Fin del modal-->
                    <div v-if="buscarResponse" class="col-md-18 " >
                        <table class="table table-responsive table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Obra -Descripcion</th>
                                    <th scope="col">Hora desde</th>
                                    <th scope="col">Hora Hasta</th>
                                    <th scope="col">Tipo </th>
                                    <th scope="col">Finalizado? </th>

                                    <th scope="col">Descripcion</th>
                               
                                </tr>
                            </thead>
                            
                                        
                            <tbody>
                                <tr v-for="obramano in arrayObraMano" :key="obramano.id">
                                    
                                    <td  >{{obramano.de_fecha_hora | moment("YY.MM.DD")}}</td>
                                    <td scope="row" v-text="obramano.codigo+'-'+obramano.nombre"></td>
                                    <td>{{obramano.de_fecha_hora| moment("HH:mm")}}</td>
                                    <td>{{obramano.a_fecha_hora| moment("HH:mm")}}</td>
                                    <td>{{obramano.tipo_trabajo}}</td>
                                    <td v-if="obramano.fin"> SI </td>
                                    <td v-else> NO </td>
                                    <td>{{obramano.texto}}</td>

<!--                                     <td>{{obramano.de_fecha_hora - obramano.a_fecha_hora |moment("h:mm")}}></td>
 -->
                                    <td>
                                        <button type="button" @click="eliminarParte(obramano.obraManoId)" class="btn btn-warning btn-sm">
                                          <i class="icon-trash"></i>
                                        </button> &nbsp;
                                    </td>                        
                                </tr>                                
                            </tbody>
                             <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                        </table>
                </div>       
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
          
                  <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre Usuarios</label>
                                    <div class="col-md-9">
                                       
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Obra</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="horad" class="form-control" placeholder="Ingrese Hora">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Hora Desde</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="horad" class="form-control" placeholder="Ingrese Hora">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Hora Hasta</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="horaa" class="form-control" placeholder="Ingrese Hora">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                <div v-show="errorObraMano" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjObraMano" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarObraMano()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarObraMano()">Actualizar</button>
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
    export default {
        data (){
    
                        return {
                hoy: 'Dias',
                errorObra : 0,
                errorMostrarMsjObra : [],
                arrayObras :{},
                textoObra:'',
                buscarResponse:'',
                buscarResponseError:'',
                validaTexto : false,
                arrayDias : [
                    {text:'01/01/2018', value:'01/01/2018'},
                    {text:'01/02/2018', value:'01/02/2018'},
                    {text:'01/03/2018', value:'01/03/2018'}
                    

                ],

                arrayHorasObra: [
                    { text: '01', value: '01' },
                    { text: '02', value: '02' },
                    { text: '03', value: '03' },
                    { text: '04', value: '04' },
                    { text: '05', value: '05' },
                    { text: '06', value: '06' },
                    { text: '07', value: '07' },
                    { text: '08', value: '08' },
                    { text: '09', value: '09' },
                    { text: '10', value: '10' },
                    { text: '11', value: '11' },
                    { text: '12', value: '12' },
                    { text: '13', value: '13' },
                    { text: '14', value: '14' },
                    { text: '15', value: '15' },
                    { text: '16', value: '16' },
                    { text: '17', value: '17' },
                    { text: '18', value: '18' },
                    { text: '19', value: '19' },
                    { text: '20', value: '20' },
                    { text: '21', value: '21' },
                    { text: '22', value: '22' },
                    { text: '23', value: '23' },
                    { text: '24', value: '24' },
                    { text: '00', value: '00' }
                ],
                 arrayMinutosObra: [
                    { text: '00', value: '00' },
                    { text: '15', value: '15' },
                    { text: '30', value: '30' },
                    { text: '45', value: '45' },
                    { text: '59', value: '59' }
                ],
                descripcionParte: '',
                obraHoraD :0,
                obraMinutoD:0,
                obraHoraA:0,
                obra: '',
                obraMinutoA:0,
                obraFamiliaHora:'',
                obraFamiliaFin: false,
                
                obraMano_id: 0,
                usuarioNombre: '',
                usuarioId:0,
                usuarioRol:0,
                obraId:0,
                hoy: this.hoy,
                diferencia_horas : '',
                horad : '',
                horaa : '',
                descripcion : '',
                nombre : '',
                selectObra : 0,


                arrayObraUsuario :[],
                arrayObraMano : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorObraMano : 0,
                errorMostrarMsjObraMano : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
            }
        },
        computed:{
           

             missingName: function () { return this.descripcionParte === ''; },
                wrongNumber: function () {
                return (
                    this.isNumeric(this.number) === false ||
                    this.number < 1 ||
                    this.number > 10
                )},

            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                console.log('paaaaaaaaagesNumber');
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        filters:{
            fecha : function (de,a){
                if (!value) return ''
                //value = val
            }

        },
        methods : {
              arrayFechas() {
               
                 console.log('holllllllllllllllll');
                 var fecha = new Date();
                 var dia = fecha.getDate();
                 var ayer = fecha.getDate() - 1;
                 var aayer = fecha.getDate() - 2;
                 console.log(fecha);
                 console.log(dia);
                 console.log(ayer);
                 console.log(aayer);


                 var mes = fecha.getMonth()+1;
                 var ano = fecha.getFullYear();
                 console.log(fecha);
                  
                console.log(ano+'-'+mes+'/'+dia);

                 //this.hoy = ano+'-'+mes+'-'+dia;
                 this.hoy = dia+'-'+mes+'-'+ano;
         console.log('thiiiiiiiiiiii.hoy');
                  console.log(this.hoy);

        var hoy2 = new Date();
         hoy2.setDate( hoy2.getDate());

        var ayer = new Date();
         ayer.setDate( ayer.getDate() - 1 );

        var antesdeayer = new Date();
         antesdeayer.setDate( antesdeayer.getDate() - 2 );
        
        var antesantesdeayer = new Date();
         antesantesdeayer.setDate( antesantesdeayer.getDate() - 3);
        

        
  /*       console.log('aaaaaaaaaaayer'+ayer.getDate()+'-'+(ayer.getMonth()+1)+'-'+ayer.getFullYear());
        console.log(antesdeayer+'antesdeayer'+antesdeayer.getDate()+'-'+(antesdeayer.getMonth()+1)+'-'+antesdeayer.getFullYear());
        console.log('antesdeayer'+antesdeayer);
        console.log('holllllllllllllllll');
 */



                 var arrayfechas2 =[];

                //arrayfechas.push(fecha.toLocaleDateString());
                  //                        {text:'01/01/2018', value:'01/01/2018'},

                /*  arrayfechas2.push({'text' : ano+'-'+mes+'-'+dia,'value' : ano+'-'+mes+'-'+dia});
                  arrayfechas2.push({'text' : ano+'-'+mes+'-'+ayer ,'value' : ano+'-'+mes+'-'+ayer});
                arrayfechas2.push({'text' : ano+'-'+mes+'-'+aayer,'value' : ano+'-'+mes+'-'+aayer});*/
             
             arrayfechas2.push({'text' : hoy2.getFullYear()+'-'+(hoy2.getMonth()+1)+'-'+hoy2.getDate(),'value' : hoy2.getFullYear()+'-'+(hoy2.getMonth()+1)+'-'+hoy2.getDate()});
             arrayfechas2.push({'text' : ayer.getFullYear()+'-'+(ayer.getMonth()+1)+'-'+ayer.getDate(),'value' : ayer.getFullYear()+'-'+(ayer.getMonth()+1)+'-'+ayer.getDate()});
           
          /*  20200727
           arrayfechas2.push({'text' : antesdeayer.getFullYear()+'-'+(antesdeayer.getMonth()+1)+'-'+antesdeayer.getDate(),'value' : antesdeayer.getFullYear()+'-'+(antesdeayer.getMonth()+1)+'-'+antesdeayer.getDate()});
             arrayfechas2.push({'text' : antesantesdeayer.getFullYear()+'-'+(antesantesdeayer.getMonth()+1)+'-'+antesantesdeayer.getDate(),'value' : antesantesdeayer.getFullYear()+'-'+(antesantesdeayer.getMonth()+1)+'-'+antesantesdeayer.getDate()});
 */
 /*                 arrayfechas2.push({'text' : ano+'-'+mes+'-'+dia,'value' : ano+'-'+mes+'-'+dia});
                  arrayfechas2.push({'text' : ano+'-'+'02'+'-'+'01' ,'value' : ano+'-'+'02'+'-'+'01'});
                arrayfechas2.push({'text' : ano+'-'+'01'+'-'+'31','value' : ano+'-'+'01'+'-'+'31'});
 */

                  //arrayfechas.push(ano+'-'+mes+'-'+aayer);

  //var otraFecha = fecha.setDate(fecha.getDate() + 1);
  //var nuevaFecha = new Date(otraFecha);
             /*    console.log('arrrrrrrrrrrrrrrrrray fecha 22222222222');
                 console.log(arrayfechas2); */
                this.arrayfechas = arrayfechas2;
                 //return arrayfechas;
             },


            actualizaCodigoObra(id){
                this.buscar = id;
                this.buscarObra(id);

            },
            validarIdObra(){
                this.errorObra=0;
                //console.log('validarObra1')
                this.errorMostrarMsjObra =[];
                
     

                /* if (!this.buscar) this.errorMostrarMsjObra.push("Codigo de obra no válido o  no puede estar vacío."); */
                //if (this.buscar.length!=8) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.)");
                if (this.buscar.substr(-5,1)!='/') this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.) Ej 1/2018 :"+this.buscar.substr(-5,1));
                if (this.buscar.length>9 || this.buscar.length<6) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta Ej 1/2018)");
                if (this.errorMostrarMsjObra.length) this.errorObra = 1;
                //console.log('validarObra2'+this.errorMostrarMsjObra)

                return this.errorObra;
            },

        buscarObra (buscar, event){
             //this.errorObra=0;
                //console.log('validarObra1')
               // this.errorMostrarMsjObra =[];
                if (event) event.preventDefault()
           
               let me=this;
               me.textoObra = '';  
               
                if (this.validarIdObra()){
                    return;
                }
               /*  me.anoObra=this.buscar.substring(0,2);
                me.codObra=this.buscar.substring(2,6);
                me.cliObra=this.buscar.substring(6,10);
                me.idObra = me.codObra+'/20'+me.anoObra;
                console.log(me.idObra+'-'+me.cliObra); */



               /*  if (this.buscar==''){
                    this.buscarResponse = 'Vacio : CODIGO OBRA VACIO  O NO VALIDO';
                     // console.log(this.buscarResponse);
                      //var url= '/obra' ;
                    return this.buscarResponse;
                } else{
                    var url= '/obra?&buscar='+ this.buscar ;
                    this.buscarResponse = '';
                }
      */
                var url= '/obraid?&buscar='+this.buscar;
                 axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayObras = respuesta.obra.tblobras_registro;
                    if (typeof me.arrayObras === "undefined"){                    
                            //console.log('vacio');
                             me.buscarResponseError = 'Undefined : CODIGO INEXISTENTE';
                                me.buscarResponse= '';
                           /* me.errorMostrarMsjObra.push('Undefined : CODIGO INEXISTENTE');
                             me.errorObra=1; */
                        
                             return me.buscarResponseError;
                        }else{
                            //console.log('no vacio');
                            //console.log(' . '+me.buscarResponse.length+' . ');
                              me.buscarResponseError = '';
                            me.textoObra = me.arrayObras.TEXTO;
                            me.codigoAlta = me.arrayObras.CODIGO;
                           // me.idObraAlta = me.arrayObras.ID_OBRA;
                           //this.obrasUsuario();
                            return me.buscarResponse = me.arrayObras.TEXTO;
                            
                        }
                     //console.log( me.arrayObras.texto);

/* 
                    console.log(response);
                    console.log(response.data);

                    console.log(response.data.obra);
                    console.log(response.data.obra.tblobras_registro); */


                    if (respuesta.length = 0){
                        me.buscarResponseError = 'Length : Respuesta Erronea del Servidor';
                         me.buscarResponse= '';
                       //  this.errorMostrarMsjObra.push("Length : Respuesta Erronea del Servidor");
                        //console.log('axio'+me.buscarResponse);
                    }
                    //debugger
                    //console.log(respuesta);
                    me.buscarResponseError = respuesta.texto;
                       me.buscarResponse= '';
                   // me.arrayObra = respuesta.obraMano.data;
                   // me.pagination= respuesta.pagination;
                                      //  //console.log(me.arrayObraMano);

                })
                .catch(function (error) {
                    me.buscarResponseError = 'Consulta : ERROR DE CONSULTA';
                       me.buscarResponse= '';
                    // this.errorMostrarMsjObra.push("Consulta : ERROR DE CONSULTA");
                    console.log(error);
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                }); 
               // if (this.errorMostrarMsjObra.length) this.errorObra = 1;
            },



            isNumeric: function (n) {
                  return !isNaN(parseFloat(n)) && isFinite(n);
                 },
            validarParte(){
                  this.errorObraMano=0;
                //console.log('validarObra1')
                this.errorMostrarMsjObraMano =[];
                
      /* descripcionParte: '',
                obraHoraD :0,
                obraMinutoD:0,
                obraHoraA:0,
                obraMinutoA:0, */
                console.log(this.obraHoraD);
                if (this.obraHoraD===0) this.errorMostrarMsjObraMano.push("Hora Inicio no puede estar vacio");

                /* if (!this.buscar) this.errorMostrarMsjObra.push("Codigo de obra no válido o  no puede estar vacío."); */
                if (this.obraHoraD===0) this.errorMostrarMsjObraMano.push("Hora Inicio no puede estar vacio");
              
                if (this.obraHoraA===0) this.errorMostrarMsjObraMano.push("Hora Final no puede estar vacio.)");
                if (this.obraMinutoA===0) this.errorMostrarMsjObraMano.push("Minuto Final no puede estar vacio");
                if (this.obraMinutoD===0) this.errorMostrarMsjObraMano.push("Minuto Inicio no puede estar vacio");

                  if (this.obraHoraA<this.obraHoraD) this.errorMostrarMsjObraMano.push("Hora Inicio no puede ser Mayor que Hora Final");
                if (this.obraHoraA==this.obraHoraD){
                    if (this.obraMinutoA<this.obraMinutoD) this.errorMostrarMsjObraMano.push("IGUAL HORAS -> Minuto Inicio no puede ser Mayor que Minuto Final");
                }
                if (this.descripcionParte==''){
                   this.descripcionParte= 'Trabajo realizado'
                } 


            

                if (this.errorMostrarMsjObraMano.length) this.errorObraMano = 1;
                //console.log('validarObra2'+this.errorMostrarMsjObra)
                    console.log(this.errorMostrarMsjObraMano);
                    console.log(this.errorObraMano);
                return this.errorObraMano;

            },
            validarEnviarParte(){
                console.log('INICIO------------EVENT');
                console.log(event);
                console.log('FIN------------EVENT');
                                event.preventDefault();


                console.log('INICIO------------validarParte');
                console.log(this.validarParte());
                console.log('FIN------------validarParte');
                if (this.validarParte()){
                    return;
                }
/* 
                 this.validaTexto = true;
                 this.attemptSubmit = true;
                if (this.missingName || this.wrongNumber){ 
                event.preventDefault();
                }
 */


                   // console.log(this.obraId);

                
                let me = this;

                axios.post('/obraMano/registrar',{
                    'obraCodigo': this.codigoAlta,
                    'obraNombre': this.textoObra,
                    'obraId': this.selectObra,
                    'usuarioId': this.usuarioId,
                    'obraHoraD': this.obraHoraD,
                    'obraMinutoD': this.obraMinutoD,
                    'hoy': this.hoy,
                    'obraHoraA': this.obraHoraA,
                    'obraMinutoA': this.obraMinutoA,
                    'descripcionParte': this.descripcionParte,
                    'obraFamiliaHora' : this.obraFamiliaHora,
                    'obraFamiliaFin' : this.obraFamiliaFin
            
                }).then(function (response) {
                   
                   let h = me.obraHoraA;
                   let m = me.obraMinutoA;
                   let dia = me.hoy;
                   console.log('hoara y minut'+me.hoy);
                   console.log(h);
                   console.log(m);
                    me.obraHoraD=h;
                    me.obraMinutoD=m;
                    me.obraHoraA='0';
                    me.obraMinutoA='0';
                    me.descripcionParte='';
                    me.fecha =me.hoy;
                    me.obraFamiliaHora= '',
                    me.obraFamiliaFin = false,
                    //this.hoy = m.fecha;
                   // me.hoy = dia ; 
                    
                  
                  me.listarObraMano(1,'','nombre');
                     me.listarObraMano();
                //     me.inicialiciarParte();
                  /*    this.obraHoraD = 0;
                    this.obraMinutoD = 0;
                    this.obraMinutoA = 0;
                    this.obraHoraA =0; */
                }).catch(function (error) {
                    console.log(error);
                     me.buscarResponse = 'Guarda Parte : Error '+error;
                      if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                });
               
                 // console.log(this.missingName+'----'+ this.wrongNumber);
              
            },
            inicialiciarParte()
            {       
                /* this.obraHoraD="15";
                this.obraMinutoD="15";
                this.obraHoraA=0;
                this.obraMinutoD=0;
                this.descripcionParte=''; */
               // console.log('inicializar parte INicio :'+this.obraHoraD+':'+this.obraMinutoD+' - final '+this.obraHoraA+':'+this.obraMinutoA );
            },
            eliminarParte(item){
                              swal({
                title: 'Esta seguro de ELIMINAR ESTE REGISTRO?',
                type: 'warning',
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
                    console.log('item '+item);
                    axios.put('/obraMano/desactivar',{
                        'id': item
                    }).then(function (response) {
                        me.listarObraMano();
                        swal(
                        'ELIMINADO!',
                        'El registro ha sido ELIMINADO con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                         if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 


            },
            listarObraMano (page,buscar,criterio){
                let me=this;
                console.log(me.hoy);
                console.log('hooooooooooooooooooooy');
                //if (fecha==0) fecha='2018-11-13';

                var url= '/obraMano?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio +'&fecha='+me.hoy;
                                //var url= '/obraMano';

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta);

                    me.arrayObraMano = respuesta.obraMano.data;
                    console.log('arrayObraMano');
                    console.log(me.arrayObraMano);
                    console.log('hoy----------------');
                    console.log(me.hoy);


                    me.pagination= respuesta.pagination;
                                      //  console.log(me.arrayObraMano);

                })
                .catch(function (error) {
                    console.log(error);
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                });
            },
            obrasUsuario (usuario){
                let me=this;
                var url= '/obrasusuario';
                                //var url= '/obraMano';
                this.selectObra = 0;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log('obrasUsuario');
                    console.log(response);
                     console.log('---------------------------');

                    me.arrayObraUsuario = respuesta.obrasUsuario;
                    me.paginationU= respuesta.paginationU;
                    me.usuarioNombre = respuesta.user_nombre;
                    me.usuarioRol = respuesta.user_rol;
                    me.usuarioId = respuesta.user;
                   /*  me.obraId = respuesta.id;
                    me.usuarioId= respuesta.userid; */
                    //me.hoy = respuesta.hoy;
                   
                                        console.log(me.arrayObraUsuario);
                                        console.log(me.usuarioNombre);
                                        console.log(me.hoy);

                })
                .catch(function (error) {
                    console.log(error);
                     if (error.response.status === 401) {
                         window.location = "/login";
                         }  
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarObraMano(page,buscar,criterio);
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
             abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "obraHora":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Crear Parte de horas';
                                this.nombre= '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar categoría';
                                this.tipoAccion=2;
                                this.obraMano_id=data['id'];
                                this.nombre = data['nombre'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
           

            this.arrayFechas();
            this.listarObraMano(1,this.buscar,this.criterio);
            this.obrasUsuario();
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>