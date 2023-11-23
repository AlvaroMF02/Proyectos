<?php
// Hago una conexión
try {
    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_videoclub");
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die("<p>Error en la conexión: " . $e->getMessage() . "</p></body></html>");
}

echo "<h3>Detalles de la película: " . $_POST["btnmostrarDetalles"] . "</h3>";

// Hago la consulta
try {
    $consulta = "select * from peliculas where idPelicula='" . $_POST["btnmostrarDetalles"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

// Si el resultado es < a 0 es pq no ha habido resultados
if (mysqli_num_rows($resultado) > 0) {
    // Guardo los datos consuultados
    $datos_usuario = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);

    echo "<p>";
    echo "<strong>Título: </strong>" . $datos_usuario["titulo"] . "<br>";
    echo "<strong>Director: </strong>" . $datos_usuario["director"] . "<br>";
    
    echo "<strong>Sinopsis: </strong>" . $datos_usuario["sinopsis"] . "<br>";
    echo "<strong>Temática: </strong>" . $datos_usuario["tematica"] . "<br>";
    echo "<img class='foto_detalle' src='Img/" . $datos_usuario["caratula"] . "' alt='caratula' title='caratula'>";
    echo "</p>";
} else
    echo "<p>La película seleccionado ya no se encuentra registrado en la BD</p>";


echo "<form action='index.php' method='post'>";
echo "<p><button type='submit'>Volver</button></p>";
echo "</form>";
