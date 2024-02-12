<?php
session_name("examenHorarios");
session_start();
require "src/funciones_ctes.php";

if(isset($_POST["btnSalir"])){
    $datos["api_session"] = $_SESSION["api_session"];
    consumir_servicios_REST(DIR_SERV . "/salir","POST",$datos);
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])) {
    require "src/seguridad.php";

    if($datos_usuario_log->tipo=="normal"){
        require "vistas/vistaNormal.php";
    }else{
        require "vistas/vistaAdmin.php";
    }

} else {
    require "vistas/vistaLogin.php";
}
