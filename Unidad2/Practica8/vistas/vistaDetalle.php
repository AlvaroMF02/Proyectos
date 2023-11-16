<?php

echo "<h3>Detalles del usuario con id " . $_POST["btnDetalle"] . "</h3>";

// Consulta dependiendo del id del usuario
try {
    $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalle"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
}

// Por si se borra un usuario, no se recarga la página y pulsas al usuario borrado
if (mysqli_num_rows($resultado) > 0) {    // Si he obtenido una tupla

    // Datos del usuario
    $datos_usuario = mysqli_fetch_assoc($resultado);
    echo "<p>";

    echo "<strong>Usuario: </strong>" . $datos_usuario["usuario"] . "<br>";
    echo "<strong>Clave: </strong>" . $datos_usuario["clave"] . "<br>";
    echo "<strong>Nombre: </strong>" . $datos_usuario["nombre"] . "<br>";
    echo "<strong>Dni: </strong>" . $datos_usuario["dni"] . "<br>";
    echo "<strong>Sexo: </strong>" . $datos_usuario["sexo"] . "<br>";
    echo "<strong>Foto: </strong><img src='Img/" . $datos_usuario["foto"] . "' alt='Imagen de usuario'><br>";
    echo "</p>";

    // Boton volver
    echo "<form action='index.php' method='post'>";
    echo "<button type='submit'>Volver</button></form><br>";

    // Mirar en la función de arriba
} else {
    echo "<p>El usuario seleccionado ya no se encuentra en la base de datos</p>";
}
?>