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
}
?>
