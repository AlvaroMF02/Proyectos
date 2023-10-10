<?php

    if(isset($_POST["enviar"])){

        $buenosSeparadores1 = substr($_POST["fecha1"],2,1) =="/" && substr($_POST["fecha1"],5,1) =="/";
        $arrayNumeros1=explode("/",$_POST["fecha1"]);
        $numerosBuenos1 = is_numeric($arrayNumeros1[0]) && is_numeric($arrayNumeros1[1]) && is_numeric($arrayNumeros1[2]);
        $fechaValida = checkdate($arrayNumeros1[1],$arrayNumeros1[0],$arrayNumeros1[2]);
        $error_fecha1 = $_POST["fecha1"]=="" || strlen($_POST["fecha1"])!=10 || !$buenosSeparadores1 || !$numerosBuenos1 || !$fechaValida;

        $buenosSeparadores1 = substr($_POST["fecha1"],2,1) =="/" && substr($_POST["fecha1"],5,1) =="/";
        $arrayNumeros1=explode("/",$_POST["fecha1"]);
        $numerosBuenos1 = is_numeric($arrayNumeros1[0]) && is_numeric($arrayNumeros1[1]) && is_numeric($arrayNumeros1[2]);
        $fechaValida = checkdate($arrayNumeros1[1],$arrayNumeros1[0],$arrayNumeros1[2]);
        $error_fecha1 = $_POST["fecha1"]=="" || strlen($_POST["fecha1"])!=10 || !$buenosSeparadores1 || !$numerosBuenos1 || !$fechaValida;


    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
    <style>
        form {
            background-color: lightblue;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }

        .verdoso {
            background-color: lightgreen;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }

        h2 {
            text-align: center
        }
        .titulo{
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="principal">
    
    <form action="fecha1.php" method="post">
    <h1 class="titulo">Fechas-Formulario</h1>
    <p>
        <label for="f1">Introduzca una fecha (DD/MM/YYYY)</label>
        <input type="text" id="f1" name="fecha1"  value="<?php if(isset($_POST["fecha1"])) echo $_POST["fecha1"] ?>">   
        
        <?php /*
            if (isset($_POST["enviar"]) && $errorFormu) {

                if ($erroFecha1) {
                    echo "* Campo vacío *";
                }
                if ($errorTamFech1) {
                    echo "* Fecha mal escrita *";
                }
        }*/
        ?>
        <br>


        <label for="f2">Introduzca una fecha (DD/MM/YYYY)</label>
        <input type="text" id="f2" name="fecha2" value="<?php if(isset($_POST["fecha2"])) echo $_POST["fecha2"] ?>"> 
        <?php /*
            if (isset($_POST["enviar"]) && $errorFormu) {

                if ($erroFecha2) {
                    echo "* Campo vacío *";
                }
                if ($errorTamFech2) {
                    echo "* Fecha mal escrita *";
                }
        }*/
        ?>
        <br>
    </p>
        <button type="submit" name="enviar">Calcular</button>
    
    </form>
    </div>


    <?php
    if (isset($_POST["enviar"]) && !$errorFormu) {




        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Fechas - Respuesta</h2>";
        echo "La palabra ";
        echo "</div>";
    }

    ?>
</body>
</html>