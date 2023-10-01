<?php
$error_form = false;

if (isset($_POST["enviar"])) {

    $errorPalab1 = $_POST["palabra1"] == "";
    $errorPalab2 = $_POST["palabra2"] == "";

    // ERROR SI HAY UNO ERROR DE LOS ANTERIORES
    $error_form = $errorPalab1 || $errorPalab2;
}

// SI NO HAY ERRORES Y SE PULSA EL BOTON SUBMIT SE VUELVE A PORNER LA PAGINA
if (isset($_POST["enviar"]) && !$error_form) {    
    require "vistas/vistaRespuesta.php";
} else {
    require "vistas/vistaFormulario.php";
}?>