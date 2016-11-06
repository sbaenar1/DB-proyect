				<!DOCTYPE html>
				<html lang="es">
				<head>
					<title>Gestion_Representante</title>
					<meta charset="UTF-8">
					<meta http-equiv="content-type" content="text/html; charset=UTF-8">
					<meta http-equiv="application-name" content="Agenda Cultural">
					<meta http-equiv="author" content="Santiago Baena Rivera">
					<meta http-equiv="author" content="Sebastian Ramirez Lopez">
					<meta http-equiv="author" content="David Sanchez Uribe">
					<meta http-equiv="keywords" content="Agenda, Cultural">
				</head>
				<body>
					<form action="" method="get">
						<fieldset>
							<legend>Crear o Actualizar Representante</legend>
							CC<input type="radio" name="tipoDoc" value="C" checked id="CC">
							Nit<input type="radio" name="tipoDoc" value="N" id="Nit">
							<input type="text" name="idRepresentante" maxlength="10" pattern="[0-9]{1,10}" title="Ingrese solo números" required id="idRepresentante">*<br>
							Nombre:<input type="text" name="nombre" maxlength="45" required id="nombre">*<br>
							Teléfono:<input type="text" name="telefono" pattern="[0-9]{1,10}" title="Ingrese solo números" required id="telefono">*<br>
							<a href="menuRegistros.html"><button type="button">Regresar</button></a>
							<input type="reset" value="Limpiar">
							<input type="submit" name="Guardar" value="Guardar"> <br>
							<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
							</fieldset>
						</form>
						<form action="" method="get">
							<fieldset>
								<legend>Buscar Representante</legend>
								CC<input type="radio" name="tipoDoc" value="C" checked>
								Nit<input type="radio" name="tipoDoc" value="N">
								<input type="text" name="idRepresentante" maxlength="10" pattern="[0-9]{1,10}" title="Ingrese solo números" required>*<br>
								<input type="reset" value="Limpiar">
								<input type="submit" name="Eliminar" value="Eliminar">
								<input type="submit" name="Buscar" value="Buscar"> <br>
								<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
							</fieldset>
						</form>
						<script>
						function display(nombre, tipoDoc, idRepresentante, telefono){
							if(tipoDoc == 'C'){
								document.getElementById("CC").checked = "checked";
							} else{
								document.getElementById("Nit").checked = "checked";
							}
							document.getElementById("idRepresentante").value = idRepresentante;
							document.getElementById("telefono").value = telefono;
							document.getElementById("nombre").value = nombre;
						}
						</script>
						<?php
						include 'conexion.php';
						if(isset($_GET['Guardar'])){
						$tipoDoc = $_GET['tipoDoc'];
						$idRepresentante = $_GET['idRepresentante'];
						$nombre = $_GET['nombre'];
						$telefono = $_GET['telefono'];
						$sql = "INSERT INTO Representantes (idRepresentante, nombre, telefono, tipoDoc) 
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
						/*echo $tipoDoc;
						echo $idRepresentante;*/
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