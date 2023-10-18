<?php
if (isset($_POST["enviar"])) {

    // NO SE HA SELECCIONADO ARCHIVO
    $errorVacio = $_FILES["archivo"]["name"] == "";

    // SI NO ES TXT
    $errorFormato = $_FILES["archivo"]["type"] != "text/plain";

    // SI TIENE UN ERROR DE ARCHIVO
    $errorArchivo = $_FILES["archivo"]["error"];

    // SI SUPERA EL TAMAÑO
    $errorTaman = $_FILES["archivo"]["size"] > 2500 * 1024;

    $errorForm = $errorVacio || $errorArchivo ||  $errorFormato || $errorTaman;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>
    <h1>Ejercicio 4</h1>

    <form action="Ejer4.php" method="post" enctype="multipart/form-data">

        <label for="fich">Suba un archivo de texto (Max. 2'5 MB)</label>
        <input type="file" accept=".txt" name="archivo" id="fich">

        <?php
        if (isset($_POST["enviar"]) && $errorForm) {
            if ($errorVacio) {
                echo "<span class=error>**</span>";

            }else if ($errorArchivo) {
                echo "<span class=error>* No se ha podido subir el archivo *</span>";
            }else if ($errorFormato) {
                echo "<span class=error>* El formato debe ser .txt *</span>";
            }else{
                echo "<span class=error>* El tamaño es superior *</span>";
            }
        }
        ?>

        <br><button type="submit" name="enviar">Contar palabras</button>

    </form>

    <?php
        if (isset($_POST["enviar"]) && !$errorForm) {
            // CON METODO
            //$contenidoFich = file_get_contents($_FILES["archivo"]["tmp_name"]);

            // SIN METODO
            @$fd=fopen($_FILES["archivo"]["tmp_name"],"r");
            if (!$fd) {
                die ("No se puede abrir el archivo");
            }
            
            $nPalabras = 0;

            while($linea = fgets($fd)){
                $nPalabras += str_word_count($linea);
            }

            echo "<h3>El archivo tiene ".$nPalabras."</h3>";
        }
    ?>

</body>

</html>