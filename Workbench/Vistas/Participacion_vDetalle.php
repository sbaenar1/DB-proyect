	<!DOCTYPE html>
	<html lang="es">
	<head>
		<title> Gestion de Participación de Artistas</title>
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
				<legend>Agregar o Eliminar Artista a un Evento</legend>
				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idEventos, nombre FROM Eventos");
				echo 'Seleccione un Evento:<select name="evento" id="evento">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='e" . $row['idEventos'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';
				?> 	<input type="submit" name="Buscar" value="Buscar"> <br>

				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idArtistas, nombre FROM Artistas");
				echo 'Seleccione un Artista:<select name="artista" id="artista">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='a" . $row['idArtistas'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';
				?> <br>
				<a href="menuRegistros.html"><button type="button">Regresar</button></a>
				<input type="submit" name="Agregar" value="Agregar"> <br>
				<p style="font-size:70%">Los campos marcados con * son obligatorios</p>

			</fieldset>
		</form>
		<h2>Artistas que participan en estos eventos</h2>
		<?php
		include 'conexion.php';

		if(isset($_GET['Buscar'])){
			$evento = (int)(substr($_GET['evento'], 1));

			$result=mysqli_query($connect, "SELECT nombre 
				FROM Eventos WHERE idEventos = '$evento'");
			$row = mysqli_fetch_assoc($result);
			$nombre = $row["nombre"];

			echo '<form action="" method="get" >
			<fieldset>
				<legend>Evento: ' . $nombre . '</legend>';

				$get=mysqli_query($connect, "SELECT idArtistas, nombre 
				FROM Participacion INNER JOIN Artistas
				ON Artistas.idArtistas = Participacion.Artistas_idArtistas
				WHERE Eventos_idEventos = '$evento'");

				echo 'Artistas:<select name="artista">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='a" . $row['idArtistas'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';


			echo '</fieldset>
		</form>';

			/*echo 'Seleccione un Artista:<select name="artista" id="artista">';
			while ($row = $get->fetch_assoc()){
				echo "<option value='a" . $row['idArtistas'] . "'>" . $row['nombre'] . "</option>";
			}*/ 
		}/*
		include 'conexion.php';
		if(isset($_GET['Agregar'])){
			echo $evento = substr($_GET['evento'], 1);
			echo $artista = substr($_GET['artista'], 1);
			$sql = "INSERT INTO Participacion(Eventos_idEventos, Artistas_idArtistas) VALUES ('$evento','$artista')";
			if(mysqli_query($connect, $sql)){
				echo "Records added successfully.";
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

			} 
		}		
		if(isset($_GET['Eliminar'])){
			echo $evento = substr($_GET['evento'], 1);
			echo $artista = substr($_GET['artista'], 1);
			$sql = "DELETE FROM Participacion WHERE Eventos_idEventos = '$evento' AND Artistas_idArtistas = '$artista'";
			if (mysqli_query($connect, $sql)) {
				echo "Record deleted successfully";
			} else {
				echo "Error deleting record: " . mysqli_error($conn);
			}
		}



*/
		mysqli_close($link);
		?>
	</body>
	</html>