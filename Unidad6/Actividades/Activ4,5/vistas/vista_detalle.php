<?php

echo "<h3>Detalles del usuario con id: ".$_POST["btnDetalle"]."</h3>";

// Consultar a la API
 $url = DIR_SERV . "/usuarios/".$_POST["btnDetalle"];
 $respuesta = consumir_servicios_REST($url, "GET");
 $obj = json_decode($respuesta);

 // Si hay errores ...
 if (!$obj) {
     die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta . "</body></html>");
 }
 if (isset($obj->error)) {
     die("<p>" . $obj->error . "</p></body></html>");
 }

echo "<strong>Nombre: </strong>" . $obj->usuario->nombre . "<br>";
echo "<strong>Usuario: </strong>" . $obj->usuario->usuario . "<br>";
echo "<strong>Email: </strong>" . $obj->usuario->email . "<br>";
echo "<strong>Tipo: </strong>" . $obj->usuario->tipo . "<br>";

echo "<form action='index.php' method='post'>";
echo "<p><button type='submit'>Volver</button></p>";
echo "</form>";

?>