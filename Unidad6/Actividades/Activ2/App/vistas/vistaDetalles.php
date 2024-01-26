<?php
// Mostrar los datos que se han pasado por le value del boton
$urlDetall = DIR_SERV . "/producto/" . urlencode($_POST["btnMostrar"]);
$respuDetall = consumir_servicios_REST($urlDetall, "GET");
$objDetall = json_decode($respuDetall);

// ver si hay errores
if (!$objDetall) {
    echo "Error consumiendo el servicio: " . $respuDetall;
}
if (isset($objDetall->mensaje_error)) {
    echo "Error en la consulta: " . $objDetall->mensaje_error;
}

echo "<h3>Detalles del producto: <strong>" . $_POST['btnMostrar'] . "</strong></h3>";
echo "<strong>Código:</strong>" . $objDetall->producto->cod . "<br>";
echo "<strong>Nombre:</strong>" . $objDetall->producto->nombre . "<br>";
echo "<strong>Nombre corto:</strong>" . $objDetall->producto->nombre_corto . "<br>";
echo "<strong>Descripción:</strong>" . $objDetall->producto->descripcion . "<br>";
echo "<strong>PVP:</strong>" . $objDetall->producto->PVP . "<br>";
echo "<strong>Familia:</strong>" . $objDetall->producto->familia . "<br>";
?>