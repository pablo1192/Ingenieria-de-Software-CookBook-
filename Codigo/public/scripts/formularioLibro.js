//hab/deshab el campo «Otro»
function habilitarOtro(objetoOrigen,nombreDelInput){
	document.getElementById(nombreDelInput).disabled=!(objetoOrigen.checked)
}

function deshabilitarSeleccion(objetoOrigen,nombreDelInput){	
	document.getElementsByName(nombreDelInput)[0].disabled=(objetoOrigen.checked);
}

//Deja el form seteado, para evitar navegadors seteen "estados"
function inicializar(){
	document.getElementsByName('editorial')[0].disabled=false;
	document.getElementsByName('idioma')[0].disabled=false;
	
	document.getElementsByName('idioma-checkbox')[0].checked=false;
	document.getElementsByName('editorial-checkbox')[0].checked=false;
	document.getElementsByName('etiqueta-checkbox')[0].checked=false;
	document.getElementsByName('autor-checkbox')[0].checked=false;
}

inicializar();
