<?php

class LibroController extends BaseController {

	public function listar()
	{
		//Se ignoran los libros dados de baja logica
		//~ $libros=Libro::all();
		$libros=Libro::disponibles()->get();
		return View::make('libro.libros',['libros'=>$libros,'librosSinInformación'=>Libro::sinInformación()]);
	}
	
	//Muestra el catalogo
	public function mostrarCatalogo()
	{
		//Se ignoran los libros dados de baja logica
		$librosDisponibles=Libro::disponibles();
		$filtrado=false;
		//Si hay filtrado se agregan las condiciones...
		if( (Input::has('filtrar')) && (input::has('valor')) ){
			$valor=Input::get('valor');
			
			switch(Input::get('filtrar')){
				case 'isbn':		$librosDisponibles->where('isbn','like','%'.$valor.'%');
									break;
				case 'titulo':		$librosDisponibles->where('título','like','%'.$valor.'%');
									break;
				case 'editorial':	$librosDisponibles->where('editorial_id','=',$valor);
									break;
				case 'etiqueta':	$librosDisponibles->whereHas('etiquetas', function($query) use ($valor) {$query->where('etiqueta_id','=',$valor);});
									break;
				case 'autor':		$librosDisponibles->whereHas('autores',function($query) use ($valor){$query->where('nombre','like','%'.$valor.'%');});
									break;
				default:			return Redirect::back()->withErrors(['El criterio de filtrado es invalido!.']);
									break;
			}
			
			$filtrado=true;
		}
		
		$libros=$librosDisponibles->get();
		
		
		return View::make('catalogo',['libros'=>$libros, 'filtrado'=>$filtrado,'criterio'=>Input::get('filtrar','ninguno'),'valor'=>Input::get('valor','ninguno')]);
	}
	
	//Muestra los detalles de un libro, desde la administración
	public function visualizar($id){
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}	  
		if(!Cookbook::existeId($id,'libro')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
	  
		$libro=Libro::find($id);
		return View::make('libro.visualizar',['libro'=>$libro]);
	}


	public function visualizarDetalles($id){
  
		if(!Cookbook::existeId($id,'libro')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}

		$libro=Libro::find($id);		
		return View::make('libro.visualizarDetalles',['libro'=>$libro]);
	}


	public function formularioAlta(){
		//Recupero las entidades secundarias, ignorando los valores por 'SIN' usado en caso de no tener ref.
		$idiomas= Idioma::disponibles()->get();
		$editoriales= Editorial::disponibles()->get();
		$etiquetas= Etiqueta::disponibles()->get();
		$autores= Autor::disponibles()->get();
		return View::make('libro.crear',['idiomas'=>$idiomas, 'editoriales'=>$editoriales,'etiquetas'=>$etiquetas,'autores'=>$autores]);
	}
	

	public function alta(){
		$validador= Validator::make(Input::all(),Libro::reglasDeValidacion());
		
		if($validador->fails()){
			return Redirect::back()->withErrors($validador)->withInput();
		}
		else{
			
			//contiene los posibles msj de errores
			$errores=[];
			
			//Validación Manual Requerida: Análisis de alternativas

			// Relación 1 a 1: Idioma/Editorial
			// -> Debido a q puede enviarse otro sin checkbox activado, pudiendo mal interpretarse.
			// Campo	Otro	Check	Acción
			// --------------------------------
			// Si		SI		SI		ERROR
			// Si		SI		NO		cargar Campo
			// Si		NO		SI		ERROR
			// Si		NO		NO		cargar Campo
			// NO		SI		SI		cargar Otro
			// NO		SI		NO		ERROR
			// NO		NO		SI		ERROR
			// NO		NO		NO		ERROR
			//Conclusión= Campo se carga solo cuando  esta presente y no el checkbox. Otro solo cuando esta presente junto con el check
		
			//idioma: debe haberse definido al menos uno. Sino otro se tomará en cuenta despues.
			//Si  NO se definió (Otro y Checkbox Activo) ni (Idioma con  Checbox activo). 
		
			if(!( ( Input::has('idioma-otro') && Input::has('idioma-checkbox') ) || ( Input::has('idioma') && !(Input::has('idioma-checkbox')) ) )){			
				$errores['idioma']='Debe seleccionar un idioma para el libro. Utilice la lista o bien defina uno nuevo.';
			}		
			
			
			//editorial: idem idioma
			if(!( ( Input::has('editorial-otro') && Input::has('editorial-checkbox') ) || ( Input::has('editorial') && !(Input::has('editorial-checkbox')) ) )){			
				$errores['editorial']='Debe seleccionar una editorial para el libro. Utilice la lista o bien defina una nueva.';
				//~ $errores['editorial']='Debe seleccionar una editorial para el libro. Utilice la lista o bien defina una nueva. ###DEBUG: Editorial='. ((Input::has('editorial'))?'SI':'NO'). ', Checkbox='. ((Input::has('editorial-checkbox'))?'SI':'NO'). ' y Otro='. ((Input::has('editorial-otro'))?'SI':'NO');
			}
			
			
			// Relación 1 a N: Etiqueta/Autor			
			// Campo	Otro	Check	Acción
			// --------------------------------
			// Si		SI		SI		Cargar Campo y Otro
			// Si		SI		NO		cargar Campo
			// Si		NO		SI		ERROR
			// Si		NO		NO		cargar Campo
			// NO		SI		SI		cargar Otro
			// NO		SI		NO		ERROR
			// NO		NO		SI		ERROR
			// NO		NO		NO		ERROR
			//Conclusión= Campo se carga cuando  esta presente. Otro solo cuando esta presente junto con el check.
			
			//etiquetas: Al menos 1 de los dos campos debe estar completado.
			//El Otro solo soporta 1 etiqueta y debe haberse activado el checkbox. 	
			if( !( (Input::has('etiqueta-otro') && Input::has('etiqueta-checkbox')) || (Input::has('etiqueta')) ) ){
				$errores['etiquetas']='Debe seleccionar una o mas etiquetas de la lista, o bien defina una nueva.';
				//~ $errores['etiquetas']='Debe seleccionar una o mas etiquetas de la lista, o bien defina una nueva. ###DEBUG: Etiqueta='. ((Input::has('etiqueta'))?'SI':'NO'). ', Checkbox='. ((Input::has('etiqueta-checkbox'))?'SI':'NO'). ' y Otro='. ((Input::has('etiqueta-otro'))?'SI':'NO');
			}
			
			//autores: idem etiquetas
			if( !( (Input::has('autor-otro') && Input::has('autor-checkbox')) || (Input::has('autor')) ) ){
				$errores['autores']='Debe seleccionar uno o mas autores de la lista, o bien defina uno nuevo.';
			}
			
			
			//Chequeo de archivos: subida correcta			
			if ( !( (Input::file('tapa')->isValid()) && (Input::file('indice')->isValid()) ) ){
				$errores['archivos']='Los archivos seleccionados se han cargado de forma erronea. Vuelva a cargarlos.';
			}
			
			//Si hubo errores lo devuelvo al form
			if(count($errores)>0){
				return Redirect::back()->withErrors($errores)->withInput();
			}
			else{
				//Se carga un array con los datos definitivos
				//Basicos:
				$datos=Input::only('isbn','precio');
				$datos['título']=Input::get('titulo');
				$datos['añoEdición']=Input::get('anoDeEdicion');
				$datos['hojas']=Input::get('cantidadDeHojas');				
				
				//Claves foraneas:
				if(Input::has('idioma-checkbox')){
					//Se crea el nuevo idioma..
					$idioma=Idioma::create(['nombre'=>Input::get('idioma-otro')]);
					$datos['idioma_id']=$idioma->id;
				}
				else{
					$datos['idioma_id']= (int) Input::get('idioma');
				}
				
				
				if(Input::has('editorial-checkbox')){					
					$editorial=Editorial::create(['nombre'=>Input::get('editorial-otro')]);
					$datos['editorial_id']=$editorial->id;				
				}
				else{
					$datos['editorial_id']=(int) Input::get('editorial');
				}
				
				//Creo el libro con la info básica:
				$libro= Libro::create($datos);				
				
				
				
				// Se asocia a las Entidad NaN:
				//Autor:
				if(Input::has('autor')){
					//uso Sync para agregar los id a la tabla libroautor
					$libro->autores()->sync(Input::get('autor'));
				}
				if(Input::has('autor-checkbox')){					
					$autor=Autor::create(['nombre'=>Input::get('autor-otro')]);
					$libro->autores()->attach($autor->id);
				}


				//Etiqueta:
				if(Input::has('etiqueta')){
					//uso Sync para agregar los id a la tabla libroautor
					$libro->etiquetas()->sync(Input::get('etiqueta'));
				}

				if(Input::has('etiqueta-checkbox')){					
					$etiqueta=Etiqueta::create(['nombre'=>Input::get('etiqueta-otro')]);
					$libro->etiquetas()->attach($etiqueta->id);
				}
				
				//Se colocan los archivos: Se deberia chequear q salio bn
				Libro::ubicarArchivos($libro,Input::file('tapa'),Input::file('indice'));

				return Redirect::to('/admin/libros');
			}
			
		}
	}

	public function formularioModificacion($id){
		//ToDo: proteger este método
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros','/admin/libros/'.$id.'/modificar','/admin/libros/sinInformacion'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}


		$libro=Libro::find($id);

		if($libro)	{
		//Selecciono los autors que no estan relacionados con libro para ofrecer vincularlos
			$autoresFiltrados=DB::select('	select a.id,a.nombre
											from autor a
											where (a.id <> 1) and (a.dadoDeBaja = 0) and not exists (
													select *
													from libroautor la
													where la.libro_id = '.$id.' and (a.id = la.autor_id)
											)
			');
			
			$etiquetasFiltradas=DB::select('select e.id,e.nombre
											from etiqueta e
											where (e.id <> 1) and (e.dadoDeBaja = 0) and not exists (
													select *
													from libroetiqueta le
													where le.libro_id = '.$id.' and (e.id = le.etiqueta_id)
											)
			');
			
			return View::make('libro.modificar',['libro'=>$libro, 'idiomas'=>Idioma::disponibles()->get(), 'editoriales'=>Editorial::disponibles()->get(),'autores'=>$autoresFiltrados,'etiquetas'=>$etiquetasFiltradas]);
		}
		else {
   		   return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
	}

	public function modificacion($id){
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros','/admin/libros/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		if(!Cookbook::existeId($id,'libro')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		//Se descompuso la funcionalidad en 5 secciones: info,autores,etiquetas,tapa e indice		
		if(Input::has('modificar')){
			switch (Input::get('modificar')) {
				case 'info':		$this->modificarInfo($id,Input::all());
									break;
				case 'autores':		$this->modificarAutores($id,Input::all());
									break;
				case 'etiquetas':	$this->modificarEtiquetas($id,Input::all());
									break;
				case 'archivos':	$this->modificarArchivo($id,Input::all());
									break;
				default: 			return Redirect::back()->withErrors('Lo que intentas modificar no es válido');
			}		
			return Redirect::to('/admin/libros/'.$id.'/modificar#'.Input::get('modificar'));
		}
		else{
			return Redirect::back()->withErrors('Error en el envío del formulario o este no es válido.');
		}
	}
	
	
	public function baja($id){
		//ToDo: Proteger este metodo
		
		//Criterio: Si el libro no fue vendido, se puede elimar completamente del Sistema, incluyendo archivos.
		// Sino se da de baja lógica, puiendose conservar o no sus archivos.
		//To-Do: Ex
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}		

		if(!Cookbook::existeId($id,'libro')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		$libro= Libro::find($id);		
		$libro->dadoDeBaja=true;
		$libro->save();
		return Redirect::to('/admin/libros#area');
	}
	
	
	/*Otras Operaciones*/
	
	public function marcarComoAgotado($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}		

		if(!Cookbook::existeId($id,'libro')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}

		$libro=Libro::find($id);
		$libro->agotado=!($libro->agotado);
		$libro->save();
		return Redirect::to('/admin/libros#area');
	}
	
	
	public function librosSinInformación(){	
		//Para cada posibilidad retorno los libros disponibles
		$librosSinAutor= Autor::find(1)->libros()->disponibles()->get();
		$librosSinEditorial= Editorial::find(1)->libros()->disponibles()->get();
		$librosSinIdioma= Idioma::find(1)->libros()->disponibles()->get();
		$librosSinEtiqueta= Etiqueta::find(1)->libros()->disponibles()->get();
	
		return View::make('libro.sinInformacion',['librosSinAutor'=>$librosSinAutor,'librosSinEditorial'=>$librosSinEditorial,'librosSinIdioma'=>$librosSinIdioma,'librosSinEtiquetas'=>$librosSinEtiqueta]);
	}
	
	// Funciones de utilidad/privadas	
	//
	
	protected function modificarInfo($id,$datos){
		$reglasDeValidacion=[
			'isbn'=>['required','numeric','digits_between:10,13', 'unique:libro,isbn,'.$id],
			'titulo'=>['required','regex:/[a-zñÑáéíóú 0-9]+/i','min:2','max:64'],
			'editorial'=>['exists:editorial,id','required_without:editorial-otro'],
			'editorial-otro'=>['regex:/[a-zñ ]+/i','max:64','min:5','unique:editorial,nombre,1','required_without:editorial'],
			'idioma'=>['exists:idioma,id','required_without:idioma-otro'],
			'idioma-otro'=>['regex:/[a-zñÑáéíóú ]+/i','max:16','min:5','unique:idioma,nombre,1','required_without:idioma'],
			'anoDeEdicion'=>['required','numeric','between:1900,2014'],
			'hojas'=>['required','numeric','between:10,9999'],
			'precio'=>['required','regex:/^[0-9]{1,4}([.][0-9]{1,2})?$/i']
		];
		
		$validador= Validator::make($datos,$reglasDeValidacion);
		if($validador->fails()){
			return Redirect::to('/admin/libros/'.$id.'/modificar#info')->withErrors($validador);
		}
		else{
			//Actualizo el libro. LLeno un array cn los Key
			$datos=Input::only('isbn','hojas','precio');
			$datos['título']=Input::get('titulo');
			$datos['añoEdición']=Input::get('anoDeEdicion');
			
			//Resuelvo la situacion delas relaciones 1 a N:
			//Idioma:
			if(Input::has('idioma-checkbox')){
				$idiomaNuevo=Idioma::create(['nombre'=>Input::get('idioma-otro')]);
				$datos['idioma_id']=$idiomaNuevo->id;
			}
			else{
				$datos['idioma_id']=Input::get('idioma');
			}
			
			
			//Editorial:
			if(Input::has('editorial-checkbox')){
				$editorialNueva=Editorial::create(['nombre'=>Input::get('editorial-otro')]);
				$datos['editorial_id']=$editorialNueva->id;
			}
			else{
				$datos['editorial_id']=Input::get('editorial');
			}
			
			//Actualizo el libro afectado:
			Libro::find($id)->fill($datos)->save();
		}
	}

	protected function modificarAutores($id,$datos){
		$reglasDeValidacion=[
			'quitar-autor'=>['array','exists:autor,id',],
			'agregar-autor'=>['array','exists:autor,id',],
			'autor-otro'=>['regex:/[a-zñÑáéíóú ]+/i','max:64','min:5', 'unique:autor,nombre']
		];
		
		$validador= Validator::make($datos,$reglasDeValidacion);
		if($validador->fails()){
			return Redirect::to('/admin/libros/'.$id.'/modificar#autores')->withErrors($validador);
		}
		else{
			$libro=Libro::find($id);
			//Compruebo que al menos 1 autor quede para el libro
			$totalAgregados=((Input::has('agregar-autor'))? count(Input::get('agregar-autor')): 0) + ((Input::has('autor-checkbox'))? 1: 0);
			$totalEliminados=((Input::has('quitar-autor'))? count(Input::get('quitar-autor')): 0);
			
			if(($libro->autores()->count() + $totalAgregados - $totalEliminados) >= 1 ){
				//Actualizo las relaciones de autores con libro..
				//Agregar:
				if(Input::has('agregar-autor')){				
					foreach(Input::get('agregar-autor') as $idAutor){
						$libro->autores()->attach($idAutor);
					}
				}
				
				//Crear
				if(Input::has('autor-checkbox')){					
					$autor=Autor::create(['nombre'=>Input::get('autor-otro')]);
					$libro->autores()->attach($autor->id);
				}

				//Quitar
				if(Input::has('quitar-autor')){				
					foreach(Input::get('quitar-autor') as $idAutor){
						$libro->autores()->detach($idAutor);
					}
				}
			}
			else{
				return Redirect::to('/admin/libros/'.$id.'/modificar#autores')->withErrors(['Debe quedar al menos un autor asignado al libro.']);
			}
		}
	}	

	protected function modificarEtiquetas($id,$datos){
		$reglasDeValidacion=[
			'quitar-etiqueta'=>['array','exists:etiqueta,id',],
			'agregar-etiqueta'=>['array','exists:etiqueta,id',],
			'etiqueta-otro'=>['regex:/[a-zñÑáéíóú ]+/i','max:64','min:5', 'unique:etiqueta,nombre']
		];
		
		$validador= Validator::make($datos,$reglasDeValidacion);
		if($validador->fails()){
			return Redirect::to('/admin/libros/'.$id.'/modificar#etiquetas')->withErrors($validador);
		}
		else{
			$libro=Libro::find($id);
			
			//Compruebo que al menos 1 etiqueta quede para el libro
			$totalAgregados=((Input::has('agregar-etiqueta'))? count(Input::get('agregar-etiqueta')): 0) + ((Input::has('etiqueta-checkbox'))? 1: 0);
			$totalEliminados=((Input::has('quitar-etiqueta'))? count(Input::get('quitar-etiqueta')): 0);
			
			if(($libro->etiquetas()->count() + $totalAgregados - $totalEliminados) >= 1 ){
				//Actualizo las relaciones de etiquetas con libro..
				//Agregar:
				if(Input::has('agregar-etiqueta')){				
					foreach(Input::get('agregar-etiqueta') as $idetiqueta){
						$libro->etiquetas()->attach($idetiqueta);
					}
				}
				
				//Crear
				if(Input::has('etiqueta-checkbox')){					
					$etiqueta=Etiqueta::create(['nombre'=>Input::get('etiqueta-otro')]);
					$libro->etiquetas()->attach($etiqueta->id);
				}

				//Quitar
				if(Input::has('quitar-etiqueta')){				
					foreach(Input::get('quitar-etiqueta') as $idEtiqueta){
						$libro->etiquetas()->detach($idEtiqueta);
					}
				}
			}
			else{
				return Redirect::to('/admin/libros/'.$id.'/modificar#autores')->withErrors(['Debe quedar al menos una etiqueta asignada al libro.']);
			}
		}
	}
	
	protected function modificarArchivo($id,$datos){
		$reglasDeValidacion=[
			'archivo'=>['required','mimes:jpeg,png,jpg']
		];
		
		$validador= Validator::make($datos,$reglasDeValidacion);
		if($validador->fails()){
			return Redirect::to('/admin/libros/'.$id.'/modificar#archivos')->withErrors($validador);
		}
		else{
			
			$carpetaDatos=public_path().'/datos/';
			$nombreDeArchivo=$id. '.'. $datos['archivo']->getClientOriginalExtension();			
		
			$datos['archivo']->move($carpetaDatos. $datos['tipo'] .'s', $nombreDeArchivo);
		
			$libro=Libro::find($id);
		
			if($datos['tipo']=='tapa'){
				$libro->tapa=$nombreDeArchivo;
			}
			else{
				$libro->índice=$nombreDeArchivo;
			}
			
			$libro->save();
		}
	}
	
	//Recupera Libros y Entidades Secundarias...
	protected function recuperar(){
		//Hay info para recuperar?
		$recuperar=Libro::recuperar();
		if($recuperar){
			$libros=Libro::noDisponibles()->get();
			$editoriales=Editorial::noDisponibles()->get();
			$idiomas=Idioma::noDisponibles()->get();
			$etiquetas=Etiqueta::noDisponibles()->get();
			$autores=Autor::noDisponibles()->get();	
			return View::make('libro.recuperar',['recuperar'=>$recuperar, 'libros'=>$libros, 'editoriales'=>$editoriales, 'idiomas'=>$idiomas, 'etiquetas'=>$etiquetas, 'autores'=>$autores]);
		}
		else{
			return View::make('libro.recuperar',['recuperar'=>$recuperar]);
		}
		
	}
	
	//Recupera un libro dado de baja
	public function restaurar($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros/recuperar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$libro= Libro::find($id);
		
		//existe?
		if($libro){
			$libro->dadoDeBaja=false;
			$libro->save();
			return Redirect::to('/admin/libros/recuperar#libros')->with('recuperado','¡El libro «'.$libro->título.'» ha sido recuperado exitosamente!');
		}
		else{
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
	}
	
}

?>
