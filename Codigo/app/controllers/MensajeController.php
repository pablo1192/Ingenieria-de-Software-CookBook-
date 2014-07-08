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
		$mensajes=null;
		$filtrar=false;
		$criterio=null;
		
		if((Input::has('filtrar')) && (Input::get('filtrar') != ' ' )){
			
			$filtrar=true;
			switch(Input::get('filtrar')){
				case 'noLeidos':	$mensajes=Mensaje::noLeidos()->get();
									$criterio='No leidos';
									break;
				case 'leidos':		$mensajes=Mensaje::leidos()->get();
									$criterio='Leidos';
									break;
				//Si es cualquier otra opcion, ignoro el filtrado
				default:			return Redirect::to('/admin/mensajes') ;
									break;
			}
		}
		else{
			$mensajes=Mensaje::all();
		}
		
		
		return View::make('mensaje.listar',['mensajes'=>$mensajes, 'filtrar'=> $filtrar, 'criterio'=>$criterio]);
	}
	
	
	
	public function visualizar($id){
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/mensajes','/admin/mensajes*'],true)){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}	  
		if(!Cookbook::existeId($id,'mensaje')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
		
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
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/mensajes','/admin/mensajes*'],true)){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}	  
		if(!Cookbook::existeId($id,'mensaje')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
				
		$mensaje=Mensaje::find($id);		

		//Cambio su estado..
		$mensaje->leído=!($mensaje->leído);
		$mensaje->save();
		
		return Redirect::back();
	}
		


	public function eliminar($id){
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/mensajes','/admin/mensajes/*'],true)){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}	  
		if(!Cookbook::existeId($id,'mensaje')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
				
		$mensaje=Mensaje::find($id);		

		if($mensaje){
			$mensaje->delete();
		}
		
		return Redirect::to('/admin/mensajes')->with('mensajeEliminado','¡El mensaje ha sido eliminado correctamente!.');
	}
		
	
	
	



}

?>
