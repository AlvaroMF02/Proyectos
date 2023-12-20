<?php
// CONTROL DEL BANEO DE UN JAMBO

// conexion basic
try {
    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
}

// coger todos los datos de un cliente
try {
    $consulta = "select * from clientes where usuario = '" . $_SESSION["usuario"] . "' and clave = '" . $_SESSION["clave"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
}

// si el cliente no se encuentra
if (mysqli_num_rows($resultado) <= 0) {
    // Está baneado (se ha borrado de la tabla)
    session_unset();
    // cambia el msj de seguridad dependiendo de lo que pasa
    $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la BD.";
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    // te lleva a index
    header("Location: index.php");
    exit();
}

// guarda los datos en una variable
$datos_usuario_logueado = mysqli_fetch_assoc($resultado);
mysqli_free_result($resultado);

// Control de inactividad
if (time()-$_SESSION["ultima_accion"]>MINUTOS*60) {
    mysqli_close($conexion);
    session_unset();
    $_SESSION["seguridad"] = "Su tiempo de sesión ha caducado";
    header("Location: index.php");
    exit();
}

$_SESSION["ultima_accion"] = time();
?>