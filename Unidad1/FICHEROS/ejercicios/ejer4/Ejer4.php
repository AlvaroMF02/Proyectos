<?php 
if (isset($_POST["enviar"])) {
    // SI NO HA MANDADO NADAS, SI TIENE ALGUN ERROR
    $errorText = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);


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
        
        <label for="fich">Suba un archivo de texto</label>
        <input type="file" accept="txt*/" name="archivo" id="fich">

        <button type="submit" name="enviar"></button>

    </form>

</body>

</html>