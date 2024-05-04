<!-- index.html -->
<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
    <link rel="icon" type="image/x-icon" href="loro.ico">
    <link rel="stylesheet" href="frontend/styles.css">
</head>
<body>
    <?php include ('backend\backend.php') ?>
    <h1>Agenda de Contactos</h1>
    <!-- Aquí irá la lista de contactos -->
    <table>
        <thead>
            <tr>
                <th>id_contacto||</th>
                <th>nombre||</th>
                <th>tel||</th>
                <th>tel2||</th>
                <th>tel3||</th>
                <th>email||</th>
                <th>Actualizar||</th>
                <th>Eliminar||</th>
            </tr>
        </thead>
        <tbody>

           <?php 

            $query = 'SELECT * FROM `contacto`';
            
            $result = mysqli_query($connection, $query);

            if(!$result){
                die("query failed".mysqli_error($connection));
            }    
            else{
                
                while($row = mysqli_fetch_assoc($result)){
                    
                    $id_contacto = $row['id_contacto'];
                    
                    $queryT = "SELECT * FROM `telefono` WHERE `id_contacto` = $id_contacto;";
                    
                    $resultT = mysqli_query($connection, $queryT);
                    
                    if(!$resultT){
                        die("query failed".mysqli_error($connection));
                    } else{
                        $fila = mysqli_fetch_assoc($resultT);
                        if(!$fila){
                            $tel1 = 'N/D';
                            $tel2 = '';
                            $tel3 = '';
                        } else{
                            if (isset($fila["telefono_1"])) {
                                if($fila["telefono_1"] != 0 && $fila["telefono_1"] != '') $tel1 = $fila["telefono_1"];
                                else{
                                    $tel1 = '';
                                    if (isset($fila["telefono_2"])) {
                                        if($fila["telefono_2"] == 0 || $fila["telefono_2"] != ''){
                                            if (isset($fila["telefono_3"])) {
                                                if($fila["telefono_3"] == 0 || $fila["telefono_3"] != ''){
                                                    $tel1 = "N/D";
                                                }
                                            } 
                                        } 
                                    }
                                }
                                if (isset($fila["telefono_2"])) {
                                    $fila["telefono_2"] != 0 && $fila["telefono_1"] != ''? $tel2 = $fila["telefono_2"] : $tel2 = '';
                                } else {
                                    $tel2 = '';
                                }
                                if (isset($fila["telefono_3"])) {
                                    $fila["telefono_3"] != 0 && $fila["telefono_3"] != ''? $tel3 = $fila["telefono_3"] : $tel3 = '';
                                } else {
                                    $tel3 = '';
                                }
                            }
                        } 
                    
                    }
                ?>
                    <tr>
                        <td><?php  echo $id_contacto; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $tel1; ?></td>
                        <td><?php echo $tel2; ?></td>
                        <td><?php echo $tel3; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><button class="actualizar-contacto" data-id="<?php echo $row['id_contacto']; ?>" onclick="mostrarFormularioActualizar(<?php echo $row['id_contacto']; ?>)">Actualizar</button></td>
                        <td><button onclick="eliminarContacto(<?php echo $row['id_contacto']; ?>)">Eliminar</button></td>
                    </tr>
            
                    <?php 
                }
            }  

            ?>

            <button onclick="mostrarFormulario()">Agregar contacto</button>
        </tbody>
    </table>

    <!-- primer formulario dentro de la pagina -->
    <div id="formulario" style="display: none;">
        <form id="formulario">
            <!-- Campos del formulario -->
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <input type="email" name="email" id="email" placeholder="Correo electrónico">
            <input type="tel" name="telefono1" id="telefono_1" placeholder="Número de teléfono">
            <input type="tel" name="telefono2" id="telefono_2" placeholder="Número de teléfono">
            <input type="tel" name="telefono3" id="telefono_3" placeholder="Número de teléfono">
            <!-- Agrega más campos según tus necesidades -->
            <button type="button" onclick="agregarContacto()">Guardar</button>
        </form>
    </div>

    <!-- segundo formulario pop-up -->
    <div id="modalActualizar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModalActualizar()">&times;</span>
            <h2>Actualizar Contacto</h2>
            <form id="formularioActualizar">

                <input type="text" id="nombreA" name="nombre" placeholder="nombre">
                <input type="email" id="emailA" name="email" placeholder="email">
                <input type="tel" id="telefono1A" name="telefono1" placeholder="Número de teléfono 1">
                <input type="tel" id="telefono2A" name="telefono2" placeholder="Número de teléfono 2">
                <input type="tel" id="telefono3A" name="telefono3" placeholder="Número de teléfono 3">
                
                <button type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>

    <script>
        function mostrarFormulario() {
            document.getElementById('formulario').style.display = 'block';
        }
        // Función para mostrar el modal de actualización
        function mostrarFormularioActualizar(idContacto) {
            // Obtener referencia al modal
            var modal = document.getElementById('modalActualizar');

            console.log("mostrar formulario actualizar...");
            // Mostrar el modal
            modal.style.display = 'block';
            // Configurar la solicitud AJAX
            //autocompletarFormulario(idContacto);

        }
    </script>
    <script src="frontend/script.js"></script>
</body>
</html>
