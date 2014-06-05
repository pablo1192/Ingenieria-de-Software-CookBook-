<?php
class Cookbook {
	//CONSTANTES
	//
 
	const MODIFICACION_TITULO 	= '¡Modificación indebida!';
	const MODIFICACION_MOTIVO	= 'Ud intenta modificar un registro al cual no posee acceso o no existe.';
	
	const ACCESO_TITULO 	= '¡Acceso incorrecto!';
	const ACCESO_MOTIVO		= 'Ud intenta acceder desde una ruta no prevista o está forzando las URLs.';
	
 
    //Chequea q exista el Id en la tabla especificada
    //Sino lanza un error 404
    public static function existeId($id,$tabla) {
        $validador=Validator::make(['id'=>$id],['exists:'.$tabla.',id']);
        return ($validador->fails()? true:false);
    }
    
    
    public static function existeIdDistintoDe1($id,$tabla) {
        if($id<>1){
			$validador=Validator::make(['id'=>$id],['exists:'.$tabla.',id']);
			return !($validador->fails());
		}
		else{
			return false;
		}
    }
    
    //Metodo algo truvual pero que intenta determinar si el USR
    //Provino de otro lado q no sea el esperado: p.e acciones manuales/forzar url
    // puede dar falsos positivos si el navegador cuenta cn plugs de privacidad...
    public static function accedeSoloDesdeRuta($ruta){
		return (Request::header('Referer')=='http://cookbook'.$ruta);
	}
    
    
}
