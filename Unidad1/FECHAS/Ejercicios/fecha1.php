<?php

if (isset($_POST["enviar"])) {

    // TIENE /
    $buenosSeparadores1 = substr($_POST["fecha1"], 2, 1) == "/" && substr($_POST["fecha1"], 5, 1) == "/";
    if ($_POST["fecha1"] != "") {
        // DIVIDIR LA FECHA
        $arrayNumeros1 = explode("/", $_POST["fecha1"]);
        // SON NUMEROS
        $numerosBuenos1 = is_numeric($arrayNumeros1[0]) && is_numeric($arrayNumeros1[1]) && is_numeric($arrayNumeros1[2]);
        // COMPROBAR QUE LA FECHA SEA CORRECTA
        $fechaValida = checkdate($arrayNumeros1[1], $arrayNumeros1[0], $arrayNumeros1[2]);
    }

    // COMPROBACION DE TODOS LOS ERRORES
    $error_fecha1 = $_POST["fecha1"] == "" || strlen($_POST["fecha1"]) != 10 || !$buenosSeparadores1 || !$numerosBuenos1 || !$fechaValida;

    // IGUAL CON FECHA 2
    $buenosSeparadores2 = substr($_POST["fecha2"], 2, 1) == "/" && substr($_POST["fecha2"], 5, 1) == "/";
    if ($_POST["fecha2"] != "") {
        $arrayNumeros2 = explode("/", $_POST["fecha2"]);
        $numerosBuenos2 = is_numeric($arrayNumeros2[0]) && is_numeric($arrayNumeros2[1]) && is_numeric($arrayNumeros2[2]);
        $fechaValida2 = checkdate($arrayNumeros2[1], $arrayNumeros2[0], $arrayNumeros2[2]);
    }


    $error_fecha2 = $_POST["fecha2"] == "" || strlen($_POST["fecha2"]) != 10 || !$buenosSeparadores2 || !$numerosBuenos2 || !$fechaValida2;


    $errorFormu = $error_fecha1 || $error_fecha2;
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

        .titulo {
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
                <input type="text" id="f1" name="fecha1" value="<?php if (isset($_POST["fecha1"])) echo $_POST["fecha1"] ?>">

                <?php
                if (isset($_POST["enviar"]) && $errorFormu) {

                    if ($_POST["fecha1"] == "") {
                        echo "* Campo vacio *";
                    } else {
                        if ($buenosSeparadores1) {
                            echo "* La fecha está mal escrita *";
                        }
                        if ($numerosBuenos1) {
                            echo "* No se han escrito números *";
                        }
                        if ($fechaValida) {
                            echo "* La fecha no es valida *";
                        }
                    }
                }
                ?>
                <br>


                <label for="f2">Introduzca una fecha (DD/MM/YYYY)</label>
                <input type="text" id="f2" name="fecha2" value="<?php if (isset($_POST["fecha2"])) echo $_POST["fecha2"] ?>">
                <?php
                if (isset($_POST["enviar"]) && $errorFormu) {

                    if ($_POST["enviar"] == "") {
                        echo "* Campo vacio *";
                    } elseif ($buenosSeparadores2) {
                        echo "* La fecha está mal escrita *";
                    } elseif ($numerosBuenos2) {
                        echo "* No se han escrito números *";
                    } elseif ($fechaValida2) {
                        echo "* La fecha no es valida *";
                    }
                }

                ?>
                <br>
            </p>
            <button type="submit" name="enviar">Calcular</button>

        </form>
    </div>


    <?php
    if (isset($_POST["enviar"]) && !$errorFormu) {

        $resul = 0;
        $resul = mktime(0, 0, 0, is_numeric($arrayNumeros1[1]) && is_numeric($arrayNumeros1[0]) && is_numeric($arrayNumeros1[2]));


        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Fechas - Respuesta</h2>";
        echo "La diferencia en días entre las dos fechas introducidas es de " . $resul;
        echo "</div>";
    }

    ?>
</body>

</html>