<?php
// la sesion iniciado con los posibles datos que pueda guardar
session_name("Examen2_curso18_19");
session_start();

// tiene constantes, funcion error pagina y repetido
require "src/ctes_funciones.php";

// si le da a salir la sesion se destruye y te manda a index
// ns pq esta en index
if(isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// si hay una sesion iniciada mira cositas de seguridad y mira si eres admin o pobre
if (isset($_SESSION["usuario"])) {
    // Estoy logueado
    // seguridad
    require "src/seguridad.php";
    // Vista oportuna
    if ($datos_usuario_logueado["tipo"] == "admin") {
        mysqli_close($conexion);
        header("Location: admin/gest_clientes.php");
        exit();
    } else {
        require "vistas/vista_normal.php";
    }
    mysqli_close($conexion);
    // si has pulsado algo del registro
} else if (isset($_POST["btnRegistro"]) || isset($_POST["btnContRegistro"])) {
    require "vistas/vista_registro.php";
} else { // si no te lleva al login
    require "vistas/vista_login.php";
}
?>