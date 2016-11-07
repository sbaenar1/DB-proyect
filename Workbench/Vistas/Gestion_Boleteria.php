	<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>Gestion_Boleteria</title>
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
				<legend> Crear o Actualizar Boletería</legend>
				Consecutivo inicial:<input type="number" name="cIni" min="0" max="65535" required id="cIni">
				Consecutivo final:<input type="number" name="cFin" min="0" max="65535" required id="cFin">*<br>
				Localidad:<input type="text" name="localidad" maxlength="20" id="localidad"><br>
				Valor:<input type="number" min="0" max="4294967295" name="valor" id="valor"><br>

				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idEventos, nombre FROM Eventos");
				echo 'Evento:<select name="evento" id="evento">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='e" . $row['idEventos'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';
				?> <br>

				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idPuntos_de_Venta, nombre FROM Puntos_de_Venta");
				echo 'Punto de Venta:<select name="pVenta" id="pVenta">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='pv" . $row['idPuntos_de_Venta'] . "'>" . $row['nombre'] . "</option>";
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
				<legend>Buscar o Eliminar Boleta</legend>
				Numero Boleta:<input type="number" name="noBoleta" min="0" max="65535" required id="noBoleta">
				<?php
				include 'conexion.php';
				$get=mysqli_query($connect, "SELECT idEventos, nombre FROM Eventos");
				echo 'Evento:<select name="evento2" id="evento2">';
				while ($row = $get->fetch_assoc()){
					echo "<option value='e" . $row['idEventos'] . "'>" . $row['nombre'] . "</option>";
				} 
				echo '</select>';
				?> <br>
				<input type="reset" value="Limpiar">
				<input type="submit" name="Eliminar" value="Eliminar">
				<input type="submit" name="Buscar" value="Buscar"> <br>
				<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
			</fieldset>
			<script>
				function display(numero, localidad, valor, evento, pVenta){
					document.getElementById("cIni").value = numero;
					document.getElementById("localidad").value = localidad;
					document.getElementById("valor").value = valor;
					document.getElementById("evento").value = evento;
					document.getElementById("pVenta").value = pVenta;
				}
			</script>
		</form>

		<?php
		include 'conexion.php';
		if(isset($_GET['Guardar'])){
			$cIni = $_GET['cIni'];
			$cFin = $_GET['cFin'];
			$localidad = $_GET['localidad'];
			$valor = $_GET['valor'];
			$evento = substr($_GET['evento'], 1);
			$pVenta = substr($_GET['pVenta'], 2);
			$sql = "CALL crearBoleteria('$cIni', '$cFin', '$localidad', 
			'$valor', '$evento', '$pVenta')";
			if(mysqli_query($connect, $sql)){
				echo "Records added successfully.";
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

			} 
		}		
		if(isset($_GET['Buscar'])){
			$noBoleta = $_GET['noBoleta'];
			$evento2 = substr($_GET['evento2'], 1);
			$sql = "SELECT localidad, valor, Puntos_de_Venta_idPuntos_de_Venta 
			FROM Boletas WHERE idBoletas = '$noBoleta' AND Eventos_idEventos = '$evento2'";			
			$result = mysqli_query($connect, $sql);
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<script> display(" . $noBoleta . ", '" . $row["localidad"] . "', " . $row["valor"] . ",'" 
				. 'e' . $evento2 . "','" . 'pv' . $row["Puntos_de_Venta_idPuntos_de_Venta"]  . "'); </script>";
			} else {
				echo "Registro no encontrado";
			}

		}

		if(isset($_GET['Eliminar'])){
			$noBoleta = $_GET['noBoleta'];
			$evento2 = substr($_GET['evento2'], 1);
			$sql = "DELETE FROM Boletas WHERE idBoletas = '$noBoleta' AND Eventos_idEventos = '$evento2'";
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