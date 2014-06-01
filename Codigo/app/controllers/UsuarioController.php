<?php
class UsuarioController extends BaseController {
 
    public function mostrarUsuarios()
    {
        $Usuario = Usuario::all();
        
        return View::make('Usuario.lista', array('usuarios' => $Usuario));
    }


    public function nuevoUsuario()
    {
        return View::make('Usuario.crear');
    }
  
    public function crearUsuario()
    {

        $validador= Validator::make(Input::all(),Usuario::reglasDeValidacion());

        if($validador->fails()){
            return Redirect::back()->withErrors($validador);
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
 
     /**
     * Ver detalles de usuario | No  usado por el momento
   *  
   * public function verUsuario($id)
   * {
   *      $usuario = Usuario::find($id);
   *
   *     return View::make('Usuario.ver', array('usuario' => $usuario));
   * }
    */

    public function bloquearUsuario($id)
    {
        $usuario=Usuario::find($id);
        $usuario->bloqueado=!($usuario->bloqueado);
        $usuario->save();
        return Redirect::to('/admin/usuarios');
    }

    public function modificarDatos($id)
    {
        $usuario=Usuario::find($id);
        return View::make('usuario.modificar',['usuario'=>$usuario]);
    }

    public function modificarUsuario($id)
    {
            $usuario=Usuario::find($id);
            $usuario->nombre=Input::get('nombre');
            $usuario->apellido=Input::get('apellido');
            $usuario->email=Input::get('email');
            $usuario->dni=Input::get('dni');
            $usuario->contraseña = Hash::make(Input::get('contraseña'));
            $usuario->save();
            
            return Redirect::to('/admin/usuarios/');
    }
 
 
}
?>