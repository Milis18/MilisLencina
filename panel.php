<?php
session_start();
require 'conexion_db.php';

	// verifico si el usuario tiene creada la sesion previamente, si el email esta en la variable de sesion.
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])){

		$email = $_SESSION['email'];
		
		// Traigo los datos del email correspondiente, por ej. nombre de usuario, apellido, nombre ,etc
		$get_datos_usuario = mysqli_query($db_connection, "SELECT * FROM `usuarios` WHERE email = '$email'");
		$datosUsuario =  mysqli_fetch_assoc($get_datos_usuario);

	}else{
		//si no esta es porque no pasó por el formulario de login, asi que afuera
		header('Location: salir.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="estilos.css" media="all" type="text/css">
<title>Panel de Control de Usuarios - ABM de Usuarios PHP y MYSQLi</title>
</head>
<body>
	<div class="container">
	<h1>Hola, bienvenido/a: , <?php echo $datosUsuario['usuario'];?></h1>
	<a href="formulario.php">ir al Formulario</a><br>
	</div>
</body>
</html>

