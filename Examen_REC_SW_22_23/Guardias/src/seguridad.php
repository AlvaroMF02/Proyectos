<?php
$url = DIR_SERV . "/logueado";
$datos["api_session"] = $_SESSION["api_session"];
$respuesta = consumir_servicios_REST($url, "GET", $datos);
$obj = json_decode($respuesta);

if (!$obj) {
    session_destroy();
    die(error_page("Gestion de guardias", "<h1>Gestion de guardias</h1><p>Error consumiendo el servicio: " . $url . "</p>"));
}
if (isset($obj->error)) {

    consumir_servicios_REST(DIR_SERV . "/salir","GET",$datos);
    session_destroy();
    die(error_page("Gestion de guardias", "<h1>Gestion de guardias</h1><p>" . $obj->error . "</p>"));
    header("Location:index.php");
    exit;
}

if (isset($obj->no_auth)) {
    session_unset();
    $_SESSION["seguridad"] = "El tiempo de sesión de la API ha caducado";
    header("Location:index.php");
    exit;
}

if (isset($obj->mensaje)) {
    
    session_unset();
    consumir_servicios_REST(DIR_SERV . "/salir","GET",$datos);
    $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}

$datos_usuario_log = $obj->usuario;

if (time() - $_SESSION["ult_accion"] > MINUTOS * 60) {
    session_unset();
    $_SESSION["seguridad"] = "Su tiempo de sesión ha expirado";
    header("Location:index.php");
    exit;
}

$_SESSION["ult_accion"] = time();
?>