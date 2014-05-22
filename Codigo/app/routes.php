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
	return	"Existen ".Usuario::count()." usuarios en la BD ;).<br/>El 1ro  se llama «".$admin['nombre']."» y su mail es «".$admin['email']."».<br/>¿La contraseña es \"admin\"? ".(Hash::check('admin',$admin['contrasena'])? 'SI :)':'No :(');
});


