<?php
class Editorial extends Eloquent { 
    protected $table = 'editorial';
    protected $fillable = ['nombre'];
    
    public function libros(){
		return $this->hasMany('Libro','editorial_id');
	}
}
?>
