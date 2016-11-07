<!DOCTYPE html>
<html lang="es">
<head>
	<title>Gestion_Evento</title>
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
			<legend> Gestión Evento</legend>
			Nombre:<input type="text" name="nombre" maxlength="45" required id="nombre">*<br>
			Hora Inicio:<input type="time" name="horaIni" required id="horaIni">* 
			Hora Fin:<input type="time" name="horaFin" id="horaFin"> <br>
			Fecha:<input type="date" name="fecha" id="fecha">* <br>
			Tipo Evento: <input type="radio" name="tipo" value="m" checked id="m">Música
			<input type="radio" name="tipo" value="t" id="t">Teatro
			<input type="radio" name="tipo" value="p" id="p">Plástica
			<input type="radio" name="tipo" value="l" id="l">Literatura
			<input type="radio" name="tipo" value="c" id="c">Cine*<br>
			Descripción:
			<textarea name="descripcion" rows="4" cols="50" id="descripcion"></textarea><br>
			<?php
			include 'conexion.php';
			$get=mysqli_query($connect, "SELECT idUniversidades, nombre FROM Universidades");
			echo 'Universidad:<select name="universidad" id="universidad">';
			while ($row = $get->fetch_assoc()){
				echo "<option value='" . $row['idUniversidades'] . "'>" . $row['nombre'] . "</option>";
			} 
			echo '</select>';
			?> <br>

			<?php
			include 'conexion.php';
			$get=mysqli_query($connect, "SELECT idEscenarios, nombre FROM Escenarios");
			echo 'Escenario:<select name="escenario" id="escenario">';
			while ($row = $get->fetch_assoc()){
				echo "<option value='" . $row['idEscenarios'] . "'>" . $row['nombre'] . "</option>";
			} 
			echo '</select>';
			?> <br>

			<a href="menuRegistros.html"><button type="button">Regresar</button></a>
			<input type="reset" value="Limpiar">
			<input type="submit" name="Guardar" value="Guardar"> <br>
			<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
		</fieldset>
	</form>
	<form action="" method="get">
		<fieldset>
			<legend>Buscar o Eliminar Evento</legend>
			Nombre: <input type="text" name="nombre" maxlength="45" required>*<br>
			<input type="reset" value="Limpiar">
			<input type="submit" name="Eliminar" value="Eliminar">
			<input type="submit" name="Buscar" value="Buscar"> <br>
			<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
		</fieldset>
	</form>
	<script>
		function display(nombre, horaIni, horaFin, fecha, tipo, descripcion, universidad, escenario){
			document.getElementById("nombre").value = nombre;
			document.getElementById("horaIni").value = horaIni;
			document.getElementById("horaFin").value = horaFin;
			document.getElementById("fecha").value = fecha;
			document.getElementById(tipo).checked = "checked";
			document.getElementById("descripcion").value = descripcion;
			document.getElementById("universidad").value = universidad;
			document.getElementById("escenario").value = escenario;
		}
		//display('Concierto','20:00','22:00','1983-02-09', 't', 'Hola Mundo', 'Universidad del Tolima', 'Auditorio Fundadores');
	</script>
</form>	
<?php
include 'conexion.php';
if(isset($_GET['Guardar'])){
	$nombre = $_GET['nombre'];
	$horaIni = $_GET['horaIni'];
	$horaFin = $_GET['horaFin'];
	$fecha = $_GET['fecha'];
	$tipo = $_GET['tipo'];
	$descripcion = $_GET['descripcion'];
	$universidad = $_GET['universidad'];		
	$escenario = $_GET['escenario'];

	$sql = "INSERT INTO Eventos (nombre, horaInicio, horaFinalizacion, fecha, 
	Tipo_Artista_Evento_Tipo, descripcion, Universidades_idUniversidades, Escenarios_idEscenarios) 
	VALUES ('$nombre', '$horaIni' , '$horaFin', '$fecha', '$tipo', '$descripcion', '$universidad', '$escenario')
	ON DUPLICATE KEY UPDATE horaInicio = '$horaIni', horaFinalizacion = '$horaFin', 
	fecha ='$fecha', Tipo_Artista_Evento_Tipo ='$tipo', descripcion ='$descripcion', Universidades_idUniversidades ='$universidad', Escenarios_idEscenarios = '$escenario'";
	if(mysqli_query($connect, $sql)){
		echo "Records added successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

	} 
}
if(isset($_GET['Buscar'])){
	$nombre = $_GET['nombre'];
	$sql = "SELECT horaInicio, horaFinalizacion, fecha, 
	Tipo_Artista_Evento_Tipo, descripcion, Universidades_idUniversidades, Escenarios_idEscenarios 
	FROM Eventos WHERE nombre = '$nombre'";			
	$result = mysqli_query($connect, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo "<script> display('" . $nombre . "', '" . $row["horaInicio"] . "', '" . $row["horaFinalizacion"] . "','" 
		. $row["fecha"] . "', '" . $row["Tipo_Artista_Evento_Tipo"]  . "','" . $row["descripcion"] . "', '" 
		. $row["Universidades_idUniversidades"] . "','" . $row["Escenarios_idEscenarios"]  . "'); </script>";
	} else {
		echo "Registro no encontrado";
	}

}

if(isset($_GET['Eliminar'])){
	$nombre = $_GET['nombre'];
	$sql = "DELETE FROM Eventos WHERE nombre = '$nombre'";
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