<?php
if (isset($_POST["enviar"])) {
    // IMPORTA EL ORDEN, NO ESTA VACIO, ES UN NUMERO Y ESTA ENTRE 1 Y 10
    $errorForm = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] <= 0 || $_POST["numero"] > 10;
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>
    <form action="Ejer2.php" method="post">
        <h1>Ejercicio 2</h1>
        <p>
            <label for="num">Introduzca un numero del 1 al 10</label><br>
            <input type="text" name="numero" id="num" value="<?php if (isset($_POST["numero"])) echo $_POST["numero"] ?>">
            <?php
            if (isset($_POST["enviar"]) && $errorForm) {
                if ($_POST["numero"] == "") {
                    echo "<span class=error>* Campo vacio *</span>";
                } else {
                    echo "<span class=error>* No has introducido un número *</span>";
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="enviar">Leer tablas</button>
        </p>


    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorForm) {
        $nombreFic = "tabla_" . $_POST["numero"] . ".txt";

        if (file_exists("Tablas/" . $nombreFic)) {

            $fd = fopen("Tablas/" . $nombreFic, "r");
            if (!$fd) {
                die("<p>No se ha podido abrir el fichero Tablas/" . $nombreFic . "</p>");
            }
            echo "<h3>Tabla del " . $_POST["numero"] . "</h3>";
            $linea = fgets($fd);
            while ($linea = fgets($fd)) {
                echo $linea . "<br>";
            }
            fclose($fd);
        } else {
            echo "<p>El fichero no existe </p>";
        }
    }
    ?>
</body>

</html>