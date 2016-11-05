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
			<form action="" method="get" >
				<fieldset>
					<legend> Gestión Representante</legend>
					CC<input type="radio" name="tipoDoc" value="CC" checked>
					Nit<input type="radio" name="tipoDoc" value="Nit">
					<input type="text" name="idRepresentante" maxlength="10" pattern="[0-9]{1,10}" title="Ingrese solo números" required>*<br>
					Nombre:<input type="text" name="nombre" maxlength="45" required>*<br>
					Teléfono:<input type="text" name="telefono" pattern="[0-9]{1,10}" title="Ingrese solo números" required>*<br>
					<a href="menuRegistros.html"><button type="button">Regresar</button></a>
					<input type="reset" value="Limpiar">
					<input type="submit" value="Eliminar" formaction="eliminarRepresentante.php"></button>
					<input type="submit" name="Guardar" value="Guardar"> <br>
					<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
				</fieldset>
			</form>
			<?php
			$host_name  = "db655123386.db.1and1.com";
			$database   = "db655123386";
			$user_name  = "dbo655123386";
			$password   = "holaMundoCruel";
			$connect = mysqli_connect($host_name, $user_name, $password, $database);

			if(mysqli_connect_errno())
			{
				echo '<p>Verbindung zum MySQL Server fehlgeschlagen: '.mysqli_connect_error().'</p>';
			}
			else
			{
				echo '<p>Verbindung zum MySQL Server erfolgreich aufgebaut.</p>';
			}

			echo "string";
			if(isset($_GET['Guardar'])){
				$tipoDoc = $_GET['tipoDoc'];
				$idRepresentante = $_GET['idRepresentante'];
				$nombre = $_GET['nombre'];
				$telefono = $_GET['telefono'];
				echo $tipoDoc;
				echo $idRepresentante;
				echo $nombre;
				echo $telefono;
				$sql = "INSERT INTO Representantes (idRepresentante, nombre, telefono, tipoDoc) 
				VALUES ('$idRepresentante', '$nombre', '$telefono', '$tipoDoc')
				ON DUPLICATE KEY UPDATE nombre = '$nombre', telefono = '$telefono', tipoDoc = '$tipoDoc'
				";
				if(mysqli_query($connect, $sql)){
					echo "Records added successfully.";
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

				} 
			}
			if(isset($_GET['Guardar'])){
				
			}

			mysqli_close($link);
			?>
		</body>
		</html>