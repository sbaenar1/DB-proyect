<!DOCTYPE html>
<html lang="es">
<head>
	<title>Gestion_PuntoDeVenta</title>
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
			<legend> Gestión Punto De Venta</legend>
			Nombre:<input type="text" name="nombre" maxlength="45" required id="nombre">*<br>
			Teléfono:<input type="text" name="tel_contacto" pattern="[0-9]{1,10}" title="Ingrese solo números" required id=telefono>*<br>
			Dirección:<input type="text" name="direccion" maxlength="20" id="direccion"> <br>
			<a href="menuRegistros.html"><button type="button">Regresar</button></a>
			<input type="reset" value="Limpiar">
			<input type="submit" name="Guardar" value="Guardar"> <br>
			<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
		</fieldset>
	</form>
	<form action="" method="get">
		<fieldset>
		<legend>Buscar o Eliminar Punto de Venta</legend>
		Nombre<input type="text" name="nombre" maxlength="45" required>*<br>
		<input type="reset" value="Limpiar">
		<input type="submit" name="Eliminar" value="Eliminar">
		<input type="submit" name="Buscar" value="Buscar"> <br>
		<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
	</fieldset>
</form>
<script>
	function display(nombre, telefono, direccion){
		document.getElementById("nombre").value = nombre;
		document.getElementById("telefono").value = telefono;
		document.getElementById("direccion").value = direccion;
	}
</script>
<?php
include 'conexion.php';
if(isset($_GET['Guardar'])){
	$nombre = $_GET['nombre'];
	$tel_contacto = $_GET['tel_contacto'];
	$direccion = $_GET['direccion'];
	$sql = "CALL insertarTelefono('$tel_contacto', '$direccion')";
	mysqli_query($connect, $sql);

	$sql = "INSERT INTO Puntos_de_Venta (nombre, Informacion_Contacto_Telefono) 
	VALUES ('$nombre', '$tel_contacto') 
	ON DUPLICATE KEY UPDATE Informacion_Contacto_Telefono = '$tel_contacto'";
	if(mysqli_query($connect, $sql)){
		echo "Records added successfully.";
	} else{
		echo "El telefono pertenece a otro Punto De Venta";
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
}

if(isset($_GET['Buscar'])){
	$nombre = $_GET['nombre'];
	$sql = "SELECT Informacion_Contacto_Telefono, Direccion 
	FROM (Puntos_de_Venta INNER JOIN Informacion_Contacto 
	ON Puntos_de_Venta.Informacion_Contacto_Telefono = Informacion_Contacto.telefono)
	WHERE nombre = '$nombre'";
	$result = mysqli_query($connect, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo "<script> display('" . $nombre . "', " . $row["Informacion_Contacto_Telefono"] . ",'" . $row["Direccion"] . "'); </script>";
	} else {
		echo "Registro no encontrado";
	}
}

if(isset($_GET['Eliminar'])){
	$nombre = $_GET['nombre'];
	$sql = "DELETE FROM Puntos_de_Venta WHERE nombre = '$nombre'";
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