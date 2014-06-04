<?php
class Autor extends Eloquent { 
    protected $table = 'autor';
	protected $fillable = ['nombre'];    
	
    public function libros(){
		return $this->belongsToMany('Libro','libroautor','autor_id','libro_id');
	}
	//agrego al modelo la funcion disponibles, la cual ignora el "Sin Autor"
	public function scopeDisponibles($query){
		return $query->where('id','<>',1);
	}
	
	//Defino las reglas para usar en Alta/Mod
	public static function reglasDeValidacion(){
		//Solo letras como minimo 5, q sea unico y no vacio..
		return ['nombre'=>['regex:/[a-zñÑáéíóú ]+/i','min:5','required','unique:autor,nombre,1,']];
	}
}
?>