<?php 
class EtiquetasController extends BaseController 
{
 
    /**
     * Mustra la lista con todas los etiquetas
     */
    public function mostrarEtiquetas()
    {
        $etiquetas= Etiqueta::disponibles()->get();// me qedo con todos menos con el <id> "Sin etiqueta" ni borrados logicamente
        return View::make('etiqueta.etiquetas', array('etiquetas' => $etiquetas));
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario 
        //y también pasa como parámetro los datos que queramos pasar a la vista. 
        // En este caso le estamos pasando un array con todas las etiquetas
    }
	
	// Muestra las etiquetas de un libro pasado por parametro
	public function mostrarEtiquetasDeX($id)
	{
	    $libro = Libro::find($id);
	    $etiquetas = $libro->etiquetas()->get();
		$libroX = $libro->get();//libroX se quedaria con el libro para tener los 2 id para luego quitar una etiqueta (nose como pasarla a la vista)
		return View::make('etiqueta.etiquetasDeX',array('etiquetasDeX' => $etiquetas));//
	}
	

	public function formularioAlta(){
		return View::make('etiqueta.crear'); //
	}
	public function altaEtiqueta()
	{
		// llamamos a la función de agregar etiqueta en el modelo y le pasamos los datos del formulario 
        $respuesta = Etiqueta::agregarEtiqueta(Input::all());
        
        // Dependiendo de la respuesta del modelo 
        // retornamos los mensajes de error con los datos viejos del formulario 
        // o un mensaje de éxito de la operación 
        if ($respuesta['error']){            
            //Si se logra restaurar, es xq lo req el usr
			if(Etiqueta::restaurar(Input::get('nombre'))){
				return Redirect::to('/admin/etiquetas');
			}
			else{
				return Redirect::back()->withErrors($respuesta['mensaje'] )->withInput();
			}
        }else{
            return Redirect::to('/admin/etiquetas')->with('mensaje', $respuesta['mensaje']);
        }
    }
	public function modificacionEtiqueta($id){
	if(!Cookbook::existeIdDistintoDe1($id,'etiqueta')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
	}	
	if(!Cookbook::accedeSoloDesdeRuta(['/admin/etiquetas','/admin/etiquetas/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
	}
	$etiqueta=Etiqueta::find($id);
	if ($etiqueta->nombre != Input::get('nombre')){	
		$validador= Validator::make(Input::all(),Etiqueta::reglasDeValidacion());
		
		if($validador->fails()){
			//~ return Redirect::to('/admin/idiomas/'.$id.'/modificar/')->withErrors($validador)->withInput();
			return Redirect::back()->withErrors($validador)->withInput();
		}
		else{
			$etiqueta->nombre=Input::get('nombre');
			$etiqueta->save();
         	return Redirect::to('/admin/etiquetas/');
		}
	}
    else
       return Redirect::to('/admin/etiquetas'); 
	}
			
	public function formularioModificacionEtiqueta($id){
		//ToDo: Proteger este metodo 
		if(!Cookbook::existeIdDistintoDe1($id,'etiqueta')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/etiquetas','/admin/etiquetas/'.$id.'/modificar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}

		$etiqueta=Etiqueta::find($id);
		return View::make('etiqueta.modificar',['etiqueta'=>$etiqueta]);
	}
	
    public function baja($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::existeIdDistintoDe1($id,'etiqueta')){
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}
		
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/etiquetas'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		
		//Se le da baja lógica...
		$etiqueta= Etiqueta::find($id);
		$etiqueta->dadoDeBaja=true;
		$etiqueta->save();
		
		return Redirect::to('/admin/etiquetas');
		
	}	
 
 	public function restaurar($id){
		//ToDo: Proteger este metodo
		if(!Cookbook::accedeSoloDesdeRuta(['/admin/libros/recuperar'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$etiqueta= Etiqueta::find($id);
		
		//existe?
		if($etiqueta){
			$etiqueta->dadoDeBaja=false;
			$etiqueta->save();
			return Redirect::to('/admin/libros/recuperar#etiquetas')->with('recuperado','¡La etiqueta «'.$etiqueta->nombre.'» ha sido recuperada exitosamente!');
		}
		else{
			return View::make('error',['título'=>Cookbook::MODIFICACION_TITULO, 'motivo'=>Cookbook::MODIFICACION_MOTIVO]);
		}		
	}
 
}
?>
