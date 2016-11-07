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



		<style>

			li {
				display: inline;
			}	
		</style>

		<script>
		var count = 1;


			function myFunction() {
				if(count < 5){
					var itm = document.getElementById("art0");
					var cln = itm.cloneNode(true);
					cln.name = "art0[]" + count;
					cln.id = "art" + count;
					document.getElementById("lista").appendChild(cln);
					count ++;
				} else{
					alert("Agrege máximo 5 artistas");

				}

			}

		</script>
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
				?>
				<input type="submit" name="Buscar" value="Buscar">


				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idArtistas, nombre FROM Artistas");
				echo 'Seleccione un Artista:<ul id="lista">
				<li><select name="art0[]" id="art0">';
					while ($row = $get->fetch_assoc()){
						echo "<option value='a" . $row['idArtistas'] . "'>" . $row['nombre'] . "</option>";
					} 
					echo '</select></li></ul>';
					?>

					

					<br>
					<a href="menuRegistros.html"><button type="button">Regresar</button></a>
					<button onclick="myFunction();return false;">Más Artistas</button>
					<input type="submit" name="Agregar" value="Agregar"> <br>
					<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
					<ul id = "list2"></ul>

				</fieldset>
			</form>
			<?php
			include 'conexion.php';

			if(isset($_GET['Buscar'])){
				$evento = (int)(substr($_GET['evento'], 1));

				$result=mysqli_query($connect, "SELECT nombre 
					FROM Eventos WHERE idEventos = '$evento'");
				$row = mysqli_fetch_assoc($result);
				$nombre = $row["nombre"];
				$evento;
				echo '<form action="" method="get">
				<input type="hidden" name="evento" value="e' . $evento . '">
				<fieldset>
					<legend>Evento: ' . $nombre . '</legend>';

					$get=mysqli_query($connect, "SELECT idArtistas, nombre 
						FROM Participacion INNER JOIN Artistas
						ON Artistas.idArtistas = Participacion.Artistas_idArtistas
						WHERE Eventos_idEventos = '$evento'");
					echo '<h3>Artistas que participan:</h3>';
					while ($row = $get->fetch_assoc()){
						echo "<input type='checkbox' name='seleccion[]' value='d" . $row['idArtistas'] ."'>". $row['nombre'] . "<br>";
					}
					echo "<input type='submit' name='Eliminar' value='Eliminar'>"; 
					echo '</fieldset>
				</form>';
			}
			if(isset($_GET['Eliminar'])){
				$evento = substr($_GET['evento'],1);
				foreach($_GET['seleccion'] as $selected){
					$selected = substr($selected, 1);
					$sql = "DELETE FROM Participacion WHERE Eventos_idEventos = '$evento' AND Artistas_idArtistas = '$selected'";
					if (mysqli_query($connect, $sql)) {
						echo "Record deleted successfully <br>";
					} else {
						echo "Error deleting record: " . mysqli_error($conn);
					}
				}
			}
		if(isset($_GET['Agregar'])){
			$evento = substr($_GET['evento'],1);
			foreach($_GET['art0'] as $selected){
				$selected = substr($selected, 1);
					$sql = "REPLACE INTO Participacion (Eventos_idEventos, Artistas_idArtistas)
					VALUES('$evento','$selected')";
					if (mysqli_query($connect, $sql)) {
						echo "Records added successfully <br>";
					} else {
						echo "Error adding record: " . mysqli_error($conn);
					}
			}

		}
		mysqli_close($link);
		?>
	</body>
	</html>