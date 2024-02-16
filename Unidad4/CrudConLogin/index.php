<?php
// Copio las constantes y las funciones
require "src/ctes_funciones.php";

// Inicio sesión
session_name("primerLogin");
session_start();

// Botón salir que tiene que estar en cada vista logueada
if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_SESSION["usuario"])) {
    // Si estoy logueado
    require "vistas/seguridad.php";

    if ($datos_usuario_logueado["tipo"] == "admin")
        require "vistas/vista_logueado_admin.php";
    else
        require "vistas/vista_logueado_normal.php";

    
} else {
    // Si no estoy logueado
    require "vistas/vista_login.php";
}
