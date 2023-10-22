<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <h1>PIB per cápita</h1>

    <?php
    // ARCHIVO DE DONDE LEEREMOS LOS DATOS
    $ruta = 'http://dwese.icarosproject.com/PHP/datos_ficheros.txt';
    $fd = fopen($ruta, "r");
    if (!$fd) {
        die("<p>No se ha podido crear el fichero " . $ruta . "</p>");
    }

    // ME SALTO LA PRIMERA LINEA POR QUE NO VALE PARA NADA
    $primera_linea = fgets($fd);


    while ($linea = fgets($fd)) {
        $datos_linea = explode("\t", $linea);
        // SEPARO POR COMAS LA PRIMERA COLUMNA PARA SACAR LA ULTIMA PARTE
        $datos_primera_col = explode(",", $datos_linea[0]);
        $paises[] = end($datos_primera_col);

        // EN LA PRIMERA NO HACE NADA
        // EN LA SEGUNDA MIRA SI ES EL PAIS APROVECHANDO QUE EL FICHERO ESTA
        if (isset($_POST["pais"]) && $_POST["pais"] == $datos_primera_col[2]) {
            $datos_pais_seleccionado = $datos_linea;
        }
    }

    fclose($fd);

    ?>

    <form action="ejer6.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="pais">Seleccione un país</label>
            <select name="pais" id="pais">
                <?php
                for ($i = 0; $i < count($paises); $i++) {
                    // HACER QUE NO SE BORRE LO SELECCIONADO
                    if (isset($_POST["pais"]) && $_POST["pais"] == $paises[$i])
                        echo "<option selected value='" . $paises[$i] . "'>" . $paises[$i] . "</option>";
                    else
                        echo "<option value='" . $paises[$i] . "'>" . $paises[$i] . "</option>";
                }
                ?>
            </select>
        </p>

        
        <p><button type="submit" name="btnBuscar">Buscar</button></p>
        

    </form>

    <?php
    if (isset($_POST["btnBuscar"])) {
        echo "<h2>País: " . $_POST["pais"] . "</h2>";
        $datos_primera_fila = explode("\t", $primera_linea);
        // COJO LOS AÑOS
        $n_anios = count($datos_primera_fila) - 1;

        echo "<table>";
        // PRIMERA FILA
        echo "<tr>";
        for ($i = 0; $i <= $n_anios; $i++) {
            echo "<th>" . $datos_primera_fila[$i] . "</th>";
        }
        echo "</tr>";

        // PAIS SELECICONADO
        echo "<tr>";
        for ($i = 0; $i <= $n_anios; $i++) {
            if (isset($datos_pais_seleccionado[$i]))
                echo "<td>" . $datos_pais_seleccionado[$i] . "</td>";
            else
                echo "<td></td>";
        }
        echo "</tr>";
        echo "</table>";
    }
    ?>

</body>

</html>