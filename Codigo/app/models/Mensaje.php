<?php

class Mensaje extends Eloquent  
{

	protected $table = 'mensaje';
	protected $fillable = array('asunto', 'cuerpo', 'usuario_id');
	
	
	public function usuario(){
        return $this->belongsTo('Usuario', 'usuario_id');
    }
	
    public static function reglasDeValidacion(){
        return [
			'asunto'=>['min:4','required'],
			'cuerpo'=>['min:10','required'],
			// Chequeo q exista y no permito q sea el Admin (id<>1)...
			'usuario'=>['required','exists:usuario,id','not_in:1']
		];
	}
	
	public function scopeLeidos($query){
		return $query->where('leído', '=', 1);
	}
	
	public function scopeNoLeidos($query){
		return $query->where('leído', '=', 0);
	}
}
?>
