<?php
$error_form = false;

if (isset($_POST["botonBor"])) {    // SE PUEDE BORRAR DE DOS MANERAS
    // SALTANDO AL INDEX OTRA VEZ 
    //header("Location:index.php");
    //exit;

    // ELIMINANDO EL $_POST PARA QUE NO HAYA NADA (MEJOR)
    unset($_POST);
}

if (isset($_POST["botonSub"])) {    // SE COMPRUEBA ERRORES COMO DEJAR EL NOMBRE VACIO

    $error_nombre = $_POST["nombre"] == "";
    $error_apellido = $_POST["apellidos"] == "";
    $error_clave = $_POST["contraseña"] == "";
    $error_sexo = !isset($_POST["sexo"]);           // SI NO EXISTE
    $error_coment = $_POST["comentarios"] == "";

    // ERROR SI HAY UNO ERROR DE LOS ANTERIORES
    $error_form = $error_nombre || $error_apellido || $error_clave || $error_sexo || $error_coment;
}

if (isset($_POST["botonSub"]) && !$error_form) {    // SI NO HAY ERRORES Y SE PULSA EL BOTON SUBMIT SE VUELVE A PORNER LA PAGINA
    require "vistas/vistaRespuesta.php";
} else {
    require "vistas/vistaFormulario.php";
}?>