<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Embellished 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140207

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cookbook - Sistema web de venta de libros</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="http://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
	<link href="/template/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="/template/fonts.css" rel="stylesheet" type="text/css" media="all" />
	<meta name="generator" content="Sistema Web Cookbook" />
	<link rel="shortcut icon" href="/favicon.png" />
	<!-- DatePicker -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<!-- Final del DatePicker -->
	<!-- Pop-up Window. Cambiar width/height para el tamaño de ventana -->
	<!-- Ejemplo de link: <a href="javascript: void(0)" onclick="popup('ayuda#indice')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a> -->
	<script type="text/javascript">
	function popup(url) 
	{
		 var width  = 800;
		 var height = 600;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {newwin.focus()}
		 return false;
	}
	</script>
</head>

<body>
<div id="wrapper1">
	<div id="header-wrapper">
		<div id="header" class="container">
			<div class="menu">
				@if (Auth::guest() )
					<a href="/login" title="Ingrese al sistema con su cuenta registrada">Iniciar Sesión</a> 
					<a href="/registrarse" title="Obtenga una cuenta de usuario">Registrarse</a>
				@else
					@if (Auth::user()->esAdmin == 1)
						¡Bienvenido, <strong>Administrador</strong>!
					@else
					¡Bienvenido, <strong>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</strong>!
					@endif
					@if (Auth::user()->esAdmin == 1)
						@if(Mensaje::noLeidos()->count() > 0)
							<a href="{{ URL::to('/admin/mensajes') }}">Mensajes <strong class="cookbook" title="Ud cuenta con mensajes sin leer">({{Mensaje::noLeidos()->count()}})</strong> </a>
						@else
							<a href="{{ URL::to('/admin/mensajes') }}">Mensajes </a>
						@endif
					<a href="{{ URL::to('/admin/perfil') }}">Modificar Contraseña</a>
					@else
					<a href="{{ URL::to('/pedidos') }}">Pedidos</a>
					<a href="{{ URL::to('/perfil') }}">Modificar Perfil</a>
					@endif
					<a href="{{ URL::to('/logout') }}">Cerrar Sesión</a>
				@endif
			</div>
			<div class="ayuda">
				@section('ayuda')
				<a href="javascript: void(0)" onclick="popup('ayuda')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
				@show
			</div>
			@if ( (Auth::user()) && (!Auth::user()->esAdmin) )
			<div class="carrito">
				<a href="/carrito" title="Acceda a su carrito de compras"><img src="/template/images/carrito.png" alt="Carrito"/> {{(Session::has('carrito'))? array_sum(Session::get('carrito')) : 0 }} </a>
			</div>
			@endif
			<div id="logo">
				<h1><a href="/"><img src="/template/images/Cookbook - Logo.limpio.png" alt="Logo Cookbook" title="Cookbook"/></a></h1>
				<span>Venta de libros online<br/><br/></span> </div>
			<div id="menu">
				<ul>
					@if (Auth::check())
						@if (Auth::user()->esAdmin == 1)
						<a href="/admin/libros" title="Ingrese a la gestión del sistema" class="button button-mediano">ADMINISTRACIÓN</a>
						@endif
					@endif
					<li id="catalogo"><a href="/" title="Conozca los libros que tenemos para ofrecerle">Catálogo</a></li>
					<li id="contacto"><a href="/contacto" title="Póngase en contacto con Cookbook">Contacto</a></li>					
				</ul>
			</div>
		</div>
	</div>
	<div id="wrapper3">
		<div id="portfolio" class="container">
	@section('contenido')
	@show
		</div>
	</div>
</div>
<div id="copyright" class="container">
	<p><span><strong>Cookbook</strong> - Sistema web de venta de libros</span><br/>
	Diseño <a href="http://templated.co" rel="nofollow">Templated</a> | Implementación <a href="#">Soluciones Informáticas</a>.</p>
</div>
<script>
	@yield('menuActivo')
	document.getElementById(menuActivo).className = "activo";
</script>
</body>
</html>

