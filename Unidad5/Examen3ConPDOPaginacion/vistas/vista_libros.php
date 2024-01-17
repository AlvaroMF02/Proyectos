<?php

echo "<h3>Listado de los libros</h3>";
// consulta con la que cojo todos los libros

try {

    $consulta = "select * from libros";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (PDOException $e) {
    $sentencia = null;
    $conexion = null;
    session_destroy();
    die("<p>No he podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

// coge todo
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// muestro los libros con el bucle
foreach ($resultado as $tupla) {
    echo "<div class='fotos'>";
    echo "<img src='img/" . $tupla["portada"] . "' alt='imagen libro' title='imagen libro'><br>";
    echo $tupla["titulo"] . " - " . $tupla["precio"] . "€";
    echo "</div>";
}

// libero el resultado
$conexion = null;
