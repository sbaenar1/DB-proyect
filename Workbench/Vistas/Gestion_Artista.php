		<!DOCTYPE html>
		<html lang="es">
		<head>
			<title>Gestion_Artista</title>
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
					<legend> Gestión Artista</legend>
					Nombre:<input type="text" name="nombre" maxlength="45" required id="nombre">*<br>
					Tipo Artista: <input type="radio" name="tipo" value="m" checked id="m">Música
					<input type="radio" name="tipo" value="t" id="t">Teatro
					<input type="radio" name="tipo" value="p" id="p">Plástica
					<input type="radio" name="tipo" value="l" id="l">Literatura
					<input type="radio" name="tipo" value="c" id="c">Cine*<br>
					<?php
					include 'conexion.php';
					$get=mysqli_query($connect, "SELECT idPaises, Nombre FROM Paises");
					echo 'Pais:<select name="pais" id="pais">';
					while ($row = $get->fetch_assoc()){
						echo "<option value='" . $row['idPaises'] . "'>" . $row['Nombre'] . "</option>";
					} 
					echo '</select>';
					?>
					<br>

					<?php
					include 'conexion.php';
					$get=mysqli_query($connect, "SELECT idRepresentante, nombre, tipoDoc FROM Representantes");
					echo 'Representante:<select name="idRepresentante" id="representante">';
					while ($row = $get->fetch_assoc()){
						$identificacion = $row['tipoDoc'] . $row['idRepresentante'];
						echo "<option value='" . $identificacion . "'>" . $row['nombre'] . "(" . $identificacion .")</option>";
					} 
					echo '</select>';
					?>
					<br>

					<a href="menuRegistros.html"><button type="button">Regresar</button></a>
					<input type="reset" value="Limpiar">
					<input type="submit" name="Guardar" value="Guardar"> <br>
					<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
				</fieldset>
				</form>
				<form action="" method="get">
					<fieldset>
						<legend>Buscar o Eliminar Artista</legend>
						Nombre: <input type="text" name="nombre" maxlength="45" required>*<br>
						<input type="reset" value="Limpiar">
						<input type="submit" name="Eliminar" value="Eliminar">
						<input type="submit" name="Buscar" value="Buscar"> <br>
						<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
					</fieldset>
				</form>
				<script>
					function display(nombre, tipo, pais, representante){
						document.getElementById("nombre").value = nombre;
						document.getElementById(tipo).checked = "checked";
						document.getElementById("pais").value = pais;
						document.getElementById("representante").value = representante;
					}
				</script>
			<?php
			include 'conexion.php';
			if(isset($_GET['Guardar'])){
				$nombre = $_GET['nombre'];
				$tipo = $_GET['tipo'];
				$pais = $_GET['pais'];
				$idRepresentante = substr($_GET['idRepresentante'], 1);
				$tipoDoc = substr($_GET['idRepresentante'], 0, 1);
				$sql = "INSERT INTO Artistas (nombre, Tipo_Artista_Evento_Tipo, Paises_idPaises, Representantes_idRepresentante, Representantes_tipoDoc) 
				VALUES ('$nombre', '$tipo' , '$pais', '$idRepresentante', '$tipoDoc')
				ON DUPLICATE KEY UPDATE Tipo_Artista_Evento_Tipo = '$tipo', Paises_idPaises = '$pais', 
				Representantes_idRepresentante = '$idRepresentante', Representantes_tipoDoc = '$tipoDoc'";
				if(mysqli_query($connect, $sql)){
					echo "Records added successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

				} 
			}
			if(isset($_GET['Buscar'])){
				$nombre = $_GET['nombre'];
				$sql = "SELECT Tipo_Artista_Evento_Tipo,  Paises_idPaises, Representantes_idRepresentante, Representantes_tipoDoc 
				FROM Artistas WHERE nombre = '$nombre'";			
				$result = mysqli_query($connect, $sql);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$identificacion = $row['Representantes_tipoDoc'] . $row['Representantes_idRepresentante'];
					echo "<script> display('" . $nombre . "', '" . $row["Tipo_Artista_Evento_Tipo"] . "', '" . $row["Paises_idPaises"] . "','" . $identificacion . "'); </script>";
				} else {
					echo "Registro no encontrado";
				}

			}
			if(isset($_GET['Eliminar'])){
				$nombre = $_GET['nombre'];
				$sql = "DELETE FROM Artistas WHERE nombre = '$nombre'";
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
