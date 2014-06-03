<?php
class UsuarioController extends BaseController {

    /*  ***************************************************************************************************************************************************  */
    /*  *************************************************** VISUALIZAR Y CREAR ****************************************************************************  */
    /*  ***************************************************************************************************************************************************  */

    public function mostrarUsuarios()
    {
        $Usuario = Usuario::all();
        
        return View::make('usuario.lista', array('usuarios' => $Usuario));
    }

    
    public function nuevoUsuario()
    {
        return View::make('registrarse');
    }

    public function registrarUsuario()
    {

        $validador= Validator::make(Input::all(),Usuario::reglasDeValidacion());

        if($validador->fails()){
            return Redirect::back()->withInput()->withErrors($validador);
        }
        else{

         $user = new Usuario;
         $user->nombre = Input::get('nombre');
         $user->apellido = Input::get('apellido');
         $user->email = Input::get('email');
         $user->dni = Input::get('dni');
         $user->contraseña = Hash::make(Input::get('contraseña'));
         $user->save();

         /*return Redirect::to('/login')->with('mensaje_registro', 'Usuario registrado con éxito.');;*/
         return Redirect::to('/login');
         }

    }
 
     /**
     * Ver detalles de usuario | No usado por el momento
   *  
   * public function verUsuario($id)
   * {
   *      $usuario = Usuario::find($id);
   *
   *     return View::make('Usuario.ver', array('usuario' => $usuario));
   * }
    */


    /*  ***************************************************************************************************************************************************  */
    /*  *************************************************** FUNCIONES DE ADMIN ****************************************************************************  */
    /*  ***************************************************************************************************************************************************  */

    public function nuevoTestUsuario()
    {
       /* $localidades= Localidad::get();
        $provincias= Provincia::get();
        return View::make('Usuario.crear',['localidades'=>$localidades, 'provincias'=>$provincias]); */
        return View::make('usuario.crear');
    }
  
   /*   Función de testing */
        public function crearUsuario()
    {

        $validador= Validator::make(Input::all(),Usuario::reglasDeValidacion());

        if($validador->fails()){
            return Redirect::back()->withInput()->withErrors($validador);
        }
        else{

         $user = new Usuario;
         $user->nombre = Input::get('nombre');
         $user->apellido = Input::get('apellido');
         $user->email = Input::get('email');
         $user->dni = Input::get('dni');
         $user->contraseña = Hash::make(Input::get('contraseña'));
         $user->save();

         return Redirect::to('/admin/usuarios');
         }
    }

    public function bloquearUsuario($id)
    {
        $usuario=Usuario::find($id);
        $usuario->bloqueado=!($usuario->bloqueado);
        $usuario->save();
        return Redirect::to('/admin/usuarios#area');
    }

    public function modificarDatos($id)
    {
        $usuario=Usuario::find($id);
        return View::make('usuario.modificar',['usuario'=>$usuario]);
    }

    public function modificarUsuario($id)
    {

        $validador= Validator::make(Input::all(),Usuario::reglasDeValidacionMod());

        if($validador->fails()){

            return Redirect::back()->withInput(Input::except('contraseña'))->withErrors($validador);
        }
        else{

            $usuario=Usuario::find($id);

            if ($usuario->nombre != Input::get('nombre')) {
                $usuario->nombre=Input::get('nombre');
            }
            if ($usuario->apellido != Input::get('apellido')){
                $usuario->apellido=Input::get('apellido');
            }
            /*Si el email es diferente al suyo y no existe en la base de datos, se graban los cambios.*/
            if ($usuario->email != Input::get('email') and (sizeof(Usuario::where('email','=',Input::get('email'))->get()) <= 0 )){
                $usuario->email=Input::get('email');
            }
            else {
                /*Si el email es igual al suyo, no realiza cambios.*/
                if ($usuario->email == Input::get('email')) {
                }
                /*Si el email es diferente, pero existe en la base de datos, se le informa del error.*/
                else {
                return Redirect::back()->withInput(Input::except('contraseña'))->withErrors(['El email ingresado ya se encuentra en la base de datos']);
                }
            }

            /*Si el dni es diferente al suyo y no existe en la base de datos, se graban los cambios.*/
            if ($usuario->dni != Input::get('dni') and (sizeof(Usuario::where('dni','=',Input::get('dni'))->get()) <= 0 )){
                $usuario->dni=Input::get('dni');
            }
            else {
                /*Si el dni es igual al suyo, no realiza cambios.*/
                if ($usuario->dni == Input::get('dni')) {
                }
                /*Si el dni es diferente, pero existe en la base de datos, se le informa del error.*/
                else {
                return Redirect::back()->withInput(Input::except('contraseña'))->withErrors(['El DNI ingresado ya se encuentra en la base de datos']);
                }
            }

            if ( ($usuario->contraseña != Input::get('contraseña')) AND (Input::get('contraseña') != null) ){
                $usuario->contraseña = Hash::make(Input::get('contraseña'));
            }

            $usuario->save();
            
            return Redirect::to('/admin/usuarios/');
          }
    }

    /*  ***************************************************************************************************************************************************  */
    /*  ************************************************************* PERFIL ******************************************************************************  */
    /*  ***************************************************************************************************************************************************  */

    public function formularioPerfil()
    {
        return View::make('usuario.perfil');
    }

    public function modificarPerfil()
    {

        $validador= Validator::make(Input::all(),Usuario::reglasDeValidacionMod());

        if($validador->fails()){

            return Redirect::back()->withInput(Input::except('contraseña'))->withErrors($validador);
        }
        else{


            if (Auth::user()->nombre != Input::get('nombre')) {
                Auth::user()->nombre=Input::get('nombre');
            }
            if (Auth::user()->apellido != Input::get('apellido')){
                Auth::user()->apellido=Input::get('apellido');
            }
            /*Si el email es diferente al suyo y no existe en la base de datos, se graban los cambios.*/
            if (Auth::user()->email != Input::get('email') and (sizeof(Usuario::where('email','=',Input::get('email'))->get()) <= 0 )){
                Auth::user()->email=Input::get('email');
            }
            else {
                /*Si el email es igual al suyo, no realiza cambios.*/
                if (Auth::user()->email == Input::get('email')) {
                }
                /*Si el email es diferente, pero existe en la base de datos, se le informa del error.*/
                else {
                return Redirect::back()->withInput(Input::except('contraseña'))->withErrors(['El email ingresado ya se encuentra en la base de datos']);
                }
            }

            /*Si el dni es diferente al suyo y no existe en la base de datos, se graban los cambios.*/
            if (Auth::user()->dni != Input::get('dni') and (sizeof(Usuario::where('dni','=',Input::get('dni'))->get()) <= 0 )){
                Auth::user()->dni=Input::get('dni');
            }
            else {
                /*Si el dni es igual al suyo, no realiza cambios.*/
                if (Auth::user()->dni == Input::get('dni')) {
                }
                /*Si el dni es diferente, pero existe en la base de datos, se le informa del error.*/
                else {
                return Redirect::back()->withInput(Input::except('contraseña'))->withErrors(['El DNI ingresado ya se encuentra en la base de datos']);
                }
            }



            if ( (Auth::user()->contraseña != Input::get('contraseña')) AND (Input::get('contraseña') != null) ){
                Auth::user()->contraseña = Hash::make(Input::get('contraseña'));
            }

            Auth::user()->save();
            
            return Redirect::to('/admin/usuarios/');
          }
    }

    public function darBaja()
    {
        Auth::user()->dadoDeBaja = 1;
        Auth::user()->save();
        return Redirect::to('/logout');
    }

}
?>