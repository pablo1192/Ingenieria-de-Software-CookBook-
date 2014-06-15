<?php
class Pedido extends Eloquent { 
    protected $table = 'pedido';
	protected $fillable = ['monto','fecha','estado'];
	
}
?>
