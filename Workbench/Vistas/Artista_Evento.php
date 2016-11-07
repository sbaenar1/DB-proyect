	<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>Agregar o Eliminar Artista a un Evento</title>
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
				echo 'Evento:<select name="evento" id="evento">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='e" . $row['idEventos'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';
				?>

				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idArtistas, nombre FROM Artistas");
				echo 'Artista:<select name="artista" id="artista">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='a" . $row['idArtistas'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';
				?> <br>
				<a href="menuRegistros.html"><button type="button">Regresar</button></a>
				<input type="submit" name="Eliminar" value="Eliminar">
				<input type="submit" name="Agregar" value="Agregar"> <br>
				<p style="font-size:70%">Los campos marcados con * son obligatorios</p>

			</fieldset>
		</form>
		<?php
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

		mysqli_close($link);
		?>
	</body>
	</html>