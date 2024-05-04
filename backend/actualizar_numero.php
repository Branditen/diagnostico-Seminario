<?php
include 'backend.php';
echo "actualizar_contacto.php iniciando...";

$datos_json = file_get_contents('php://input');

// Decodifica la cadena JSON en un array PHP
$datos = json_decode($datos_json, true);

// Ahora puedes acceder a los datos como lo harías con un array PHP normal

// Obtener los datos del formulario
$id_contacto = $datos['id_contacto'];
echo " php id contacto = $id_contacto.";

$telefono1 = $datos['telefono_1A'];
$telefono2 = $datos['telefono_2A'];
$telefono3 = $datos['telefono_3A'];
echo " php telefono 1: $telefono1.";
echo " php telefono 2: $telefono2.";
echo " php telefono 3: $telefono3.";

if($telefono1 == null){
    $telefono1 = 0;
}

if($telefono2 == null){
    $telefono2 = 0;
}

if($telefono3 == null){
    $telefono3 = 0;
}

$query = "SELECT * FROM `telefono` WHERE `id_contacto` = $id_contacto;";

$resultado = mysqli_query($connection,$query);

$fila = mysqli_fetch_assoc($resultado);

print_r($fila); 

if ($resultado) {
    echo "\nSe a ha establecido conexion con la BD.";
} else {
    echo "\nError al establecer conexion: " . mysqli_error($connection);
}

if(!$fila){
    $queryTel = "INSERT INTO `telefono` (telefono_1, telefono_2, telefono_3, id_contacto) VALUES ('$telefono1', '$telefono2' , '$telefono3' , '$id_contacto')";

    $resultadoTel = mysqli_query($connection, $queryTel);
    
    if ($resultadoTel) {
        echo "\nTelefono del contacto actualizado correctamente.";
    } else {
        echo "\nError al actualizar el Telefono del contacto: " . mysqli_error($connection);
    }


} else{
    $queryTelA = "UPDATE telefono SET telefono_1 = '$telefono1', telefono_2 = '$telefono2', telefono_3 = '$telefono3' WHERE id_contacto = $id_contacto";

    $resultadoTelA = mysqli_query($connection, $queryTelA);


    if ($resultadoTelA) {
        echo "\nTelefono del contacto actualizado correctamente.";
    } else {
        echo "\nError al actualizar el Telefono del contacto: " . mysqli_error($connection);
    }
    
}

mysqli_close($connection);
