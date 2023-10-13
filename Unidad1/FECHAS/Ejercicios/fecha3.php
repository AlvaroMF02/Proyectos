<?php

function buenos_separadores($texto)
{
    return substr($texto, 2, 1) == "/" && substr($texto, 5, 1) == "/";
}

function numeros_buenos($texto)
{
    return is_numeric(substr($texto, 0, 2)) && is_numeric(substr($texto, 3, 2)) && is_numeric(substr($texto, 6, 4));
}

function fecha_valida($texto)
{
    return checkdate(substr($texto, 3, 2), substr($texto, 0, 2), substr($texto, 6, 4));
}
if (isset($_POST["enviar"])) {

    // COMPROBACION DE TODOS LOS ERRORES
    $error_fecha1 = $_POST["fecha1"] == "" || strlen($_POST["fecha1"]) != 10 || !buenos_separadores($_POST["fecha1"]) || !numeros_buenos($_POST["fecha1"]) || !fecha_valida($_POST["fecha1"]);
    $error_fecha2 = $_POST["fecha2"] == "" || strlen($_POST["fecha2"]) != 10 || !buenos_separadores($_POST["fecha2"]) || !numeros_buenos($_POST["fecha2"]) || !fecha_valida($_POST["fecha2"]);

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
        .error{
            color: red;
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
                if (isset($_POST["enviar"]) && $error_fecha1) {

                    if ($_POST["fecha1"] == "") {
                        echo "<span class=error>* Campo vacio *</span>";
                    } else {
                        echo "<span class=error>* Fecha inválida *</span>";
                    }
                }
                ?>
                <br>


                <label for="f2">Introduzca una fecha (DD/MM/YYYY)</label>
                <input type="text" id="f2" name="fecha2" value="<?php if (isset($_POST["fecha2"])) echo $_POST["fecha2"] ?>">
                <?php
                if (isset($_POST["enviar"]) && $error_fecha2) {

                    if ($_POST["fecha2"] == "") {
                        echo "<span class=error>* Campo vacio *</span>";
                    } else {
                        echo "<span class=error>* Fecha inválida *</span>";
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

        $fecha1=explode("/",$_POST["fecha1"]);
        $fecha2=explode("/",$_POST["fecha2"]);

        // SACO LOS SEGUNDOS DE CADA DIA
        $tiempo1 = mktime(0,0,0,$fecha1[1],$fecha1[0],$fecha1[2]);
        $tiempo2 = mktime(0,0,0,$fecha2[1],$fecha2[0],$fecha2[2]);

        // LOS RESTO Y LOS PONGO POSITIVOS POR SI TIEMPO1 ES MENOR
        $segundosDiff = abs($tiempo1 - $tiempo2);

        // CALCULO LOS DIAS BASNDOME EN LOS SEGUNDOS
        $diasPasados = floor($segundosDiff/(60*60*24));

        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Fechas - Respuesta</h2>";
        echo "La diferencia en días entre las dos fechas introducidas es de " . $diasPasados;
        echo "</div>";
    }

    ?>
</body>

</html>