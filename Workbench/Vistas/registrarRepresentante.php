<html>
<body>


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
    $tipoDoc = $_GET['tipoDoc'];
    $idRepresentante = $_GET['idRepresentante'];
    $nombre = $_GET['nombre'];
    $telefono = $_GET['telefono'];
    echo $tipoDoc;
    echo $idRepresentante;
    echo $nombre;
    echo $telefono;
    $sql = "INSERT INTO Representantes (idRepresentante, nombre, telefono, tipoDoc) 
    VALUES ('$idRepresentante', '$nombre', '$telefono', '$tipoDoc')";
    if(mysqli_query($connect, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    mysqli_close($link);
}
?>

</body>
</html>

</body>
</html>