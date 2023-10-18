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
    <title>Ejercicio 5</title>
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

        <h1>PIR per cápita Europa</h1>
        <form action="ejer6.php" method="post">

        <p>
        <label for="pais">Indique el país que quiere buscar</label><br>
        <input type="text" name="pais" id="pais">
        <?php
            if (isset($_POST["enviar"]) && $errorForm) {
                if ($_POST["enviar"]=="") {
                    echo "<span class=error>* El campo está vacío *</span>";
                }else{
                    echo "<span class=error>* Introduzca letras *</span>";
                }
            }
        ?>
        </p>
        <button type="submit" name="enviar">Buscar datos</button>

        </form>

    <?php
        @$fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

        if (!$fd) {
            die("No se puede abrir el archivo");
        } else {

            $linea = fgets($fd);
            $datosFila = explode("\t", $linea);
            $nColumnas = count($datosFila);
            echo "<table>";
            echo "<tr>";
            for ($i = 0; $i < $nColumnas; $i++) {
                echo "<th>" . $datosFila[$i] . "</th>";
            }
            echo "</tr>";

            while ($linea = fgets($fd)) {
                $datosFila = explode("\t", $linea);
                echo "<tr>";
                echo "<th>" . $datosFila[0] . "</th>";

                for ($i = 1; $i < $nColumnas; $i++) {
                    if (isset($datosFila[$i])) {
                        echo "<td>" . $datosFila[$i] . "</td>";
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    fclose($fd);
    ?>

</body>

</html>