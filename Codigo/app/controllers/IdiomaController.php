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
		//ToDo: Proteger este metodo 
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
		//ToDo: Proteger este metodo
		if(!Cookbook::existeIdDistintoDe1($id,'idioma')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/idiomas'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
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
