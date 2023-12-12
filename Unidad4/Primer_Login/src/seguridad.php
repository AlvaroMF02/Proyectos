<?php
//Hago un control de Baneo
// conexion nueva 
try {
    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Primer Login", "<h1>Primer Login</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
}

// consulta con los datos de session
try {
    $consulta = "select * from usuarios where usuario='" . $_SESSION["usuario"] . "' and clave='" . $_SESSION["clave"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Primer Login", "<h1>Primer Login</h1><p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

// si no se ha encontrado al usuario
if (mysqli_num_rows($resultado) <= 0) {
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    session_unset();
    // cambia el mensahe de la session de seguridad
    $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}
// guardo los datos del usuario
$datos_usuario_logueado = mysqli_fetch_assoc($resultado);
mysqli_free_result($resultado);

// Ahora control de inactividad
// al superar un tiempo se borra la session de login por lo que te tienes que volver a logear
if (time() - $_SESSION["ultima_accion"] > MINUTOS * 60) {
    mysqli_close($conexion);
    session_unset();
    // cambio la session de seguridad con otro mensaje
    $_SESSION["seguridad"] = "Su tiempo de sesión ha caducado";
    header("Location:index.php");
    exit;
}
// reinicia el tiempo de sesion
$_SESSION["ultima_accion"] = time();
