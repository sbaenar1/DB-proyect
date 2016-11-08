		<!DOCTYPE html>
		<html lang="es">
		<head>
			<title>Registro_Usuario</title>
			<meta charset="UTF-8">
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<meta http-equiv="application-name" content="Agenda Cultural">
			<meta http-equiv="author" content="Santiago Baena Rivera">
			<meta http-equiv="author" content="Sebastian Ramirez Lopez">
			<meta http-equiv="author" content="David Sanchez Uribe">
			<meta http-equiv="keywords" content="Agenda, Cultural">	
		</head>
		<body>
			<form action="" method="post" >
				<fieldset>
					<legend> RegistroUsuario</legend>
					Usuario:<input type="text" name="usuario" maxlength="45" required id="usuario">*<br>
					Contraseña:<input type="password" name="contrasena" maxlength="45" required id="contrasena">*<br>
					<a href="Page2.php"><button type="button">Regresar</button></a>
					<input type="reset" value="Limpiar">
					<input type="submit" name="Continuar" value="Continuar"> <br>
					<p style="font-size:70%">Los campos marcados con * son obligatorios</p>
				</fieldset>
			</form>	
			<?php
			include 'conexion.php';
			if(isset($_POST['Continuar'])){
				$usuario = $_POST['usuario'];
				$contrasena = $_POST['contrasena'];
				$sql = "SELECT Usuario from Administradores  WHERE Usuario = '$usuario' AND 
				Contrasena = SHA2(CONCAT('$contrasena','$usuario'),512)";
				$result = mysqli_query($connect, $sql);
				if(mysqli_num_rows($result) > 0){
					echo "<script type='text/javascript'>window.location.href = 'menuRegistros.html';</script>";
					exit();
				} else{
					echo 'Usuario o Contrasena incorrecta';


				}


			}




			mysqli_close($link);

			?>
		</body>


		</html>