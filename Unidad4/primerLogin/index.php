<?php

session_name("primerLogin");
session_start();

require "src/func_ctes.php";

// borrar sesion
if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])) {

    // esta logeado
    require "src/seguridad.php";

    // ha pasado controles

    if ($datos_usuario_logueado["tipo"] == "admin") {
        require "vistas/vista_admin.php";
    } else {
        require "vistas/vista_logueado.php";
    }

    mysqli_close($conexion);
    
} else {
    require "vistas/vista_login.php";
}
