<?php

if (isset($_POST["enviar"])) {

    $error_fecha1 = !checkdate($_POST["mes1"], $_POST["dia1"], $_POST["anyo1"]);
    $error_fecha2 = !checkdate($_POST["mes2"], $_POST["dia2"], $_POST["anyo2"]);

    $errorFormu = $error_fecha1 || $error_fecha2;
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
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

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div id="principal">

        <form action="fecha2.php" method="post">
            <h1 class="titulo">Fechas-Formulario</h1>
            <p>
            <p>Introduzca una fecha:</p>
            <label for="dia1">Día:</label>
            <select name="dia1" id="dia1">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    if (isset($_POST["enviar"]) && $_POST["dia1"] == $i) {
                        echo "<option selected value='" . $i . "'>" . sprintf("%02d", $i) . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . sprintf("%02d", $i) . "</option>";
                    }
                }
                ?>
            </select>

            <label for="mes1">Mes:</label>
            <select name="mes1" id="mes1">
                <?php
                $meses = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");

                for ($i = 1; $i <= 12; $i++) {
                    if (isset($_POST["enviar"]) && $_POST["mes1"] == $i) {
                        echo "<option selected value='" . $i . "'>" . $meses[$i] . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . $meses[$i] . "</option>";
                    }
                }
                ?>
            </select>

            <label for="anyo1">Año:</label>
            <select name="anyo1" id="anyo1">
                <?php
                $anyoActual = date("Y");
                for ($i = $anyoActual - 50; $i <= $anyoActual; $i++) {
                    if (isset($_POST["enviar"]) && $_POST["anyo1"] == $i) {
                        echo "<option selected value='" . $i . "'>" . $i . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                }
                ?>
                
                </select>

                <?php
                if (isset($_POST["enviar"]) && $error_fecha2) {
                    echo "<span class='error'>* Fecha no válida *</span>";
                }
                ?>


            <p>Introduzca una fecha:</p>
            <label for="dia2">Día:</label>
            <select name="dia2" id="dia2">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    if (isset($_POST["enviar"]) && $_POST["dia2"] == $i) {
                        echo "<option selected value='" . $i . "'>" . sprintf("%02d", $i) . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . sprintf("%02d", $i) . "</option>";
                    }
                }
                ?>
            </select>
            <label for="mes2">Mes:</label>
            <select name="mes2" id="mes2">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    if (isset($_POST["enviar"]) && $_POST["mes2"] == $i) {
                        echo "<option selected value='" . $i . "'>" . $meses[$i] . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . $meses[$i] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="anyo2">Año:</label>
            <select name="anyo2" id="anyo2">
                <?php
                for ($i = $anyoActual - 50; $i <= $anyoActual; $i++) {
                    if (isset($_POST["enviar"]) && $_POST["anyo2"] == $i) {
                        echo "<option selected value='" . $i . "'>" . $i . "</option>";
                    } else {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                }
                ?>
                
                </select>

                <?php
                if (isset($_POST["enviar"]) && $error_fecha2) {
                    echo "<span class='error'>* Fecha no válida *</span>";
                }
                ?>

            
            </p>
            <button type="submit" name="enviar">Calcular</button>

        </form>
    </div>


    <?php
    if (isset($_POST["enviar"])&&!$errorFormu) {


        $tiempo1 = strtotime($_POST["anyo1"]."/".$_POST["mes1"]."/".$_POST["dia1"]);
        $tiempo2 = strtotime($_POST["anyo2"]."/".$_POST["mes2"]."/".$_POST["dia2"]);

        // LOS RESTO Y LOS PONGO POSITIVOS POR SI TIEMPO1 ES MENOR
        $segundosDiff = abs($tiempo1 - $tiempo2);

        // CALCULO LOS DIAS BASNDOME EN LOS SEGUNDOS
        $diasPasados = floor($segundosDiff / (60 * 60 * 24));

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