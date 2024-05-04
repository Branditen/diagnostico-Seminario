<?php
include 'backend.php';

// Obtener el id del contacto a eliminar desde la solicitud
$id_contacto = $_POST['id_contacto']; // Asumiendo que se envía el id por POST

// Crear la consulta SQL para eliminar el contacto
$query = "DELETE FROM contacto WHERE id_contacto = $id_contacto";

// Ejecutar la consulta
$resultado = mysqli_query($connection, $query);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    echo "Contacto eliminado correctamente.";
} else {
    echo "Error al eliminar el contacto: " . mysqli_error($connection);
}

$queryTel = "DELETE FROM telefono WHERE id_contacto = $id_contacto";

$resultadoTel = mysqli_query($connection, $queryTel);

if ($resultadoTel) {
    echo "Numero/s de telefono eliminado correctamente.";
} else {
    echo "Error al eliminar numero telefonico: " . mysqli_error($connection);
}

mysqli_close($connection);
?>