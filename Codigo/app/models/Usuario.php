<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {


	protected $table = 'usuario';
	protected $fillable = array('nombre', 'apellido', 'email', 'dni', 'provincia_id', 'dirección', 'localidad', 'teléfono');
	protected $guarded = array('contraseña');

    /* No existe regla nativa length para números (DNI). Luego busco la forma de implementarla. */
	public static function reglasDeValidacion(){
		
        return ['nombre'=>['min:2','required'], 'apellido'=>['min:2','required'], 'email'=>['min:3','required', 'email', 'unique:usuario,email'], 'dni'=>['required', 'regex:/^[0-9]{1,2}([.][0-9]{3}([.][0-9]{3}))$/i', 'unique:usuario,dni'], 'dirección'=>['min:7', 'required'], 'localidad'=>['min:5', 'required'], 'teléfono'=>['min:7', 'required'], 'contraseña'=>['min:5','required', 'confirmed']];
	}

	/*  'precio'=>['required','regex:/^[0-9]{1,4}([.][0-9]{1,2})?$/i'] */
	/*  'dni'=>['required', 'regex:/^[0-9]{1,2}([.][0-9]{3}([.][0-9]{3}))', 'unique:usuario,dni'] */
	/*  'dni'=>['numeric','required', 'unique:usuario,dni'  */

	public static function reglasDeValidacionMod(){

        return ['nombre'=>['min:2','required'], 'apellido'=>['min:2','required'], 'email'=>['min:3','required', 'email'], 'dirección'=>['min:7', 'required'], 'localidad'=>['min:5', 'required'], 'dni'=>['required', 'regex:/^[0-9]{1,2}([.][0-9]{3}([.][0-9]{3}))$/i'], 'teléfono'=>['min:7', 'required'], 'contraseña'=>['min:5', 'confirmed']] ;
	}


	/* Reglas especiales para la función Modificar del Admin. Para que no salte error al modificar los datos precargados. Esta función no estará en el sistema final */
	public static function reglasDeValidacionModAdmin(){

        return ['nombre'=>['min:2','required'], 'apellido'=>['min:2','required'], 'email'=>['min:3','required', 'email'], 'dni'=>['required', 'regex:/^[0-9]{1,2}([.][0-9]{3}([.][0-9]{3}))$/i'], 'contraseña'=>['min:5', 'confirmed']] ;
	}

	public static function reglasDeValidacionAdmin(){

        return ['contraseña'=>['min:5', 'confirmed']] ;
	}


	public function provincia(){
		return $this->belongsTo('Provincia','provincia_id');
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
