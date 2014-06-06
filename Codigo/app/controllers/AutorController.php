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
			//~ return Redirect::to('/admin/idiomas/crear')->withErrors($validador);
			return Redirect::back()->withErrors($validador);
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
		
		$cantidadDeLibros= Autor::find($id)->libros()->count();
		//Si hay al menos un libro asociado..actualizo el Autor por defecto ("Sin Autor")..
		if($cantidadDeLibros){
			$actualizaciónIds= DB::update('update libroautor set autor_id = 1 where autor_id = ? ', [$id]);
		}
		$libros = Libro::disponibles()->get();
		foreach($libros as $libro) 
		{
		    if($libro->autores()->count() >= 1 && $libro->autores()->where('autor_id','=','1')->count() >= 1){
				$libro->autores()->detach(1);
			}
			if($libro->autores()->count() == 0)
			{   
			   $libro->autores()->attach(1);
			}
		}	
		//Elimino 
		Autor::destroy($id);		
		return Redirect::to('/admin/autores');                    //Redirect::back();
		
	}
	

}

?>

