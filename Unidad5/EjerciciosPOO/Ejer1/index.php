<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 POO</title>
</head>
<body>
    <h1>Ejercicio 1 POO</h1>

    <?php
    // usar la clase fruta
    require "classFruta.php";

    // crear una variable Fruta (sin constructor)
    $pera = new Fruta();

    $pera->setColor("Verde");
    $pera->setTamanyo("Mediana");

    echo "<h2>Informacion de la fruta:</h2>";
    echo "<p><strong>Color: </strong>".$pera->getColor()."<br><strong>Tamaño: </strong>".$pera->getTamanyo()."</p>";

    ?>

</body>
</html>