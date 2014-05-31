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

Route::get('/', function()
{
	return View::make('hello');
});

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
Route::get('/admin/libros/{id}',['uses'=>'LibroController@visualizar']);
Route::get('/admin/libros/{id}/modificar',['uses'=>'LibroController@formularioModificacion']);
Route::post('/admin/libros/{id}/modificar',['uses'=>'LibroController@modificacion']);
Route::get('/admin/libros/{id}/borrar',['uses'=>'LibroController@baja']);
Route::get('/admin/libros/{id}/agotado',['uses'=>'LibroController@marcarComoAgotado']);

?>
