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

			if (Auth::attempt($userdata)) {

				return Redirect::to('/admin/usuarios');

			} else {	 	

				return Redirect::to('/login');
			}

		}
	}

}
