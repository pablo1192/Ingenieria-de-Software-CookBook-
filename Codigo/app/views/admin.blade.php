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
	<title>Cookbook - Panel de Administración</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="http://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
	<link href="/template/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="/template/fonts.css" rel="stylesheet" type="text/css" media="all" />
	<meta name="generator" content="Sistema Web Cookbook" />
	<link rel="shortcut icon" href="/favicon.png" />
</head>

<body>
<div id="wrapper1">
	<div id="header-wrapper">
		<div class="menu">
			@if ( Auth::guest() )
				<a href="/login" title="Ingrese al sistema con su cuenta registrada">Iniciar Sesión</a> 
				<a href="/registrarse" title="Obtenga una cuenta de usuario">Registrarse</a>
			@else
				Bienvenido, <strong>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</strong>!
				--
				<a href="{{ URL::to('/perfil') }}">Modificar Perfil</a>
				--
				<a href="{{ URL::to('/logout') }}">Cerrar Sesión</a>
			@endif
		</div>
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="/"><img src="/template/images/Cookbook - Logo.limpio.png" alt="Logo Cookbook" title="Cookbook"/></a></h1>
				<span>Sistema web de venta de libros<br/><br/><strong>Panel de Administración</strong></span> </div>
			<div id="menu">
				<ul>
						<li class="current_page_item"><a href="/admin/" accesskey="1" title="Panel de Administración">Administración</a></li>					
					<li><a href="/admin/libros/" accesskey="2" title="Gestión de libros">Libros</a></li>
					<li><a href="/admin/usuarios/" accesskey="2" title="Gestión de usuarios">Usuarios</a></li>
					<li><a href="/admin/" accesskey="2" title="Visualización de reportes y estadústicas">Reportes</a></li>
					<li><a href="/admin/" accesskey="2" title="Gestión de Mensajes">Mensajes</a></li>
					<li><a href="/admin/" accesskey="2" title="Obtenga acceso a la ayuda del sistema">Ayuda</a></li>
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
</body>
</html>

