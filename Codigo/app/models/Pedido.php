<?php
class Pedido extends Eloquent { 
    protected $table = 'pedido';
	protected $fillable = ['monto','fecha','estado'];


	public function libros(){
		return $this->belongsToMany('Libro','libropedido','pedido_id','libro_id')->withPivot('cantidad');
	}

}
?>
