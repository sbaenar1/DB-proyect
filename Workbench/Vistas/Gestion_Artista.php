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
	<form action="registrarArtista.php" method="get" >
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
			$get=mysqli_query($connect, "SELECT idRepresentante, nombre FROM Representantes");
			echo 'Representante:<select name="idRepresentante" id="representante">';
			while ($row = $get->fetch_assoc()){
				echo "<option value='r" . $row['idRepresentante'] . "'>" . $row['nombre'] . "(" . $row['idRepresentante'] .")</option>";
			} 
			echo '</select>';
			?>
			<br>
			<a href="menuRegistros.html"><button type="button">Regresar</button></a>
			<input type="reset" value="Limpiar">
			<input type="submit" name="Guardar" value="Guardar"> <br>
			<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
		</fieldset>
		<form action="" method="get">
			<fieldset>
				<legend>Buscar o Eliminar Artista</legend>
				Nombre<input type="text" name="nombre" maxlength="45" required>*<br>
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
				document.getElementById("representante").value = "r" + representante;
			}
		</script>
	</script>
	<?php
	include 'conexion.php';
	if(isset($_GET['Guardar'])){
		$nombre = $_GET['nombre'];
		$tipo = $_GET['tipo'];
		$pais = $_GET['pais'];
		$idRepresentante = $_GET['idRepresentante'];

		$sql = "INSERT INTO Artistas (idRepresentante, nombre, telefono, tipoDoc) 
		VALUES ('$idRepresentante', '$nombre', '$telefono', '$tipoDoc')
		ON DUPLICATE KEY UPDATE nombre = '$nombre', telefono = '$telefono'";
		if(mysqli_query($connect, $sql)){
			echo "Records added successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

		} 
	}
	if(isset($_GET['Buscar'])){
		$tipoDoc = $_GET['tipoDoc'];
		$idRepresentante = $_GET['idRepresentante'];
		$sql = "SELECT nombre, telefono FROM Representantes WHERE idRepresentante = '$idRepresentante' AND tipoDoc = '$tipoDoc'";
		$result = mysqli_query($connect, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			echo "<script> display('" . $row["nombre"] . "', '" . $tipoDoc . "', " . $idRepresentante . "," . $row["telefono"] . "); </script>";
		} else {
			echo "Registro no encontrado";
		}

	}
	if(isset($_GET['Eliminar'])){
		$tipoDoc = $_GET['tipoDoc'];
		$idRepresentante = $_GET['idRepresentante'];
		$sql = "DELETE FROM Representantes WHERE idRepresentante = '$idRepresentante' AND tipoDoc = '$tipoDoc'";
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
