<?php 
if (isset($_POST["enviar"])) {

    // $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);


    // SI TIENE UN ERROR DE ARCHIVO
    $errorArchivo = $_FILES["archivo"]["error"];
    
    // SI EL FORMATO ES CORRECTO?
    $errorFormato = !getimagesize($_FILES["archivo"]["tmp_name"]);

    // SI SUPERA EL TAMAÑO
    $errorTaman = $_FILES["archivo"]["size"] > 2500 * 1024;
    
    $errorSubidaTxt = $errorArchivo ||  $errorFormato|| $errorTaman;
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
    <form action="Ejer4.php" method="post">
        <h1>Ejercicio 4</h1>
        
        <label for="fich">Suba un archivo de texto (Max. 2,5 Mb)</label>
        <input type="file" accept="txt*/" name="archivo" id="fich">
        <?php 
            if (isset($_POST["enviar"]) && $errorSubidaTxt) {
                if ($errorArchivo) {
                    echo "<span class=error>No se ha podido subir el archivo</span>";
                }
                if ($errorFormato) {
                    echo "<span class=error>El formato debe ser .txt</span>";
                }
                if ($errorTaman) {
                    echo "<span class=error>El archivo es demasiado grande</span>";
                }
            }
        ?>

        <br><button type="submit" name="enviar">Contar letras</button>

    </form>

</body>

</html>