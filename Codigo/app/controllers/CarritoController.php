<?php

class CarritoController extends BaseController {

	public function visualizar(){
		if(Session::has('carrito')){
			//proceso el carrito, para indcar los detalles de cada item.
			$carrito=Session::get('carrito');
			$carritoProcesado=[];
			
			foreach($carrito as $id => $cantidad){
				$libro= Libro::find($id);
				
				$carritoProcesado[$id]['titulo']=$libro->título;
				$carritoProcesado[$id]['cantidad']=$cantidad;
				$carritoProcesado[$id]['precioUnitario']=$libro->precio;
				$carritoProcesado[$id]['precioTotal']= $libro->precio * $cantidad;
			}

			return View::make('carrito',['carrito'=>$carritoProcesado]);
		}
		else{
			return View::make('carrito',['carrito'=>[]]);
		}
	}
	
	//crea/inicializa el carrito al agregrse el 1er libro. solo agrega de a 1
	//recibe como parametro $id= id del libro q se desea agregar
	public function agregarLibro(){
		if(Input::has('id')){
			$id=Input::get('id');
			if(!Cookbook::existeId($id,'libro')){
				return View::make('error',['título'=>'Libro inexistente!', 'motivo'=>'Se ha intentado agregar al carrito un libro que no existe o bien no está disponible']);
			}
			
			//¿existe el carrito?
			if(Session::has('carrito')){
				$carrito=Session::get('carrito');
				//el libro fue agregado?
				if(isset($carrito[$id])){
					$carrito[$id]++;
				}
				else{
					$carrito[$id]=1;
				}
				//Actualizo el carrito..
				Session::put('carrito',$carrito);
			}
			else{
				//Inicializo el carrito con el libro con cantidad = 1.
				Session::put('carrito',[$id =>1]);
			}
			return Redirect::back()->with('agregado','El libro ha sido agregado exitosamente.');
		}
		return Redirect::back();
	}


	public function quitarLibro($id){
		if(!Cookbook::accedeSoloDesdeRuta(['/carrito'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		if(!Cookbook::existeId($id,'libro')){
			return View::make('error',['título'=>'Libro inexistente!', 'motivo'=>'Se ha intentado quitar al carrito un libro que no existe o bien no está disponible']);
		}
		if( (Session::has('carrito')) && (isset(Session::get('carrito')[$id])) ){
			$carrito = Session::get('carrito');
			if($carrito[$id]>1){
				$carrito[$id]--;
			}
			else{
				//Elimino el libro del carrito
				unset($carrito[$id]);
			}
		}
	}
	
	//Elimina el carrito de la sesion
	public function vaciarCarrito(){
		if(!Cookbook::accedeSoloDesdeRuta(['/carrito'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		
		if(Session::has('carrito')){
			Session::forget('carrito');
		}
		
		return Redirect::back();
	}

}

?>
