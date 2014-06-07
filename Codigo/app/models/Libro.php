<?php
class Libro extends Eloquent { 
    protected $table = 'libro';
    // Son excluidos ademas de las relaciones: los No nulos con valor por defecto (agotadoy dadoDeBaja) y los archivos (tapa e índice).
    protected $fillable= ['isbn','título','precio','hojas','añoEdición','editorial_id','idioma_id'];
    
    public function editorial(){
		return $this->belongsTo('Editorial','editorial_id');
	}	

    public function idioma(){
		return $this->belongsTo('Idioma','idioma_id');
	}	
	
	
    public function etiquetas(){
		return $this->belongsToMany('Etiqueta','libroetiqueta','libro_id','etiqueta_id');
	}	
	
    public function autores(){
		return $this->belongsToMany('Autor','libroautor','libro_id','autor_id');
	}	
	
	
	
	//funcion que filtra los libros no disponibles (dados de baja logica). Uso: Libro::disponibles()->get();
	public function scopeDisponibles($query){
		return $query->where('dadoDeBaja','=',0);
	}
	
	public function scopeNoAgotados($query){
		return $query->where('agotado','=',0);
	}
	public function scopeAgotados($query){
		return $query->where('agotado','<>',0);
	}
	
	//Retorno el conjunto de reglas para la validacion. Util para Alta/Modificacion
	//Es el conj completo, incluyendo la posibilidad de validar "otros"
	public static function reglasDeValidacion(){
		return [
			'isbn'=>['required','numeric','digits_between:10,13','unique:libro,isbn'],
			'titulo'=>['required','regex:/[a-zñÑáéíóú 0-9]+/i','min:2','max:64'],
			'autor'=>['array','exists:autor,id',],
			'autor-otro'=>['regex:/[a-zñÑáéíóú ]+/i','max:64','min:5','required_without:autor', 'unique:autor,nombre'],
			'editorial'=>['exists:editorial,id','required_without:editorial-otro'],
			'editorial-otro'=>['regex:/[a-zñ ]+/i','max:64','min:5','unique:editorial,nombre,1','required_without:editorial'],
			'idioma'=>['exists:idioma,id','required_without:idioma-otro'],
			'idioma-otro'=>['regex:/[a-zñÑáéíóú ]+/i','max:16','min:5','unique:idioma,nombre,1','required_without:idioma'],
			'etiqueta'=>['array','exists:etiqueta,id'],	
			'etiqueta-otro'=>['max:100','min:5','unique:etiqueta,nombre','alpha','required_without:etiqueta'],
			'anoDeEdicion'=>['required','numeric','between:1900,2014'],
			'cantidadDeHojas'=>['required','numeric','between:10,9999'],
			'precio'=>['required','regex:/^[0-9]{1,4}([.][0-9]{1,2})?$/i'],
			'tapa'=>['required','mimes:jpeg,png,jpg'],
			'indice'=>['required','mimes:jpeg,png,jpg']
		];
	}
	
	
	//	Funciones de Utilidad
	//
	
	//Ubica la tapa y portada en sus respectivos directorios renombrandolos como coresponda.
	//Actualiza al libro
	//$libro= instancia de libro, $archivoDe.. instancia de uploadedFile (input::file(..))
	public static function ubicarArchivos($libro,$archivoDeTapa,$archivoDeIndice){
		$carpetaDatos=public_path().'/datos/';
		$tapaFinal=$libro->id. '.'. $archivoDeTapa->getClientOriginalExtension();
		$indiceFinal=$libro->id. '.'.$archivoDeIndice->getClientOriginalExtension();
		//~ $archivoDeTapa->move($carpetaDatos. 'tapas/', $libro->id. '.'. $archivoDeTapa->getClientOriginalExtension());
		$archivoDeTapa->move($carpetaDatos. 'tapas', $tapaFinal);
		//~ $archivoDeIndice->move($carpetaDatos. 'indice/', $libro->id. '.'. $archivoDeIndice->getClientOriginalExtension());
		$archivoDeIndice->move($carpetaDatos. 'indices',  $indiceFinal);
		
		$libro->tapa=$tapaFinal;
		$libro->índice=$indiceFinal;
		$libro->save();
	}
	
	public static function borrarArchivos($id){
		$libro= Libro::find($id);
		$resultado=false;
		$carpetaDatos=public_path().'/datos/';
		if(File::exists($carpetaDatos.'tapas/'.$libro->tapa)){
			$resultado&=File::delete($carpetaDatos.'tapas/'.$libro->tapa);
		}

		if(File::exists($carpetaDatos.'indice/'.$libro->índice)){
			$resultado&=File::delete($carpetaDatos.'indice/'.$libro->índice);
		}
		
		return $resultado;
	}
	
}
?>
