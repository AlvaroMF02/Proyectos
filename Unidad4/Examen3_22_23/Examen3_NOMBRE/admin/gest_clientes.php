<?php
// vista del admin con mucha seguridad ns
require "../src/ctes_funciones.php";
session_name("Examen2_curso18_19");
session_start();

// si la sesion esta iniciada te hace todo esto
if(isset($_SESSION["usuario"])) {
    $salto="../index.php";
    require "../src/seguridad.php";
    // si no es admin te lleva al index
    if ($datos_usuario_logueado["tipo"]=="admin")
        require "../vistas/vista_admin.php";
    else{
        header("Location: ../index.php");
    }
// si no te lleva al index para que te logees
}else{
    header("Location: ../index.php");
}
?>