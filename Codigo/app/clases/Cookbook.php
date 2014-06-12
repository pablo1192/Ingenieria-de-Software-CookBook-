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
	
 
    //Chequea q exista el Id en la tabla especificada, y que no esté dado de baja logica (cuando corresponda)  
    public static function existeId($id,$tabla) {        
        if(Cookbook::tieneBajaLogica($tabla)){
			return (boolean) (DB::select('select * from '.$tabla.' where ((id ='.$id.') and ( dadoDeBaja = 0 ))'));
		}
		else{
			return (boolean) (DB::select('select * from '.$tabla.' where id ='.$id));
		}
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
				//Elimina el nombre del host, dejando desde la / en adelante
				$urlOrigen=preg_replace('/^http:[\/][\/][^\/]+/i','',Request::header('Referer'));
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
    
    
    //	Funciones Internas
    //
    
    //Determina si la tabla tiene BL. Util para tener en cuenta en los "existe"..
    protected static function tieneBajaLogica($nombreDeTabla){
		if(preg_match('/\s*\b(libro|editorial|autor|etiqueta|idioma|usuario)\b\s*/i',$nombreDeTabla)){
			return true;
		}
		else{
			return false;
		}
	}
    
}
