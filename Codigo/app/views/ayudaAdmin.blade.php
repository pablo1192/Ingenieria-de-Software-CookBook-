<html>

<head>
<title>Cookbook - Ayuda del sistema</title>
<style type="text/css">
html, body {
overflow-x: auto;
font-family: 'Varela Round', sans-serif;
font-size: 11pt;
font-weight: 400;
}
</style>
</head>

<body>
<a name="indice"></a><h1>Cookbook - Ayuda del sistema (Administración)</h1><hr>
<h2>Índice:</h2>
<ol>
<li><a href="#libros">Gestión de libros.</a></li>
<li><a href="#usuarios">Gestión de usuarios.</a></li>
<li><a href="#pedidos">Gestión de pedidos.</a></li>
<li><a href="#reportes">Generación de reportes.</a></li>
<li><a href="#contacto">Casilla de mensajes.</a></li>
</ol>

<hr>

<a name="libros"></a><h2>Gestión de libros.</h2>
<ul>
<li><strong>Listado completo</strong> - En esta sección, usted verá todos los libros que se encuentran en el catálogo del sistema.</li>
	Si desea inhabilitar la compra de un libro, haga click en "Agotado". El libro se seguirá mostrando en el catálogo pero los usuarios no podrán agregarlo al carrito de compras.</br>
	Si desea eliminar por completo un libro del catálogo, haga click en "Eliminar". Esta operación no es permanente y los datos podrán ser recuperados.
<li><strong>Agregar un libro</strong> - Para agregar un nuevo libro al catálogo, deberá completar todos sus datos.</li>
	Al lado de cada campo, verá un "<span class="tooltip" title="Esto es un tooltip informativo.">[?]</span>". Sitúe el cursor sobre encima del símbolo para conocer cómo es el formato de los datos.
<li><strong>Modificar un libro</strong> - La actualización de los datos de un libro se realiza por partes.</li>
	Esta área se encuentra dividida en cuatro secciones. Haga click en "Modificar" para guardar los cambios de una sección específica.
<li><strong>Entidades secundarias</strong> - Estas son los autores, etiquetas, editoriales e idiomas de sus libros.</li>
	En la sección de cada entidad, podrá agregar una nueva, modificarla y eliminarla.</br>
	Tenga en cuenta que si elimina un dato que pertenece a un libro, la entidad no desaparecerá de los detalles del mismo. La eliminación previene que la entidad pueda ser utilizada al modificar o agregar un nuevo libro.
<li><strong>Recuperación de datos</strong> - Si ha eliminado un libro o entidad secundaria, aparecerá un botón "Recuperar" en las operaciones.</li>
	Aquí se listan todos los elementos eliminados. Para recuperar los datos, sólo haga click en el elemento.</br>
	Las entidades secundarias recuperadas podrán volver a ser utilizadas en los datos de un libro. Los libros recuperados se volverán a mostrar en el catálogo.
<a href="#indice" title="Ir al índice">↑</a>
</ul>

<hr>

<a name="usuarios"></a><h2>Gestión de usuarios.</h2> 
<ul>
<li><strong>Usuarios totales</strong> - En esta sección se muestran todos los usuarios registrados en el sistema.</li>
<li><strong>Usuarios vigentes</strong> - Aquí sólo se muestran los usuarios que no han sido bloqueados ni dados de baja.</li>
<li><strong>Operaciones</strong> - Posee diferentes funciones a su disposición.</li>
	Usando el enlace "Ver datos", puede visualizar la información personal del cliente.</br>
	Puede buscar un usuario específico mediante su nombre o apellido (completo o parcial) o su DNI (completo).</br>
	Si desea inhabilitarle el acceso al sistema a un usuario, use la función "Bloquear". Esta operación puede deshacerse.
<a href="#indice" title="Ir al índice">↑</a>
</ul>

<hr>

<a name="pedidos"></a><h2>Gestión de pedidos.</h2>
<ul>
<li><strong>Pedidos vigentes</strong> - Aquí verá todos los pedidos que se encuentran sin finalizar.</li>
	Cada pedido se encuentra completamente detallado y se incluye la funcionalidad de generar un comprobante de compra.</br>
	Puede buscar el pedido de un cliente específico mediante su nombre o apellido (completo o parcial) y filtrar por los diferentes estados de las solicitudes de compra.
<li><strong>Estado actual</strong> - Un pedido tiene tres estados posibles.</li>
	<ul>
	<li><i><strong>Pendiente</strong></i>: El pedido no ha sido enviado todavía. Una vez enviado, haga click en "Cambiar a Enviado" para que el cliente sea informado.</li>
	<li><i><strong>Enviado</strong></i>: El pedido se encuentra en camino. El cliente cambiará el estado a Finalizado una vez que reciba la mercadería solicitada. Si no lo hace, póngase en contacto o cambie el estado manualmente</li>
	<li><i><strong>Finalizado</strong></i>: El pedido ha sido resuelto. Desaparecerá de la lista. Filtre por Finalizados si quiere repasar estos pedidos. <a href="#indice" title="Ir al índice">↑</a></li>
	</ul>
</ul>

<hr>

<a name="reportes"></a><h2>Generación de reportes.</h2>
<ul>
<li><strong>Reportes</strong> - En esta sección es posible generar distintos tipos de reportes.</li>
	Elija el tipo de reporte que quiera crear y seleccione las dos fechas deseadas.
<li><strong>Usuarios registrados</strong> - Informa los usuarios que se registraron entre dos fechas.</li>
<li><strong>Libros vendidos</strong> - Informa la cantidad individual y total de libros vendidos entre dos fechas.</li>
<li><strong>Pedidos solicitados</strong> - Informa todos los pedidos que se realizaron entre dos fechas. <a href="#indice" title="Ir al índice">↑</a></li>
</ul>

<hr>

<a name="contacto"></a><h2>Casilla de mensajes.</h2>
<ul>
<li><strong>Bandeja de entrada</strong> - Los usuarios registrados podrán ponerse en contacto con usted. Si posee mensajes sin leer, podrá enterarse desde cualquier parte, observando "Mensajes (Nº)" arriba a la derecha.</li>
	Al acceder a su casilla, verá una lista de los mensajes que ha recibido, el usuario que lo envió, la fecha y el asunto.</br>
	Haga click en el asunto para visualizar el mensaje. Esto lo marcará automáticamente como leído.</br>
	Haga click en "Leído" o "No Leído" para modificar manualmente su estado.</br>
	Haga click en "Borrar" para eliminar un mensaje. Esta operación no puede deshacerse.
<li><strong>Visualizar mensaje</strong> - Aquí verá el cuerpo del mensaje que le ha sido enviado.</li>
	Haga click en "Responder" para contactarse con el cliente. Se le pedirá eligir su cliente de correo. La respuesta será enviada a la casilla de email que posee el usuario registrado.</br>
	Haga click en "Borrar" para eliminar el mensaje. Esta operación no puede deshacerse.
<a href="#indice" title="Ir al índice">↑</a>
</ul>


<hr>


</br></br><a href="JavaScript:window.close()">Cerrar ayuda</a>


</body>
</html>
