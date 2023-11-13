<?php
if (!isset($conexion)) {

    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p></body></html>");
    }
}
$consulta = "select * from usuarios";
try {
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
}

mysqli_data_seek($resultado, 0);
echo "<table>";
echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";

// MIENTRAS HAYA TUPLAS     tmb se puede hacer escalar con un for
while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td><form action='index.php' method='post'><button class ='enlace' title='Detalles del usuario' value='" . $tupla["id_usuario"] . "' type='submit' name='btnDetalle'>" . $tupla["nombre"] . "</button></form></td>";
    echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla["nombre"] . "'><button class ='enlace' title='Borrar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnBorrar'><img src='images/borrar.png' title='Borrar usuario' alt='Borrar'></button></form></td>";
    echo "<td><form action='index.php' method='post'><button class ='enlace' title='Editar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnEditar'><img src='images/editar.png' title='Editar usuario' alt='Borrar'></button></form></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_free_result($resultado);
