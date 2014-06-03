<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {


	protected $table = 'usuario';
	protected $fillable = array('nombre', 'apellido', 'email', 'dni');
	protected $guarded = array('contraseña');

    /* No existe regla nativa length para números (DNI). Luego busco la forma de implementarla. */
	public static function reglasDeValidacion(){
		
        return ['nombre'=>['min:2','required'], 'apellido'=>['min:2','required'], 'email'=>['min:4','required', 'email', 'unique:usuario,email'], 'dni'=>['numeric','required', 'unique:usuario,dni'], 'contraseña'=>['min:5','required']] ;
	}

	public static function reglasDeValidacionMod(){

        return ['nombre'=>['min:2','required'], 'apellido'=>['min:2','required'], 'email'=>['min:4','required', 'email'], 'dni'=>['numeric','required'], 'contraseña'=>['min:5']] ;
	}


	public function localidad(){
		return $this->belongsTo('Localidad','localidad_id');
	}	


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->contraseña;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}
