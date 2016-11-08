<!DOCTYPE html>
<html lang="es">
<head>
	<title>Busqueda General</title>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="application-name" content="Agenda Cultural">
	<meta http-equiv="author" content="Santiago Baena Rivera">
	<meta http-equiv="author" content="Sebastian Ramirez Lopez">
	<meta http-equiv="author" content="David Sanchez Uribe">
	<meta http-equiv="keywords" content="Agenda, Cultural">	
</head>
<body>
<fieldset>
	<a href="RegistroUsuario.php"><button type="button">Login</button></a>
</fieldset>
	<form action="" method="get" >
		<fieldset>
			<legend> Busqueda de Evento</legend>
			Nombre:<input type="text" name="nombre" maxlength="45" id="nombre">*<br>
			Fecha:<input type="date" name="fecha" id="fecha">* <br>
			Tipo Evento: <input type="radio" name="tipo" value="m" id="m">Música
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
			echo "<option value=''>---------</option>";
			while ($row = $get->fetch_assoc()){
				echo "<option value='" . $row['idUniversidades'] . "'>" . $row['nombre'] . "</option>";
			} 
			echo '</select>';
			?> <br>

			<?php
			include 'conexion.php';
			$get=mysqli_query($connect, "SELECT idEscenarios, nombre FROM Escenarios");
			echo 'Escenario:<select name="escenario" id="escenario">';
			echo "<option value=''>---------</option>";
			while ($row = $get->fetch_assoc()){
				echo "<option value='" . $row['idEscenarios'] . "'>" . $row['nombre'] . "</option>";
			} 
			echo '</select>';
			?> <br>

			<?php
			include 'conexion.php';
			$get=mysqli_query($connect, "SELECT idArtistas, nombre FROM Artistas");

			echo 'Artista:<select name="artista" id="artista">';
			echo "<option value=''>---------</option>";

			while ($row = $get->fetch_assoc()){
				echo "<option value='a" . $row['idArtistas'] . "'>" . $row['nombre'] . "</option>";
			} 
			echo '</select>';
			?> <br>

			<a href="menuRegistros.html"><button type="button">Regresar</button></a>
			<input type="reset" value="Limpiar">
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
if(isset($_GET['Buscar'])){
	'nombre' . $nombre = $_GET['nombre'];
	'fecha' . $fecha = $_GET['fecha'];
	'tipo' . $tipo = $_GET['tipo'];
	'descripcion' . $descripcion = $_GET['descripcion'];
	'universidad' . $universidad = $_GET['universidad'];		
	'escenario' . $escenario = $_GET['escenario'];
	'artista' . $artista = substr($_GET['artista'], 1);
	$sql = sprintf("SELECT Tipo_Artista_Evento.Nombre AS nombreTi, Escenarios.nombre AS nombreEs, Universidades.nombre AS nombreUn, Eventos.nombre AS nombreEv, horaInicio, horaFinalizacion, descripcion,fecha, Eventos.Escenarios_idEscenarios, Eventos.Universidades_idUniversidades, Participacion.Artistas_idArtistas, Eventos.Tipo_Artista_Evento_Tipo, BoletasDisponibles FROM Eventos, Participacion, Universidades, Escenarios, Tipo_Artista_Evento
		WHERE Eventos.nombre LIKE '$nombre' OR fecha = '$fecha' OR Eventos.Escenarios_idEscenarios = '$escenario' OR Eventos.Universidades_idUniversidades = '$universidad' OR Participacion.Artistas_idArtistas = '$artista' OR Eventos.Tipo_Artista_Evento_Tipo = '$tipo' GROUP BY Eventos.nombre");
	$get = mysqli_query($connect, $sql);
	echo "<table border='1'>
	<tr>
		<th>Nombre</th>
		<th>Hora Inicio</th>
		<th>Hora Finalizacion</th>
		<th>Fecha</th>
		<th>Descripcion</th>
		<th>Escenario</th>
		<th>Tipo</th>
		<th>Universidad</th>
		<th>Boletas Disponibles</th>
	</tr>";
	/////

	while ($row = $get->fetch_assoc()){
	
		echo "<tr>";
		echo "<td>" . $row['nombreEv'] . "</td>";
		echo "<td>" . $row['horaInicio'] . "</td>";
		echo "<td>" . $row['horaFinalizacion'] . "</td>";
		echo "<td>" . $row['fecha'] . "</td>";
		echo "<td>" . $row['descripcion'] . "</td>";
		echo "<td>" . $row['nombreEs'] . "</td>";
		echo "<td>" . $row['nombreTi'] . "</td>";
		echo "<td>" . $row['nombreUn'] . "</td>";
		echo "<td>" . $row['BoletasDisponibles'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}


mysqli_close($link);
?>

</body>
</html>