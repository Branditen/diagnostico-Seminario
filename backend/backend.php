<?php
    
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "brandon1234");
    define("DATABASE", "agenda_2");

    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD,DATABASE);

    if(!$connection){
        die("Conexion fallida");
    } else{
        echo "conectado. :) ";
    }
?>
