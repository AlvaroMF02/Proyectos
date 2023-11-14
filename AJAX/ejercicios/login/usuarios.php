<?php
// Cojo los request del formulario
$usuario = $_REQUEST["usuario"];
$password = $_REQUEST["password"];

// Filtro si son correctos
if ($usuario == "admin" && $password == "1234") {
    echo "USUARIO VALIDO";
}else{
    echo "USUARIO NO VALIDO";
}
?>
