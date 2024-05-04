<?php
// Incluir archivo de conexión a la base de datos
include 'backend.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];

$telefono1 = $_POST['telefono1'];
$telefono2 = $_POST['telefono2'];
$telefono3 = $_POST['telefono3'];
echo "Este es el telefono 1: $telefono1.
Este es el telefono 2: $telefono2.
Este es el telefono 3: $telefono3.";



// Crear la consulta SQL para insertar el nuevo contacto
$query = "INSERT INTO `contacto` (email, nombre) VALUES ('$email', '$nombre')";

// Ejecutar la consulta
$result = mysqli_query($connection, $query);

// Verificar si la consulta se ejecutó correctamente
if ($result) {
    echo "Contacto agregado correctamente. (procesar_formulario.php)";
} else {
    echo "Error al agregar el contacto (php): " . mysqli_error($connection);
}

$queryId = "SELECT * FROM `contacto` ORDER BY `id_contacto` DESC LIMIT 1";

$resultId = mysqli_query($connection, $queryId);

if ($resultId) {
    $fila = mysqli_fetch_assoc($resultId);      
    // Autocompletar los campos del formulario con los datos del contacto
    $id_contacto = $fila['id_contacto'];
    // Asignar los valores a los campos del formulario utilizando JavaScript
    echo " $id_contacto este es el id contacto";
} else {
    // Manejar el caso en el que no se encuentren datos del contacto
    echo "No se encontraron datos del contacto.";
}


$queryTel = "INSERT INTO `telefono` (telefono_1, telefono_2, telefono_3, id_contacto) VALUES ('$telefono1', '$telefono2' , '$telefono3' , '$id_contacto')";

$resultTel = mysqli_query($connection, $queryTel);

if ($resultTel) {
    echo "Telefono/s agregado/s correctamente. (procesar_formulario.php)";
} else {
    echo "Error al agregar el telefono: " . mysqli_error($connection);
}


// Cerrar la conexión a la base de datos
mysqli_close($connection);