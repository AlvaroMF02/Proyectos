<?php
// ------------------------ MOSTRAR A LOS USUARIOS ------------------------
// Consultar a la API
$url = DIR_SERV . "/usuarios";
$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta);

// Si hay errores ...
if (!$obj) {
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta . "</body></html>");
}
if (isset($obj->error)) {
    die("<p>" . $obj->error . "</p></body></html>");
}

echo "<table>";
echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";

for ($i = 0; $i < count($obj->usuarios); $i++) {
    echo "<tr>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='".$obj->usuarios[$i]->id_usuario."' name='btnDetalle' title='Detalles del Usuario'>".$obj->usuarios[$i]->nombre."</button></form></td>";
    echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='".$obj->usuarios[$i]->nombre."'><button class='enlace' type='submit' value='".$obj->usuarios[$i]->id_usuario."' name='btnBorrar'><img src='images/borrar.png' alt='Imagen de Borrar' title='Borrar Usuario'></button></form></td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='".$obj->usuarios[$i]->id_usuario."' name='btnEditar'><img src='images/editar.png' alt='Imagen de Editar' title='Editar Usuario'></button></form></td>";
    echo "</tr>";
}
echo "</table>";

?>