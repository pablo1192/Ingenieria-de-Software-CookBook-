<?php
class Cookbook {
	//CONSTANTES
	//
 
	const MODIFICACION_TITULO 	= '¡Modificación indebida!';
	const MODIFICACION_MOTIVO	= 'Ud intenta modificar un registro al cual no posee acceso o no existe.';

	//ACTIVA/DESACTIVA el control de accedeSoloDesdeRuta. Util por si da falsos positivos en un navegador
	const ACCESO_ACTIVADO	= TRUE;	
	const ACCESO_TITULO 	= '¡Acceso incorrecto!';
	const ACCESO_MOTIVO		= 'Ud intenta acceder desde una ruta no prevista o está forzando las URLs.';
	
 
    //Chequea q exista el Id en la tabla especificada    
    public static function existeId($id,$tabla) {        
        return (boolean) (DB::select('select * from '.$tabla.' where id ='.$id));
    }
    
    //idem al anterior, pero ademas el id no debe ser 1
    public static function existeIdDistintoDe1($id,$tabla) {
        if($id<>1){
			return Cookbook::existeId($id,$tabla);
		}
		else{
			return false;
		}
    }
    
    //Metodo algo trivial pero que intenta determinar si el USR
    //Provino de otro lado q no sea el esperado: p.e acciones manuales/forzar url
    // puede dar falsos positivos si el navegador cuenta cn plugs de privacidad...
    //$rutas es un arreglo!.
    public static function accedeSoloDesdeRuta($rutas){
		if(Cookbook::ACCESO_ACTIVADO){
			if(Request::header('Referer') !== ''){		
				if(Request::header('Referer') == 'http://cookbookl*'){
				$urlOrigen=str_replace('http://cookbookl','',(strtolower(Request::header('Referer'))));
				}
				else {
				$urlOrigen=str_replace('http://cookbookl','',(strtolower(Request::header('Referer'))));
				}
				return (in_array($urlOrigen,$rutas));
			}
			else{
				return false;
			}
		}
		else{
			//retorna OK para dar correcto funcionamiento..
			return true;
		}
	}
    
    
}
