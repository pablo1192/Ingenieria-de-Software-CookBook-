<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function showLogin()
	{
		return View::make('login');
	}

	public function doLogin()
	{
		$rules = array(
			'email'    => 'required|email',
			'contraseña' => 'required|min:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/login')
				->withErrors($validator)
				->withInput(Input::except('contraseña'));
		} else {

			// No cambiar "password" por "contraseña" porque se rompe. Es algo del Laravel.
			
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('contraseña')
			);

			//Loguea al usuario para ver sus datos. Si está eliminado o bloqueado, es echado del sistema.

			if (Auth::attempt($userdata)) {

				if ((Auth::user()->dadoDeBaja == 1) OR (Auth::user()->bloqueado == 1)) {

					return Redirect::to('/logout')->with('cuenta-invalida', 'Su cuenta ha sido deshabilitada.');

				} else {

					return Redirect::to('/admin/usuarios')->with('ingreso-exitoso', 'Ha ingresado con éxito al sistema.');

				}
	
			} else {

				return Redirect::to('/login')->with('ingreso-fallido', 'Sus credenciales son inválidas.');
			}
		}
	}

	public function doLogout()
	{
		Auth::logout();
		return Redirect::to('/login');
	}

}
