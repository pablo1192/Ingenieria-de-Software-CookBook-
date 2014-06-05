<?php
class Provincia extends Eloquent { 
    protected $table = 'provincia';
	protected $fillable = ['nombre'];    
	
    public function usuarios(){
		return $this->hasMany('Usuario','provincia_id');
	}
}
?>
