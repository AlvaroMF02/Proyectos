<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 POO</title>
</head>

<body>
    <h1>Ejercicio 3 POO</h1>

    <?php
    // usar la clase fruta
    require "classFruta.php";

    echo "<h2>Informacion de las frutas:</h2>";
    // llamar a un metodo estático (de clase)
    echo "<p>Frutas creadas hasta le momento ".Fruta::cuantaFruta()."</p>";

    // crear una variable Fruta con el constructor (el mismo llama a un metodo)
    $pera = new Fruta("Verde", "Mediano");
    $manzana = new Fruta("Roja", "Mediano");
    $fresa = new Fruta("Roja", "Pequeña");
    $melon = new Fruta("Amarillo", "Grande");

    echo "<p>Frutas creadas hasta le momento ".Fruta::cuantaFruta()."</p>";

    // Destruir una de las frutas
    echo "<p>Destruyendo la manzana</p>";
    unset($manzana);

    echo "<p>Frutas creadas hasta le momento ".Fruta::cuantaFruta()."</p>";

    ?>

</body>

</html>