<?php

class LibroController extends BaseController {

	public function listar()
	{
		//Se ignoran los libros dados de baja logica
		//~ $libros=Libro::all();
		$libros=Libro::disponibles()->get();
		return View::make('libro.libros',['libros'=>$libros]);
	}

	

	//Muestra los detalles de un libro, desde la administración
	public function visualizar($id){
		$libro=Libro::find($id);
		return View::make('libro.visualizar',['libro'=>$libro]);
	}
	
	public function formularioAlta(){
		//Recupero las entidades secundarias, ignorando los valores por 'SIN' usado en caso de no tener ref.
		$idiomas= Idioma::where('id','<>',1)->get();
		$editoriales= Editorial::where('id','<>',1)->get();
		return View::make('libro.crear',['idiomas'=>$idiomas, 'editoriales'=>$editoriales]);
	}
	

	public function alta(){
		
	}

	public function formularioModificacion($id){
		return "Has modificado  a ".$id;		
	}

	public function modificacion($id){

	}
	
	
	public function baja($id){
		//ToDo: Proteger este metodo
		return "Le has dado de baja a ".$id.'<br/> Ingresaste desde: '.Request::header('Referer');;
	}
	
	
	/*Otras Operaciones*/
	
	public function marcarComoAgotado($id){
		//ToDo: Proteger este metodo
		$libro=Libro::find($id);
		$libro->agotado=!($libro->agotado);
		$libro->save();
		return Redirect::to('/admin/libros');
	}
		
	
}

?>
