<?php
// comprobacion de que esta o no
    // conexion
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Primer Login", "<h1>Primer Login</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    // consulta
    try {
        $consulta = "select * from usuarios where usuario ='" . $_SESSION["usuario"] . "' and clave='" . $_SESSION["clave"] . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Primer Login", "<h1>Primer Login</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    // si no esta es porque lo han borrado baneado
    if (mysqli_num_rows($resultado) < 0) {

        session_unset($resultado);
        mysqli_close($consexion);
        session_unset();
        $_SESSION["seguridad"] = "Ya no estas registrado en la base de datos";
        header("Location:index.php");
        exit;
    }
    $datos_usuario_logueado = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);

    // control de inactividad
    if (time() - $_SESSION["ultima_accion"] > MINUTOS * 1) {

        mysqli_close($consexion);
        session_unset();
        $_SESSION["seguridad"] = "Su tiempo de sesion ha caducado";
        header("Location:index.php");
        exit;
    }
    // renovar el tiempo
    $_SESSION["ultima_accion"]=time();
?>