<?php
// En este index se ve la parte del administrador

// Inicamos otra sesion para coger los datos guardados en las otras sesiones
session_name("Examen3_17_18");
session_start();
require "../src/func_ctes.php";

// seguridad para /admin/index.php

// comprueba se sigue la sesion iniciada
if (isset($_SESSION["usuario"])) {

    $salto = "../index.php";
    require "../src/seguridad.php";
    // si es admin te enseña el html del admin con la tabla
    if ($datos_usuario_logueado["tipo"] == "admin") {
        require "../vistas/vista_admin.php";
    } else {    // si no te manda al index normal (al login)
        mysqli_close($conexion);
        header("Location:" . $salto);
        exit;
    }
    mysqli_close($conexion);
} else {
    header("Location:../index.php");
    exit;
}
