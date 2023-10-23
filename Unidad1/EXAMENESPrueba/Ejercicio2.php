<?php
if (isset($_POST["enviar"])) {

    // NO SE HA SELECCIONADO ARCHIVO
    $errorVacio = $_FILES["fichero"]["name"] == "";

    // SI TIENE UN ERROR DE ARCHIVO
    $errorArchivo = $_FILES["fichero"]["error"];

    // SI NO ES TXT
    $errorFormato = $_FILES["fichero"]["type"] != "text/plain";

    // SI SUPERA EL TAMAÑO
    $errorTaman = $_FILES["fichero"]["size"] > 1000 * 1024;

    $errorForm = $errorVacio || $errorArchivo ||  $errorFormato || $errorTaman;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer 2</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 2 Examen</h1>
    <form action="Ejercicio2.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="fich">Suba un fichero (MAX. 1MB)</label>
            <input type="file" name="fichero" id="fich">
            <?php
            if (isset($_POST["enviar"]) && $errorForm) {
                if ($errorVacio) {
                    echo "<span class=error>**</span>";
                } else if ($errorArchivo) {
                    echo "<span class=error>* No se ha podido subir el archivo *</span>";
                } else if ($errorFormato) {
                    echo "<span class=error>* El formato debe ser .txt *</span>";
                } else {
                    echo "<span class=error>* El tamaño es superior *</span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="enviar">Enviar</button>

    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorForm) {

        echo "<h2>Respuesta</h2>";

        @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Ficheros/archivo.txt");

        if ($var) {
            echo "<p>Subido con exito</p>";
        } else {
            echo "<p>no se ha podido subir</p>";
        }
    }
    ?>
</body>

</html>