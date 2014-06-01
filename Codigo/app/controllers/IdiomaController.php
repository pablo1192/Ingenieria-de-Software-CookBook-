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
			//~ return Redirect::to('/admin/idiomas/crear')->withErrors($validador);
			return Redirect::back()->withErrors($validador);
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
		
		$validador= Validator::make(Input::all(),Idioma::reglasDeValidacion());
		
		if($validador->fails()){
			//~ return Redirect::to('/admin/idiomas/'.$id.'/modificar/')->withErrors($validador)->withInput();
			return Redirect::back()->withErrors($validador)->withInput();
		}
		else{
			//Modifico el idioma
			$idioma=Idioma::find($id);
			$idioma->nombre=Input::get('nombre');
			$idioma->save();
			
			return Redirect::to('/admin/idiomas/');
		}
	}
	
	public function formularioModificacion($id){
		//ToDo: Proteger este metodo 
		$idioma=Idioma::find($id);
		return View::make('idioma.modificar',['idioma'=>$idioma]);
	}
	
	public function baja($id){
		//ToDo: Proteger este metodo
		
		if($id != 1){
			$cantidadDeLibros= Idioma::find($id)->libros()->count();
			
			//Si hay al menos una libro asociado..actualizo al Idioma por defecto ("Sin Idioma")..
			if($cantidadDeLibros){
				$actualizaciónIds= DB::update('update libro set idioma_id = 1 where idioma_id = ? ', [$id]);
				
			}
			//Elimino sin problemas
			Idioma::destroy($id);

		}
		return Redirect::back();
	}

}

?>
