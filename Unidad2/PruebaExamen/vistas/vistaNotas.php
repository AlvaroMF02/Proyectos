<?php

try {
    $consulta = "select * from alumnos where cod_alu='".$_POST["alumnos"]."'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}


echo "<h2>Notas del Alumno ".$nombreAlumno."</h2>";
