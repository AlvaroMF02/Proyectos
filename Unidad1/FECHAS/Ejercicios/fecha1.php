<?php

    if(isset($_POST["enviar"])){

        // ESTA VACIO
        $erroFecha1 = $_POST["fecha1"]=="";
        $erroFecha2 = $_POST["fecha2"]=="";

        // SE PASA DE TAMAÑO (ESTÁ MAL ESCRITO)
        $errorTamFech1 = strlen($_POST["fecha1"])>10;
        $errorTamFech2 = strlen($_POST["fecha2"])>10;

        //FECHA INVALIDA
        //$errorFormFech1 = checkdate($_POST["fecha1"]);

        $errorFormu = $erroFecha1 || $erroFecha2;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
    <style>
        .titulo{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="titulo">Fechas-Formulario</h1>
    <form action="ejer1.php" method="post">
        <label for="f1">Introduzca una fecha (DD/MM/YYYY)</label>
        <input type="text" id="f1" name="fecha1">   <br>

        <label for="f2">Introduzca una fecha (DD/MM/YYYY)</label>
        <input type="text" id="f2" name="fecha2">   <br>

        <button type="submit" name="enviar">Calcular</button>

    </form>
</body>
</html>