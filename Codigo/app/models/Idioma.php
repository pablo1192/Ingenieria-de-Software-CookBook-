<?php
class Idioma extends Eloquent { 
    protected $table = 'idioma';
	protected $fillable = ['nombre'];    
	
    public function libros(){
		return $this->hasMany('Libro','idioma_id');
	}
	
	//agrego al modelo la funcion disponibles, la cual ignora el "Sin idioma"
	public function scopeDisponibles($query){
		return $query->where('id','<>',1);
	}
	
	//Defino las reglas para usar en Alta/Mod
	public static function reglasDeValidacion(){
		//Solo letras como minimo 5, q sea unico y no vacio..
		return ['nombre'=>['alpha','min:5','required','unique:idioma,nombre,1']];
	}
}
?>
