<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',['uses'=>'LibroController@mostrarCatalogo']);
Route::get('/{id}/detalles',['uses'=>'LibroController@visualizarDetalles'])->before('auth');

// URL de pruebas para saber si tenemos la BD bn conectada.
Route::get('/test', function()
{
	$admin= Usuario::first();
	return	"Existen ".Usuario::count()." usuarios en la BD ;).<br/>El 1ro  se llama «".$admin['nombre']."» y su mail es «".$admin['email']."».<br/>¿La contraseña es \"admin\"? ".(Hash::check('admin',$admin['contraseña'])? 'SI :)':'No :('.var_dump($admin));
});

//Gestion de Libros
Route::get('/admin/libros',['uses'=>'LibroController@listar']);
Route::get('/admin/libros/crear',['uses'=>'LibroController@formularioAlta']);
Route::post('/admin/libros/crear',['uses'=>'LibroController@alta']);
//Route::get('/admin/libros/sinInformacion',['uses'=>'LibroController@librosSinInformación']);
Route::get('/admin/libros/recuperar',['uses'=>'LibroController@recuperar']);
Route::get('/admin/libros/{id}',['uses'=>'LibroController@visualizar']);
Route::get('/admin/libros/{id}/modificar',['uses'=>'LibroController@formularioModificacion']);
Route::post('/admin/libros/{id}/modificar',['uses'=>'LibroController@modificacion']);
Route::get('/admin/libros/{id}/borrar',['uses'=>'LibroController@baja']);
Route::get('/admin/libros/{id}/agotado',['uses'=>'LibroController@marcarComoAgotado']);
Route::get('/admin/libros/{id}/restaurar',['uses'=>'LibroController@restaurar']);

//Gestion de Editorial
Route::get('/admin/editoriales',['uses'=>'EditorialController@listar']);
Route::get('/admin/editoriales/crear',['uses'=>'EditorialController@formularioAlta']);
Route::post('/admin/editoriales/crear',['uses'=>'EditorialController@alta']);
Route::get('/admin/editoriales/{id}/modificar',['uses'=>'EditorialController@formularioModificacion']);
Route::post('/admin/editoriales/{id}/modificar',['uses'=>'EditorialController@modificacion']);
Route::get('/admin/editoriales/{id}/borrar',['uses'=>'EditorialController@baja']);
Route::get('/admin/editoriales/{id}/restaurar',['uses'=>'EditorialController@restaurar']);

//Gestion de Idioma
Route::get('/admin/idiomas',['uses'=>'IdiomaController@listar']);
Route::get('/admin/idiomas/crear',['uses'=>'IdiomaController@formularioAlta']);
Route::post('/admin/idiomas/crear',['uses'=>'IdiomaController@alta']);
Route::get('/admin/idiomas/{id}/modificar',['uses'=>'IdiomaController@formularioModificacion']);
Route::post('/admin/idiomas/{id}/modificar',['uses'=>'IdiomaController@modificacion']);
Route::get('/admin/idiomas/{id}/borrar',['uses'=>'IdiomaController@baja']);
Route::get('/admin/idiomas/{id}/restaurar',['uses'=>'IdiomaController@restaurar']);

// Agregue algo de etiquetas
Route::get('/admin/etiquetas', array('uses' => 'EtiquetasController@mostrarEtiquetas'));
Route::get('/admin/etiquetas/crear',['uses'=>'EtiquetasController@formularioAlta']);
Route::post('/admin/etiquetas/crear',['uses'=>'EtiquetasController@altaEtiqueta']);
Route::get('/admin/etiquetas/{id}/modificar',['uses'=>'EtiquetasController@formularioModificacionEtiqueta']);
Route::post('/admin/etiquetas/{id}/modificar',['uses'=>'EtiquetasController@modificacionEtiqueta']);
Route::get('/admin/etiquetas/{id}/borrar',['uses'=>'EtiquetasController@baja']);
Route::get('/admin/etiquetas/{id}/restaurar',['uses'=>'EtiquetasController@restaurar']);

//Gestion de Autores (alta,modificacion)
Route::get('/admin/autores',['uses'=>'AutorController@listar']);
Route::get('/admin/autores/crear',['uses'=>'AutorController@formularioAlta']);
Route::post('/admin/autores/crear',['uses'=>'AutorController@alta']);
Route::get('/admin/autores/{id}/modificar',['uses'=>'AutorController@formularioModificacion']);
Route::post('/admin/autores/{id}/modificar',['uses'=>'AutorController@modificacionAutor']);
Route::get('/admin/autores/{id}/borrar',['uses'=>'AutorController@baja']);
Route::get('/admin/autores/{id}/restaurar',['uses'=>'AutorController@restaurar']);

//Gestión de Usuarios para admin. Nuevo/Crear: funciones de prueba
Route::get('/admin/usuarios', array('uses' => 'UsuarioController@mostrarUsuarios'))->before('admin_auth');
Route::get('/admin/usuarios/vigentes', array('uses' => 'UsuarioController@mostrarUsuariosVigentes'))->before('admin_auth');
//Route::get('/admin/usuarios/nuevo', array('uses' => 'UsuarioController@nuevoTestUsuario'));
//Route::post('/admin/usuarios/crear', array('uses' => 'UsuarioController@crearUsuario'));
Route::get('/admin/usuarios/{id}/ver', array('uses'=>'UsuarioController@verUsuario'));
Route::get('/admin/usuarios/{id}/bloquear',['uses'=>'UsuarioController@bloquearUsuario']);
//Route::get('/admin/usuarios/{id}/modificar',['uses'=>'UsuarioController@modificarDatos']);
//Route::post('/admin/usuarios/{id}/modificar',['uses'=>'UsuarioController@modificarUsuario']);

//Registro, Login, Logout
Route::get('/registrarse', array('uses' => 'UsuarioController@nuevoUsuario'));
Route::post('/registrarse', array('uses' => 'UsuarioController@registrarUsuario'));

Route::get('/login', array('uses' => 'HomeController@showlogin'));
Route::post('/login', array('uses' => 'HomeController@doLogin'));
Route::get('/logout', array('uses' => 'HomeController@doLogout'))->before('auth');

Route::get('/resetear', array('uses' => 'HomeController@showReset'));
Route::post('/resetear', array('uses' => 'HomeController@doReset'));

//Perfil, Darse de baja
Route::get('/perfil', array('uses' => 'UsuarioController@formularioPerfil'))->before('auth');
Route::post('/perfil', array('uses' => 'UsuarioController@modificarPerfil'));
Route::get('/eliminar', array('uses' => 'UsuarioController@darBaja'))->before('auth');
Route::get('/admin/perfil', array('uses' => 'UsuarioController@formularioAdminPerfil'))->before('auth');
Route::post('/admin/perfil', array('uses' => 'UsuarioController@modificarAdminPerfil'));

//Pedidos
Route::get('/pedidos', array('uses' => 'UsuarioController@verPedidos'))->before('auth');
Route::get('/pedidos/{id}/ver', array('uses'=>'UsuarioController@detallePedido'))->before('auth');
Route::get('/pedidos/{id}/cambiar', array('uses' => 'UsuarioController@cambiarEstado'))->before('auth');
Route::get('/admin/pedidos', array('uses' => 'UsuarioController@verPedidosAdmin'))->before('admin_auth');
Route::get('/admin/pedidos/{id}/ver', array('uses'=>'UsuarioController@detallePedidoAdmin'))->before('admin_auth');
//filtro pedidos.(ordenar por fecha, funciona solo con todos los pedidos) 
Route::get('/admin/pedidos/ordenD', array('uses' => 'UsuarioController@verPedidosAdminOrdDesc'))->before('admin_auth');

//Carrito
Route::get('/carrito', array('uses' => 'CarritoController@visualizar'))->before('auth.usrReg');
Route::post('/carrito', array('uses' => 'CarritoController@agregarLibro'))->before('auth.usrReg');
Route::get('/carrito/vaciar', array('uses' => 'CarritoController@vaciarCarrito'))->before('auth.usrReg');
Route::get('/carrito/{id}/quitar', array('uses' => 'CarritoController@quitarLibro'))->before('auth.usrReg');

//Compra
Route::get('/carrito/tarjeta', array('uses' => 'CarritoController@solicDatosTarjeta'))->before('auth.usrReg');

Route::post('/carrito/tarjeta/confirmarCompra', array('uses' => 'CarritoController@comprar'))->before('auth.usrReg');
//~ Route::get('/carrito/tarjeta/confirmarCompra', function(){return Redirect::to('/404'); })->before('auth.usrReg');

Route::post('/carrito/tarjeta/finalizarCompra', array('uses' => 'CarritoController@altaPedido'))->before('auth.usrReg');
//~ Route::get('/carrito/tarjeta/finalizarCompra', function(){return Redirect::to('/404');})->before('auth.usrReg');

//Comprobantes
Route::get('/pedidos/{id}/comprobante', array('uses' => 'UsuarioController@comprobanteUsuario'))->before('auth.usrReg');
Route::get('/admin/pedidos/{id}/comprobante', array('uses' => 'UsuarioController@comprobanteAdmin'))->before('admin_auth');
Route::get('/admin/pedidos/ordenD/{id}/comprobante', array('uses' => 'UsuarioController@comprobanteAdminDesc'))->before('admin_auth');


//Mensajería
Route::get('/contacto', array('uses' => 'MensajeController@visualizarFormulario'))->before('auth.usrReg');
Route::post('/contacto', array('uses' => 'MensajeController@enviarMensaje'))->before('auth.usrReg');
Route::get('/admin/mensajes', array('uses' => 'MensajeController@listar'))->before('admin_auth');
Route::get('/admin/mensajes/{id}/ver', array('uses' => 'MensajeController@visualizar'))->before('admin_auth');
Route::get('/admin/mensajes/{id}/cambiarEstado', array('uses' => 'MensajeController@cambiarEstado'))->before('admin_auth');
Route::get('/admin/mensajes/{id}/borrar', array('uses' => 'MensajeController@eliminar'))->before('admin_auth');


//Ayuda
Route::get('/ayuda', array('uses' => 'UsuarioController@verAyuda'));
Route::get('/admin/ayuda', array('uses' => 'UsuarioController@verAyudaAdmin'))->before('admin_auth');



//Reportes
Route::get('/admin/reportes', array('uses' => 'UsuarioController@mostrarReportes'))->before('admin_auth');
Route::get('/admin/exportar',array('uses' => 'UsuarioController@exportarRepCantUs'))->before('admin_auth');
Route::get('/admin/exportarPedidos',array('uses' => 'UsuarioController@exportarPedidos'))->before('admin_auth');
Route::get('/admin/exportarLibroVendidos',array('uses' => 'UsuarioController@exportarRepLibrosVendidos'))->before('admin_auth');
//Otras funciones.
Route::get('/admin/exportarBD', array('uses' => 'UsuarioController@exportarBD'))->before('admin_auth');



//Manejo de errores de Servidor
Route::get('/404',function(){
	return View::make('error404');
});

Route::get('/500',function(){
	return View::make('error500');
});
//


//Rutea los que no sean admin, al catálogo.
Route::when('admin/*', 'admin_auth');
