<?php
class Libro extends Eloquent { 
    protected $table = 'libro';
    //protected fillable= [] ???
    
    public function editorial(){
		return $this->belongsTo('Editorial','editorial_id');
	}	

    public function idioma(){
		return $this->belongsTo('Idioma','idioma_id');
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
}
?>
