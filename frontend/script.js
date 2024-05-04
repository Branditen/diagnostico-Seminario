function agregarContacto() {
    // Obtener los datos del formulario
    var nombre = document.getElementById('nombre').value;
    var email = document.getElementById('email').value;
    var telefono1 = document.getElementById('telefono_1').value;
    var telefono2 = document.getElementById('telefono_2').value;
    var telefono3 = document.getElementById('telefono_3').value;

    // Crear un objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open('POST', 'backend/procesar_formulario.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Definir la función de respuesta
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Mostrar mensaje de éxito
            alert(xhr.responseText);

            // Limpiar el formulario después de agregar el contacto
            document.getElementById('nombre').value = '';
            document.getElementById('email').value = '';
            document.getElementById('telefono_1').value = '';
            document.getElementById('telefono_2').value = '';
            document.getElementById('telefono_3').value = '';
        } else {
            // Mostrar mensaje de error
            alert("Error al agregar el contacto (js): " + xhr.statusText);
        }
    };

    // Manejar errores de red
    xhr.onerror = function() {
        alert("Error de red al intentar agregar el contacto.");
    };

    // Enviar los datos del formulario
    xhr.send('nombre=' + encodeURIComponent(nombre) + '&email=' + encodeURIComponent(email) + '&telefono1=' + encodeURIComponent(telefono1) + '&telefono2=' + encodeURIComponent(telefono2) + '&telefono3=' + encodeURIComponent(telefono3));
}


function eliminarContacto(id_contacto) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Mostrar mensaje de éxito o actualizar la lista de contactos
                alert(xhr.responseText);
                // Actualizar la lista de contactos, si es necesario
            } else {
                // Mostrar mensaje de error
                alert("Error al eliminar el contacto: " + xhr.statusText);
            }
        }
    };

    xhr.open('POST', 'backend/eliminar_contacto.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id_contacto=' + id_contacto);
}


// Función para cerrar el modal de actualización
function cerrarModalActualizar() {
    // Obtener referencia al modal
    var modal = document.getElementById('modalActualizar');
    
    // Ocultar el modal
    modal.style.display = 'none';
}
  
// Cerrar el modal cuando se hace clic fuera de él
window.onclick = function(event) {
    var modal = document.getElementById('modalActualizar');
    if (event.target == modal) {
      modal.style.display = 'none';
    }
}

function actualizarContacto(idContacto){
    // Obtener los datos del formulario
    document.getElementById('formularioActualizar').addEventListener('submit', function(event) {
        // Evitar que el formulario se envíe por defecto
        event.preventDefault();
        // Obtener los datos del formulario
        console.log("actualizar contacto (adentro)")

        var nombreA = document.getElementById('nombreA').value;
        var emailA = document.getElementById('emailA').value;
        
        console.log(nombreA);
        console.log(emailA);
        var id_contactoA = idContacto
        console.log(id_contactoA)

        var datos = {
            nombre: nombreA,
            email: emailA,
            id_contacto: idContacto,
        };

        // Crear una instancia de XMLHttpRequest
        var xhr = new XMLHttpRequest();
        
        // Configurar la solicitud AJAX
        xhr.open('POST', 'backend/actualizar_contacto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        
        // Definir la función de callback cuando la solicitud se complete
        xhr.onload = function() {
          
          if (xhr.status === 200) {
            // La solicitud se completó exitosamente
            console.log(xhr.responseText); // Puedes mostrar un mensaje de éxito o realizar otras acciones aquí
          } else {
            // Ocurrió un error al procesar la solicitud
            console.error('Error al actualizar el contacto: ' + xhr.statusText);
          }
        };
        
        // Manejar errores de red
        xhr.onerror = function() {
            alert("Error de red al intentar agregar el contacto.");
        };
        
        // Convertir el objeto de datos a JSON y enviar la solicitud
        xhr.send(JSON.stringify(datos));
    
    });
} 

function actualizarNumero(idContacto){
   // Obtener los datos del formulario
   document.getElementById('formularioActualizar').addEventListener('submit', function(event) {
       // Evitar que el formulario se envíe por defecto
       event.preventDefault();
       // Obtener los datos del formulario
       console.log("Iniciando actualizar numero...");

       var tel1A = document.getElementById('telefono1A').value;
        console.log(tel1A);
        if (tel1A != null) {
            var tel1A = document.getElementById('telefono1A').value;
            console.log("El valor tel 1 (js): " + tel1A);
        } else {
            tel1A = 0;
        }
        var tel2A = document.getElementById('telefono2A').value;
        console.log(tel2A);
        if (tel2A != null) {
            var tel2A = document.getElementById('telefono2A').value;
            console.log("El valor tel 2 (js): " + tel2A);
        } else {
            tel2A = 0;
        }
        var tel3A = document.getElementById('telefono3A').value;
        console.log(tel3A);
        if (tel3A != null) {
            var tel3A = document.getElementById('telefono3A').value;
            console.log("El valor tel 3 (js): " + tel3A);
        } else {
            tel3A = 0;
        }
        console.log(tel1A);
        console.log(tel2A);
        console.log(tel3A);
        var id_contactoA = idContacto
        console.log(id_contactoA)

        var datos = {
            id_contacto: idContacto,
            telefono_1A: tel1A,
            telefono_2A: tel2A,
            telefono_3A: tel3A,
        };

        // Crear una instancia de XMLHttpRequest
        var xhr = new XMLHttpRequest();
        
        // Configurar la solicitud AJAX
        xhr.open('POST', 'backend/actualizar_numero.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        
        // Definir la función de callback cuando la solicitud se complete
        xhr.onload = function() {
            
            if (xhr.status === 200) {
            // La solicitud se completó exitosamente
            console.log(xhr.responseText); // Puedes mostrar un mensaje de éxito o realizar otras acciones aquí
            } else {
            // Ocurrió un error al procesar la solicitud
            console.error('Error al actualizar el numero: ' + xhr.statusText);
            }
        };
        
        // Manejar errores de red
        xhr.onerror = function() {
            alert("Error de red al intentar actualizar el numero.");
        };
        
        // Convertir el objeto de datos a JSON y enviar la solicitud
        xhr.send(JSON.stringify(datos));
   
   });
}

function autocompletarFormulario(idContacto){
    
    var xhr = new XMLHttpRequest();

    var id_contactoD = idContacto;

    console.log(id_contactoD + " es el id contacto. script.js");

    var url = "backend/autocompletar_formulario.php?id_contacto=" + id_contactoD;
    xhr.open("GET", url, true);

    //xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

    // Configurar la función de devolución de llamada cuando se complete la solicitud
    xhr.onload = function() {
        // Verificar si la solicitud se completó correctamente (estado 200)
        if (xhr.status == 200) {
            // Procesar la respuesta recibida del servidor
            console.log(xhr.responseText); // Esto imprimirá la respuesta del servidor en la consola del navegador
        } else {
            // Manejar errores
            console.error('Error al realizar la solicitud:', xhr.status);
        }
    };
    xhr.send();
    console.log("final autocompletarFormulario()");
}

// Asigna un evento a los botones de actualización de contacto
document.querySelectorAll('.actualizar-contacto').forEach(function(button) {
    button.addEventListener('click', function() {
        var idContacto = this.getAttribute('data-id');
        // Llama a la función de actualización de contacto pasando el ID como argumento
        actualizarContacto(idContacto);
        actualizarNumero(idContacto);
    });
});