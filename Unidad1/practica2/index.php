<?php
    $errorForm = false;

    if (isset($_POST["enviar"])) {
        
        // ERROR PAR ALOS CAMPOS REQUERIDOS POR SI SE PONEN VACIOS
        $errorNombr = $_POST["nombre"] == "";
        $errorSexo = !isset($_POST["sexo"]);

        $errorForm = $errorNombr || $errorSexo;
    }

    //  SI SE PRESIONA EL BOTON Y NO HAY ERRORES
    if (isset($_POST["enviar"]) && !$errorForm) {
        require "vistas/vistasRespuestas.php";
    }else{
        require "vistas/vistasFormulario.php";
    }
?>