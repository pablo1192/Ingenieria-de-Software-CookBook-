<?php

class Etiqueta extends Eloquent  
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'etiqueta';
	
	public static function agregarEtiqueta($input){
        // función que recibe como parámetro la información del formulario para crear la etiqueta
        
        $respuesta = array();
        
        // Declaramos reglas para validar que el nombre  sea obligatorio
        $reglas =  array(
            'nombre'  => array('required', 'max:100','unique:etiqueta,nombre','alpha'),   
        );
                
        $validator = Validator::make($input, $reglas);
        
        // verificamos que los datos cumplan la validación 
        if ($validator->fails()){
            
            // si no cumple las reglas se van a devolver los errores al controlador 
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;
        }else{
        
            // en caso de cumplir las reglas se crea el objeto Etiqueta
            $etiqueta = static::create($input);        
            
            // se retorna un mensaje de éxito al controlador
            $respuesta['mensaje'] = 'Etiqueta creada!';
            $respuesta['error']   = false;
            $respuesta['data']    = $etiqueta;
        }     
        
        return $respuesta; 
  }
	
}
?>
