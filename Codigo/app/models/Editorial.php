<?php
class Editorial extends Eloquent { 
    protected $table = 'editorial';
    protected $fillable = ['nombre'];
    
    public function libros(){
		return $this->hasMany('Libro','editorial_id');
	}
	
	//agrego al modelo la funcion disponibles, la cual ignora el "Sin Editorial"
	public function scopeDisponibles($query){
		return $query->where('id','<>',1);
	}
	
	//Defino las reglas para usar en Alta/Mod
	public static function reglasDeValidacion(){
		//Solo letras como minimo 3, q sea unico y no vacio..
		return ['nombre'=>['alpha','min:3','required','unique:editorial,nombre,1']];
	}
}
?>
