<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 POO</title>
</head>

<body>
    <h1>Ejercicio 4 POO</h1>

    <?php
    // usar la clase fruta
    require "classUva.php";

    echo "<h2>Herencia de Fruta a Uva:</h2>";

    // crear una uva que tiene semillas
    $uva = new Uva("Morada","Pequeña",true);

    echo "<h3>Informacion de la uva creada:</h3>";

    if($uva->tieneSemilla()){
        echo "<p><strong>Color: </strong>".$uva->getColor()."<br><strong>Tamaño: </strong>".$uva->getTamanyo()." <br> Tiene semillas</p>";

    }else{
        echo "<p><strong>Color: </strong>".$uva->getColor()."<br><strong>Tamaño: </strong>".$uva->getTamanyo()." <br> No tiene semillas</p>";
    }


    ?>

</body>

</html>