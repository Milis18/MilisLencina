<?php
//incluyo la conexión con la base de datos
include('proceso.php');
	
	//si envie edit por metodo GET
	if (isset($_GET['edit'])) {
		$ID = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM cliente WHERE ID=$ID");

	//	$vale = count($record);
		
		//exit;
		
			if (!empty($record) == 1 ) {
				$datos = mysqli_fetch_array($record);
					$DIRECCION = $datos['DIRECCION'];
					$TELEFONO = $datos['TELEFONO'];
					$EMAIL = $datos['EMAIL'];
					//$IDpuesto = $datos['IDpuesto'];
			}
		

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ABM simple con PHP MySQL </title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<?php 
		//en caso que haya realizado alguna operacion y envie mensaje.
		if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php 
	//traigo todos los registros de la tabla
	$resultados = mysqli_query($db, "SELECT ID, DIRECCION, TELEFONO, EMAIL FROM cliente "); ?>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>DIRECCION</th>
			<th>TELEFONO</th>
			<th>EMAIL</th>
			<th colspan="2">ACCION</th>
		</tr>
	</thead>
	
	<?php 
		//si existen registros 
		while ($row = mysqli_fetch_array($resultados)) { ?>
		<tr>
			<td> <?php echo $row['ID']; ?> </td>
			<td> <?php echo $row['DIRECCION']; ?> </td>
			<td> <?php echo $row['TELEFONO']; ?> </td>
			<td> <?php echo $row['EMAIL']; ?> </td>
			<td>
				<a href="panel.php?edit=<?php echo $row['ID']; ?>">Editar</a>
				<a href="proceso.php?del=<?php echo $row['ID']; ?>">Eliminar</a>
			</td>
		</tr>
	<?php } ?>
</table>

<h1> Formulario de Alta o Edición </h1>

<form method="post" action="proceso.php" >
			<div >
				<label>ID</label>
				<input type="NUMBER" name="ID" value="<?php echo $ID; ?>">
			</div>
			<br>	
			<div >
				<label>DIRECCION</label>
				<input type="text" name="DIRECCION" value="<?php echo $DIRECCION; ?>">
			</div>
			<br>
			<div >
				<label>TELEFONO</label>
				<input type="text" name="TELEFONO" value="<?php echo $TELEFONO; ?>">
			</div>
			<br>
			<div >
				<label>EMAIL</label>
				<input type="text" name="EMAIL" value="<?php echo $EMAIL; ?>">
			</div>
			<br>


	
	
	<?php
	
	//traigo todas las empresas de la tabla de manera ascendente
	$sqltrabajo = "SELECT ID, PUESTO FROM trabajo ORDER BY PUESTO ASC";
	//echo $sqlempresas;
	$result = mysqli_query($db, $sqltrabajo);
	
	//var_dump($result);
	

	//si el registro ya tiene una empresa, mostrar seleccionado
	$marca = $PUESTO;

	
	echo '<select name="PUESTO">';
			echo "<option>-- Seleccione su Puesto --</option>";
			while ($row=mysqli_fetch_array($result))
			{  
				if ($row['IDpuesto'] == $marca) //si es igual mostrar seleccionada la empresa
					{    echo "<option value='".$row['ID']."'>".$row['PUESTO']."</option>";
					}
				else
					{    echo "<option value='".$row['ID']."'>".$row['PUESTO']."</option>";
					}
			}
	echo "</select>";
	
			
			
	
	?>
	
	<div class="input-group">

		<?php if ($update == true): ?>
			<button  type="submit" name="update">Actualizar</button>
		<?php else: ?>
			<button type="submit" name="save" >Guardar</button>
		<?php endif ?>
	</div>
	<br>
	<br>
	
</form>
	<a href="salir.php">Salir del sistema</a>
</body>
</html>