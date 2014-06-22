<?php

class AutorController extends BaseController {

	public function listar()
	{
		$autores= Autor::disponibles()->get();
		return View::make('autor.autores',['autores'=>$autores]);
	}
	
	public function alta(){
		
		$validador= Validator::make(Input::all(),Autor::reglasDeValidacion());
		
		if($validador->fails()){
			//Si se logra restaurar, es xq lo req el usr
			if(Autor::restaurar(Input::get('nombre'))){
				return Redirect::to('/admin/autores/');
			}
			else{
				return Redirect::back()->withErrors($validador);
			}
		}
		else{
			//Creo el autor
			Autor::create(Input::all());
			return Redirect::to('/admin/autores/');
		}
	}


	public function formularioAlta(){
		return View::make('autor.crear');
	}
	
	public function modificacionAutor($id){
		//ToDo: Proteger este metodo
			//Si no existe el id o es el id=1
	if(!Cookbook::existeIdDistintoDe1($id,'autor')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
	}	
	if(!Cookbook::accedeSoloDesdeRuta(['/admin/autores','/admin/autores/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
	}	
	$autor=Autor::find($id);
	if ($autor->nombre != Input::get('nombre')){	
		$validador= Validator::make(Input::all(),Autor::reglasDeValidacion());
		
		if($validador->fails()){
			//~ return Redirect::to('/admin/idiomas/'.$id.'/modificar/')->withErrors($validador)->withInput();
			return Redirect::back()->withErrors($validador)->withInput();
		}
		else{
			$autor->nombre=Input::get('nombre');
			$autor->save();
         	return Redirect::to('/admin/autores/');
		}
	}
    else
       return Redirect::to('/admin/autores'); 
	}
	
	public function formularioModificacion($id){
		//ToDo: Proteger este metodo 
		if(!Cookbook::existeIdDistintoDe1($id,'autor')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/autores','/admin/autores/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}

		$autor=Autor::find($id);
		return View::make('autor.modificar',['autor'=>$autor]);
	}
	
	public function baja($id){
		//ToDo: Proteger este metodo
        if(!Cookbook::existeIdDistintoDe1($id,'autor')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/autores'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		
		//Se le da baja lógica...
		$autor= Autor::find($id);
		$autor->dadoDeBaja=true;
		$autor->save();
		
		return Redirect::back();
		
	}
	
	public function restaurar($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros/recuperar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$autor= Autor::find($id);
		
		//existe?
		if($autor){
			$autor->dadoDeBaja=false;
			$autor->save();
			return Redirect::to('/admin/libros/recuperar#autores')->with('recuperado','¡El autor «'.$autor->nombre.'» ha sido recuperado exitosamente!');
		}
		else{
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
	}
	

}

?>

