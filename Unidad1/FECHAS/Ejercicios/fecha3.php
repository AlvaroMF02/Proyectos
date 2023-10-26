<?php

if (isset($_POST["enviar"])) {

    // COMPROBACION DE TODOS LOS ERRORES
    $error_fecha1 = $_POST["fecha1"] == "";
    $error_fecha2 = $_POST["fecha2"] == "";

    $errorFormu = $error_fecha1 || $error_fecha2;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3</title>
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

        <form action="fecha3.php" method="post">
            <h1 class="titulo">Fechas-Formulario</h1>
            <p>
                <label for="f1">Introduzca una fecha:</label>
                <input type="date" name="fecha1" step="1" value="<?php if(isset($_POST["fecha1"])) echo $_POST["fecha1"]?>">

                <?php
                if (isset($_POST["enviar"]) && $error_fecha1) {

                    if ($_POST["fecha1"] == "") 
                        echo "<span class=error>* No has seleccionado una fecha *</span>";
                }
                ?>
                <br>


                <label for="f2">Introduzca una fecha: </label>
                <input type="date" name="fecha2" step="1" value="<?php if(isset($_POST["fecha2"])) echo $_POST["fecha2"]?>">
                <?php
                if (isset($_POST["enviar"]) && $error_fecha2) {

                    if ($_POST["fecha2"] == "")
                        echo "<span class=error>* No has seleccionado una fecha *</span>";
                    
                }

                ?>
                <br>
            </p>
            <button type="submit" name="enviar">Calcular</button>

        </form>
    </div>


    <?php
    if (isset($_POST["enviar"]) && !$errorFormu) {

        // LA FECHA SE BORRA Y NS SACARLAS
        $tiempo1 = strtotime($_POST["fecha1"]);
        $tiempo2 = strtotime($_POST["fecha2"]);

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