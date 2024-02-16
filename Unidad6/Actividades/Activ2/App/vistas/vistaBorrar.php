<?php
// hacer la url para borrar
$urlBorrar = DIR_SERV . "/producto/borrar/" . urlencode($_POST["btnBorrar"]);
$respuestBorrar = consumir_servicios_REST($urlBorrar, "DELETE");
$objBorrar = json_decode($respuestBorrar);

if (!$objBorrar) echo "Error API: " + $respuestBorrar;
if (isset($objBorrar->mensaje_error)) echo "Error consulta: " + $$objBorrar->mensaje_error;

$_SESSION["mensaje"] = $objBorrar->mensaje;
?>