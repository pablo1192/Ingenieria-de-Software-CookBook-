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

	/*public function showWelcome()
	{
		return View::make('hello');
	}*/

	public function showLogin()
	{
		if (! Auth::check()){
		  return View::make('login');
		}
		else {
			return Redirect::to('/');
		}
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

					Auth::logout();
					return Redirect::to('/login')->with('cuenta-invalida', '-> Su cuenta ha sido deshabilitada.');

				} else {

					return Redirect::to('/');

				}
	
			} else {

				return Redirect::to('/login')->withInput(Input::except('contraseña'))->with('ingreso-fallido', '-> Sus credenciales son inválidas. Ingrese sus datos nuevamente.');
			}
		}
	}

	public function doLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function showReset()
	{
		if (! Auth::check()){
		  return View::make('resetear');
		}
		else {
			return Redirect::to('/');
		}
	}

	public function doReset()
	{
		$usuarios = Usuario::where('email', '<>', 'admin@gmail.com')->get();

		$rules = array(
			'email'    => 'required|email',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/resetear')
				->withErrors($validator)
				->withInput();
		} else {

			if (Input::get('email') != "admin@gmail.com") {
				// Si no es admin, restablece la contraseña. Se le enviaría a la casilla de email algún str_random(). Simulado: el password es "default".
				foreach ($usuarios as $usuario) {
					if (($usuario->email == Input::get('email')) && (!$usuario->bloqueado) && (!$usuario->dadoDeBaja)) {
						$usuario->contraseña = Hash::make("default");
						$usuario->save();
						return Redirect::to('/login')->with('email-encontrado', '-> Revise su casilla de correo para restablecer su contraseña.');
					}
					else {
						if (($usuario->bloqueado) || ($usuario->dadoDeBaja)) {
							return Redirect::to('/login')->with('cuenta-invalida', '-> No es posible restablecer su contraseña.');
						}
					}
				}
				return Redirect::to('/login')->with('email-fallido', '-> Email no encontrado.');
			} else {
				// Si es admin, "no" restablece la contraseña. Mandaría un email de confirmación primero. Simulado: el password es "admin".
				if (Input::get('email') == "admin@gmail.com"){
					$admin = Usuario::where('email', '=', 'admin@gmail.com')->first();
					$admin->contraseña = Hash::make("admin");
					$admin->save();
					return Redirect::to('/login')->with('email-encontrado', '-> Revise su casilla de correo para restablecer su contraseña.');
				}
			}
		}
	}

}
