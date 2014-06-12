<?php
class Editorial extends Eloquent { 
    protected $table = 'editorial';
    protected $fillable = ['nombre'];
    
    public function libros(){
		return $this->hasMany('Libro','editorial_id');
	}
	
	//agrego al modelo la funcion disponibles, la cual ignora el "Sin Editorial"
	//ni las editoriales borradas logicamente
	public function scopeDisponibles($query){
		return $query->where('id','<>',1)->where('dadoDeBaja','=',0);
	}
	
	//Defino las reglas para usar en Alta/Mod
	public static function reglasDeValidacion(){
		//Solo letras como minimo 3, q sea unico y no vacio..
		return ['nombre'=>['regex:/[a-zñÑáéíóú ]+/i','max:64','min:5','required','unique:editorial,nombre,1']];
	}
	

	
}
?>
