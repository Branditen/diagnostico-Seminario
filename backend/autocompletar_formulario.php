<?php
// Conectar a la base de datos y realizar la consulta para obtener la información del contacto
// Supongamos que tienes una función para conectar a la base de datos y obtener los datos del contacto
include 'backend.php';
// Obtener el id_contacto del formulario (suponiendo que se pasa como un parámetro GET o POST)
$id_contacto = $_GET['id_contacto'];
echo $id_contacto;
echo " es el id contacto (autocompletar_formulario.php)";

// Realizar la consulta para obtener los datos del contacto con el id_contacto especificado
// Aquí debes ejecutar tu consulta SQL para obtener los datos del contacto utilizando el $id_contacto
$queryD = "SELECT * FROM `contacto` WHERE `id_contacto` = $id_contacto;";
                    
$resultD = mysqli_query($connection, $queryD);

// Supongamos que tienes una función para ejecutar la consulta y obtener los datos del contacto

// Verificar si se encontraron datos del contacto
if ($resultD) {
    $fila = mysqli_fetch_assoc($resultD);      
    // Autocompletar los campos del formulario con los datos del contacto
    $nombreD = $fila['nombre'];
    $emailD = $fila['email'];
    // Asignar los valores a los campos del formulario utilizando JavaScript
    echo "<script>
            document.getElementById('nombre').value = '$nombreD';
            document.getElementById('email').value = '$emailD';
          </script>";
} else {
    // Manejar el caso en el que no se encuentren datos del contacto
    echo "No se encontraron datos del contacto.";
}

mysqli_close($connection);

