<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 POO</title>
</head>

<body>
    <h1>Ejercicio 2 POO</h1>

    <?php
    // usar la clase fruta
    require "classFruta.php";

    echo "<h2>Informacion de la fruta:</h2>";

    // crear una variable Fruta con el constructor (el mismo llama a un metodo)
    $pera = new Fruta("Verde", "Mediano");

    ?>

</body>

</html>