<?php 
	
	
	//Conexion con la base de datos
	$db = mysqli_connect('localhost', 'root', '', 'laboratorio');

	// Inicializo las variables que voy a utilizar
	
	$ID = 0;
	$DIRECCION = '';
	$TELEFONO = '';
	$EMAIL = ''; 
	$PUESTO= 0;
	$update = false;

	//Registro nuevo 
	if (isset($_POST['save'])) {
		$ID = $_POST['ID'];
		$DIRECCION = $_POST['DIRECCION'];
		$TELEFONO = $_POST['TELEFONO'];
		$EMAIL = $_POST['EMAIL'];
		$PUESTO = $_POST['PUESTO'];
		
	
		mysqli_query($db, "INSERT INTO cliente  (DIRECCION, TELEFONO, EMAIL, PUESTO, ID) VALUES ('$DIRECCION', '$TELEFONO', '$EMAIL', '$PUESTO', '$ID')"); 
		$_SESSION['message'] = "Registro guardado"; 
		header('location: panel.php');
	}

	//Registro para actualizar, existe un ID
	if (isset($_POST['update'])) {
		$ID = $_POST['ID'];
		$DIRECCION = $_POST['DIRECCION'];
		$TELEFONO = $_POST['TELEFONO'];
		$EMAIL = $_POST['EMAIL'];
		$IDpuesto = $_POST['IDpuesto'];

		mysqli_query($db, "UPDATE cliente  SET PUESTO ='$PUESTO', DIRECCION='$DIRECCION', TELEFONO='$TELEFONO', EMAIL='$EMAIL' WHERE ID=$ID");
		$_SESSION['message'] = "¡Registro actualizado!"; 
		header('location: panel.php');
	}

	//Si existe un registro y deseo eliminar el ID
	if (isset($_GET['del'])) {
		$ID = $_GET['del'];
		mysqli_query($db, "DELETE FROM cliente WHERE ID=$ID");
		$_SESSION['message'] = "¡Registro eliminado!"; 
		header('location: panel.php');
	}

	//Traigo todos los registros de la tabla

	$results = mysqli_query($db, "SELECT * FROM cliente ");

	/*
SELECT id,apellido, nombre, celular,  FROM miembros RIGHT JOIN estadocivil ON miembros.estadocivil_id=estadocivil.idec
	
SELECT miembros.id, miembros.nombre, estadocivil.nombre AS descripc FROM miembros RIGHT JOIN estadocivil ON miembros.estadocivil_id=estadocivil.idec
	
SELECT miembros.*, estadocivil.nombre AS descripc FROM miembros RIGHT JOIN estadocivil ON miembros.estadocivil_id=estadocivil.idec


SELECT miembros.id, miembros.apellido, miembros.nombre, estadocivil.nombre AS estadocivil FROM miembros RIGHT JOIN estadocivil ON miembros.estadocivil_id=estadocivil.idec
*/


?>