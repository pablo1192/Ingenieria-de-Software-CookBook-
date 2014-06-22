<?php

class EditorialController extends BaseController {


	public function listar()
	{
		$editoriales= Editorial::disponibles()->get();
		return View::make('editorial.editoriales',['editoriales'=>$editoriales]);
	}
	
	public function alta(){
		
		$validador= Validator::make(Input::all(),Editorial::reglasDeValidacion());
		
		if($validador->fails()){
			//posible editorial ya creada
			//Si existe una llamada igual, directamente se la recupera... caso contrario, se informa del error de validacion
			if(Editorial::restaurar(Input::get('nombre'))){
				return Redirect::to('/admin/editoriales/');
			}
			else{
				return Redirect::back()->withErrors($validador);
			}
			
		}
		else{
			//Creo el idioma
			Editorial::create(Input::all());
			return Redirect::to('/admin/editoriales/');
		}
	}


	public function formularioAlta(){

		return View::make('editorial.crear');
	}
	
	public function modificacion($id){
		//ToDo: Proteger este metodo
		
		//Si no existe el id o es el id=1
		if(!Cookbook::existeIdDistintoDe1($id,'editorial')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/editoriales','/admin/editoriales/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}

		$editorial=Editorial::find($id);
		if(($editorial) && ($editorial->nombre != Input::get('nombre'))){
			$validador= Validator::make(Input::all(),Editorial::reglasDeValidacion());
			
			if($validador->fails()){			
				return Redirect::back()->withErrors($validador)->withInput();
			}
			else{
				//Modifico el idioma
				$editorial->nombre=Input::get('nombre');
				$editorial->save();
				
				return Redirect::to('/admin/editoriales/');
			}
		}
		else{
			return Redirect::to('/admin/editoriales/');
		}
	}
	
	public function formularioModificacion($id){
		//ToDo: Proteger este metodo 
		//Si no existe el id o es el id=1
		if(!Cookbook::existeIdDistintoDe1($id,'editorial')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/editoriales','/admin/editoriales/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}

		$editorial=Editorial::find($id);
		return View::make('editorial.modificar',['editorial'=>$editorial]);
	}

	public function baja($id){
		//ToDo: Proteger este metodo

		if(!Cookbook::existeIdDistintoDe1($id,'editorial')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/editoriales'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		
		//Se le da baja lógica...
		$editorial= Editorial::find($id);
		$editorial->dadoDeBaja=true;
		$editorial->save();
		
		return Redirect::back();
	}
	
	public function restaurar($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros/recuperar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$editorial= Editorial::find($id);
		
		//existe?
		if($editorial){
			$editorial->dadoDeBaja=false;
			$editorial->save();
			return Redirect::to('/admin/libros/recuperar#editoriales')->with('editorialRecuperada','¡La editorial «'.$editorial->nombre.'» ha sido recuperada exitosamente!');
		}
		else{
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
	}
	
}

?>
