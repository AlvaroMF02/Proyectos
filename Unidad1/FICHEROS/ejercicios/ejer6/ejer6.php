<?php
if (isset($_POST["enviar"])) {
    $errorForm = $_POST["pais"] = "" || !is_numeric($_POST["pais"]);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<style>
    .error {
        color: red;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }

    table {
        border-collapse: collapse;
        width: 90%;
        margin: 0 auto;
    }
</style>

<body>
    <?php
    @$fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

    if (!$fd) {
        die("No se puede abrir el archivo");
    }

    // ME SALTO LA PRIMERA LINEA POR QUE NO VALE PARA NADA
    $primeraLinea = fgets($fd);

    while ($linea = fgets($fd)) {
        $datosLinea = explode("\t", $linea);
        // SEPARO POR COMAS LA PRIMERA COLUMNA PARA SACAR LA ULTIMA PARTE
        $datosPrimColum = explode(",", $datosLinea[0]);
        $paises[] = $datosPrimColum[2];

        // EN LA PRIMERA NO HACE NADA
        // EN LA SEGUNDA MIRA SI ES EL PAIS APROVECHANDO QUE EL FICHERO ESTA
        if (isset($_POST["pais"]) && $_POST["pais"] == $datosPrimColum[2]) {
            $datosPaisSelecc = $datosLinea;
        }
    }


    fclose($fd);
    ?>

    <h1>PIR per cápita Europa</h1>
    <form action="ejer6.php" method="post">

        <p>
            <label for="pais">Indique el país que quiere buscar</label><br>
            <select name="pais" id="pais">
                <?php
                for ($i = 1; $i < count($paises); $i++) {

                    if (isset($_POST["pais"]) && $_POST["pais"] == $paises[$i]) {
                        echo "<option selected value=" . $paises[$i] . ">" . $paises[$i] . "</option>";
                    } else {
                        echo "<option value=" . $paises[$i] . ">" . $paises[$i] . "</option>";
                    }
                }
                ?>

            </select>

        </p>
        <button type="submit" name="enviar">Buscar datos</button>

    </form>
    <?php
    if (isset($_POST["enviar"])) {
        echo "<h2>PIB per cápita de " . $_POST["pais"] . "</h2>";
        $datosPrimeraLinea = explode("\t", $primeraLinea);

        $nAnyos = count($datosPrimeraLinea);
        echo "<table>";
        echo "<tr>";
        for ($i = 1; $i <= $nAnyos; $i++) {
            echo "<th>" . $datosPrimeraLinea[$i] . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i = 1; $i <= $nAnyos; $i++) {
            if (isset($datosPaisSelecc[$i])) {
                echo "<td>" . $datosPaisSelecc[$i] . "</td>";
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";

        echo "</table>";
    }
    ?>


</body>

</html>