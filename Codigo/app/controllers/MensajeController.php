<?php

class MensajeController extends BaseController {

	public function visualizarFormulario()
	{
		return View::make('contacto');
	}
	
	public function enviarMensaje()
	{
		$validador = Validator::make(Input::all(), Mensaje::reglasDeValidacion());
		
		if($validador->fails()){
			return Redirect::back()->withErrors($validador);
		}
		else{
			//proceso el cuerpo y asunto del msj: Sustituyo caracters HTML (protección).
			//Los saltos de linea en el cuerpo los sustituyo por <br/>
			$asunto=e(Input::get('asunto'));
			
			$cuerpo=e(Input::get('cuerpo'));			
			$cuerpo=nl2br($cuerpo);
			
			//creo el mensaje
			Mensaje::create([
							'asunto'=> $asunto,
							'cuerpo'=> $cuerpo,
							'usuario_id'=>Input::get('usuario')
					]);
			
			return Redirect::back()->with('mensajeEnviado','El mensaje ha sido enviado correctamente.');
		}
		
	}
	
	public function listar(){
		//ToDo: Proteger este metodo!
		
		$mensajes=Mensaje::all();
		return View::make('mensaje.listar',['mensajes'=>$mensajes]);
	}
	
	
	
	public function visualizar($id){
		//ToDo: Proteger este metodo!
		
		$mensaje=Mensaje::find($id);		
		
		//Si no fue leido lo seteo como leido..
		if(!$mensaje->leído){
			$mensaje->leído=true;
			$mensaje->save();
		}
		
		return View::make('mensaje.visualizar',['mensaje'=>$mensaje]);
	}
	
	//Cambia el estado de leido
	public function cambiarEstado($id){
		//ToDo: Proteger este metodo!
		
		$mensaje=Mensaje::find($id);		

		//Cambio su estado..
		$mensaje->leído=!($mensaje->leído);
		$mensaje->save();
		
		return Redirect::back();
	}
		
	
	
	



}

?>
