<?php
include 'backend.php';
echo "actualizar_contacto.php iniciando...";

$datos_json = file_get_contents('php://input');

// Decodifica la cadena JSON en un array PHP
$datos = json_decode($datos_json, true);

// Ahora puedes acceder a los datos como lo harías con un array PHP normal

// Obtener los datos del formulario
$nombre = $datos['nombre'];
echo " php $nombre.";
$email = $datos['email'];
echo " php $email.";
$id_contacto = $datos['id_contacto'];
echo " php $id_contacto.";

// Crear la consulta SQL para actualizar el contacto
$query = "UPDATE contacto SET nombre = '$nombre', email = '$email' WHERE id_contacto = $id_contacto";

// Ejecutar la consulta
$resultado = mysqli_query($connection, $query);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    echo "\nContacto actualizado correctamente.";
} else {
    echo "\nError al actualizar el contacto: " . mysqli_error($connection);
}
mysqli_close($connection);

