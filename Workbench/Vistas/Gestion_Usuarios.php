<!DOCTYPE html>
<html lang="es">
<head>
	<title>Gestion_Usuarios</title>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="application-name" content="Agenda Cultural">
	<meta http-equiv="author" content="Santiago Baena Rivera">
	<meta http-equiv="author" content="Sebastian Ramirez Lopez">
	<meta http-equiv="author" content="David Sanchez Uribe">
	<meta http-equiv="keywords" content="Agenda, Cultural">	
</head>
<body>
	<form action="" method="get" >
		<fieldset>
			<legend> Crear o Actualizar Usuario</legend>
			Cedula:<input type="number" name="id" min="0" max="2147483647" required id="cedula">*<br>
			Usuario:<input type="text" name="usuario" maxlength="45" required id="usuario">*<br>
			Contraseña:<input type="text" name="contrasena" maxlength="45" required id="contrasena">*<br>
			<a href="menuRegistros.html"><button type="button">Regresar</button></a>
			<input type="reset" value="Limpiar">
			<input type="submit" name="Guardar" value="Guardar"> <br>
			<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
		</fieldset>
	</form>
	<form action="" method="get">
		<fieldset>
		<legend>Buscar o Eliminar Usuario</legend>
		Usuario:<input type="text" name="usuario" maxlength="45" required id="usuario2">*<br>
		<input type="reset" value="Limpiar">
		<input type="submit" name="Eliminar" value="Eliminar">
		<input type="submit" name="Buscar" value="Buscar"> <br>
		<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
	</fieldset>
</form>

<script>
	function display(id, usuario){
		document.getElementById("cedula").value = id;
		document.getElementById("usuario").value = usuario;
	}
</script>
<?php
include 'conexion.php';
if(isset($_GET['Guardar'])){
	echo $id = $_GET['cedula'];
	echo $usuario = $_GET['usuario'];
	echo $contrasena = $_GET['contrasena'];
	$sql = "CALL CrearUsuario('$usuario', '$contrasena' , '$id')";
	if(mysqli_query($connect, $sql)){
		echo "Records added successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
}

if(isset($_GET['Buscar'])){
	$usuario = $_GET['usuario'];
	$sql = "SELECT idAdministradores 
	FROM Administradores WHERE Usuario = '$usuario'";
	$result = mysqli_query($connect, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo "<script> display(" . $row["idAdministradores"] . ", '" . $usuario . "'); </script>";
	} else {
		echo "Registro no encontrado";
	}
}

if(isset($_GET['Eliminar'])){
	$usuario = $_GET['usuario'];
	$sql = "DELETE FROM Administradores WHERE Usuario = '$usuario'";
	if (mysqli_query($connect, $sql)) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
}
mysqli_close($link);
?>	
</body>
</html>