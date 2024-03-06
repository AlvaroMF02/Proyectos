<?php
session_name("pruebaRecu");
session_start();

require "./src/func_const.php";

if(isset($_POST["btnSalir"])){
    $datos["api_session"] = $_SESSION["api_session"];
    consumir_servicios_REST(DIR_SERV . "/salir","GET",$datos);
}

if(isset($_SESSION["usuario"])){

    require "./src/seguridad.php";

    require "./vistas/vistaExamen.php";

}else{
    require "./vistas/vista_home.php";
}

?>