  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
      <form action="" method="get">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <nav>
    <div class="nav-wrapper">
      <a href="Page.html" class="brand-logo right">Agenda Cultural</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="Registro_Usuario.html">Iniciar Sesion</a></li>
        <li><a href="Register.html">Registrarse</a></li>
      </ul>
    </div>
  </nav>
  <label>Tipo Evento</label>
  <select class="browser-default">
    <option value="" disabled selected>Choose your option</option>
    <option value="universidad" name="lista">Universidad</option>
    <option value="escenario" name="lista">Escenario</option>
    <option value="artista" name="lista">Artista</option>
    <option value="teatro" name="lista">Teatro</option>
    <option value="plastica" name="lista">Plástica</option>
    <option value="literatura" name="lista">Literatura</option>
    <option value="cine" name="lista">Cine</option>
</select>
  <br>
  <nav>
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>
  <br>
  <table>
    <thead>
      <tr>
          <th data-field="id">Nombre</th>
          <th data-field="name">Descripción</th>
          <th data-field="price">Tipo</th>
          <th data-field="Fecha">Fecha</th>
          <th data-field="HI">Hora Inicio</th>
          <th data-field="HF">Hora Fin</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
  <script>
  function getTypes(lista){
    if(lista == 'universidad'){
      document.getElementById("lista").value = universidad;
    }else if (lista == 'escenario') {
      document.getElementById("lista").value = escenario;
    }else if (lista == 'artista') {
      document.getElementById("lista").value = artista;
    }else if (lista == 'teatro') {
      document.getElementById("lista").value = teatro;
    }else if (lista == 'plastica') {
      document.getElementById("lista").value = plastica;
    } else if (lista == 'literatura') {
      document.getElementById("lista").value = literatura;
    }else {
      document.getElementById("lista").value = cine;
    }
  }
  </script>
</form>
  <?php
  
  include 'conexion.php';
  if(isset($_GET['search'])){
    $T_event = $_GET['lista'];
    $sql = "select nombre, descripcion, tipo, fecha, horaInicio, horaFinalizacion
    FROM Eventos WHERE nombre = 'search'";
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
