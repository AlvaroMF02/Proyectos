<?php
session_name("examenHorarios");
session_start();



if (isset($_SESSION["usuario"])) {
    require "src/seguridad.php";

    if($datos_usuario_log->tipo=="normal"){
        require "src/vistaNormal.php";
    }else{
        require "src/vistaAdmin.php";
    }

} else {
    require "vistas/vistaLogin.php";
}
