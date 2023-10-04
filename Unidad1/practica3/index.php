<?php
$error_form = false;

function LetraNIF($dni){
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
}

function dniBienEscrito($texto){
    return strlen($texto)==9 && is_numeric(substr($texto,0,8))
    && substr($texto,-1)>="A" && substr($texto,-1)<="Z";
}
function dniValido($texto){
    $numero = substr($texto,0,8);
    $letra = substr($texto,-1);
    $valido = LetraNIF($numero)==$letra;
    return $valido;
}

if (isset($_POST["botonBor"])) {    // SE PUEDE BORRAR DE DOS MANERAS
    unset($_POST);
}

if (isset($_POST["botonSub"])) {    // SE COMPRUEBA ERRORES COMO DEJAR EL NOMBRE VACIO

    $error_nombre = $_POST["nombre"] == "";
    $error_apellido = $_POST["apellidos"] == "";
    $error_clave = $_POST["contraseña"] == "";
    $error_sexo = !isset($_POST["sexo"]);           // SI NO EXISTE
    $error_coment = $_POST["comentarios"] == "";
    $error_dni = $_POST["dni"] == "" || !dniBienEscrito(strtoupper($_POST["dni"])) || !dniValido(strtoupper($_POST["dni"]));

    // ERROR SI HAY UNO ERROR DE LOS ANTERIORES
    $error_form = $error_nombre || $error_apellido || $error_clave || $error_sexo || $error_dni ||$error_coment;
}

if (isset($_POST["botonSub"]) && !$error_form) {    // SI NO HAY ERRORES Y SE PULSA EL BOTON SUBMIT SE VUELVE A PORNER LA PAGINA
    require "vistas/vistaRespuesta.php";
} else {
    require "vistas/vistaFormulario.php";
}?>