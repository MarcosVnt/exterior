<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

//Auth::routes();

   
Route::group(['middleware'=>['guest']],function(){
   


    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('/teclado',[
        'name' => 'teclado', 
        'uses' => 'TecladoController@index'
    ]);
    Route::get('/teclado/validar','TecladoController@validar');
    Route::put('/teclado/registrar','TecladoController@registrar');
    
    /* Route::get('/externo', function () {
        return view('principalexterno');
    })->name('externo'); */

     Route::get('/externo', 'Auth\LoginController@externo');

   
    Route::get('/demo', 'XmlController@demo'); 
    

});


//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');


Route::get('/teclado/validar','TecladoController@validar');
Route::put('/teclado/registrar','TecladoController@registrar');

Route::group(['middleware'=>['auth','web']],function(){



   //  Route::get('/externo', 'Auth\LoginController@externo')->name('externo');
   //    Route::get('/externo','Auth\LoginController@logout')->name('logout');


  


    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    //Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

    Route::get('/main', 'InicioController@muestraContenido')->name('main');
    
    /* Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    */
    /* 
    Route::get('/home', 'HomeController@index')->name('home');
    */

    Route::get('/clientesvnt', 'XmlController@clientesvnt');


    Route::get('/comprasvnt', 'XmlController@comprasvnt');
    Route::get('/comprasvntdemo', 'XmlController@comprasvntDemo');


    Route::get('/comprasvnt/buscar', 'XmlController@buscar');

    Route::post('/comprasvnt/nota', 'XmlController@nota');
    Route::put('/comprasvnt/eliminarnota', 'XmlController@eliminarnota');


    Route::get('/comprasvntxls', 'ExcelController@comprasvntxls');

        /*     Route::get('/comprasvnt', 'XmlController@comprasvnt');
            Route::get('/comprasvnt', 'XmlController@comprasvnt');
        */
            //Route::get('/todasobras', 'FotoObraController@todasobras');

            /* 
            Route::get('/altafotosobra', 'FotoObraController@altafotosobra');
            //Route::post('altafotosobra','FotoObraController@storemultiple');
            Route::post('altafotosobra','FotoObraController@storeMedium');
            */
            /* https://itsolutionstuff.com/post/laravel-5-image-upload-and-resize-example-using-intervention-image-packageexample.html
            Route::get('resizeImage', 'ImageController@resizeImage');
            Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);
            */

    Route::get('/fotosobras', 'FotoObraController@index');
    Route::get('/fotosobrasexterno', 'FotoObraController@externofotos');
    
    Route::get('/fotosunaobra', 'FotoObraController@listarFotosDeUnaObra');
    Route::get('/ultimasfotos', 'FotoObraController@ultimasFotos');

    
    Route::post('/foto/borrar', 'FotoObraController@borrarfoto');
    Route::post('/foto/rotar', 'FotoObraController@rotarFotoObra');


    Route::get('altafoto', 'FotoObraController@altaunafoto');
        /*     Route::get('obrasusuario', 'FotoObraController@obrasUsuario');
        */    
    Route::post('altafoto',['as'=>'altafoto','uses'=>'FotoObraController@guardaAltaFoto']);
    

    

    

    Route::get('/obra', 'ObraController@buscarPorId');
    Route::get('/obra/listar', 'ObraController@listaObras');
    Route::get('/obra/horas', 'ObraController@horasPorDia');
    Route::get('/obra/horas/usuario', 'ObraController@horasPorDiaUsuario');
    Route::get('/informepdf', 'ObraController@informePdf');

    Route::get('/informepdf/cliente', 'ObraController@informePdfCliente');

    


    Route::get('/obraid', 'ObraController@index');
    Route::post('/obrausuario/registrar','ObraController@registrarObraUsuario');

    /* Route::get('/obraUsuario', 'ObraManoController@index'); */


    Route::get('/obraMano', 'ObraManoController@index');
    Route::get('/obraMano/horas', 'ObraManoController@listaHorasObra');
    
    Route::get('/obraMano/taller', 'ObraManoController@taller');

    Route::post('/obraMano/registrar', 'ObraManoController@store');
    Route::put('/obraMano/desactivar', 'ObraManoController@desactivar');




    Route::get('/compras', 'GestorcompraController@index');
    Route::post('/compras/registrar', 'GestorcompraController@store');
    Route::put('/compras/actualizar', 'GestorcompraController@update');
    Route::put('/compras/eliminar', 'GestorcompraController@delete');
    Route::put('/compras/activar', 'GestorcompraController@activar');


    Route::get('/rol', 'RolController@index');
    Route::get('/rol/selectRol', 'RolController@selectRol');

    Route::get('/user', 'UserController@index');
    Route::get('/user/taller', 'UserController@listaTaller');
    Route::get('/user/teclado', 'UserController@tecladoExiste');
    

    Route::get('/user/taller/obra', 'UserController@listaUsuariosTaller');

    Route::get('/obrasusuario', 'UserController@obrasusuario');

    Route::post('/user/registrar', 'UserController@store');
    Route::put('/user/actualizar', 'UserController@update');
    Route::put('/user/desactivar', 'UserController@desactivar');
    Route::put('/user/activar', 'UserController@activar');

    Route::get('/usuario/horas', 'UserController@horasPorDia');

    Route::get('/turnos', 'HorarioController@turnosUsuario');
    Route::post('/horario/registrar', 'HorarioController@store');
    Route::put('/horario/desactivar', 'HorarioController@desactivar');


    Route::post('/send-mail', 'FotoObraController@enviarEmailColaborador');

    Route::post('/presupuesto/registrar', 'PresupuestoController@registrar');
    Route::get('/presupuesto', 'PresupuestoController@index');
    Route::get('/presupuesto/aceptados', 'PresupuestoController@aceptados');
    
    Route::get('/presupuesto/view', 'PresupuestoController@view');
    Route::post('/presupuesto/duplicar', 'PresupuestoController@duplicar');

    Route::get('/presupuesto/pdf', 'PresupuestoController@generarPdf');
   Route::get('/presupuesto/pdf-fabricacion', 'PresupuestoController@generarPdfFabricacion');
   
   
    Route::put('/presupuesto/eliminar', 'PresupuestoController@eliminarPresupuesto');
    Route::put('/presupuesto/actualizar', 'PresupuestoController@updatedos');
    Route::put('/presupuesto/actualizartotales', 'PresupuestoController@actualizartotales');
    
    Route::put('/presupuesto/ponercodigoobra', 'PresupuestoController@ponercodigoobra');
    Route::put('/presupuesto/ponerfechaentrega', 'PresupuestoController@ponerfechaentrega');


    Route::put('/presupuesto/componente/eliminar', 'PresupuestoComponenteController@eliminar');
    Route::put('/presupuesto/componente/actualizar', 'PresupuestoComponenteController@actualizar');
    Route::post('/presupuesto/componente/guardar', 'PresupuestoComponenteController@guardar');

    Route::put('/presupuesto/detalle/desactivar', 'PresupuestoDetalleController@desactivar');

    Route::put('/presupuesto/detalle/eliminar', 'PresupuestoDetalleController@eliminar');
    Route::put('/presupuesto/detalle/actualizar', 'PresupuestoDetalleController@actualizar');
    Route::put('/presupuesto/detalle/actualizar/coste', 'PresupuestoDetalleController@actualizarcoste');

    Route::put('/presupuesto/detalle/actualizar/linea', 'PresupuestoDetalleController@actualizarlinea');


    Route::post('/presupuesto/detalle/guardar', 'PresupuestoDetalleController@guardar');
    Route::put('/presupuesto/detalle/actualizarcostes', 'PresupuestoDetalleController@actualizarCostes');



    Route::get('/presupuesto/documentacion', 'PresupuestosFicheroController@documentacion');
    Route::put('/presupuesto/documentacion/eliminar', 'PresupuestosFicheroController@eliminar');
    Route::post('altafotopresupuesto',['as'=>'altafotopresupuesto','uses'=>'PresupuestosFicheroController@guardaAltaFotoPresupuesto']);
    Route::post('altafichero',['as'=>'altafichero','uses'=>'PresupuestosFicheroController@guardaFichero']);
    

    Route::post('/tarifaproducto/guardar', 'TarifaproductoController@guardar');
    Route::get('/tarifaproducto/buscar', 'TarifaproductoController@buscar');
    Route::post('/tarifaproducto/traer', 'TarifaproductoController@traer');
    Route::put('/tarifaproducto/eliminar', 'TarifaproductoController@eliminar');
    Route::put('/tarifaproducto/articulo/eliminar', 'TarifaproductoController@eliminarArticulo');
    Route::put('/tarifaproducto/articulo/actualizar', 'TarifaproductoController@actualizarArticulo');
    Route::post('/tarifaproducto/articulo/guardar', 'TarifaproductoController@guardarArticulo');

    Route::post('/tarifaproducto/componente/guardar', 'TarifaproductoController@guardarcomponente');
    Route::put('/tarifaproducto/componente/actualizar', 'TarifaproductoController@actualizarcomponente');

    Route::put('/tarifaproducto/actualizar
    ', 'TarifaproductoController@actualizarcoste');


    Route::get('/productotarifa', 'TarifaproductoController@index');
    Route::post('/aceptarcomopresupuestado', 'PresupuestoController@aceptarcomopresupuestado');


     Route::get('/presupuesto/pdfdemo', function () {
        return view('pdf/demo');
    })->name('demo');


    Route::get('/demo', 'ObraManoController@demo');


    Route::post('/valla/create', 'VallaController@createDesdeForm');
    Route::post('/valla/update', 'VallaController@updateDesdeForm');
    Route::put('/valla/eliminar', 'VallaController@eliminar');
    Route::put('/valla/activar', 'VallaController@activar');

    Route::post('/contrato/create', 'ContratoController@createDesdeForm');
    Route::post('/contrato/update', 'ContratoController@updateDesdeForm');
    Route::put('/contrato/eliminar', 'ContratoController@eliminar');
    Route::get('/contratos', 'ContratoController@index');
    Route::put('/contrato/finalizar', 'ContratoController@finalizar');
    Route::put('/contrato/activar', 'ContratoController@activar');


    Route::post('/terreno/create', 'TerrenoController@createDesdeForm');
    Route::post('/terreno/update', 'TerrenoController@updateDesdeForm');
    Route::put('/terreno/eliminar', 'TerrenoController@eliminar');
    Route::get('/terrenos', 'TerrenoController@index');
    Route::put('/terreno/finalizar', 'TerrenoController@finalizar');


    Route::get('/vallas', 'VallaController@index');
    Route::get('/listarVallas', 'VallaController@listarVallas');


  /*   Route::get('/vallasExterior', 'VallaController@vallasexteriorindex');
    Route::get('/vallas-exterior', 'VallaController@vallasexteriorindex'); */
    
    Route::get('/demoBusqueda', 'DemoController@demoBusqueda');
    Route::post('/presupuesto/duplicarrotuleon', 'PresupuestoController@duplicarPresupuestoRotuleon');

    Route::post('/log-error', 'ErrorLogController@store');

    Route::get('/terrenos/max-dni','TerrenoController@maxDni');

    Route::post('/ruta-vallas/update', 'RutaVallaController@update');
    Route::post('/ruta-vallas/create', 'RutaVallaController@create');
    Route::get('/ruta-vallas/listar', 'RutaVallaController@listar');
    Route::get('/ruta-vallas/vallas', 'RutaVallaController@vallas');
    Route::put('/ruta-vallas/delete', 'RutaVallaController@eliminar');

    Route::post('/ruta-vallas-lineas/create', 'RutaVallaLineaController@create');
    Route::put('/ruta-vallas-lineas/delete', 'RutaVallaLineaController@delete');

    Route::get('/ruta/{token}', 'RutaVallaController@accesoTemporal');



});
Route::get('/ruta/{token}', 'RutaVallaController@accesoTemporal');


/* Route::get('/vallas-exterior', 'VallaController@vallasexteriorindex');
Route::get('/vallas', 'VallaController@index');  */