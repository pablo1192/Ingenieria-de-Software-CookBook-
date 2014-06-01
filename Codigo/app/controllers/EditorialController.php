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
			return Redirect::back()->withErrors($validador);
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
		
		$validador= Validator::make(Input::all(),Editorial::reglasDeValidacion());
		
		if($validador->fails()){			
			return Redirect::back()->withErrors($validador)->withInput();
		}
		else{
			//Modifico el idioma
			$editorial=Editorial::find($id);
			$editorial->nombre=Input::get('nombre');
			$editorial->save();
			
			return Redirect::to('/admin/editoriales/');
		}
	}
	
	public function formularioModificacion($id){
		//ToDo: Proteger este metodo 
		$editorial=Editorial::find($id);
		return View::make('editorial.modificar',['editorial'=>$editorial]);
	}
	
	public function baja($id){
		//ToDo: Proteger este metodo
		
		if($id != 1){
			$cantidadDeLibros= Editorial::find($id)->libros()->count();
			
			//Si hay al menos una libro asociado..actualizo a la editorial  por defecto ("Sin Editorial")..
			if($cantidadDeLibros){
				$actualizaciónIds= DB::update('update libro set editorial_id = 1 where editorial_id = ? ', [$id]);
				//Se deberia chequear q salio todo ok
			}
			
			//Elimino sin problemas
			Editorial::destroy($id);
			
		}
		
		return Redirect::back();
	}

}

?>
