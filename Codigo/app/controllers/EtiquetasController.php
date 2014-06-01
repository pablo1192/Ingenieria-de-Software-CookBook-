<?php 
class EtiquetasController extends BaseController 
{
 
    /**
     * Mustra la lista con todas los etiquetas
     */
    public function mostrarEtiquetas()
    {
        $etiquetas= Etiqueta::where('id','<>',1)->get();// me qedo con todos menos con el <id> "Sin etiqueta"	        
        return View::make('etiqueta.etiquetas', array('etiquetas' => $etiquetas));
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario 
        //y también pasa como parámetro los datos que queramos pasar a la vista. 
        // En este caso le estamos pasando un array con todas las etiquetas
    }
	public function formularioAlta(){
		$etiquetas = Etiqueta::where('id','<>',1)->get();//
		return View::make('etiqueta.crear',['etiquetas'=> $etiquetas]); //
	}
	public function altaEtiqueta()
	{
		// llamamos a la función de agregar etiqueta en el modelo y le pasamos los datos del formulario 
        $respuesta = Etiqueta::agregarEtiqueta(Input::all());
        
        // Dependiendo de la respuesta del modelo 
        // retornamos los mensajes de error con los datos viejos del formulario 
        // o un mensaje de éxito de la operación 
        if ($respuesta['error'] == true){
            return Redirect::to('/admin/etiquetas')->withErrors($respuesta['mensaje'] )->withInput();
        }else{
            return Redirect::to('/admin/etiquetas')->with('mensaje', $respuesta['mensaje']);
        }
    }
			
			
 
}
?>