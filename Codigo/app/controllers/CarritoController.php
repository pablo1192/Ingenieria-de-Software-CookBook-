<?php

class CarritoController extends BaseController {

	public function visualizar(){

		if(Session::has('carrito')){
			//proceso el carrito, para indcar los detalles de cada item.
			$carrito=Session::get('carrito');
			$carritoProcesado=[];
			$montoTotal=0;
			foreach($carrito as $id => $cantidad){
				$libro= Libro::find($id);
				
				$carritoProcesado[$id]['titulo']=$libro->título;
				$carritoProcesado[$id]['cantidad']=$cantidad;
				$carritoProcesado[$id]['precioUnitario']=$libro->precio;
				$carritoProcesado[$id]['precioTotal']= $libro->precio * $cantidad;
				$montoTotal+=($libro->precio * $cantidad);
			}
			
            Session::put('monto',$montoTotal);// Agregado para mantener el monto 
			Session::put('carritoProc',$carritoProcesado);//
			
			return View::make('carrito',['carrito'=>$carritoProcesado,'montoTotal'=>$montoTotal]);
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
			Session::put('carrito',$carrito);
		}
		return Redirect::back();
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
	
	//Solicita los datos de la tarjeta
	public function solicDatosTarjeta()
	{
	  if(!Cookbook::accedeSoloDesdeRuta(['/carrito','/carrito/tarjeta'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
	  if(Session::has('carrito'))
	  {
	        $carrito = Session::get('carrito');
			$montoTotal = Session::get('monto');
			return View::make('datosTarjeta',['carrito'=>$carrito,'monto'=>$montoTotal]);
	  }
	  return Redirect::back();
	}
	public function comprar()
	{
	    if(!Cookbook::accedeSoloDesdeRuta(['/carrito/tarjeta'])){
			return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		}
		$reglasTarjeta =['numero'=>['digits:16','required'],'contraseña'=>['digits:3','required','confirmed']];
		$validador= Validator::make(Input::all(),$reglasTarjeta);
        if($validador->fails()){
            return Redirect::back()->withInput()->withErrors($validador);
        }
        else
		{	
		   $carrito = Session::get('carrito');
		   $montoTotal = Session::get('monto');
		   return View::make('confCompra',['carrito'=>$carrito,'monto'=>$montoTotal]);;
		}
    }
	public function altaPedido()
	{
	  // if(!Cookbook::accedeSoloDesdeRuta(['/carrito/tarjeta/confirmarCompra'])){
		//	return View::make('error',['título'=>Cookbook::ACCESO_TITULO, 'motivo'=>Cookbook::ACCESO_MOTIVO]);
		//}
	   if(Auth::user()->esAdmin != 1)
	   {
	     if(Session::has('carrito'))
	     {
	        $carrito= Session::get('carrito');
			$ped = new Pedido;
		    $ped->monto = Session::get('monto');
		    $ped->fecha = date('Y/m/d');
		    $ped->usuario_id = Auth::user()->id;
		    $ped->save();
			//crea la relacion del pedido con los libros.
			$ca=[];			
			foreach($carrito as $id => $cantidad){
				$ca[$id]['libro_id']=$id;
				$ca[$id]['cantidad']=$cantidad;
			}	
			$ped->libros()->sync($ca);		 
		 
		    Session::forget('carrito');//limpia el carrito
		    Session::forget('monto');// limpia monto
			Session::forget('carritoProc');// limpia el carrito procesado
			Session::put('notificacionDeCompra', '¡La compra ha sido exitosa! Revise sus pedidos para ver si ya ha sido enviado.');//crea el mensaje a notificar que luego es eliminado desde la vista
		    return Redirect::to('/pedidos');
		 } 
		 else{
		    return Redirect::to('/');
			}
	  }
	  else{
	      return Redirect::to('/');
		  }
       	  
	}
}

?>
