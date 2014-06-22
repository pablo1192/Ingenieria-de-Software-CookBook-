<?php
class Idioma extends Eloquent { 
    protected $table = 'idioma';
	protected $fillable = ['nombre'];    
	
    public function libros(){
		return $this->hasMany('Libro','idioma_id');
	}
	
	//agrego al modelo la funcion disponibles, la cual ignora el "Sin idioma"
	public function scopeDisponibles($query){
		return $query->where('id','<>',1)->where('dadoDeBaja','=',0);
	}
	
	public function scopeNoDisponibles($query){
		return $query->where('id','<>',1)->where('dadoDeBaja','=',1);
	}
	
	//Defino las reglas para usar en Alta/Mod
	public static function reglasDeValidacion(){
		//Solo letras como minimo 5, q sea unico y no vacio..
		return ['nombre'=>['regex:/[a-zñÑáéíóú ]+/i','max:16','min:5','required','unique:idioma,nombre,1']];
	}
	
	//Restaura un registro
	//True=Si efectivamente lo hizo (xq existe), False caso contrario.
	public static function restaurar($nombre){
		return (boolean) (DB::table('idioma')->where('nombre','=',$nombre)->where('dadoDeBaja','=',1)->update(['dadoDeBaja'=>0]));
	}
}
?>
