<?php
class Idioma extends Eloquent { 
    protected $table = 'idioma';
	protected $fillable = ['nombre'];    
	
    public function libros(){
		return $this->hasMany('Libro','idioma_id');
	}
}
?>
