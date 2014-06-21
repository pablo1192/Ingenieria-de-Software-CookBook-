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
		<div id="header" class="container">
			<div class="menu">
				¡Bienvenido, <strong>Administrador</strong>!
				<a href="{{ URL::to('/admin/') }}">Mensajes (0)</a>
				<a href="{{ URL::to('/admin/perfil') }}">Modificar Contraseña</a>
				<a href="{{ URL::to('/logout') }}">Cerrar Sesión</a>
			</div>
			<div class="ayuda">
				<a href="/ayuda" title="Obtenga acceso a la ayuda del sistema"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/>
			</div>
			<div id="logo">
				<h1><a href="/"><img src="/template/images/Cookbook - Logo.limpio.png" alt="Logo Cookbook" title="Cookbook"/></a></h1>
				<span>Venta de libros online</span> </div>
			<div id="menu">
				<ul>
					<li id="catálogo"><a href="/" title="Catálogo de libros">Catálogo</a></li>
					<li id="libros"><a href="/admin/libros/" title="Gestión de libros">Libros</a></li>
					<li id="usuarios"><a href="/admin/usuarios/" title="Gestión de usuarios">Usuarios</a></li>
					<li id="usuarios"><a href="/admin/pedidos/" title="Gestión de usuarios">Pedidos</a></li>
					<li id="reportes"><a href="/admin/" title="Visualización de reportes y estadísticas">Reportes</a></li>
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

