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
                        <i class="fa fa-align-justify"></i> Fotos Obra
                        <!--  <a class="nav-link" href="{{ route('logout') }}">Desconectar</a> -->
                        <!-- <button type="button" @click="abrirModal('fotoObra','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Añadir Fotos
                        </button>  -->
                      <!--   <a class="nav-link" href="/altafoto" ><i class="icon-plus"></i> Añadir Fotos</a> -->

                    </div>
                      
                    <div class="card-body">


                        <!---NUEVA BUSQUEDA  -->
                             <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputUsuario">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" v-model="usuarioNombre" readonly >
                                </div>
                                 

                                 <div class="form-group col-md-8">
                                     <label for="selectObrar">Obras</label>

                                    <select v-model="selectObra" class="form-control"  @change="actualizaCodigoObra(selectObra)">
                                            <option value="0" disabled>Seleccione Obra</option>
                                            <option v-for="obras in arrayObraUsuario" :key="obras.id" :value="obras.codigo" v-text="obras.codigo" ></option>
                                        </select>

                                </div>
                            </div>
                            

                        <!--- -->
                         <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Codigo de obra (AAOOOOCCCC)</label>
                                    <div class="col-md-4">
                                    <input type="text" v-model="buscar" @keyup.enter="buscarObra(buscar)" class="form-control" placeholder="Introduce Codigo Obra">
                                        
                                    </div>
                                    
                                    <div class="col-md-3">
                                    <button type="submit" v-on:click.stop.prevent="buscarObra(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        
                                    </div>
                                    

                                </div>

                        </form>
                        <div v-if="buscarResponse" class="col-md-18 is-valid" >
                            <input type="text"  v-model="buscarResponse" class="form-control" placeholder="nombre de la  obra" readonly>
                               
                        </div>
                        <div v-show="errorObra" class="col-md-12 div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjObra" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>
                        <div v-if="textoObra"  class="col-md-12">
                            <button type="button" @click="abrirModal('fotoObra','registrar')" class="btn btn-success">
                                <i class="icon-plus"></i>&nbsp;Añadir Fotos
                            </button>       
                        </div>
                        
                    </div>
                     <div class="col-md-3">
                         <button type="submit" v-on:click.prevent="listarFotosObras(1,buscar,criterio)" class="btn btn-success float-right">recargar lista de fotos </button>
                    </div>
                    <div class="card-body" v-if="hayFotos==1">

                      
                        <div class="form-group row">
                            <div class="col-md-6">
                                <!-- <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarRol(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarRol(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div> -->
                            </div>
                        </div>

                        <div class="card col-md-12"  v-for="obrafoto in arrayObrafoto" :key="obrafoto.id">
                            <img class="card-img-top" :src="`${obrafoto.imagen}`" alt="Card image cap">
                          
                            <div class="card-body">
                                <h5 class="card-title">{{obrafoto.codigoObra}}</h5>
                                <h3 class="card-text">{{obrafoto.nombreObra}}.</h3>
                                <p class="card-text">{{obrafoto.texto}}.</p>
                                
                                <!-- <a href="#" class="btn btn-danger">Borrar Foto</a> -->
                                 <div class="col-md-3">
                                    <button type="submit" v-on:click.prevent="borrarFoto(obrafoto.obrafotoid)" class="btn btn-danger float-right">Borrar Foto</button>
                                </div>
                            </div>
                        </div>
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

                        <table v-if="hayFotos==22" class="table table-responsive table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Obra -Descripcion</th>
                                    <th scope="col">Descripción</th>
<!--                                     <th scope="col">Url</th>
 -->                                    <th scope="col" >Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="obrafoto in arrayObrafoto" :key="obrafoto.id">
                                    
                                    <td scope="row" v-text="obrafoto.codigoObra+'-'+obrafoto.nombreObra"></td>
                                    <td v-text="obrafoto.nombre"></td>
<!--                                     <td v-text="obrafoto.imagen"></td>
 -->                                    <td>
                                        <!-- <img src="'storage/obras/images/'+obrafoto.obra_id" class="img-fluid"/> -->
                                        <img class="img-fluid" :src="`${obrafoto.imagen}`">
<!--                                     <img src={{ Storage::get(obrafoto.imagen);}} class="img-thumbnail">
 -->                                    </td>  
                                   <!--  <td>
                                        <div v-if="obrafoto.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td> -->
                                </tr>                                
                            </tbody>
                             <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                        </table>
                       
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
              <!--Inicio del modal AÑADIR FOTOS-->
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
                                    <label class="col-md-3 form-control-label" for="text-input">Codigo Obra</label>
                                    <div class="col-md-9">
                                        <input type="text" name="selectObra" id="selectObra" v-model="codigoAlta" readOnly class="form-control" placeholder="Cocigo de Obra">
                                        
                                    </div>
                                    

                                    <!-- <div class="col-md-9">
                                        <input type="text" name="idObra" id="idObra" v-model="idObraAlta" readOnly class="form-control" placeholder="Cocigo de Obra">
                                        
                                    </div> -->
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre Obra</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="buscarResponse" readOnly class="form-control" placeholder="Nombre de Obra">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción...</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="nombreFoto" id="nombreFoto" v-model="descripcionAlta" class="form-control" placeholder="Descripcion foto">
                                    </div>
                                </div>
    <foto-obra-dropzone></foto-obra-dropzone>


                              <!--   <div class="form-group">
                                     <div class="form-group">
                                <label for ="foto">Foto obra , Max : 4mb tamaño:</label>
                                <input type="file" class="form-control-file" id="image" name="image" /> -->
                                
                                <!-- MULTIMPLE FILES
                                https://codepen.io/emils/pen/VWgpaJ?editors=1000-->
<!--                                     <div v-for="item in items" :key="item.id" >
                                        <h2>Seleccione una Imagen {{item.nombreImagen}}</h2>

                                        <div v-if="!item.image">

                                            <input type="file" @change="onFileChange(item, $event)" v-bind:id="'img'+item.id"  v-bind:name="'img'+item.id">
                                            <progress  v-bind:id="item.id" v-bind:value="percent" max="100"> </progress> % {{percent}} 
                                                <br><br>
                                                {{message}}	
                                                <br><br>
                                        </div>
                                        <div v-else>
                                            <img :src="item.image" class="img-fluid"/>
                                            <button v-on:click.stop.prevent="removeImage(item)" class="btn btn-danger float-right">Remove image</button>
                                        
                                        <button type="submit" v-on:click.prevent="guardaFoto(item)" class="btn btn-success float-right">Subir Imagen  {{item.id}}</button>

                                        </div>

                                     <div>
                                   </div>
                                	

                                </div> 
 -->                     
                                <div v-show="errorFoto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjFoto" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form> 
                        </div> 
                        <div class="modal-footer">
                            <button type="submit" v-on:click.prevent="cerrarModal()" class="btn btn-success float-right">Subir Imagen Obra</button>
    	{{items}}
                           <!--  <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
                         -->
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

    
    data: function data() {
        return {
            usuarioId: 0,
            paginationU: '',
            arrayObraUsuario: [],
            selectObra: 0,
            usuarioNombre: '',
            percent: 0,
            porcentaje: [],
            message: "",

            anoObra: '',
            codObra: '',
            cliObra: '',
            idObra: '',

            errorObra: 0,
            errorMostrarMsjObra: [],
            //idObraAlta:0,
            file: {},
            nombreImage: '',
            imageNombre: '',
            items: [{ id: 0,image: false,subido:false},{ id: 1,image: false,subido:false},{ id: 2,image: false,subido:false}
            ],
            nombreAlta: '',
            codigoAlta: '',
            descripcionAlta: '',
            arrayObras: {},
            buscar: '',
            errorFoto: 0,
            errorMostrarMsjFoto: [],
            buscarResponse: '',
            obrafoto_id: 0,
            codigoObra: '',
            nombreObra: '',
            textoObra: '',
            arrayObrafoto: [],
            modal: 0,
            tituloModal: '',
            hayFotos: 0,
            tipoAccion: 0,
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            offset: 3,
            criterio: 'nombre',
            page:1,
          }  
    },

    computed: {
        isActived: function isActived() {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function pagesNumber() {
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
        }
    },
    methods: {
        actualizaCodigoObra: function actualizaCodigoObra(id) {
            this.buscar = id;
            this.buscarObraCodigo(id);
        },
        obrasUsuario: function obrasUsuario() {
            var me = this;
            var url = '/obrasusuario';
            //var url= '/obraMano';
            this.selectObra = 0;
            axios.get(url).then(function (response) {
                var respuesta = response.data;
               //console.log('obrasUsuario');
               //console.log(response);
               //console.log('----FOTOS OBRA-----------------------');

                me.arrayObraUsuario = respuesta.obrasUsuario;
                me.paginationU = respuesta.paginationU;
                me.usuarioNombre = respuesta.user_nombre;
                me.usuarioId = respuesta.user;
                /*  me.obraId = respuesta.id;
                 me.usuarioId= respuesta.userid; */
                //me.hoy = respuesta.hoy;

               //console.log(me.arrayObraUsuario);
               //console.log(me.usuarioNombre);
               //console.log(me.hoy);
               //console.log('----FOTOS OBRA-----------------------');
            }).catch(function (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
        },
        borrarFoto: function borrarFoto(id) {
            var _this = this;

            swal({
                title: 'Esta seguro de Borrar esta Foto?',
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
            }).then(function (result) {
                if (result.value) {
                    var me = _this;

                    axios.post('/foto/borrar', {
                        'id': id
                    }).then(function (response) {
                        me.listarFotosObras();
                        swal('Eliminado!', 'El registro ha sido desactivado con éxito.', 'success');
                    }).catch(function (error) {
                       //console.log(error);
                        if (error.response.status === 401) {
                            window.location = "/login";
                        }
                    });
                } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel) {}
            });
        },
        guardaFoto: function guardaFoto(item) {
           //console.log('GUARDAFOTO--------------->'.$item);

            event.preventDefault();

            var me = this;
            me.imageNombre = item;
            var itemid = item.id;
           //console.log('GUARDAFOTO--------------->'.$item);


            //console.log('guardaFoto :' + this.codigoAlta + '-----' + this.descripcionAlta + '----' + this.nombreImage);
            //////console.log(me.imageNombre.image);
            var formData = new FormData();
            formData.append('file', this.file);
            //console.log(formData);

            formData.append('selectObra', this.codigoAlta);
            formData.append('nombreObra', this.textoObra);

            formData.append('nombreFoto', this.descripcionAlta);
            formData.append('image', this.nombreImage);

            console.log('GUARDA FOTO ---> ',item,itemid,formData);

            axios.post('/altafoto', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },

                onUploadProgress: function onUploadProgress(uploadEvent) {

                    me.percent = Math.round(uploadEvent.loaded / uploadEvent.total * 100);
                    me.porcentaje.itemid = Math.round(uploadEvent.loaded / uploadEvent.total * 100);
                }

            }).then(function (response) {
                me.percent = 0;
                me.porcentaje.itemid = 0;

               //console.log(response);

               //console.log('THEM FINAL ------------------');
            }).catch(function (error) {
               //console.log(error);
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
        },
        onFileChange: function onFileChange(item, e) {
            //console.log('onfilechange'+item,e);
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
//this.items[item.id].push("nombre" , files[0].name);

Vue.set(this.items[item.id], 'nombreImagen', files[0].name);

            console.log(item.id,'onfilechange',item,e, files[0],files[0].name,this.items[item.id]);

            this.createImage(item, files[0]);
        },
        createImage: function createImage(item, file) {
            var image = new Image();
            var reader = new FileReader();

            reader.onload = function (e) {
                item.image = e.target.result;
                item.subido = true;
                item.marcos = "apellido";
            };
            reader.readAsDataURL(file);
            this.file = file;
            this.nombreImage = file.name;
            //console.log(file);
            //console.log(file.name); 
        },

        removeImage: function removeImage(item) {
            //console.log(item);
            // me.listarFotosObras(1,this.buscar,this.criterio);
            item.image = false;
            item.subido = false;
        },
        validarIdObra: function validarIdObra() {
            this.errorObra = 0;
            //console.log('validarObra1')
            this.errorMostrarMsjObra = [];

            /* if (!this.buscar) this.errorMostrarMsjObra.push("Codigo de obra no válido o  no puede estar vacío."); */
            if (this.buscar.length != 10) this.errorMostrarMsjObra.push("Codigo de obra no válido -> (vacio o Longitud incorrecta.)");

            if (this.errorMostrarMsjObra.length) this.errorObra = 1;
            //console.log('validarObra2'+this.errorMostrarMsjObra)

            return this.errorObra;
        },
        buscarObraCodigo: function buscarObraCodigo(buscar, event) {
           //console.log(buscar);
            //this.errorObra=0;
            //console.log('validarObra1')
            // this.errorMostrarMsjObra =[];
            if (event) event.preventDefault();

            var me = this;
            me.textoObra = '';

            /*  if (this.validarIdObra()){
                 return;
             } */
            /*  me.anoObra=this.buscar.substring(0,2);
             me.codObra=this.buscar.substring(2,6);
             me.cliObra=this.buscar.substring(6,10);
             me.idObra = me.codObra+'/20'+me.anoObra;
            //console.log(me.idObra+'-'+me.cliObra); */

            /*  if (this.buscar==''){
                 this.buscarResponse = 'Vacio : CODIGO OBRA VACIO  O NO VALIDO';
                  ////console.log(this.buscarResponse);
                   //var url= '/obra' ;
                 return this.buscarResponse;
             } else{
                 var url= '/obra?&buscar='+ this.buscar ;
                 this.buscarResponse = '';
             }
            */
            var url = '/obraid?&buscar=' + this.buscar;
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayObras = respuesta.obra.tblobras_registro;
                if (typeof me.arrayObras === "undefined") {
                    //console.log('vacio');
                    me.buscarResponseError = 'Undefined : CODIGO INEXISTENTE';
                    me.buscarResponse = '';
                    /* me.errorMostrarMsjObra.push('Undefined : CODIGO INEXISTENTE');
                      me.errorObra=1; */

                    return me.buscarResponseError;
                } else {
                    //console.log('no vacio');
                    //console.log(' . '+me.buscarResponse.length+' . ');
                    me.buscarResponseError = '';
                    me.textoObra = me.arrayObras.TEXTO;
                    me.buscar = '';
                    me.codigoAlta = me.arrayObras.CODIGO;
                    // me.idObraAlta = me.arrayObras.ID_OBRA;
                    //this.obrasUsuario();
                    return me.buscarResponse = me.arrayObras.TEXTO;
                }
                //console.log( me.arrayObras.texto);

                /* 
                                   //console.log(response);
                                   //console.log(response.data);
                
                                   //console.log(response.data.obra);
                                   //console.log(response.data.obra.tblobras_registro); */

                if (respuesta.length = 0) {
                    me.buscarResponseError = 'Length : Respuesta Erronea del Servidor';
                    me.buscarResponse = '';
                    //  this.errorMostrarMsjObra.push("Length : Respuesta Erronea del Servidor");
                    //console.log('axio'+me.buscarResponse);
                }
                //debugger
                //console.log(respuesta);
                me.buscarResponseError = respuesta.texto;
                me.buscarResponse = '';
                // me.arrayObra = respuesta.obraMano.data;
                // me.pagination= respuesta.pagination;
                //  //console.log(me.arrayObraMano);
            }).catch(function (error) {
                me.buscarResponseError = 'Consulta : ERROR DE CONSULTA';
                me.buscarResponse = '';
                // this.errorMostrarMsjObra.push("Consulta : ERROR DE CONSULTA");
               //console.log(error);
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
            // if (this.errorMostrarMsjObra.length) this.errorObra = 1;
        },
        buscarObra: function buscarObra(buscar, event) {
            if (event) event.preventDefault();
            //alert(buscar)
            /* if (this.validarObra()){
                            //console.log('validar Obra desde busacrobra');
            } */
            //debugger
            var me = this;
            me.textoObra = '';

            if (this.validarIdObra()) {
                return;
            }
            me.anoObra = this.buscar.substring(0, 2);
            me.codObra = this.buscar.substring(2, 6);
            me.cliObra = this.buscar.substring(6, 10);
            me.idObra = me.codObra + '/20' + me.anoObra;
           //console.log(me.idObra + '-' + me.cliObra);

            /*  if (this.buscar==''){
                 this.buscarResponse = 'Vacio : CODIGO OBRA VACIO  O NO VALIDO';
                  ////console.log(this.buscarResponse);
                   //var url= '/obra' ;
                 return this.buscarResponse;
             } else{
                 var url= '/obra?&buscar='+ this.buscar ;
                 this.buscarResponse = '';
             }
            */
            var url = '/obra?&buscar=' + this.buscar;
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayObras = respuesta.obra.tblobras_registro;
                if (typeof me.arrayObras === "undefined") {
                    //console.log('vacio');
                    me.buscarResponse = 'Undefined : CODIGO INEXISTENTE';
                    return me.buscarResponse;
                } else {
                    //console.log('no vacio');
                    //console.log(' . '+me.buscarResponse.length+' . ');
                    me.textoObra = me.arrayObras.TEXTO;
                    me.codigoAlta = me.arrayObras.CODIGO;
                    // me.idObraAlta = me.arrayObras.ID_OBRA;
                    //this.obrasUsuario();
                    return me.buscarResponse = me.arrayObras.TEXTO;
                }
                //console.log( me.arrayObras.texto);

                /* 
                                   //console.log(response);
                                    console.log(response.data);
                
                                    console.log(response.data.obra);
                                    console.log(response.data.obra.tblobras_registro); */

                if (respuesta.length = 0) {
                    me.buscarResponse = 'Length : Respuesta Erronea del Servidor';
                    //console.log('axio'+me.buscarResponse);
                }
                //debugger
                //console.log(respuesta);
                me.buscarResponse = respuesta.texto;

                // me.arrayObra = respuesta.obraMano.data;
                // me.pagination= respuesta.pagination;
                //  //console.log(me.arrayObraMano);
            }).catch(function (error) {
                me.buscarResponse = 'Consulta : ERROR DE CONSULTA';
                console.log(error);
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
        },
        listarFotosObras: function listarFotosObras(pag, buscar, criterio) {
            var me = this;
          
            
           //console.log('listarFotosObras: pAGE:' + pag + '-BUSCAR:' + me.buscar + '-CRITERIO' + me.criterio + '-');
            var url = '/fotosobras?page=' +pag + '&buscar=' + me.buscar + '&criterio=' + me.criterio;
            axios.get(url).then(function (response) {
                me.hayFotos = 0;
                var respuesta = response.data;
               //console.log('INICIO--------listarfotos');

               //console.log(respuesta);
                me.obrasUsuario();
               //console.log('FIN----------listarfotos');
                me.arrayObrafoto = respuesta.obraFoto.data;

                if (me.arrayObrafoto.length > 0) {
                    me.hayFotos = 1;
                    //console.log('>0');
                } else {
                        //console.log('no >0');
                    };

                me.pagination = respuesta.pagination;
            }).catch(function (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }

                //console.log(error);
            });
        },
        cambiarPagina: function cambiarPagina(page, buscar, criterio) {
            var me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
           //console.log('CAMBARPAGINA ',page, buscar, criterio);
            
            //Envia la petición para visualizar la data de esa página
            me.listarFotosObras(page, buscar, criterio);
        },
        cerrarModal: function cerrarModal() {
            this.modal = 0;
            this.tituloModal = '';
            this.nombre = '';
            this.descripcion = '';
            let me = this;
            
                me.listarFotosObras();
                me.obrasUsuario();

                me.removeImage(me.imageNombre);
                me.cerrarModal();
        },
        abrirModal: function abrirModal(modelo, accion) {
            var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];

            switch (modelo) {
                case "fotoObra":
                    {
                        switch (accion) {
                            case 'registrar':
                                {
                                    this.modal = 1;
                                    this.tituloModal = 'Gestor de Imagenes Rotuleon';
                                    this.nombre = '';
                                    this.descripcion = '';
                                    this.tipoAccion = 1;
                                    break;
                                }
                            case 'actualizar':
                                {
                                    ////console.log(data);
                                    this.modal = 1;
                                    this.tituloModal = 'Actualizar ';
                                    this.tipoAccion = 2;
                                    this.categoria_id = data['id'];
                                    this.nombre = data['nombre'];
                                    this.descripcion = data['descripcion'];
                                    break;
                                }
                        }
                    }
            }
        }
    },
    mounted: function mounted() {

        this.listarFotosObras(this.page, this.buscar, this.criterio);
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
    .img-fluid{

        max-width: 50% !important;
    }
    .img {
  width: 10%;
  margin: auto;
  display: block;
  margin-bottom: 10px;
}
    
</style>
