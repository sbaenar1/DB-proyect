<?php
    $host_name  = "db655195544.db.1and1.com";
    $database   = "db655195544";
    $user_name  = "dbo655195544";
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
?>