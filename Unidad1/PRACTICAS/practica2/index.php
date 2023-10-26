<?php
    $errorForm = false; // NO HACE FALTA Q SEA FALSO DESDE EL PRINCIPIO

    if (isset($_POST["enviar"])) {
        
        // ERROR PAR ALOS CAMPOS REQUERIDOS POR SI SE PONEN VACIOS
        $errorNombr = $_POST["nombre"] == "";
        $errorSexo = !isset($_POST["sexo"]);

        $errorForm = $errorNombr || $errorSexo;
    }

    //  SI SE PRESIONA EL BOTON Y NO HAY ERRORES
    if (isset($_POST["enviar"]) && !$errorForm) {
        // TE LLEVA A LA RESPUESTA 
        require "vistas/vistasRespuestas.php";
    }else{
        // TE REDIRIJE A LA MISMA PAGINA, SIN BORRAR CAMPOS ESCRITOS Y MARCANDO LOS ERRORES
        require "vistas/vistasFormulario.php";
    }
?>