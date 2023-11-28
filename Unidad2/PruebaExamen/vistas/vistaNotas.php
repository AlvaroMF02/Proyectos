<?php

try {
    $consulta = "select * from alumnos where cod_alu='" . $_POST["alumnos"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}


echo "<h2>Notas del Alumno " . $nombreAlumno . "</h2>";

$cod_alu = $_POST["alumnos"];
try {
    $consulta = "select asignaturas.cod_asig, asignaturas.denominacion, notas.nota FROM asignaturas,notas WHERE asignaturas.cod_asig AND notas.cod_alu='" . $cod_alu . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>");
}
if (mysqli_num_rows($resultado) > 0) {
    echo "<table>";
    echo "<tr><th>Asignatura</th><th>Nota</th><th>Acción</th></tr>";
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla["denominacion"] . "</td>";
        echo "<td>" . $tupla["nota"] . "</td>";
        echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditarNota' value='" . $cod_alu . "'>Editar</button>-<button type='submit' name='btnBorrarNota' value='" . $cod_alu . "'>Borrar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";
}

mysqli_free_result($resultado);
mysqli_close($conexion);
