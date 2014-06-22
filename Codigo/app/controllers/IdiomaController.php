<?php

class IdiomaController extends BaseController {

	public function listar()
	{
		$idiomas= Idioma::disponibles()->get();
		return View::make('idioma.idiomas',['idiomas'=>$idiomas]);
	}
	
	public function alta(){
		
		$validador= Validator::make(Input::all(),Idioma::reglasDeValidacion());
		
		if($validador->fails()){			
			//Si se logra restaurar, es xq lo req el usr
			if(Idioma::restaurar(Input::get('nombre'))){
				return Redirect::to('/admin/idiomas/');
			}
			else{
				return Redirect::back()->withErrors($validador);
			}
		}
		else{
			//Creo el idioma
			Idioma::create(Input::all());
			return Redirect::to('/admin/idiomas/');
		}
	}


	public function formularioAlta(){
		return View::make('idioma.crear');
	}
	
	public function modificacion($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::existeIdDistintoDe1($id,'idioma')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/idiomas','/admin/idiomas/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		
		$idioma=Idioma::find($id);
	
		if(($idioma) && ($idioma->nombre != Input::get('nombre'))){
			$validador= Validator::make(Input::all(),Idioma::reglasDeValidacion());
			
			if($validador->fails()){
				//~ return Redirect::to('/admin/idiomas/'.$id.'/modificar/')->withErrors($validador)->withInput();
				return Redirect::back()->withErrors($validador)->withInput();
			}
			else{
				//Modifico el idioma			
				$idioma->nombre=Input::get('nombre');
				$idioma->save();
				
				return Redirect::to('/admin/idiomas/');
			}
		}
		else{
			return Redirect::to('/admin/idiomas/');
		}
	}
	
	public function formularioModificacion($id){
		//To-Do: Proteger este metodo

		if(!Cookbook::existeIdDistintoDe1($id,'idioma')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/idiomas','/admin/idiomas/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$idioma=Idioma::find($id);
		return View::make('idioma.modificar',['idioma'=>$idioma]);
	}
	
	public function baja($id){
		//To-Do: Proteger este metodo
		if(!Cookbook::existeIdDistintoDe1($id,'idioma')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/idiomas'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		
		//Se le da de baja logica...
		$idioma=Idioma::find($id);
		$idioma->dadoDeBaja=true;
		$idioma->save();
		return Redirect::back();
	}
	
	public function restaurar($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros/recuperar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$idioma= Idioma::find($id);
		
		//existe?
		if($idioma){
			$idioma->dadoDeBaja=false;
			$idioma->save();
			return Redirect::to('/admin/libros/recuperar#idiomas')->with('idiomaRecuperado','¡El idioma «'.$idioma->nombre.'» ha sido recuperado exitosamente!');
		}
		else{
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
	}

}

?>
